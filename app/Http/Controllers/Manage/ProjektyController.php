<?php

namespace App\Http\Controllers\manage;

use App\Http\Form\AddPageForm;
use App\Http\Form\ChooseProjectForm;
use App\Http\Form\KonfiguracjaForm;
use App\Http\Form\PageContentForm;
use App\Http\Form\ProjektDodajForm;
use App\Http\Model\BaseModel;
use App\Http\Model\KonfiguracjaModel;
use App\Http\Model\PagesModel;
use App\Http\Model\ProjektyModel;
use App\Http\Service\SlugService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjektyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->getSession()->put('active','projekty');
        $projekty = ProjektyModel::getProjekty();
        return view('projekty/index',array('projekty'=>$projekty));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $f = new ProjektDodajForm();
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
        return view('projekty/dodaj',array('form'=>$form));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->route('id');
        ProjektyModel::removeProjekt($id);
        $request->getSession()->flash('successMessage','Pomyślnie usunięto projekt z listy!');
        return redirect("/projekty");
    }

    /**
     * @Any("/projekty/konfiguracja")
     */
    public function konfiguracja(Request $request){
        $id_projektu = $request->route('id_projektu');
        $czyIstnieje = KonfiguracjaModel::czyIstnieje($id_projektu);
        $f = new KonfiguracjaForm();
        $konfiguracja = KonfiguracjaModel::selectWhere($id_projektu);
        $form = $f::prepareForm();
        //dump($czyIstnieje);die;
        if($czyIstnieje){
            $form[0]['input']['value'] = $konfiguracja[0]->sciezka_server;
            $form[1]['input']['value'] = $konfiguracja[0]->sciezka_route;
            $form[2]['input']['value'] = $konfiguracja[0]->sciezka_view;
        }
        $form[3]['input']['value'] = $id_projektu;

        if($request->getMethod() == "POST"){
            $data = $request->all();

            if($czyIstnieje){
                $result = KonfiguracjaModel::update($data,$id_projektu);
            } else {
                $result = KonfiguracjaModel::insert($data);
            }
            if($result){
                $request->getSession()->flash('successMessage','Pomyślnie dodano konfigurację!');
                return redirect($_SERVER['HTTP_REFERER']);
            } else {
                $request->getSession()->flash('errorMessage','Napotkano na błąd!');
                return redirect($_SERVER['HTTP_REFERER']);
            }
        }
        return view('projekty/konfiguracja',array('form'=>$form,'konfiguracja'=>$konfiguracja,'id_projektu'=>$id_projektu));
    }

    /**
     * Any('/projekty/manage)
     */
    public function manage(Request $request){
        $data_get = $request->all();
        $f = new ChooseProjectForm();
        $form = $f::prepareForm();
        $f2 = new PageContentForm();
        $formContent = $f2::prepareForm();
        $projekty = ProjektyModel::getProjekty();
        $projekty_choose = array();
        foreach($projekty as $p){
            $projekty_choose[$p->id] = $p->nazwa;
        }
        $form[0]['input']['values'] = $projekty_choose;
        $form[0]['input']['default'] = $projekty[0]->nazwa;
        $id = $projekty[0]->id;
        $nazwa_strony = $projekty[0]->nazwa;
        if($request->getMethod() == "POST"){
            $id = $request->get('select');
        }

        $pages = PagesModel::getPagesById($id);
        $request->getSession()->put('active','manage');
        $formContent[0]['input']['value'] = $pages[0]->nazwa;
        if(isset($data_get['page'])){
            $nazwa_strony = $data_get['page'];
            $formContent[0]['input']['value'] = $data_get['page'];
        }

        return view('projekty/manage',array('projekty'=>$projekty,'pages'=>$pages,'id'=>$id,'nazwa_strony'=>$nazwa_strony,'form'=>$form,'formContent'=>$formContent));
    }

    /**
     * Any('/projekty/manage/addPage)
     */
    public function addpage(Request $request,$id){
        $f = new AddPageForm();
        $form = $f::prepareForm();
        if($request->getMethod() == "POST"){
            $data = $request->all();
            $this->validate($request,[
                'nazwa'=>'required|unique:cms_projekty_strony',
                'route'=>'required|unique:cms_projekty_strony',
            ]);
            $data['slug'] = SlugService::createSlug($data['nazwa']);
            $data['id_projektu'] = $id;
            $result = PagesModel::insert($data);
            if($result){
                $request->getSession()->flash('successMessage','Pomyślnie dodano stronę!');
                return redirect('/projekty/manage');
            } else {
                $request->getSession()->flash('errorMessage','Napotkano na błąd!');
                return redirect($_SERVER['HTTP_REFERER']);
            }
        }

        return view('projekty/addpage',array('id'=>$id,'form'=>$form));
    }

    public function deletepage(Request $request,$id){
        $result = PagesModel::deletePage($id);
        if($result){
            $request->getSession()->flash('successMessage','Pomyślnie usunięto stronę!');
        } else {
            $request->getSession()->flash('errorMessage','Napotkano na błąd!');
        }
        return redirect('/projekty/manage');
    }

    public function addContent(Request $request){
        if($request->getMethod() == "POST"){
            $request->all();
            $this->validate($request,[
                'name' => 'required',
            ]);
        }
        return redirect('/projekty/manage');
    }
}
