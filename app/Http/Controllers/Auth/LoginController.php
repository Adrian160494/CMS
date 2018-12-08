<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Form\LoginForm;
use App\Http\Form\SetPasswordForm;
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
            $pass = md5($password);
           $user =  User::getUserByUsername($username);
           if($user && ($pass == $user[0]->password)){
               $request->getSession()->put('userAuth',$username.'_'.$data['_token']);
               $request->getSession()->flash('successMessage','Logowanie przebiegło pomyślnie!');
               $request->getSession()->put('username',$username);
               $request->getSession()->put('account_type',$user[0]->account_type);
               return redirect('/manage');
           } else {
               $request->getSession()->flash('errorMessage','Podano błędne dane');
           }
        }
        return view('login/login',array('form'=>$form));
    }

    public function setPassword(Request $request){
        $f = new SetPasswordForm();
        $form = $f::prepareForm();
        $form[0]['input']['value'] = $request->query('email');
        if($request->getMethod() == "POST"){
            $data = $request->all();
            $this->validate($request,array(
                'password'=>'required|same:repeat-password',
                'repeat-password'=>'required'
            ));
            if($data['password'] == $data['repeat-password']){
                $pass = md5($data['password']);
                $in = array('password'=>$pass);
                app()->make('Users')->update($in,$data['email']);
                 $request->getSession()->flash('successMessage','Pomyślnie zmieniono hasło!');
                return redirect('/');
            }
        }
        return view('login.setPassword',array(
            'form'=>$form,
        ));
    }
    public function logout(Request $request){
        $session = $request->getSession();
        $session->forget('userAuth');
        $session->forget('username');
        $session->forget('account_type');
        $request->getSession()->flash('successMessage','Wylogowywanie przebiegło pomyślnie!');
        return redirect('/');
    }
}
