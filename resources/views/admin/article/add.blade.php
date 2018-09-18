@extends ('layouts.admin')
@section('content')


    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; Article manage
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>Article Management</h3>
            @if($errors)
                <div class="mark">
                    @if(is_object($errors))
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    @else
                        <p>{{$errors}}</p>
                    @endif
                </div>
            @endif
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>Add Article</a>
                <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>All Article</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/category')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require"></i>分类：</th>
                        <td>
                            <select name="cate_id">
                                {{--<option value="0">==顶级分类==</option>--}}
                                @foreach($data as $d)
                                    <option value="{{$d->cate_id}}">{{$d->_cate_name}}</option>
                                    @endforeach

                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th>文章标题：</th>
                        <td>
                            <input type="text" class="lg" name="article_title">

                        </td>
                    </tr>
                    <tr>
                        <th><i class="require"></i>编辑：</th>
                        <td>
                            <input type="text" class="sm" name="article_editor">

                        </td>
                    </tr>

                    <tr>
                        <th>缩略图：</th>
                        <td>
                            <input type="text" size="50" name="article_thumb">
                            <input id="file_upload" name="file_upload" type="file" multiple="true">
                            <script src="{{asset('resources/org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
                            <link rel="stylesheet" type="text/css" href="{{asset('resources/org/uploadify/uploadify.css')}}">
                            <script type="text/javascript">
                            <?php $timestamp = time();?>
                            $(function() {
                            $('#file_upload').uploadify({
                            'formData'     : {
                            'timestamp' : '<?php echo $timestamp;?>',
                            'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
                            },
                            'swf'      : "{{asset('resources/org/uploadify/uploadify.swf')}}",
                            'uploader' : "{{asset('resources/org/uploadify/uploadify.php')}}"
                            });
                            });
                            </script>
                            <style>
                                .uploadify{display:inline-block;}
                                .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
                                table.add_tab tr td span.uploadify-button-text{color:#FFF;margin: 0;}
                            </style>
                        </td>
                    </tr>

                    <tr>
                        <th>关键词：</th>
                        <td>
                            <textarea name="article_tag"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <th>描述：</th>
                        <td>
                            <textarea class="lg" name="article_description"></textarea>

                        </td>
                    </tr>

                    <tr>
                        <th>文章内容：</th>
                        <td>
                            <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.config.js')}}"></script>
                            <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.all.min.js')}}"> </script>
                            <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                            <script id="editor"  name="art_content" type="text/plain" style="width:860px;height:500px;"></script>
                            <script type="text/javascript">

                            var ue = UE.getEditor('editor');
                            </script>

                            <style>
                                .edui-default{line-height:28px;}
                                div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                                {overflow:hidden;height:20px;}
                                div.edui-box{overflow:hidden;height:22px;}
                            </style>


                        </td>
                    </tr>

                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

@endsection