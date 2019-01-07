<?php

namespace App\Http\Controllers;

use Auth;
use Log;
use Image;//依赖包的Image静态方法生成缩略图
use App\Model\Power;
use App\Model\Users;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function welcome(){
        $user_info = Users::users_info()->where('name', Auth::user()->name)->first();
        return view('index.welcome', ['user_info' => $user_info]);
    }

    public function index(){
        $power_finfo = Power::power_info()->where('f_id', 0)->get();
        $power_cinfo = Power::power_info()->where('p_url', '!=', '/')->get();
        return view('index.index', ['power_finfo' => $power_finfo, 'power_cinfo' => $power_cinfo]);
    }
}