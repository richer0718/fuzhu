<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    public function login(){
        return view('admin/login');

    }
    public function loginout(Request $request){
        $request->session()->flush();
        return redirect('admin/login');
    }

    public function loginRes(Request $request){
        $username = $request -> input('username');
        $password = $request -> input('password');
        $res = DB::table('admin') -> where([
            'username'=>$username,
            'password'=>$password,
            'type' => '1'
        ]) -> first();
        //dd($res);
        $res = (array)$res;
        if($res){

            session([
                'admin_username' => $res['username'],
                'type' => 'manage',
            ]); //储存登陆标志

            return redirect('admin/number')->with('status', 'success');
        }else{
            return redirect('admin/login')->with('status', 'error');
        }
        //var_dump($res);
    }

    public function index(Request $request){
        if(!session('username')){
            return redirect('admin/login');
        }
        //dd(session('username'));
        return view('admin/index');
    }

    //玩家获取
    public function getData(){
        $customer_number = '';
        $customer_area = '';
        if(Cookie::has('customer_name')){
            $customer_number = Cookie::get('customer_name');
        }
        if(Cookie::has('customer_area')){
            $customer_area = Cookie::get('customer_area');
        }

        $areas = [
            'AZQQ' => '安卓QQ',
            'AZVX' => '安卓微信',
            'IOSQQ' => '苹果QQ',
            'IOSVX' => '苹果微信',
        ];
        return view('admin/getdata') -> with([
            'areas' => $areas,
            'customer_number' => $customer_number,
            'customer_area' => $customer_area
        ]);
    }

    public function chaxunRes(Request $request){
        $statuss = [
            '0' => '正常刷完',
            '1' => '排队等待',
            '2' => '正在登陆',
            '3' => '正常挂机',
            '4' => '健康系统',
            '5' => '成功登陆',
            '6' => '领取奖励',
            '13' => '选择好友',
            '12' => '微信二维码',
            '11' => '手机验证码',
            '-1' => '手动停挂',
            '-2' => '密码错误',
            '-3' => '地图未过',
            '-4' => '防沉迷',
            '-5' => '账号冻结',
            '-6' => '未关闭登陆保护',
            '-7' => '新号',
            '-8' => '授权超时',
            '-9' => '刷图限制',
            '21' => '内部错误',
            '-20' => '验证失败',
            '-21' => '点数不足',
        ];
        $res = DB::table('number') -> where([
            'number' => $request -> input('number'),
            'area' => $request -> input('area'),
        ]) -> first();
        if($res){
            $res -> status_name = $statuss[$res -> status];
        }

        return redirect('getData') -> with('res',$res)->cookie('customer_name',$request -> input('number')) -> cookie('customer_area',$request->input('area'));;
    }

    public function yanzhengma(Request $request){
        $res = DB::table('number') -> where([
            'id' => $request -> input('yanzheng_id')
        ]) -> update([
            'yanzhengma' => $request -> input('yanzhengma')
        ]);
        if($res){
            echo 'success';
        }else{
            echo 'error';
        }
        return redirect('manage/number') -> with('yanzhengma','success');

    }




}
