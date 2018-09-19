@extends('layouts.admin')
@section('content')
    <!--Breadcrumbs navigation Start-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i>-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">Home</a> &raquo; All Category
    </div>
    <!--Breadcrumbs navigation End-->


    <!--Search results page list start-->
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_title">
            <h3>Category management</h3>
            </div>
            <!--Quick navigation Start-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>Add Category</a>
                    <a href="{{url('admin/category')}}"><i class="fa fa-recycle"></i>All Category</a>
                </div>
            </div>
            <!--Quick navigation End-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%">Order</th>
                        <th class="tc" width="5%">ID</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Views</th>
                        <th>Operate</th>
                    </tr>

                    @foreach($data as $v)
                    <tr>
                        <td class="tc">
                            <input type="text" onchange="changeOrder(this,{{$v->cate_id}})" value="{{$v->cate_order}}">
                        </td>
                        <td class="tc">{{$v->cate_id}}</td>
                        <td>
                            <a href="#">{{$v->_cate_name}}</a>
                        </td>
                        <td>{{$v->cate_title}}</td>
                        <td>{{$v->cate_view}}</td>
                        <td>
                            <a href="{{url('admin/category/'.$v->cate_id.'/edit')}}">Modify</a>
                            <a href="javascript:;" onclick="delCate({{$v->cate_id}})">Delete</a>
                        </td>
                    </tr>


                    @endforeach

                </table>


                {{--<div class="page_nav">--}}
                    {{--<div>--}}
                        {{--<a class="first" href="/wysls/index.php/Admin/Tag/index/p/1.html">第一页</a>--}}
                        {{--<a class="prev" href="/wysls/index.php/Admin/Tag/index/p/7.html">上一页</a>--}}
                        {{--<a class="num" href="/wysls/index.php/Admin/Tag/index/p/6.html">6</a>--}}
                        {{--<a class="num" href="/wysls/index.php/Admin/Tag/index/p/7.html">7</a>--}}
                        {{--<span class="current">8</span>--}}
                        {{--<a class="num" href="/wysls/index.php/Admin/Tag/index/p/9.html">9</a>--}}
                        {{--<a class="num" href="/wysls/index.php/Admin/Tag/index/p/10.html">10</a>--}}
                        {{--<a class="next" href="/wysls/index.php/Admin/Tag/index/p/9.html">下一页</a>--}}
                        {{--<a class="end" href="/wysls/index.php/Admin/Tag/index/p/11.html">最后一页</a>--}}
                        {{--<span class="rows">11 条记录</span>--}}
                    {{--</div>--}}
                {{--</div>--}}



                {{--<div class="page_list">--}}
                    {{--<ul>--}}
                        {{--<li class="disabled"><a href="#">&laquo;</a></li>--}}
                        {{--<li class="active"><a href="#">1</a></li>--}}
                        {{--<li><a href="#">2</a></li>--}}
                        {{--<li><a href="#">3</a></li>--}}
                        {{--<li><a href="#">4</a></li>--}}
                        {{--<li><a href="#">5</a></li>--}}
                        {{--<li><a href="#">&raquo;</a></li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            </div>
        </div>
    </form>
        <!--Search results page list end-->

    <script>
        // $(function(){
        //
        // });
        function changeOrder(obj,cate_id){
            var cate_order = $(obj).val();

           $.post("{{url('admin/cate/changeOrder')}}",{'_token':'{{csrf_token()}}','cate_id':cate_id,'cate_order':cate_order},function(data){
               if(data.status == 0){
                   layer.msg(data.msg,{icon:6});
               } else{
                   layer.msg(data.msg,{icon:5});
               }

           });
        }


        //delete

        function delCate(cate_id){
                layer.confirm('Are you sure to delete this blog?',{
                    btn:['Yes','Cancel'] //btn
                },function(){
                    $.post("{{url('admin/category/')}}/"+cate_id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){
                        if(data.status == 0){

                             layer.msg(data.msg,{icon:6});
                            var int=self.setInterval(function(){  // This method means excute function after 1 seconds
                                location.reload();   // reload the page
                            },1000) //1000 means 1000 mili seconds
                             //location.href = location.href;

                        } else{
                            layer.msg(data.msg,{icon:5});
                        }
                    });
                    //alert(cate_id);
                },function () {

                });
        }
        function refreshPage()
        {
            window.location.reload();
            window.setTimeout("refreshPage()",3000);
        }

    </script>

@endsection


