<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\ProfileTransformer;

class ProfileController extends Controller
{
    /**
     * 个人信息转化实例
     * @method __construct
     * @param  ProfileTransformer $profileTransformer
     */
    public $profileTransformer;

    /**
     * 构造方法
     * @method __construct
     * @param  ProfileTransformer $profileTransformer 个人信息转换类
     */
    public function __construct(ProfileTransformer $profileTransformer)
    {
        $this->profileTransformer = $profileTransformer;
    }

    /**
     * 展示用户信息
     * @method show
     * @param  Request $request 请求对象
     * @return Response         返回对象
     */
    public function show(Request $request)
    {
        $user = $request->user();

        $user = $this->profileTransformer->transform($user);

        return $this->responseSuccess($user);
    }

    /**
     * 更新用户信息
     * @method update
     * @param  Request $request 请求对象
     * @param  User    $user    用户对象
     * @return Response         返回对象
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'passwd' => 'required'
        ]);

        $user_id = $request->user()->id;

        $user = $user->find($user_id);

        $is_email = $user->where('email', $request->input('email'))->first();

        if ($is_email && $request->input('email') != $user->email) {
            return $this->responseFail('邮箱已存在');
        }

        $request->input('name') == $user->name ? : $user->name = $request->input('name');
        $request->input('email') == $user->email ? : $user->email = $request->input('email');
        $request->input('passwd') == $user->passwd ? : $user->passwd = $request->input('passwd');

        $rsp = $user->save();

        if ($rsp) {
            return $this->responseSuccess('修改成功');
        } else {
            return $this->responseFail('失败');
        }

    }
}
