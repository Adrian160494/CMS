<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 27.10.2018
 * Time: 18:41
 */

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Form\ChooseProjectForm;
use App\Http\Form\CmsMenuDodajForm;
use App\Http\Model\MenuModel;
use App\Http\Model\ProjektyModel;
use App\Http\Service\SlugService;
use Illuminate\Http\Request;

class CmsController extends Controller{

    public function index(Request $request){
        $request->getSession()->put('active','menu');
        $data = $request->all();
        $f = new ChooseProjectForm();
        $form = $f::prepareForm();
        $projekty = ProjektyModel::getProjekty();
        $projekty_choose = array();
        foreach($projekty as $p){
            $projekty_choose[$p->id] = $p->nazwa;
        }
        $id_projektu = $projekty[0]->id;
        $form[0]['input']['values'] = $projekty_choose;
        $form[0]['input']['default'] = $projekty[0]->nazwa;
        if(isset($data['id_projektu'])){
            $id_projektu = $request->get('id_projektu');
            $form[0]['input']['default'] = $id_projektu;
        }
        $menu = MenuModel::getMenuByProject($id_projektu);
        return view('cms/index',array(
            'id_projektu'=>$id_projektu,
            'menu'=>$menu,
            'form'=>$form
        ));
    }

    public function changeProjekt(Request $request){
      if($request->getMethod() == "POST"){
          $id_projektu = $request->all()['select'];
      }
        return redirect('/cms/menu?id_projektu='.$id_projektu);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $f = new CmsMenuDodajForm();
        $form = $f::prepareForm();
        if($request->getMethod() == "POST"){
            $data = $request->all();
            $data['slug'] = SlugService::createSlug($data['nazwa']);
            if(!isset($data['is_active'])){
                $data['is_active'] = 0;
            }
            $validate = $this->validate($request,[
                'nazwa'=>'required|unique:cms_projekty',
                'url'=>'required|min:7|max:30',
            ]);
            $result = ProjektyModel::addProjekt($data);
            if($result){
                $result2 = ProjektyModel::getProjektBySlug($data['slug']);
                PagesModel::addMainPage($result2[0]->id);
                $request->getSession()->flash('successMessage','Pomyślnie dodano nowy projekt!');
                return redirect('/projekty');
            } else{
                $request->getSession()->flash('errorMessage','Wpisano błędne dane!');
                return redirect('/projekty/create');
            }

        }
        return view('cms/dodaj',array('form'=>$form));
    }

}