<?php
namespace App\Http\Controllers\Ustawienia;

use App\Http\Controllers\Controller;
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

class PicturesController extends Controller {

    public $size ;

    public function __construct()
    {
        $this->size = app()->make('Size');
    }

    public function index(Request $request){
        $request->getSession()->put('active','null');
        return view('ustawienia/index',array(

        ));
    }

    public function config(Request $request){
        $request->getSession()->put('active','grafiki');
        $size = $this->size->getSize();
        return view('ustawienia/pictures/index',array(
            'pictures'=>$size,
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $f = new AddPictureSizeForm();
        $form = $f::prepareForm();
        if($request->getMethod() == "POST"){
            $data = $request->all();
            $this->validate($request,array(
                'width'=>'required|numeric',
                'height'=>'required|numeric'
            ));
            $result = $this->size->insert($data);
            if($result){
                $request->getSession()->flash('successMessage','Pomyślnie dodano nowy rozmiar!');
                return redirect('/configuration/pictures');
            } else{
                $request->getSession()->flash('errorMessage','Wpisano błędne dane!');
                return redirect('/configuration/pictures');
            }
        }
        return view('ustawienia/pictures/dodaj',array(
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