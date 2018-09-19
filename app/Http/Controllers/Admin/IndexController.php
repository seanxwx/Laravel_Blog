<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class IndexController extends CommonController
{
    public function index(){
       return view('admin.index');
    }

    public function info(){
        return view('admin.info');
    }

    //chaneg admin password
    public  function  pass(){
        if($input = Input::all()){
            $rules = [
                'password' => 'required|between:6,20|confirmed',
            ];

            $message = [
                'password.required'=>'New Password cannot be blank',
                'password.between'=>'New password should between 6 to 20 characeters',
                'password.confirmed'=>'New password does not meet the confirm password'
            ];

           $validator = Validator::make($input,$rules,$message);

           if($validator->passes()){
               $user = User::first();
               $_password = Crypt::decrypt($user->user_pass);
              if($input['password_o']==$_password){
                  $user->user_pass = Crypt::encrypt($input['password']);
                  $user->update();
                  return back()->with('errors','Password change successfully');
              }else{
                  return back()->with('errors','Old password wrong');
              }

               //echo 'yes';
           }else{

               //return Redirect::back()->withErrors(['msg', 'The Message']);
               return back()->withErrors($validator);
              //return back()->withErrors($validator);
           }
        }else{
            return view('admin.pass');
        }

    }
}
