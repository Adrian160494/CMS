<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 01.01.2019
 * Time: 17:37
 */
namespace App\Http\Controllers\Ustawienia;

use App\Http\Controllers\Controller;
use App\Http\Form\AddGalleryElement;
use App\Http\Form\AddGalleryForm;
use App\Http\Service\SlugService;
use Illuminate\Http\Request;

class GalleryController extends Controller{

    protected $galleryModel;
    protected $galleryElementsModel;

    public function __construct()
    {
        $this->galleryModel = app()->make('Galleries');
        $this->galleryElementsModel = app()->make('GalleriesElements');
    }

    public function index(Request $request){
        $request->getSession()->put('active','galerie');
        $galleries = $this->galleryModel->getGalleries();

        return view('ustawienia/gallery/list',array(
            'galleries'=>$galleries,
        ));
    }

    public function create(Request $request){

        $f = new AddGalleryForm();
        $form = $f::prepareForm();

        if($request->getMethod() == "POST"){
            $data = $request->all();
            $data['slug'] = SlugService::createSlug($data['name']);
            if(!isset($data['is_active'])) {
                $data['is_active'] = 0;
            } elseif($data['is_active'] == "on"){
                $data['is_active'] = 1;
            }

            $result = $this->galleryModel->insert($data);
            if($result){
                $request->getSession()->flash('successMessage','Pomyślnie dodano nową galerie');
                return redirect()->route('config.galleries.list');
            } else{
                $request->getSession()->flash('errorMessage','Wystąpił błąd zapisu!');
                return redirect($_SERVER['HTTP_REFERER']);
            }
        }

        return view('ustawienia/gallery/dodaj',array(
            'form'=>$form,
        ));
    }

    public function delete(Request $request,$id){
        $result = $this->galleryModel->delete($id);
        if($result){
            $request->getSession()->flash('successMessage','Pomyślnie usunięto galerie!');
            return redirect($_SERVER['HTTP_REFERER']);
        } else{
            $request->getSession()->flash('errorMessage','Wpisano błędne dane!');
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function changeActivity(Request $request,$id){
        $result = $this->galleryModel->changeActivity($id);
        if($result){
            $request->getSession()->flash('successMessage','Aktywowano galerie!');
            return redirect($_SERVER['HTTP_REFERER']);
        } else{
            $request->getSession()->flash('successMessage','Deaktywowano galerie!');
            return redirect($_SERVER['HTTP_REFERER']);
        }
        return redirect($_SERVER['HTTP_REFERER']);
    }

    public function configGallery(Request $request,$id){
        $params = $request->all();
        $elements = $this->galleryElementsModel->getElements($id);
        $size = app()->make('Size')->getSize();
        return view('ustawienia/gallery/config',array(
            'id'=>$id,
            'elements'=>$elements,
        ));
    }

    public function createElement(Request $request,$id){
        $f = new AddGalleryElement();
        $form = $f::prepareForm();
        $form[0]['input']['value'] = $id;
        if($request->getMethod() == "POST"){
            $params = $request->all();
            $galleryService = $this->galleryElementsModel;
            $gallery = $this->galleryModel->selectWhere($id,false);
            $result = null;
            if($_FILES['file']['name']){
                $result = $this->uploadFile(SlugService::createSlug($gallery[0]->name),true);
            }
//            if($result != 0){
            $params = $request->all();
            if(!isset($params['is_acvtive'])){
                $params['is_active'] = 0;
            }
            if($result){
                $data = array(
                    'id_gallery'=>$id,
                    'name'=>$params['name'],
                    'id_plik'=>$result ? $result : null,
                    'is_active'=> $params['is_active'] == "on" ? 1 : 0,
                );
            } else {
                $data = array(
                    'id_gallery'=>$id,
                    'name'=>$params['name'],
                    'is_active'=> $params['is_active'] == "on" ? 1 : 0,
                );
            }
            $result2 = $galleryService->insert($data);
            if($result2){
                $request->getSession()->flash('successMessage','Pomyślnie dodano element banneru');
                return redirect()->route('config.galleries.config',array('id'=>$id));
            } else{
                $request->getSession()->flash('errorMessage','Wystąpił błąd zapisu!');
                return redirect($_SERVER['HTTP_REFERER']);
            }

//            } else{
//                $request->getSession()->flash('errorMessage','Wystąpił błąd przy dodawaniu pliku');
//                return redirect($_SERVER['HTTP_REFERER']);
//            }

        }
        return view('ustawienia/gallery/dodajElement',array(
            'id_gallery'=>$id,
            'form'=>$form,
        ));
    }

    public function editElement(){

    }

    public function deleteElement(Request $request,$id){
        $result = $this->galleryElementsModel->delete($id);
        if($result){
            $request->getSession()->flash('successMessage','Pomyślnie usunięto element!');
            return redirect($_SERVER['HTTP_REFERER']);
        } else{
            $request->getSession()->flash('errorMessage','Wpisano błędne dane!');
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }
}