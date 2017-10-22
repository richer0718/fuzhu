<?php

namespace App\Http\Controllers\Admin;

use App\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    //获取账号情况 api/getNumberData/{number}/{area}

    public function getNumberData($number,$area){
        $res = DB::table('number') -> select(
            'add_user',
            'number',
            'pass',
            'area',
            'use_time',
            'save_time',
            'map',
            'mode',
            'status',
            'device',
            'updated_time'
        ) -> where([
            'number' => $number,
            'area' => $area
        ]) -> first();

        if($res){
            $str = implode(',',(array)$res);
            echo $str;
        }else{
            echo 'error';
        }

    }

    //获取验证码
    public function getCode($number,$area){
        $res = DB::table('number') -> select(
            'yanzhengma'
        ) -> where([
            'number' => $number,
            'area' => $area
        ]) -> first();
        if($res){
            echo $res -> yanzhengma;
        }else{
            echo 'error';
        }
    }



    //修改消耗次数，剩余次数   updateNumber/{number}/{area}/{save_time}/{map}/{mode}/{status}/{device}
    public function updateNumber($number,$area,$save_time,$map,$mode,$status,$device){
        $res = DB::table('number') -> where([
            'number' => $number,
            'area' => $area
        ]) -> update([
            'save_time' => $save_time,
            'map' => $map,
            'mode' => $mode,
            'status' => $status,
            'device' => $device,
            'updated_time' => time()
        ]);

        if($res){
            echo 'success';
        }else{
            echo 'error';
        }

    }



    //回收点数  recoverPoint/{number}/{area}/{point}
    public function recoverPoint($number,$area,$point){
        //看下这个账号存在不存在
        $number_info = DB::table('number') -> where([
            'number' => $number,
            'area' => $area
        ]) -> first();

        if($number_info){

            DB::table('number') -> where([
                'number' => $number,
                'area' => $area
            ]) -> update([
                //剩余次数变为0
                'save_time' => 0,
                'updated_time' => time()
            ]);


            //代理的剩余点数增加
            //挂机中数量-一 历史数量+1
            DB::table('daili') -> where([
                'username' => $number_info -> add_user
            ]) -> increment('point',intval($point));
            DB::table('daili') -> where([
                'username' => $number_info -> add_user
            ]) -> increment('number_lishi');
            DB::table('daili') -> where([
                'username' => $number_info -> add_user
            ]) -> decrement('number_guaji',intval($point));


            //记录回收日志
            $log = new Log();
            $log -> write($number_info -> add_user,'回收',intval($point),'','','');
            echo 'success';
        }else{
            echo 'error';
        }


    }






}
