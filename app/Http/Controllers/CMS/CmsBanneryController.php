<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Form\ChooseProjectForm;
use App\Http\Form\CmsBannerDodajForm;
use App\Http\Model\BaneryModel;
use App\Http\Model\ProjektyModel;
use App\Http\Service\SlugService;
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
        $bannery= BaneryModel::getBaneryByProject($id_projektu);
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
            }
            $this->validate($request,[
                'nazwa'=>'required|unique:cms_bannery',
                'id_projektu'=>'required'
            ]);
            $result = BaneryModel::insert($data);
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

    public function changeActivity($id){
        BaneryModel::changeActivity($id);
        return redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete(Request $request,$id){
        $result = MenuPositionModel::deletePositionMenu($id);
        if($result){
            $request->getSession()->flash('successMessage','Pomyślnie usunięto pozycję!');
            return redirect($_SERVER['HTTP_REFERER']);
        } else{
            $request->getSession()->flash('errorMessage','Wpisano błędne dane!');
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function deleteMenu(Request $request,$id){
        $result = BaneryModel::delete($id);
        if($result){
            $request->getSession()->flash('successMessage','Pomyślnie usunięto banner!');
            return redirect($_SERVER['HTTP_REFERER']);
        } else{
            $request->getSession()->flash('errorMessage','Wpisano błędne dane!');
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

}