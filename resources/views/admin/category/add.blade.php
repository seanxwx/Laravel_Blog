@extends ('layouts.admin')
@section('content')


    <!--Breadcrumbs navigation Start-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i>-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">Home</a> &raquo; Add Article Category
    </div>
    <!--Breadcrumbs navigation End-->

	<!--Search results page list start-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>Category Manage</h3>
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
                <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>Add Category</a>
                <a href="{{url('admin/category')}}"><i class="fa fa-recycle"></i>All Category</a>
            </div>
        </div>
    </div>
    <!--Search results page list Ends-->
    
    <div class="result_wrap">
        <form action="{{url('admin/category')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>Parent classification：</th>
                        <td>
                            <select name="cate_pid">
                                <option value="0">==Top classification==</option>
                                @foreach($data as $d)
                                    <option value="{{$d->cate_id}}">{{$d->cate_name}}</option>
                                    @endforeach

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>Classification：</th>
                        <td>
                            <input type="text" name="cate_name">
                            <span><i class="fa fa-exclamation-circle yellow"></i>This is the name of classification（Required）</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Article Headings：</th>
                        <td>
                            <input type="text" class="lg" name="cate_title">

                        </td>
                    </tr>



                    <tr>
                        <th>Keywords：</th>
                        <td>
                            <textarea name="cate_keywords"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>Description：</th>
                        <td>
                            <textarea class="lg" name="cate_description"></textarea>

                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>Order</th>
                        <td>
                            <input type="text" class="sm" name="cate_order">

                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="Submit">
                            <input type="button" class="back" onclick="history.go(-1)" value="Return">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

@endsection