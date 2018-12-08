<?php
namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Form\AddPictureSizeForm;
use App\Http\Form\ChooseProjectForm;
use App\Http\Form\CmsBannerDodajForm;
use App\Http\Form\CreateBanerElementForm;
use App\Http\Form\UserCreateForm;
use App\Http\Model\BaneryModel;
use App\Http\Model\ProjektyModel;
use App\Http\Objects\User;
use App\Http\Service\SlugService;
use App\Mail\UserMail;
use Illuminate\Database\Query\Grammars\SQLiteGrammar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use League\Flysystem\Config;

class UsersController extends Controller {

    public $users,$types ;

    public function __construct()
    {
        $this->users= app()->make('Users');
        $this->types= app()->make('UsersTypes');
    }

    public function index(Request $request){
        $request->getSession()->put('activeMain','users');
        $request->getSession()->put('active','konta');
        $users = $this->users->getUsers();
        return view('users/users/index',array(
            'users'=>$users,
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $f = new UserCreateForm();
        $form = $f::prepareForm();
        $types =app()->make('UsersTypes')->getTypes();
        $form[2]['input']['values'] = $types;
        $form[2]['input']['default'] = $types;
        if($request->getMethod() == "POST"){
            $data = $request->all();
            $this->validate($request,array(
               'username'=>'required|min:3|max:20',
                'email'=>'required|email|unique:cms_users',
                'account_type'=>'required'
            ));
            $type = $this->types->getTypeById($data['account_type'])[0]->type;
            $date = strtotime("+7 day");
            $data['expire_date'] = date("Y-m-d H:i:s",$date);
            $user = new User($data['username'],$data['email'],$type,$data['_token']);
            if(!empty($user)){
                //$result = $this->sendVerificationEmail($data['email'],$user);
                $this->users->insert($data);
                Mail::to($data['email'])->send(new UserMail($user));
                    $request->getSession()->flash('successMessage','Na podany email wysłano kod weryfikujący!');
                    return redirect('/users');
            }

        }
        return view('users.users.create',array(
            'form'=>$form,
        ));
    }

    public function sendVerificationEmail($email,$user){
        Mail::to($email)->send(new UserMail($user));
        return true;
    }

    public function activateAccount(Request $request){
        $params = $request->all();
        $data = array('_token'=>'null','is_active'=>1);
        $result = $this->users->update($data,$params['email']);
        $request->getSession()->flash('successMessage',"Pomyślnie aktywowano konto. Teraz ustaw hasło");
        if($result){
            $request->getSession()->flash('successMessage',"Pomyślnie aktywowano konto. Teraz ustaw hasło");
            return redirect('/setPassword?email='.$params['email']);
        } else {
            $request->getSession()->flash('successMessage',"Konto zostało już wcześniej aktywowane!");
            return redirect('/');
        }

    }

    public function delete(Request $request,$id){
        $result = $this->users->delete($id);
        if($result){
            $request->getSession()->flash('successMessage','Pomyślnie usunięto użytkownika!');
            return redirect($_SERVER['HTTP_REFERER']);
        } else{
            $request->getSession()->flash('errorMessage','Wpisano błędne dane!');
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

}