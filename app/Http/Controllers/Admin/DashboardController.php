<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class DashboardController extends Controller
{
    //
    public function __construct(){

    }
    public $data=[];
    public function index(){
        return view('admin.dashboard.index');
    }
    public function get_info_detail(){
        $user = new User();
        $adminInfo = $user->getAdminInfo(Auth::user()->username);
        return view('admin.info.info_detail', compact('adminInfo'));
    }

}
