<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Form\LoginForm;
use App\Http\Model\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){
        $f = new LoginForm();
        $form = $f::prepareForm();
        $userAuth = $request->getSession()->get('userAuth');
        if($userAuth){
            return redirect('/manage');
        }
        if($request->getMethod() == "POST"){
            $data = $request->all();
            $this->validate($request,array(
                'username'=>'required',
                'password'=>'required|min:3'
            ));
            $username = $data['username'];
            $password = $data['password'];
           $user =  User::getUserByUsername($username);
           if($user && ($password == $user[0]->password)){
               $request->getSession()->put('userAuth',$username.'_'.$data['_token']);
               $request->getSession()->flash('successMessage','Logowanie przebiegło pomyślnie!');
               $request->getSession()->put('username',$username);
               return redirect('/manage');
           } else {
               $request->getSession()->flash('errorMessage','Podano błędne dane');
           }
        }
        return view('login/login',array('form'=>$form));
    }
    public function logout(Request $request){
        $session = $request->getSession();
        $session->forget('userAuth');
        $request->getSession()->flash('successMessage','Wylogowywanie przebiegło pomyślnie!');
        return redirect('/');
    }
}
