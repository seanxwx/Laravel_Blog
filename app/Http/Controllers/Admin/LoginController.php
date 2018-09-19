<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

//  (URL::asset( '/org/code/Code.class.php'));
//require_once $_SERVER['DOCUMENT_ROOT'] . '/org/code/Code.class.php';
//require_once dirname(__FILE__) . '/Code.class.php';
require_once 'resources/org/code/Code.class.php';
//require_once public_path().'/org/code/Code.class.php';


//namespace App\Http\Controller\resources\org\code;

//use App\Http\Controller\resources\org\code\Code;

class LoginController extends CommonController
{
    public function login()
    {

        if ($input = Input::all()) {
            $code = new \Code;
            $_code = $code->get();
            if (strtoupper($input['code']) != $_code) {
                return back()->with('msg', 'Verification code incorrect');
            }

            $user = User::first();
            if($user->user_name != $input['user_name'] || Crypt::decrypt($user->user_pass) != $input['user_pass']){
                return back()->with('msg', 'Username or password incorrect');
            }
            session(['user'=>$user]);
//            dd(session('user'));
            //echo 'ok';
            return redirect(('admin/index'));
        }

        else{
               //$user = User::first();
                //dd($_SERVER);
//                session(['user'=>null]);
                return view('admin.login');
            }
        }



    public function code(){
        $code = new \Code;
        $code->make();
    }

    public function quit(){
        session(['user'=>null]);
        return redirect('admin/login');
    }

    public function crypt(){

        //<250
        $str = '121321';
        $str1 = 'sdasfasfaf';
        $str_p ="eyJpdiI6IjdWczN6TEF2c1NyT1Ewazc0ckUxU1E9PSIsInZhbHVlIjoicGordnNKVGV2eEtsMFcrMFlLaHMxdz09IiwibWFjIjoiMjIyN2RhYTZjZTg4N2E0NjcyNDYyZDU1MWU5YWUwNzcyM2Q1MWQ1ZTJmYThjZGZmNWZmYjVmOGU2NDMxMTEwMyJ9";

        echo Crypt::encrypt($str);
        echo "<br />";
        echo Crypt::decrypt($str_p);
    }

//    public function getCode(){
//        $code = new \Code;
//        echo $code->get();
//    }
}
