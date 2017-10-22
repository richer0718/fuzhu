@extends('layouts.admin_common')
@section('right-box')
    <style>
        #mytable tr td{
            border:1px solid #000000;
        }
    </style>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" style="max-height:800px;overflow: scroll;" >


        <!--
        <form method="post">
        <table class="table">
            <tr>
                <td>订单号：</td>
                <td>
                    <input type="text" name="orderid"  class="form-control" value="@if(!empty($_POST['orderid'])){{ $_POST['orderid'] }}@endif"/>
                </td>

                <td>收货人姓名</td>
                <td>
                    <input type="text" name="ordername"  class="form-control" value="@if(!empty($_POST['ordername'])){{ $_POST['ordername'] }}@endif" />
                </td>

                <td>配送方式</td>
                <td>
                    <select name="peisong">
                        <option value="0">货物自提</option>
                        <option value="1">送货上门</option>
                    </select>
                </td>

                <td>发货状态</td>
                <td>
                    <select name="status">
                        <option value="0">待收货</option>
                        <option value="1">待评价</option>
                        <option value="2">已完成</option>
                        <option value="3">退货／退款</option>
                    </select>
                </td>



            </tr>
            <tr>
                <td>售后状态</td>
                <td>
                    <select name="shouhou">
                        <option value="">请售后</option>
                        <option value="1">申请售后</option>
                        <option value="0">未售后</option>
                    </select>
                </td>
                <td>订单起始时间</td>
                <td>
                    <input type="text" name="createtime_left"  value="@if(!empty($_POST['createtime_left'])){{ $_POST['createtime_left'] }}@endif" class="form-control" onclick="laydate({istime: false, format: 'YYYY-MM-DD'})"/>
                </td>
                <td>订单截止时间</td>
                <td>
                    <input type="text" name="createtime_right"  value="@if(!empty($_POST['createtime_right'])){{ $_POST['createtime_right'] }}@endif" class="form-control" onclick="laydate({istime: false, format: 'YYYY-MM-DD'})"/>
                </td>
            </tr>
            <tr>
                <td colspan="7">
                    <button class="btn btn-default" type="submit">搜索</button>
                    <button class="btn btn-default" type="button" onclick="location.href='{{Request::getRequestUri()}}' ">重置</button>
                    <button class="btn btn-default" type="button">导出</button>
                </td>
            </tr>
        </table>
            {{ csrf_field() }}
        </form>
-->

        <ol class="breadcrumb">
            <li><a href="{{ url('admin/addNotice') }}">发布公告</a></li>
        </ol>


        <h1 class="page-header">公告列表 <span class="badge"></span></h1>
        <div class="table-responsive"  >
            <table class="table table-striped table-hover" id="mytable">
                <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">标题</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">发布时间</span></th>
                    <th><span class="glyphicon glyphicon-signal"></span> <span class="visible-lg">是否置顶</span></th>

                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">操作</span></th>

                </tr>
                </thead>
                <tbody>
                @unless(!$res)
                    @foreach($res as $k => $vo)
                        <tr>
                            <td>{{ $k + 1 }}</td>
                            <td>{{$vo -> title }}</td>
                            <td>{{ date('Y-m-d H:i',$vo -> updated_at) }}</td>
                            <td>@if($vo -> is_top == 1)置顶@else不置顶@endif</td>
                            <td>
                                <a href="{{ url('admin/detail').'/'.$vo -> id }}">查看</a>
                                <a href="{{ url('admin/edit').'/'.$vo -> id }}">修改</a>
                                <a class="delete_data" data="{{ $vo -> id }}">删除</a>
                            </td>

                        </tr>
                    @endforeach
                @endunless
                </tbody>

            </table>
        </div>
    </div>
    <!-- 充值 -->
    <div class="modal fade " id="recharge" tabindex="-1" role="dialog"  >
        <div class="modal-dialog" role="document" style="width:900px;">
            <form action="{{ url('manage/rechargeRes') }}" method="post" autocomplete="off" draggable="false" id="myForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" >充值</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table" style="margin-bottom:0px;">
                            <thead>
                            <tr> </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td wdith="10%">充值码:</td>
                                <td width="90%"><input type="text" value="" class="form-control" name="code" maxlength="" autocomplete="off" required/></td>
                            </tr>

                            {{ csrf_field() }}
                            </tbody>
                            <tfoot>
                            <tr></tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary">确认</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- 确认充值 -->
    <div class="modal fade " id="recharge_true" tabindex="-1" role="dialog"  >
        <div class="modal-dialog" role="document" style="width:400px;">
            <form action="{{ url('manage/rechargeConfirm') }}" method="post" autocomplete="off" draggable="false" id="myForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" >{{ session('username') }} ，您确认充值么？</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table" style="margin-bottom:0px;">
                            <thead>
                            <tr> </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td colspan="2">
                                    <p style="font-size: 20px;">该充值码点数为:{{ session('recharge_true')['point'].'点' }}</p>
                                </td>
                            </tr>
                            <input type="hidden" name="code" value="{{ session('recharge_true')['code'] }}" />

                            {{ csrf_field() }}
                            </tbody>
                            <tfoot>
                            <tr></tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary">确认</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- 停挂 -->
    <div class="modal fade " id="stopnumber" tabindex="-1" role="dialog"  >
        <div class="modal-dialog" role="document" style="width:400px;">
            <form action="{{ url('manage/stopNumber') }}" method="post" autocomplete="off" draggable="false" id="myForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" >提醒</h4>
                    </div>
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="number_id" />
                    <div class="modal-body">

                        <h4 class="modal-title" >您将手动停止代挂。该账号剩余挂机次数为：<a id="numbertime"></a>次，未使用部分，将回收。中途停挂违约费用扣除100点</h4>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary">确认</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        @if (session('insertres'))
            alert('添加成功！');
        @endif
        @if (session('editres'))
            alert('修改成功！');
        @endif
        @if (session('deleteres'))
            alert('删除成功！');
        @endif
        @if (session('rechargeres') && session('rechargeres') == 'success')
            alert('充值成功！');
        @endif
        @if (session('rechargeres') && session('rechargeres') == 'error')
            alert('请核对后，再提交，如有疑问，联系QQ：972102275！');
        @endif

    </script>
    <script>
        $(function(){
            //删除
            $('.delete_data').click(function(){
                var id = $(this).attr('data');
                if(confirm('确认删除么？')){
                    location.href='{{ url('admin/delete_notice') }}'+'/'+id;
                }
            })
            //数据验证
            $('#myForm').submit(function(){
                var length = $.trim( $('input[name=code]').val() ).length ;
                if( length != 16 ){
                    alert('充值码有误');return false;
                }
            })

            @if (session('recharge_true'))
                $('#recharge_true').modal('show')
            @endif


            @if (session('isset'))
                alert('{{ session('isset') }}');
            @endif

            @if (session('delete_number') && session('delete_number') == 'success')
                alert('删除成功');
            @endif

            @if (session('delete_number') && session('delete_number') == 'error')
                alert('该账号挂机信息已经变动，请刷新页面后重试！');
            @endif

            //删除数据
            $('.delete_number').click(function(){
                var id  = $(this).attr('data');
                if(confirm('您确定要删除么')){
                    location.href="{{ url('manage/delete_number') }}"+'/'+id;
                }
            })




        })

        function tinggua (sh){
            $('#number_id').val($(sh).attr('number'));
            //将剩余挂机次数显示
            $('#numbertime').text($(sh).attr('data'));
            $('#stopnumber').modal('show');
        }

    </script>
@stop