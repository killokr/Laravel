<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        
        $allUser = UserModel::all()->sortDesc();
        $loggedUsername = session()->get('loggedUsername');
        $isAdmin = session()->get('isAdmin');
        return view('admin.index')->with(['loggedUsername'=>$loggedUsername,'isAdmin'=>$isAdmin,'allUser'=>$allUser]);
    }
}
