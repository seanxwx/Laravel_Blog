<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class ArticleController extends CommonController
{
    public function index(){

        //get.admin/article 全部文章列表

        echo 'article';

    }

    //get.admin/article add article
    public function create(){


        $data = (new Category)->tree();
        //dd($categorys);
        //$data = [];
        return view('admin.article.add',compact('data'));
    }

}
