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
use App\Http\Service\SlugService;
use Illuminate\Database\Query\Grammars\SQLiteGrammar;
use Illuminate\Http\Request;
use League\Flysystem\Config;

class UsersController extends Controller {

    public $users ;

    public function __construct()
    {
        $this->users= app()->make('Users');
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
        return view('users.users.create',array(
            'form'=>$form,
        ));
    }

    public function delete(Request $request,$id){
        $result = $this->size->delete($id);
        if($result){
            $request->getSession()->flash('successMessage','Pomyślnie usunięto rozmiar!');
            return redirect($_SERVER['HTTP_REFERER']);
        } else{
            $request->getSession()->flash('errorMessage','Wpisano błędne dane!');
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

}