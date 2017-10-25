<!doctype html>
<html lang="zh-CN">
<head>
    @include('layouts.common_admin')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/login.css')}}">
</head>

<body class="user-select">
<div class="container">
    <div class="siteIcon"><img src="{{asset('admin/images/icon/icon.png')}}" alt="" data-toggle="tooltip" data-placement="top" title="欢迎使用飞飞辅助系统" draggable="false" /></div>
    <form action="{{url('chaxunRes')}}" method="post" autocomplete="off" >

        <div class="modal-content" style="width:80%;margin:0 auto;">
            <div class="modal-header">
                <h4 class="modal-title" >查询</h4>
            </div>
            <div class="modal-body">
                <table class="table" style="margin-bottom:0px;">
                    <thead>
                    <tr> </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td wdith="20%">账号:</td>
                        <td width="80%"><input type="text" value="{{ $customer_number }}" class="form-control" name="number" maxlength="" autocomplete="off" required/></td>
                    </tr>
                    <tr>
                        <td wdith="20%">大区:</td>
                        <td width="80%">
                            <select name="area" class="form-control" style="margin-top:10px;">

                                <option value="">请选择</option>
                                @foreach($areas as $k => $vo)
                                    <option value="{{ $k }}" @if($customer_area == $k) selected @endif >{{ $vo }}</option>
                                @endforeach

                            </select>
                        </td>
                    </tr>


                    {{ csrf_field() }}
                    </tbody>
                    <tfoot>
                    <tr></tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary">确认</button>
            </div>
        </div>







        {{ csrf_field() }}
    </form>
    <!--
    <div class="footer">
        <p><a href="{{url('admin/index')}}" data-toggle="tooltip" data-placement="left" title="不知道自己在哪?">回到后台 →</a></p>
    </div>
    -->
</div>

@if( session('res') )
    <div class="modal fade " id="showres" tabindex="-1" role="dialog"  >
        <div class="modal-dialog" role="document" style="width:80%;">
            <form action="{{ url('admin/editDailiRes') }}" method="post" autocomplete="off" draggable="false" id="myForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" >账号信息</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table" style="margin-bottom:0px;">

                            <tbody>

                            <tr>
                                <td width="15%">账号</td>
                                <td width="85%"><input type="text" value="{{ session('res') -> number }}" class="form-control" name="username" maxlength="" autocomplete="off" disabled/></td>
                            </tr>
                            <tr>
                                <td>挂机次数</td>
                                <td><input type="text" value="{{ session('res') -> use_time }}" class="form-control" name="password" maxlength="" autocomplete="off" disabled/></td>
                            </tr>
                            <tr>
                                <td>剩余次数</td>
                                <td><input type="text" value="{{ session('res') -> save_time }}" class="form-control" name="tel" maxlength="" autocomplete="off" disabled/></td>
                            </tr>
                            <tr>
                                <td>挂机设备</td>
                                <td><input type="text" value="{{ session('res') -> device }}" class="form-control" name="qq" maxlength="" autocomplete="off" disabled/></td>
                            </tr>
                            <tr>
                                <td>检测时间</td>
                                <td><input type="text" value="{{ date('Y-m-d H:i',session('res') -> updated_time) }}" class="form-control" name="remark" disabled autocomplete="off" /></td>
                            </tr>
                            <tr>
                                <td>账号状态</td>
                                <td>
                                    @if(session('res') -> status_name == '微信二维码') <a href="{{ 'http://feifeifuzhu.com/jietu/'.session('res')->area.'-'.session('res')->number.'.jpg' }}" target="_blank" style="color:red;">扫描微信二维码</a>
                                    @elseif(session('res') -> status_name == '手机验证码' ) <a href="{{ 'http://feifeifuzhu.com/jietu/'.session('res')->area.'-'.session('res')->number.'.jpg' }}" target="_blank" style="color:red;">查看图片</a> <a class="yanzhengma" data="{{ session('res') -> id }}" style="color:red;">输入验证码</a>
                                    @else
                                        {{ session('res') -> status_name }}
                                    @endif
                                </td>
                            </tr>
                            {{ csrf_field() }}
                            </tbody>
                            <tfoot>
                            <tr></tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">确定</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endif

<!-- 输入手机验证码 -->
<div class="modal fade " id="yanzhengma_input" tabindex="-1" role="dialog"  >
    <div class="modal-dialog" role="document" style="width:80%;">
        <form action="{{ url('customer/yanzhengma') }}" method="post" autocomplete="off" draggable="false" id="myForm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" >请输入手机验证码</h4>
                </div>
                <div class="modal-body">
                    <table class="table" style="margin-bottom:0px;">
                        <thead>
                        <tr> </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td wdith="20%">验证码:</td>
                            <td width="80%"><input type="number" value="" class="form-control" name="yanzhengma" maxlength="" autocomplete="off" required/></td>
                        </tr>

                        <input type="hidden" name="yanzheng_id"  />

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



<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
<script>
    $(function(){
        @if(session('res'))
            $('#showres').modal('show');
        @endif
        @if (session('yanzhengma'))
            alert('输入成功！');
        @endif
        $('.yanzhengma').click(function(){
            var id = $(this).attr('data');
            $('input[name=yanzheng_id]').val(id);
            $('#yanzhengma_input').modal('show')
        })

    })


    var username=document.cookie.split(";")[0].split("=")[1];
    //JS操作cookies方法!
    //写cookies
    function setCookie(name,value)
    {
        var Days = 30;
        var exp = new Date();
        exp.setTime(exp.getTime() + Days*24*60*60*1000);
        document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
    }

    function getCookie(name)
    {
        var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
        if(arr=document.cookie.match(reg))
            return unescape(arr[2]);
        else
            return null;
    }

    function delCookie(name)
    {
        var exp = new Date();
        exp.setTime(exp.getTime() - 1);
        var cval=getCookie(name);
        if(cval!=null)
            document.cookie= name + "="+cval+";expires="+exp.toGMTString();
    }


</script>
</body>
</html>
