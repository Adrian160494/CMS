<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Form\ChooseProjectForm;
use App\Http\Form\CmsBannerDodajForm;
use App\Http\Form\CreateBanerElementForm;
use App\Http\Model\BaneryModel;
use App\Http\Model\ProjektyModel;
use App\Http\Service\SlugService;
use Illuminate\Database\Query\Grammars\SQLiteGrammar;
use Illuminate\Http\Request;
use League\Flysystem\Config;

class CmsBanneryController extends Controller {

    public function index(Request $request){
        $request->getSession()->put('active','banner');
        $data = $request->all();
        $f = new ChooseProjectForm();
        $form = $f::prepareForm();
        $array = $this->getProjekty($request,$form);
        $form = $array['form'];
        $id_projektu = $array['id_projektu'];
        if(isset($data['id_projektu'])){
            $id_projektu = $request->get('id_projektu');
            $request->getSession()->put('id_projektu',$id_projektu);
            $form[0]['input']['default'] = $id_projektu;
        }
        $bannery= resolve('bannery')->getBaneryByProject($id_projektu);
        return view('cms/bannery/index',array(
            'form'=>$form,
            'bannery'=>$bannery,
            'id_projektu' => $id_projektu
        ));
    }

    public function createBanner(Request $request){
        $data = $request->all();
        $f = new CmsBannerDodajForm();
        $form = $f::prepareForm();
        $form[0]['input']['value'] = $data['id_projektu'];
        if($request->getMethod() == "POST"){
            $data = $request->all();
            $data['slug'] = SlugService::createSlug($data['nazwa']);
            if(!isset($data['is_active'])){
                $data['is_active'] = 0;
            } else {
                $data['is_active'] = 1;
            }
            $this->validate($request,[
                'nazwa'=>'required|unique:cms_bannery',
                'id_projektu'=>'required'
            ]);
            $result = resolve('bannery')->insert($data);
            if($result){
                $request->getSession()->flash('successMessage','Pomyślnie dodano banner!');
                return redirect('/cms/bannery');
            } else{
                $request->getSession()->flash('errorMessage','Wpisano błędne dane!');
                return redirect('/cms/bannery');
            }

        }
        return view('cms/bannery/dodaj',array('form'=>$form));
    }

    public function getProjekty($request,$form){
        $projekty = ProjektyModel::getProjekty();
        $projekty_choose = array();
        foreach($projekty as $p){
            $projekty_choose[$p->id] = $p->nazwa;
        }
        $id_projektu = $projekty[0]->id;
        $form[0]['input']['values'] = $projekty_choose;
        $form[0]['input']['default'] = $projekty[0]->nazwa;
        return array(
            'form'=> $form,
            'id_projektu' => $id_projektu
        );
    }

    public function changeProjekt(Request $request){
        if($request->getMethod() == "POST"){
            $id_projektu = $request->all()['select'];
        }
        return redirect('/cms/bannery?id_projektu='.$id_projektu);
    }

    public function configBanner(Request $request,$id,$id_projektu){
        $params = $request->all();
        $bannery = app()->make('banneryElements')->getElements($id);
        $size = app()->make('Size')->getSize();
        return view('cms/bannery/config',array(
            'id_projektu'=>$id_projektu,
            'id_baneru'=>$id,
            'bannery'=> $bannery,
            'size'=>$size,
            ));
    }

    public function createBannerElement(Request $request,$id_baneru,$id_projektu){
        $f = new CreateBanerElementForm();
        $form = $f::prepareForm();
        $form[0]['input']['value'] = $id_baneru;
        if($request->getMethod() == "POST"){
            $params = $request->all();
            $banneryEService = app()->make('banneryElements');
            $baner = app()->make('bannery')->selectWhere($id_baneru,false);
            $result = null;
            if($_FILES['file']['name']){
                $result = $this->uploadFile(SlugService::createSlug($baner[0]->nazwa));
            }
//            if($result != 0){
                $params = $request->all();
                if(!isset($params['is_acvtive'])){
                    $params['is_active'] = 0;
                }
                if($result){
                    $data = array(
                        'id_baneru'=>$id_baneru,
                        'nazwa'=>$params['nazwa'],
                        'opis'=>$params['opis'],
                        'id_plik'=>$result ? $result : null,
                        'is_active'=> $params['is_active'] == "on" ? 1 : 0,
                    );
                } else {
                    $data = array(
                        'id_baneru'=>$id_baneru,
                        'nazwa'=>$params['nazwa'],
                        'opis'=>$params['opis'],
                        'is_active'=> $params['is_active'] == "on" ? 1 : 0,
                    );
                }
                $result2 = $banneryEService->insert($data);
                if($result2){
                    $request->getSession()->flash('successMessage','Pomyślnie dodano element banneru');
                    return redirect()->route('cms.bannery.config',array('id'=>$id_baneru,'id_projektu'=>$id_projektu));
                } else{
                    $request->getSession()->flash('errorMessage','Wystąpił błąd zapisu!');
                    return redirect($_SERVER['HTTP_REFERER']);
                }

//            } else{
//                $request->getSession()->flash('errorMessage','Wystąpił błąd przy dodawaniu pliku');
//                return redirect($_SERVER['HTTP_REFERER']);
//            }

        }
        return view('cms/bannery/dodajElement',array(
            'id_projektu'=>$id_projektu,
            'id_baneru'=>$id_baneru,
            'form'=>$form,
        ));
    }

    public function resizePicture(Request $request,$id,$width,$height,$id_size){
        $root = $_SERVER['DOCUMENT_ROOT'];
        $element = app()->make('banneryElements')->getElementById($id);
        $newPath = $root.str_replace('original-',$width.'x'.$height.'-',$element[0]->sciezka_plik);
        $result = $this->resize($root.$element[0]->sciezka_plik,$newPath,$width,$height,$element[0]->typ);
        app()->make('ImageSizes')->insert(array('id_picture'=>$element[0]->id_plik,'id_size'=>$id_size));

        if($result){
            $request->getSession()->flash('successMessage','Pomyślnie dodano rozmiar!');
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete(Request $request,$id){
        $result = app()->make('bannery')->delete($id);
        if($result){
            $request->getSession()->flash('successMessage','Pomyślnie usunięto baner!');
            return redirect($_SERVER['HTTP_REFERER']);
        } else{
            $request->getSession()->flash('errorMessage','Wpisano błędne dane!');
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function deleteElement(Request $request,$id){
        $result = app()->make('banneryElements')->delete($id);
        if($result){
            $request->getSession()->flash('successMessage','Pomyślnie usunięto banner!');
            return redirect($_SERVER['HTTP_REFERER']);
        } else{
            $request->getSession()->flash('errorMessage','Wpisano błędne dane!');
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function changeActivity(Request $request,$id){
        $result = app()->make('bannery')->changeActivity($id);
        if($result){
            $request->getSession()->flash('successMessage','Aktywowano banner!');
            return redirect($_SERVER['HTTP_REFERER']);
        } else{
            $request->getSession()->flash('successMessage','Deaktywowano banner!');
            return redirect($_SERVER['HTTP_REFERER']);
        }
        return redirect($_SERVER['HTTP_REFERER']);
    }

    public function changeElementActivity(Request $request,$id){
        $result = app()->make('banneryElements')->changeActivity($id);
        if($result){
            $request->getSession()->flash('successMessage','Aktywowano element!');
            return redirect($_SERVER['HTTP_REFERER']);
        } else{
            $request->getSession()->flash('successMessage','Deaktywowano element!');
            return redirect($_SERVER['HTTP_REFERER']);
        }
        return redirect($_SERVER['HTTP_REFERER']);
    }

}