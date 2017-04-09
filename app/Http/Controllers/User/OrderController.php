<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class OrderController extends Controller
{
    public function getOrder(Request $request, User $user)
    {
        $user_id = $request->user()->id;

        $user = $user->where("id", $user_id)->with([
            'order' => function ($q){
                $q->with([
                    'plan' => function($q) {
                        $q->with('node');
                    }
                ]);
            },
            'userAccount'
        ])->first();

        $user->remaining_transfer = number_format(($user->transfer_enable-($user->u+$user->d))/1024/1024/1024, 2, '.', '');
        $user->transfer           = number_format($user->transfer_enable/1024/1024/1024, 2, '.', '');
        $user->used_transfer      = number_format(($user->u+$user->d)/1024/1024/1024, 2, '.', '');
        
        if (isset($user->order[0])) {
            $user->url = 'ss://'.base64_encode($user->order[0]->plan->node->crypt_type.':'.$user->passwd.'@'.$user->order[0]->plan->node->host.':'.$user->port);
            return $this->responseSuccess($user);
        } else {
            return $this->responseFail("暂无套餐");
        }
    }
}
