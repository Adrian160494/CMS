<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Form\AddNewPostForm;
use App\Http\Form\ChooseProjectForm;
use App\Http\Form\CmsBannerDodajForm;
use App\Http\Form\CreateBanerElementForm;
use App\Http\Form\EditPostForm;
use App\Http\Model\BaneryModel;
use App\Http\Model\ProjektyModel;
use App\Http\Service\SlugService;
use Illuminate\Database\Query\Grammars\SQLiteGrammar;
use Illuminate\Http\Request;
use League\Flysystem\Config;

class CmsPostsController extends Controller {

    public $posts = null;

    public function __construct()
    {
        $this->posts = app()->make('Posts');
    }

    public function index(Request $request){
        $f = new ChooseProjectForm();
        $data = $request->all();
        $form = $f::prepareForm();
        $array = $this->getProjekty($request,$form);
        $request->getSession()->put('activeMain','cms');
        $request->getSession()->put('active','posts');
        $form = $array['form'];
        $id_projektu = $array['id_projektu'];
        if(isset($data['id_projektu'])){
            $id_projektu = $request->get('id_projektu');
            $request->getSession()->put('id_projektu',$id_projektu);
            $form[0]['input']['default'] = $id_projektu;
        }
        $posts = $this->posts->getPosts($id_projektu);
        return view('cms/posts/index',array(
            'posts'=>$posts,
            'form'=>$form,
            'id_projektu'=>$id_projektu,
        ));
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
        return redirect('/cms/posts?id_projektu='.$id_projektu);
    }

    public function create(Request $request){
        $f = new AddNewPostForm();
        $form = $f::prepareForm();
        $array = $this->createPostSelectCategory($form);
        $form = $array['form'];
        return view('cms/posts/dodaj',array(
            'form'=>$form,
        ));
    }

    public function createPostSelectCategory($form){
        $categories = array();
        $categoriesA = app()->make('Categories')->getAllCategories();
        foreach($categoriesA as $p){
            $categories[$p->id] = $p->name;
        }
        $form[2]['input']['values'] = $categories;
        $form[2]['input']['default'] = $categoriesA[0]->id;
        return array(
            'form'=>$form
        );
    }

    public function fillTheForm($post,$form){
        $form[0]['input']['value'] = $post->title;
        $form[1]['input']['value'] = $post->author;
        $form[2]['input']['default'] = $post->id_category;
        return $form;
    }

    public function edit(Request $request,$id){
        $f = new EditPostForm();
        $form = $f::prepareForm();
        $post = $this->posts->getPostById($id);
        $array = $this->createPostSelectCategory($form);
        $form = $array['form'];
        $form = $this->fillTheForm($post[0],$form);
        return view('cms/posts/edit',array(
            'form'=>$form,
            'content'=>$post[0]->description
        ));
    }
}