@extends('layouts.admin_common')
@section('right-box')

    <style>
        table tr{
            margin-top:5px;
        }
        .laydate_box, .laydate_box * {
            box-sizing:content-box;
        }
        .super{
            font-weight: bolder;
            color:red;
        }
    </style>
    <script src="{{ asset('js/laydate/laydate.js') }}"></script>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" style="height:800px;overflow-y: scroll;padding-bottom:100px;">
        <div class="row">
                <div class="col-md-12">
                    <form method="post">
                        <table class="table" style="width:800px;" >
                            <tr>
                                <td>代理账号：</td>
                                <td style="width:150px;">
                                    <input type="text" name="zhanghao"  class="form-control" value="@if(!empty($_POST['zhanghao'])){{ $_POST['zhanghao'] }}@endif"/>
                                </td>

                                <td>类型</td>
                                <td style="width:100px">
                                    <select name="log_type">
                                        <option value="">请选择</option>
                                        <option value="充值" @if(isset($_POST['log_type']) && $_POST['log_type'] == '充值') selected @endif >充值</option>
                                        <option value="挂机" @if(isset($_POST['log_type']) && $_POST['log_type'] == '挂机') selected @endif >挂机</option>
                                        <option value="违约" @if(isset($_POST['log_type']) && $_POST['log_type'] == '违约') selected @endif >违约</option>
                                        <option value="回收" @if(isset($_POST['log_type']) && $_POST['log_type'] == '回收') selected @endif >回收</option>
                                    </select>
                                </td>

                                <td>起始时间</td>
                                <td style="width:150px">
                                    <input type="text" name="createtime_left"  value="@if(!empty($_POST['createtime_left'])){{ $_POST['createtime_left'] }}@endif" class="form-control"  onclick="laydate({istime: false, format: 'YYYY-MM-DD'})"/>
                                </td>
                                <td>截止时间</td>
                                <td style="width:150px">
                                    <input type="text" name="createtime_right"  value="@if(!empty($_POST['createtime_right'])){{ $_POST['createtime_right'] }}@endif" class="form-control" onclick="laydate({istime: false, format: 'YYYY-MM-DD'})"/>
                                </td>

                            <tr>
                                <td colspan="4">
                                    <button class="btn btn-default" type="submit">搜索</button>
                                    <button class="btn btn-default" type="button" onclick="location.href='{{Request::getRequestUri()}}' ">重置</button>
                                </td>
                            </tr>
                        </table>
                        {{ csrf_field() }}
                    </form>

                    <h1 class="page-header">日志<span class="badge" style="font-size:17px;padding: 7px 10px;">共{{ $count_point }}点</span></h1>

                    <table class="table table-striped table-bordered" style="width:800px;">
                        <tr>
                            <td>日期</td>
                            <td>类型</td>
                            <td>代理账号</td>
                            <td>游戏账号</td>
                            <td>点数</td>
                            <td>备注</td>
                        </tr>
                        @foreach($res as $vo)
                        <tr>
                            <td>{{ date('Y-m-d H:i',$vo -> created_at) }}</td>
                            <td>{{ $vo -> log_type }}</td>
                            <td>{{ $vo -> username }}</td>
                            <td>{{ $vo -> zhanghao }}</td>
                            <td class="{{ $vo -> class_name }}">{{ $vo -> point }}</td>
                            <td>@if($vo -> remark){{ $vo -> remark }}@else{{ $vo -> zhucema }}@endif</td>
                        </tr>
                        @endforeach

                    </table>

                </div>


        </div>
    </div>
    <script>

    </script>


@stop