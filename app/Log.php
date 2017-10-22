<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'recharge_log';
    protected $fillable = ['id','username','log_type','point','zhanghao','zhucema'];

    public $timestamps = true;

    public  function getDateFormat(){
        return time();
    }

    public  function asDateTime($value){
        return $value;
    }

    //记录日志
    public function write($username = '',$type = '' ,$point = 0,$zhanghao = '',$zhucema = '',$remark = ''){

        $this -> username = $username;
        $this -> log_type = $type;
        $this -> point = $point;
        $this -> zhanghao = $zhanghao;
        $this -> zhucema = $zhucema;
        $this -> remark = $remark;
        $this -> save();
    }
}
