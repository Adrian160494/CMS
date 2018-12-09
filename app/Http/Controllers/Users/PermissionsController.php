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
use Illuminate\Support\Facades\Route;
use League\Flysystem\Config;

class PermissionsController extends Controller {

    public $permissions,$types ;

    public function __construct()
    {
        $this->permissions= app()->make('Permissions');
        $this->types= app()->make('UsersTypes');
    }

    public function index(Request $request){
        $request->getSession()->put('activeMain','users');
        $request->getSession()->put('active','permissions');
        $types = $this->types->getAllTypes();
        $resultPermissions = array();
        $lastResult = array();
        $permissions = $this->permissions->getPermissions();
        foreach($types as $t){
            $resultPermissions[$t->type] = array();
        }
        foreach($permissions as $p){
            array_push($resultPermissions[$p->type],$p);
        }
        $array = '';
        $count = 0;
        foreach ($permissions as $r){
            if(empty($array)){
                $count++;
                $array =array('action'=>$r->action,'name'=>$r->name,'module'=>$r->module,'permissions'=>array());
                $array['permissions'][$r->account_type]=array('permission'=>$r->permission,'id'=>$r->id,'account_type'=>$r->account_type);
            } else if($r->action == $array['action']) {
                $count++;
                $array['permissions'][$r->account_type]=array('permission'=>$r->permission,'id'=>$r->id,'account_type'=>$r->account_type);
            }
            if($count == 4){
                array_push($lastResult,$array);
                $array = '';
                $count = 0;
            }
        }

        return view('users/permissions/index',array(
            'permissions'=>$lastResult,
        ));
    }

    public function changePermission(Request $request,$id){
        $result = $this->permissions->changeActivity($id);
        if($result){
            $request->getSession()->flash('successMessage','Zmieniono uprawnienie');
            return redirect($_SERVER['HTTP_REFERER']);
        } else{
            $request->getSession()->flash('successMessage','Zmieniono uprawnienie!');
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }


}