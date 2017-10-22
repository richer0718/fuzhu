@extends('layouts.admin_common')
@section('right-box')
    <style>
        #mytable tr td{
            border:1px solid #000000;
        }
    </style>
    <script src="{{ asset('js/laydate/laydate.js') }}"></script>
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
            <li><a data-toggle="modal" data-target="#addDaili" >新增代理</a></li>
            <li>
                @if($is_reg == 1)
                    <a id="startReg" style="background-color:darkred;color:white;">开启注册（已关闭）</a>
                @else
                    <a id="stopReg" style="background-color:darkred;color:white;">停止注册（已开启）</a>
                @endif

            </li>
            <li>正在挂机数量：{{$count_guaji}}个</li>
            <li>历史挂机数量：{{$count_lishi}}个</li>
            <li>总账号数量：{{$count_all}}个</li>
            <li>剩余点数：{{$count_point}}</li>
            <li>充值点数：{{$count_point_all}}</li>
        </ol>



        <h1 class="page-header">基本信息 <span class="badge"></span></h1>
        <div class="table-responsive"  >
            <table class="table table-striped table-hover" id="mytable">
                <thead>
                <tr>
                    <th><span class="glyphicon glyphicon-th-large"></span> <span class="visible-lg">ID</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">代理账号</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">qq</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">手机号码</span></th>
                    <th><span class="glyphicon glyphicon-user"></span> <span class="visible-lg">正在挂机数量</span></th>
                    <th><span class="glyphicon glyphicon-signal"></span> <span class="visible-lg">历史挂机数量</span></th>
                    <th><span class="glyphicon glyphicon-camera"></span> <span class="visible-lg">总账号数量</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">剩余点数</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">充值总点数</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">加入时间</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">备注</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">状态</span></th>
                    <th><span class="glyphicon glyphicon-time"></span> <span class="visible-lg">操作</span></th>

                </tr>
                </thead>
                <tbody>
                @unless(!$res)
                    @foreach($res as $k => $vo)
                        <tr>
                            <td>{{ $k + 1 }}</td>
                            <td>{{$vo -> username }}</td>
                            <td>{{$vo -> qq }}</td>
                            <td>{{$vo -> tel }}</td>
                            <td>{{$vo -> number_guaji }}</td>
                            <td>{{$vo -> number_lishi }}</td>
                            <td>{{$vo -> number_all}}</td>
                            <td>{{$vo -> point}}</td>
                            <td>{{$vo -> point_all}}</td>
                            <td>{{ date('Y-m-d H:i',$vo -> created_at) }}</td>
                            <td>{{$vo -> remark}}</td>
                            <td>@if($vo -> status == 1) 冻结 @else 正常 @endif</td>

                            <td>
                                <a class="beizhu" data="{{ $vo -> id }}">备注</a>／<a href="{{ url('admin/editDaili').'/'.$vo -> id }}">修改密码</a>／<a onclick="recharge('{{ $vo -> username }}',{{ $vo -> id }})">充值</a>／@if($vo -> status == 1)<a onclick="huifu({{ $vo -> id }})" style="color:darkred;">恢复</a>@else<a onclick="dongjie({{ $vo -> id }})">冻结</a>@endif
                            </td>

                        </tr>
                    @endforeach
                @endunless
                </tbody>

                @if(count($res))
                <!--tfoot>
                    <tr>

                        <td colspan="14"></td>
                    </tr>
                </tfoot -->
                @endif

            </table>
        </div>
    </div>


    <!-- 备注 -->
    <div class="modal fade " id="beizhu-box" tabindex="-1" role="dialog"  >
        <div class="modal-dialog" role="document" style="width:400px;">
            <form action="{{ url('admin/remark') }}" method="post" autocomplete="off" draggable="false" id="myForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" >备注</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table" style="margin-bottom:0px;">
                            <thead>
                            <tr> </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td width="90%"><input type="text" value="" class="form-control" name="remark" maxlength="" autocomplete="off" required/></td>
                            </tr>
                            <input type="hidden" name="remark_id"  id="remark_id" />
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

    <!-- 新增代理 -->
    <div class="modal fade " id="addDaili" tabindex="-1" role="dialog"  >
        <div class="modal-dialog" role="document" style="width:400px;">
            <form action="{{ url('admin/addDailiRes') }}" method="post" autocomplete="off" draggable="false" id="myForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" >新增代理</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table" style="margin-bottom:0px;">

                            <tbody>

                            <tr>
                                <td width="15%">账号</td>
                                <td width="85%"><input type="text" value="" class="form-control" name="username" maxlength="" autocomplete="off" required/></td>
                            </tr>
                            <tr>
                                <td>密码</td>
                                <td><input type="text" value="" class="form-control" name="password" maxlength="" autocomplete="off" required/></td>
                            </tr>
                            <tr>
                                <td>手机</td>
                                <td><input type="text" value="" class="form-control" name="tel" maxlength="" autocomplete="off" required/></td>
                            </tr>
                            <tr>
                                <td>QQ</td>
                                <td><input type="text" value="" class="form-control" name="qq" maxlength="" autocomplete="off" required/></td>
                            </tr>
                            <tr>
                                <td>备注</td>
                                <td><input type="text" value="" class="form-control" name="remark" maxlength="" autocomplete="off" /></td>
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

    <!-- 修改代理 -->
    @if(session('editdaili'))
    <div class="modal fade " id="editDaili" tabindex="-1" role="dialog"  >
        <div class="modal-dialog" role="document" style="width:400px;">
            <form action="{{ url('admin/editDailiRes') }}" method="post" autocomplete="off" draggable="false" id="myForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" >修改</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table" style="margin-bottom:0px;">

                            <tbody>
                            <input type="hidden" name="id" value="{{ session('editdaili') -> id }}" />
                            <tr>
                                <td width="15%">账号</td>
                                <td width="85%"><input type="text" value="{{ session('editdaili') -> username }}" class="form-control" name="username" maxlength="" autocomplete="off" disabled/></td>
                            </tr>
                            <tr>
                                <td>密码</td>
                                <td><input type="text" value="{{ session('editdaili') -> password }}" class="form-control" name="password" maxlength="" autocomplete="off" required/></td>
                            </tr>
                            <tr>
                                <td>手机</td>
                                <td><input type="text" value="{{ session('editdaili') -> tel }}" class="form-control" name="tel" maxlength="" autocomplete="off" required/></td>
                            </tr>
                            <tr>
                                <td>QQ</td>
                                <td><input type="text" value="{{ session('editdaili') -> qq }}" class="form-control" name="qq" maxlength="" autocomplete="off" required/></td>
                            </tr>
                            <tr>
                                <td>备注</td>
                                <td><input type="text" value="{{ session('editdaili') -> remark }}" class="form-control" name="remark" maxlength="" autocomplete="off" /></td>
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
    @endif

    <!-- 充值  -->
    <div class="modal fade " id="recharge-box" tabindex="-1" role="dialog"  >
        <div class="modal-dialog" role="document" style="width:400px;">
            <form action="{{ url('admin/recharge') }}" method="post" autocomplete="off" draggable="false" id="myForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" >代理充值</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table" style="margin-bottom:0px;">

                            <tbody>

                            <tr>
                                <td width="15%">代理账号</td>
                                <td width="85%"><input type="text" value="" class="form-control"  maxlength="" autocomplete="off"  id="recharge_username_show" disabled=""/></td>
                            </tr>
                            <input type="hidden" name="recharge_id" id="recharge_id" />
                            <input type="hidden" name="recharge_username" id="recharge_username" />
                            <tr>
                                <td>充值点数</td>
                                <td><input type="number" value="" class="form-control" name="recharge_point" maxlength="" autocomplete="off" required/></td>
                            </tr>

                            <tr>
                                <td>备注</td>
                                <td><input type="text" value="" class="form-control" name="recharge_remark" maxlength="" autocomplete="off" /></td>
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

    <script>
        @if (session('remark'))
            alert('备注成功！');
        @endif
        @if (session('chongzhi'))
            alert('重置密码成功！');
        @endif
        @if (session('insertres'))
            alert('添加成功！');
        @endif
        @if (session('dongjie'))
            alert('冻结成功！');
        @endif
        @if (session('huifu'))
            alert('恢复成功！');
        @endif
        @if (session('is_reg'))
            alert('修改成功！');
        @endif
        @if (session('isset'))
            alert('用户已存在！');
        @endif
        @if (session('rechargeres') && session('rechargeres') == 'success')
            alert('充值成功！');
        @endif
        @if (session('rechargeres') && session('rechargeres') == 'error')
            alert('请核对后，再提交，如有疑问，联系QQ：972102275！');
        @endif

        @if(session('editRes'))
            alert('修改成功');
        @endif


    </script>
    <script>
        //冻结账号
        function dongjie(id){
            if(confirm('确认冻结此代理么？')){
                location.href='{{ url('admin/dongjie') }}'+'/'+id;
            }
        }
        //恢复账号
        function huifu(id){
            if(confirm('确认恢复此代理么？')){
                location.href='{{ url('admin/huifu') }}'+'/'+id;
            }
        }
        //重置密码
        function chongzhi(id){
            if(confirm('确认重置密码么？')){
                location.href='{{ url('admin/chongzhi') }}'+'/'+id;
            }
        }

        //充值
        function recharge(username,id){
            $('#recharge_username').val(username);
            $('#recharge_username_show').val(username);
            $('#recharge_id').val(id);

            $('#recharge-box').modal('show');
        }

        $(function(){
            @if(session('editdaili'))
            $('#editDaili').modal('show');
            @endif



            //备注
            $('.beizhu').click(function(){
                var id = $(this).attr('data');
                $('#remark_id').val(id);
                $('#beizhu-box').modal('show')
            })

            //停止注册
            $('#stopReg').click(function(){
                if(confirm('确定要停止注册么？')){
                    location.href='{{ url('admin/changeReg') }}'+'/1';
                }
            })
            //开启注册
            $('#startReg').click(function(){
                if(confirm('确定要开启注册么？')){
                    location.href='{{ url('admin/changeReg') }}'+'/0';
                }
            })








            //数据验证
            $('#myForm').submit(function(){

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