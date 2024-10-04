<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\clients\contacts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class DashboardController extends Controller
{
    //
    public function __construct(){

    }
    public $data=[];
    public function index(){
        $today = \Carbon\Carbon::today();
        $countContact = contacts::whereDate('created_at', $today)->count();
        
        return view('admin.dashboard.index', compact('countContact'));
    }
    public function get_info_detail(){
        $user = new User();
        $adminInfo = $user->getAdminInfo(Auth::user()->username);
        return view('admin.info.info_detail', compact('adminInfo'));
    }
}
