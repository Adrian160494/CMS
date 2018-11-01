<?php

namespace App\Http\Controllers\manage;

use App\Http\Form\KonfiguracjaForm;
use App\Http\Form\ProjektDodajForm;
use App\Http\Model\BaseModel;
use App\Http\Model\KonfiguracjaModel;
use App\Http\Model\ProjektyModel;
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
            $data['slug'] = $data['nazwa'];
            if(!isset($data['is_active'])){
                $data['is_active'] = 0;
            }
            $result = ProjektyModel::insert($data);
            if($result){
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
}
