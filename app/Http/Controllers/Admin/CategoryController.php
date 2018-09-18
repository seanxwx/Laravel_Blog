<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;


use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{
    //get.admin/category  all category list
    public function index(){

        //$categorys = Category::tree();

      $categorys = (new Category)->tree();
//      $data = $this->getTree($categorys,'cate_name','cate_id','cate_pid');
//        dd($categorys);

      return view('admin.category/index',['data'=>$categorys]);

    }

    public function changeOrder()
    {
        $input =  Input::all();
        $cate = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $re = $cate->update();
        if($re){
            $data = [
                'status'=>0,
                'msg'=>'Order update successful',

            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'Order update failed',

            ];
        }
        return $data;

       //echo $re;
//        echo $input['cate_id'];
    }


    //get.admin/category add category
    public function create(){
        $data = Category::where('cate_pid',0)->get();
        //dd($data);
        return view('admin/category/add',compact('data'));

       //return view('admin/category/add');
    }


    //post.admin/category
    public function store(){

        //except first 'token'
        $input = Input::except('_token');
        //dd($input);
        $rules = [
            'cate_name' => 'required',
        ];

        $message = [
            'cate_name.required'=>'分类名称不能为空',
            'password.between'=>'新密码须在6-20之间',
            'password.confirmed'=>'新密码和确认密码不一致'
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = Category::create($input);
            if($re){
                return redirect('admin/category');

            }else{
                return back()->with('errors','Data fill failed, please try again');
            }
        }else {

            //return Redirect::back()->withErrors(['msg', 'The Message']);
            return back()->withErrors($validator);
        }
    }


    //get.admin/category/{category}/edit        edit the category
    public function edit($cate_id){

        $field = Category::find($cate_id);
        $data = Category::where('cate_pid',0)->get();
        return view('admin.category.edit',compact('field','data'));
        //dd($field);
        //echo $cate_id;
    }

    //put.admin/category/{category}     update category
    public function update($cate_id){
        $input = Input::except('_token','_method');
        $re = Category::where('cate_id',$cate_id)->update($input);
        //dd($re);
        if($re){
            return redirect('admin/category');
        }else{
            return back()->with('errors','Data update failed, please try again');
        }
    }




    //get.admin/category show single category info
    public function show(){

    }




    //delete.admin/category/{category}      delete single category
    public function destroy($cate_id){
        $re = Category::where('cate_id',$cate_id)->delete();

        Category::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);
        if($re){
            $data = [
                'status'=> 0,
                'msg' => 'Blog delete successful'
            ];
            //return back()->with('msg', 'Blog delete successful');
//            return redirect('admin/category');
        }else{
            $data = [
                'status'=> 1,
                'msg' => 'Blog delete failed, please try again'
            ];
            //return back()->with('errors','Data delete failed, please try again');
        }
        return $data;
    }

}
