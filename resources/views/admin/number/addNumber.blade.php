@extends('layouts.admin_common')
@section('right-box')

    <style>
        table tr{
            margin-top:5px;
        }
        .laydate_box, .laydate_box * {
            box-sizing:content-box;
        }
    </style>
    <script src="{{ asset('js/laydate/laydate.js') }}"></script>
    <form id="myForm" method="post" action="{{ url('manage/addNumberRes') }}" onsubmit="return chekform()">
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" >
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">添加账号</h1>

                <table class="table table-striped table-bordered" style="width:450px;">
                    <tr>
                        <td style="width:120px;">游戏账号：</td>
                        <td><input type="text"  class="form-control"  name="number" @if(isset($info) || old('number') ) value="{{ $info -> number or old('number')  }}" @endif required/></td>
                    </tr>
                    <tr>
                        <td>游戏密码：</td>
                        <td><input type="text"  class="form-control" name="pass" @if(isset($info) || old('pass') ) value="{{ $info -> pass or old('pass') }}" @endif required/></td>
                    </tr>
                    <tr>
                        <td>大区：</td>
                        <td>
                            <select name="area" id="area_select">
                                <option value="AZQQ" @if(isset($info))  @if( $info -> area == 'AZQQ') selected @endif @endif  @if( old('area') == 'AZQQ') selected @endif >安卓QQ</option>
                                <option value="AZVX" @if(isset($info))  @if( $info -> area == 'AZVX') selected @endif @endif  @if( old('area') == 'AZVX') selected @endif >安卓微信</option>
                                <option value="IOSQQ" @if(isset($info))  @if( $info -> area == 'IOSQQ') selected @endif @endif @if( old('area') == 'IOSQQ') selected @endif >苹果QQ</option>
                                <option value="IOSVX" @if(isset($info))  @if( $info -> area == 'IOSVX') selected @endif @endif  @if( old('area') == 'IOSVX') selected @endif >苹果微信</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>刷图选择：</td>
                        <td>
                            <select name="map" id="map_select">
                                <option value="DS" @if(isset($info))  @if( $info -> map == 'DS') selected @endif @endif @if( old('map') == 'DS') selected @endif >大师魔女的回忆</option>
                                <option value="JY" @if(isset($info)) @if( $info -> map == 'JY') selected @endif @endif  @if( old('map') == 'JY') selected @endif >精英魔女的回忆</option>
                                <option value="PT" @if(isset($info)) @if( $info -> map == 'PT') selected @endif @endif  @if( old('map') == 'PT') selected @endif >普通魔女的回忆</option>


                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>刷图次数：</td>
                        <td>
                            <div class="input-group">
                                <input type="number" class="form-control" name="save_time" value="{{ $info -> save_time or old('save_time') }}"  required/>
                                <span class="input-group-addon">次</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>养号模式：</td>
                        <td>
                            <select name="mode" id="mode_select">
                                <option value="0" @if(isset($info))  @if( $info -> mode == '0') selected @endif @endif @if( old('mode') == '0') selected @endif >关闭</option>
                                <option value="1" @if(isset($info))  @if( $info -> mode == '1') selected @endif @endif  @if( old('mode') == '1') selected @endif >模式一</option>
                                <option value="2" @if(isset($info))  @if( $info -> mode == '2') selected @endif @endif @if( old('mode') == '2') selected @endif >模式二</option>
                                <option value="3" @if(isset($info))  @if( $info -> mode == '3') selected @endif @endif @if( old('mode') == '3') selected @endif >模式三</option>
                            </select>
                        </td>
                    </tr>

                    <tr id="super_tr" style="display:none;">
                        <td>截止时间：</td>
                        <td>
                            <div class="input-group">
                                <input type="text" id="end_date" name="end_date"  value="" class="form-control" onclick="laydate({istime: false, format: 'YYYY-MM-DD'})"  />
                                <span class="input-group-addon">23:59:59</span>
                            </div>

                        </td>
                    </tr>

                    <tr>
                        <td>上号时间：</td>
                        <td>
                            <div class="input-group">
                                <input type="number" class="form-control" name="shanghao_time"  value="{{ $info -> shanghao_time or old('shanghao_time') }}" required/>
                                <span class="input-group-addon">分钟后开始排队！（只能填写数字）</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button class="btn btn-success" type="submit" id="addButton">添加</button>
                            <button class="btn btn-default" type="button" id="rest">重置</button>
                        </td>
                    </tr>

                </table>

            </div>


        </div>
    </div>
    </form>

    <!-- 确认 -->
    <div class="modal fade " id="queren" tabindex="-1" role="dialog"  >
        <div class="modal-dialog" role="document" style="width:400px;">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" >请确认充值信息</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table" style="margin-bottom:0px;">
                            <tr>
                                <td style="width:120px;">游戏账号：</td>
                                <td><input type="text"  class="form-control"  id="show_number"  disabled/></td>
                            </tr>
                            <tr>
                                <td>游戏密码：</td>
                                <td><input type="text"  class="form-control" id="show_pass" disabled/></td>
                            </tr>
                            <tr>
                                <td>大区：</td>
                                <td><input type="text"  class="form-control" id="show_area" disabled/></td>
                            </tr>
                            <tr>
                                <td>刷图选择：</td>
                                <td><input type="text"  class="form-control" id="show_map" disabled/></td>
                            </tr>
                            <tr>
                                <td>刷图次数：</td>
                                <td>
                                    <div class="input-group">
                                        <input type="number" class="form-control" disabled id="show_savetime"/>
                                        <span class="input-group-addon">次</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>养号模式：</td>
                                <td><input type="text"  class="form-control" id="show_mode" disabled/></td>
                            </tr>
                            <tr id="super_trr">
                                <td>截止时间：</td>
                                <td>
                                    <div class="input-group">
                                        <input type="text"  class="form-control" id="show_end_date" disabled/>
                                        <span class="input-group-addon">23:59:59</span>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td>上号时间：</td>
                                <td>
                                    <div class="input-group">
                                        <input type="text"  class="form-control" id="show_shanghaotime" disabled/>
                                        <span class="input-group-addon">分钟后开始排队</span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" id="querenbutton">确认</button>
                    </div>
                </div>
        </div>
    </div>


    <script>
        $(function(){
            $('#mode_select').change(function(){
                if($('#mode_select').val() != 0){
                    $('#super_tr').show();
                }else{
                    $('#end_date').val('');
                    $('#super_tr').hide();
                }
            })


            $('#rest').click(function(){
                location.reload();
            });
            $('#querenbutton').click(function(){
                $('#myForm').submit();
            })

            @if(old('number'))
                alert('您的点数，不足以支付本次代刷的费用，请充值后，再上传！');
            @endif


        })
        function chekform(){
            //如果是第二次确认，则返回true
            var is_true = $('#queren').css('display');
            if(is_true == 'block'){
                return true;
            }

            if($('#mode_select').val() != 0  && $('#end_date').val() == ''){
                //如果开启养号模式 截止时间必填
                alert('截止时间必填');return false;
            }
            if($('#mode_select').val() != 0){
                $('#show_end_date').val($('#end_date').val());
                $('#super_trr').show();
            }else{
                $('#show_end_date').val('');
                $('#super_trr').hide();
            }


            //把值赋过去
            $('#show_number').val($('input[name=number]').val());
            $('#show_pass').val($('input[name=pass]').val());
            $('#show_area').val($('#area_select option:selected').text());
            $('#show_map').val($('#map_select option:selected').text());
            $('#show_mode').val($('#mode_select option:selected').text());
            $('#show_savetime').val($('input[name=save_time]').val());
            $('#show_shanghaotime').val($('input[name=shanghao_time]').val());

            if(issbccase($('input[name=number]').val())){
                alert('账号不合法');return false;
            }


            $('#queren').modal('show')
            //弹框让他确认
            return false;
        }

        function   issbccase(source)   {
            if   (source=="")   {
                return   true;
            }
            var   reg=/^[\w\u4e00-\u9fa5\uf900-\ufa2d]*$/;
            if   (reg.test(source))   {
                return   false;
            }   else   {
                return   true;
            }
        }

    </script>


@stop