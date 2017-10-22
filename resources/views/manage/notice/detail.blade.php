@extends('layouts.manage_common')
@section('right-box')

    <script src="{{ asset('admin/lib/ueditor/ueditor.config.js') }}"></script>
    <script src="{{ asset('admin/lib/ueditor/ueditor.all.min.js') }}"> </script>
    <div class="col-sm-12 col-sm-offset-3 col-md-10 col-lg-10 col-md-offset-2 main" id="main" style="height:700px;overflow-y: auto;padding-bottom:100px;">
        <div class="row">
            <form @if(isset($res)) action="{{ url('admin/editNoticeRes') }}" @else action="{{ url('admin/addNoticeRes') }}" @endif   method="post" class="add-article-form" enctype="multipart/form-data">
                <div class="col-md-12" >
                    <h1 class="page-header">消息内容</h1>

                    <div class="form-group">
                        <label for="article-title" class="sr-only">标题</label>
                        <input type="text" id="article-title" name="title" class="form-control" placeholder="在此处输入标题" value="{{ $res->title }}" disabled autofocus autocomplete="off">
                    </div>



                    <div class="form-group">
                        {!! $res -> content !!}
                    </div>

                    <!--
                    <div class="add-article-box">
                        <h2 class="add-article-box-title"><span>关键字</span></h2>
                        <div class="add-article-box-content">
                            <input type="text" class="form-control" placeholder="请输入关键字" name="keywords" autocomplete="off">
                            <span class="prompt-text">多个标签请用英文逗号,隔开。</span>
                        </div>
                    </div>
                    <div class="add-article-box">
                        <h2 class="add-article-box-title"><span>描述</span></h2>
                        <div class="add-article-box-content">
                            <textarea class="form-control" name="describe" autocomplete="off"></textarea>
                            <span class="prompt-text">描述是可选的手工创建的内容总结，并可以在网页描述中使用</span>
                        </div>
                    </div>
                    -->

                </div>

            </form>
        </div>
    </div>

@stop