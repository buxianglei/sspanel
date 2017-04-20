<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Plan;
use App\Events\GenerateOrderEvent;

class OrderController extends Controller
{
    /**
     * 获取订单
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function getOrder(Request $request, User $user)
    {
        $user_id = $request->user()->id;

        $user = $user->where("id", $user_id)->with([
            'order' => function ($q){
                $q->orderBy("id", 'desc')->with([
                    'plan' => function($q) {
                        $q->with('node');
                    }
                ])->limit(1);
            },
            'userAccount'
        ])->first();

        if (!empty($user->order[0]->plan->node->port)) {
            $user->port = $user->order[0]->plan->node->port;
        }

        $user->remaining_transfer = number_format(($user->transfer_enable-($user->u+$user->d))/1024/1024/1024, 2, '.', '');
        $user->transfer           = number_format($user->transfer_enable/1024/1024/1024, 2, '.', '');
        $user->used_transfer      = number_format(($user->u+$user->d)/1024/1024/1024, 2, '.', '');

        if (isset($user->order[0])) {
            $user->url = 'ss://'.base64_encode($user->order[0]->plan->node->crypt_type.':'.$user->passwd.'@'.$user->order[0]->plan->node->host.':'.$user->port);
            return $this->responseSuccess($user);
        } else {
            return $this->responseNotFound($user);
        }
    }

    /**
     * 生成订单
     *
     * @param Request $request
     * @return Response
     */
    public function generateOrder(Request $request, User $user)
    {
        $this->validate($request, [
            'plan_id' => 'required'
        ]);

        $plan_id = $request->input('plan_id');

        $user_id = $request->user()->id;

        $user = $user->find($user_id);

        $amount = $user->userAccount->amount;

        $current_order = $user->order->where("plan_id", $plan_id)->first();

        $plan = Plan::where('id', $plan_id)->first();

        if (empty($plan)) {
            return $this->responseFail('套餐不存在');
        }

        $plan_price = $plan->price;

        if ($amount - $plan_price < 0) {
            return $this->responseFail('您的余额不足以此次购买，请充值');
        };

        if ($plan->once == true && $current_order) {
            return $this->responseFail('此套餐只可订购一次');
        }

        $rsp = event(new GenerateOrderEvent($user, $plan_id));

        return $rsp;
    }
}
