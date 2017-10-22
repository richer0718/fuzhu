<!doctype html>
<html lang="zh-CN">
<head>
    @include('layouts.common_admin')
</head>
<body style="padding-top:0;">
    <div class="col-sm-12 col-sm-offset-3 col-md-12 col-lg-12 col-md-offset-2 main" id="main" style="margin:0;">
        <div class="row">

                <div class="col-md-12" >


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

        </div>
    </div>

</body>