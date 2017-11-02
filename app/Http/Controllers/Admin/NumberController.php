<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NumberController extends Controller
{
    //
    public function index(Request $request){
        //配置
        $areas = [
            'AZQQ' => '安卓QQ',
            'AZVX' => '安卓微信',
            'IOSQQ' => '苹果QQ',
            'IOSVX' => '苹果微信',
        ];
        $maps = [
            'PT' => '普通魔女的回忆',
            'JY' => '精英魔女的回忆',
            'DS' => '大师魔女的回忆',
        ];
        $modes = [
            '关闭','模式一','模式二','模式三'
        ];
        $statuss = [
            '0' => '正常刷完',
            '1' => '排队等待',
            '2' => '正在登陆',
            '3' => '正常挂机',
            '4' => '健康系统',
            '5' => '成功登陆',
            '6' => '领取奖励',
            '13' => '选择好友',
            '11' => '手机验证码',
            '12' => '微信二维码',
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

        //代理统计
        $res_daili = DB::table('daili') -> get();

        //$res_all = DB::table('daili') -> get();
        $count_guaji = 0;
        $count_lishi = 0;
        $count_all = 0;
        $count_point = 0;
        $count_point_all = 0;

        foreach($res_daili as $vo){
            $count_guaji += $vo -> number_guaji;
            $count_lishi += $vo -> number_lishi;
            $count_all += $vo -> number_all;
            $count_point += $vo -> point;
            $count_point_all += $vo -> point_all;
        }

        $res = DB::table('number') -> where(function($query) use($request){
            if($request -> input('number')){
                $query -> where('number','like','%'.trim($request -> input('number')).'%' );
                //dd($request -> input('number'));
            }
            if($request -> input('daili')){
                $query -> where('add_user','like','%'.trim($request -> input('daili')).'%' );
                //dd($request -> input('number'));
            }
            if($request -> input('area')){
                $query -> where('area',trim($request -> input('area')));
            }
            if($request -> input('map')){
                $query -> where('map',trim($request -> input('map')));
            }
            if($request -> input('status')){
                $query -> where('status',trim($request -> input('status')));
            }
        }) -> orderBy('created_time','asc') -> orderBy('save_time','asc') -> paginate(1000);

        foreach($res as $k => $vo){
            $res[$k] -> area = $areas[$vo -> area];
            $res[$k] -> map = $maps[$vo -> map];
            $res[$k] -> mode = $modes[$vo -> mode];
            $res[$k] -> status = $statuss[$vo -> status];
        }

        //挂机中的数量
        $count_guaji = DB::table('number') -> where('status','>',0) -> count();
        $count_paidui = DB::table('number') -> where('status','=',0) -> count();
        return view('admin/number/index') -> with([
            'res' => $res,
            'count_guaji'=>$count_guaji,
            'count_paidui'=>$count_paidui,
            'areas'=>$areas,
            'maps' => $maps,
            'statuss' => $statuss,
            'count_guaji_daili' => $count_guaji,
            'count_lishi' => $count_lishi,
            'count_all' => $count_all,
            'count_point' => $count_point,
            'count_point_all' => $count_point_all,
        ]);
    }
}
