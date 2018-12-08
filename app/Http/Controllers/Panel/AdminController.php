<?php
namespace App\Http\Controllers\Panel;

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

class AdminController extends Controller {

    public $permissions,$types;

    public function __construct()
    {
        $this->permissions = app()->make('Permissions');
        $this->types = app()->make('UsersTypes');
    }

    public function index(Request $request){
        $request->getSession()->put('activeMain','panel');
        $request->getSession()->put('active','admin');
        return view('panel/admin/index',array(
        ));
    }

    public function addModules(Request $request){
        $numberRows = 0;
        $types = $this->types->getAllTypes();
        foreach (Route::getRoutes() as $route)
        {
            $action = $route->getName();
            $name= explode('.',$action);
            if($action != null){
                $checkExist = $this->permissions->getPermissionByAction($action);
                if(!$checkExist){

                    foreach($types as $t){
                        $numberRows++;
                        $this->permissions->insert(array('action'=>$action,'name'=>$name[count($name)-1],'module'=>$name[0],'account_type'=>$t->id));
                    }
                }
                $array  = array('route'=>$action,'module'=>$name[0],'name'=>$name[count($name)-1]);
                $controllers[] = $array;
            }
        }
        if($numberRows>0){
            $request->getSession()->flash('successMessage',"Pomyślnie dodano ".$numberRows/(count($types))." nowych modułów");
            return redirect('/admin');
        } else{
            $request->getSession()->flash('infoMessage',"Brak modułów do dodania");
            return redirect('/admin');
        }
    }

}