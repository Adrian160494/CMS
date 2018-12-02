<?php
namespace App\Http\Controllers\Ustawienia;

use App\Http\Controllers\Controller;
use App\Http\Form\AddCategoryForm;
use App\Http\Form\AddPictureSizeForm;
use App\Http\Form\ChooseProjectForm;
use App\Http\Form\CmsBannerDodajForm;
use App\Http\Form\CreateBanerElementForm;
use App\Http\Model\BaneryModel;
use App\Http\Model\ProjektyModel;
use App\Http\Service\SlugService;
use Illuminate\Database\Query\Grammars\SQLiteGrammar;
use Illuminate\Http\Request;
use League\Flysystem\Config;

class CategoriesController extends Controller {

    public $categories;


    public function __construct()
    {
        $this->categories = app()->make('Categories');
    }

    public function index(Request $request){
        $request->getSession()->put('activeMain','ustawienia');
        $request->getSession()->put('active','kategorie');
        $categories = $this->categories->getCategories();
        return view('ustawienia/categories/index',array(
            'categories'=>$categories,
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $f = new AddCategoryForm();
        $form = $f::prepareForm();
        if($request->getMethod() == "POST"){
            $data = $request->all();
            $this->validate($request,array(
                'name'=>'required|unique:cms_category',
            ));
            $result = $this->categories->insert($data);
            if($result){
                $request->getSession()->flash('successMessage','Pomyślnie dodano kategorię!');
                return redirect('/configuration/categories');
            } else{
                $request->getSession()->flash('errorMessage','Wpisano błędne dane!');
                return redirect('/configuration/categories');
            }
        }
        return view('ustawienia/categories/dodaj',array(
            'form'=>$form,
        ));
    }

    public function delete(Request $request,$id){
        $result = $this->categories->delete($id);
        if($result){
            $request->getSession()->flash('successMessage','Pomyślnie usunięto kategorie!');
            return redirect($_SERVER['HTTP_REFERER']);
        } else{
            $request->getSession()->flash('errorMessage','Wpisano błędne dane!');
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function changeActivity(Request $request,$id){
        $result = $this->categories->changeActivity($id);
        if($result){
            $request->getSession()->flash('successMessage','Aktywowano kategorię!');
            return redirect($_SERVER['HTTP_REFERER']);
        } else{
            $request->getSession()->flash('successMessage','Deaktywowano kategorię!');
            return redirect($_SERVER['HTTP_REFERER']);
        }
        return redirect($_SERVER['HTTP_REFERER']);
    }

}