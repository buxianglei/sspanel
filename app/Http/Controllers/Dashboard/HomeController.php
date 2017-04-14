<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    
    /**
     * 检测是否登陆
     *
     * @param Request $request
     * @return User|Boolean
     */
    public function isLogin (Request $request) {
        if ($request->user()) {
            $request->user()->avatar = 'https://www.gravatar.com/avatar/' . md5( $request->user()->email );
            return $this->responseSuccess($request->user());
        } else {
            return $this->responseFail('未登录');
        }
    }
}
