<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 27.10.2018
 * Time: 18:41
 */

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;

class ManageController extends Controller{

    public function index(){
        return view('manage/index');
    }
}