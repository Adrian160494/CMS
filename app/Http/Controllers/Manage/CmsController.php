<?php
/**
 * Created by PhpStorm.
 * User: Adrian
 * Date: 27.10.2018
 * Time: 18:41
 */

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CmsController extends Controller{

    public function index(Request $request){
        $request->getSession()->put('active','menu');
        return view('cms/index');
    }
}