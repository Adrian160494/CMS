<?php

namespace App\Http\Controllers\manage;

use App\Http\Form\ProjektDodajForm;
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
            ProjektyModel::addProjekt($data);
            $request->getSession()->flash('successMessage','Pomyślnie dodano nowy projekt!');
            return redirect('/projekty');
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
    public function destroy($id)
    {
        //
    }

    public function setKonfiguracja(){

    }
}
