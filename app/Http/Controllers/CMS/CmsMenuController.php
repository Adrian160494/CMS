<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 27.10.2018
 * Time: 18:41
 */

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Form\AddMainMenuPositionForm;
use App\Http\Form\ChooseProjectForm;
use App\Http\Form\CmsMenuDodajForm;
use App\Http\Form\CmsMenuEdytujForm;
use App\Http\Model\MenuModel;
use App\Http\Model\MenuPositionModel;
use App\Http\Model\PagesModel;
use App\Http\Model\ProjektyModel;
use App\Http\Service\SlugService;
use Illuminate\Http\Request;

class CmsMenuController extends Controller{

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
            $request->getSession()->put('id_projektu',$id_projektu);
            $form[0]['input']['default'] = $id_projektu;
        }
        $menu = MenuModel::getMenuByProject($id_projektu);
        return view('cms/menu/index',array(
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
        $data = $request->all();
        $f = new CmsMenuDodajForm();
        $form = $f::prepareForm();
        $form[0]['input']['value'] = $data['id_projektu'];
        if($request->getMethod() == "POST"){
            $data = $request->all();
            $data['slug'] = SlugService::createSlug($data['nazwa']);
            if(!isset($data['is_active'])){
                $data['is_active'] = 0;
            }
            $this->validate($request,[
                'nazwa'=>'required|unique:cms_menu',
                'id_projektu'=>'required'
            ]);
            $result = MenuModel::insert($data);
            if($result){
                $request->getSession()->flash('successMessage','Pomyślnie dodano nowe menu!');
                return redirect('/cms/menu');
            } else{
                $request->getSession()->flash('errorMessage','Wpisano błędne dane!');
                return redirect('/cms/menu');
            }

        }
        return view('cms/menu/dodaj',array('form'=>$form));
    }

    public function editMenu(Request $request,$id,$id_projektu){

        $f = new CmsMenuEdytujForm();
        $form = $f::prepareForm();
        $data_edit = MenuModel::getMenuToEdit($id,$id_projektu);
        $form[1]['input']['value'] = $data_edit[0]->nazwa;

        if($request->getMethod() == "POST"){
            $data_update = $request->only('nazwa');
            $result = MenuModel::update($data_update,$id);
            if($result){
                $request->getSession()->flash('successMessage','Pomyślnie edytowano menu!');
                return redirect('/cms/menu');
            } else{
                $request->getSession()->flash('errorMessage','Wpisano błędne dane!');
                return redirect('/cms/menu');
            }

        }
        return view('cms/menu/edytuj',array(
            'form'=>$form,
            'id_projektu'=>$id_projektu,
            'id'=>$id,
        ));
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
        $result = MenuModel::deleteMenu($id);
        if($result){
            $request->getSession()->flash('successMessage','Pomyślnie usunięto menu!');
            return redirect($_SERVER['HTTP_REFERER']);
        } else{
            $request->getSession()->flash('errorMessage','Wpisano błędne dane!');
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function configMenu(Request $request,$id){
        $id_projektu = $request->query('id_projektu');
        $menu = MenuModel::getMenuById($id);
        $menu_positions = MenuPositionModel::getMenuPositionsByProject($id);
        return view('cms/menu/config_menu',array(
            'menu'=>$menu[0],
            'id_menu'=>$id,
            'id_projektu'=>$id_projektu,
            'menuPositions'=> $menu_positions,
        ));
    }

    public function changeActivity($id){
        MenuModel::changeActivity($id);
        return redirect($_SERVER['HTTP_REFERER']);
    }

    public function changeSubmenu($id){
        MenuModel::changeSubmenu($id);
        return redirect($_SERVER['HTTP_REFERER']);
    }

    public function createPagesSelect($request){
        $id_projektu = $request->query('id_projektu');
        $pages = PagesModel::getPagesById($id_projektu);
        $pages_choose[''] = "Wybierz";
        foreach($pages as $p){
            $pages_choose[$p->route] = $p->nazwa;
        }
        return $pages_choose;
    }

    public function dodajPozycjeMenu(Request $request, $id, $id_parent = null){
        $id_projektu = $request->query('id_projektu');
        $f = new AddMainMenuPositionForm();
        $form = $f::prepareForm();
        $form[0]['input']['value'] = $id;
        $form[1]['input']['value'] = $id_parent;
        $pages_choose = $this->createPagesSelect($request);
        $form[4]['input']['values']= $pages_choose;
        if($request->getMethod() == "POST"){
            $data = $request->except('id_projektu');
            if($data['id_parent_submenu'] == ''){
                unset($data['id_parent_submenu']);
            }
            $this->validate($request,[
                'nazwa'=>'required|unique:cms_menu_positions',
                'url'=>'required|unique:cms_menu_positions',
            ]);
            $result = MenuPositionModel::insert($data);
            if($result){
                $request->getSession()->flash('successMessage','Pomyślnie dodano pozycje menu!');
                return redirect('/cms/menu/config/'.$id.'/?id_projektu='.$id_projektu);
            } else{
                $request->getSession()->flash('errorMessage','Wpisano błędne dane!');
                return redirect('/cms/menu/config/'.$id.'/?id_projektu='.$id_projektu);
            }
        }

        return view('cms/menu/addMenuPosition',array(
            'form'=>$form,
            'id_menu'=>$id,
            'id_projektu'=>$id_projektu
        ));
    }

}