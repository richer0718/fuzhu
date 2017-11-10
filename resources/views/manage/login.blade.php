<!doctype html>
<html lang="zh-CN">
<head>
    @include('layouts.common_admin')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/login.css')}}">
</head>

<body class="user-select">
<div class="container">
    <div class="siteIcon"><img src="{{asset('admin/images/icon/icon.png')}}" alt="" data-toggle="tooltip" data-placement="top" title="欢迎使用飞飞辅助系统" draggable="false" /></div>
    <form action="{{url('manage/loginRes')}}" method="post" autocomplete="off" class="form-signin">
        <h2 class="form-signin-heading">登录</h2>
        <label for="userName" class="sr-only">用户名</label>
        <input type="text" id="userName" name="username" class="form-control" placeholder="请输入用户名" required autofocus autocomplete="off" maxlength="10">
        <label for="userPwd" class="sr-only">密码</label>
        <input type="password" id="userPwd" name="password" class="form-control" placeholder="请输入密码" required autocomplete="off" maxlength="18">

        <!--
        <select name="type" class="form-control" style="margin-bottom:10px;">
            <option value="0">平台管理员</option>
            <option value="1">社区管理员</option>
        </select>
        -->

        <a><button class="btn btn-lg btn-primary btn-block" type="submit" id="signinSubmit">登录</button></a><br>
        <a><button class="btn btn-lg btn-primary btn-block" type="button" id="reg">注册</button></a><br>
        <a><button class="btn btn-lg btn-primary btn-block" type="button" id="findpass">找回密码</button></a>
        {{ csrf_field() }}
    </form>
    <!--
    <div class="footer">
        <p><a href="{{url('admin/index')}}" data-toggle="tooltip" data-placement="left" title="不知道自己在哪?">回到后台 →</a></p>
    </div>
    -->
</div>
<!-- 注册 -->
<div class="modal fade " id="reg-box" tabindex="-1" role="dialog"  >
    <div class="modal-dialog" role="document" style="width:400px;">
        <form action="{{ url('manage/regRes') }}" method="post" autocomplete="off" draggable="false" id="myForm" onsubmit="return chekform()">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" >请准确填写信息</h4>
                </div>
                <div class="modal-body">
                    <table class="table" style="margin-bottom:0px;">
                        <thead>
                        <tr> </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td width="25%">用户名:</td>
                            <td width="75%">
                                <input type="text"  class="form-control" name="username" value="{{ old('username') }}" maxlength="10" autocomplete="off" required/>
                            </td>
                        </tr>
                        <tr>
                            <td>密码:</td>
                            <td>
                                <input type="password" value="" class="form-control" name="newpassword" maxlength="" autocomplete="off" required/>
                            </td>
                        </tr>
                        <tr>
                            <td>请重复密码:</td>
                            <td>
                                <input type="password" value="" class="form-control" name="repassword" maxlength="" autocomplete="off" required/>
                            </td>
                        </tr>
                        <tr>
                            <td>QQ:</td>
                            <td>
                                <input type="number"  class="form-control" name="qq" value="{{ old('qq') }}" minlength="8" maxlength="11" autocomplete="off" required/>
                            </td>
                        </tr>
                        <tr>
                            <td>手机号码:</td>
                            <td>
                                <input type="number" class="form-control" name="tel" value="{{ old('tel') }}" maxlength="" autocomplete="off" required/>

                            </td>
                        </tr>
                        <tr>
                            <td>验证码:</td>
                            <td>
                                <input type="text" class="form-control" name="code" value="{{ old('code') }}" maxlength="" autocomplete="off" required/>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <img src="{{ url('captcha') }}" onclick="this.src='{{ url('captcha/mews') }}?r='+Math.random();" alt="">
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">确认</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade " id="findpass-box" tabindex="-1" role="dialog"  >
    <div class="modal-dialog" role="document" style="width:400px;">
        <form action="{{ url('manage/findPass') }}" method="post" autocomplete="off" draggable="false" id="myTwoForm" onsubmit="return chekform2()">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" >请准确填写信息</h4>
                </div>
                <div class="modal-body">
                    <table class="table" style="margin-bottom:0px;">
                        <thead>
                        <tr> </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td width="25%">用户名:</td>
                            <td width="75%">
                                <input type="text"  class="form-control" name="username2" value="{{ old('username2') }}" maxlength="" autocomplete="off" required/>
                            </td>
                        </tr>
                        <tr>
                            <td>新密码:</td>
                            <td>
                                <input type="password" value="" class="form-control" name="newpassword2" maxlength="" autocomplete="off" required/>
                            </td>
                        </tr>
                        <tr>
                            <td>请重复密码:</td>
                            <td>
                                <input type="password" value="" class="form-control" name="repassword2" maxlength="" autocomplete="off" required/>
                            </td>
                        </tr>

                        <tr>
                            <td>手机号码:</td>
                            <td>
                                <input type="number" class="form-control" name="tel2" value="{{ old('tel2') }}" maxlength="" autocomplete="off" required/>
                                <p>请填写注册时的手机号码</p>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">提交</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
<script>
    $('#reg').click(function(){
        $('#reg-box').modal('show');
    })
    $('#findpass').click(function(){
        $('#findpass-box').modal('show');
    })





$('[data-toggle="tooltip"]').tooltip();
    window.oncontextmenu = function(){
        //return false;
    };
    $('.siteIcon img').click(function(){
        window.location.reload();
    });
    $('#signinSubmit').click(function(){
        if($('#userName').val() === ''){
            $(this).text('用户名不能为空');
        }else if($('#userPwd').val() === ''){
            $(this).text('密码不能为空');
        }else{
            $(this).text('请稍后...');
        }
    });

    @if (session('status'))
        alert('登陆失败！');
    @endif
    @if (session('regres'))
        alert('注册成功，请登录！');
    @endif
    @if (session('stopreg'))
        alert('当前停止注册！');
    @endif

    @if (session('findpass') == 'error')
        alert('找回密码失败！');
    @endif
    @if (session('findpass') == 'success')
        alert('找回密码成功！请重新登录');
    @endif
    @if(session('code'))
        $('#reg-box').modal('show');
        alert('验证码错误！');
    @endif
    @if(session('nameisset'))
        $('#reg-box').modal('show');
        alert('用户名已存在');
    @endif



    function chekform(){
        //检测两次输入的密码是否一致
        if( $('input[name=repassword]').val() !=  $('input[name=newpassword]').val()  ){
            alert('两次输入密码不一致');return false;
        }
        //检验手机格式
        if (!isPhoneNo($('input[name=tel]').val())) {
            alert("手机号码格式不正确！");
            return false;
        }
        return true;
    }

    function isPhoneNo(phone) {
        var pattern = /^1[34578]\d{9}$/;
        return pattern.test(phone);
    }




    function chekform2(){
        //检测两次输入的密码是否一致
        if( $('input[name=repassword2]').val() !=  $('input[name=newpassword2]').val()  ){
            alert('两次输入密码不一致');return false;
        }
    }

</script>
</body>
</html>
