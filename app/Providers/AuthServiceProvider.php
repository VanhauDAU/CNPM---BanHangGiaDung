<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Admin\Post;
use App\Policies\PostPolicy;
use App\Policies\UserPolicy;
use App\Policies\StaffPolicy;
use App\Models\admin\modules;
use App\Models\admin\Staffs;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Staffs::class => StaffPolicy::class,
        User::class => UserPolicy::class,
        
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        // ResetPassword::createUrlUsing(function ($users, string $token){
        //     dd($users);
        //     return 'https:example.com/reset-password?token='.$token;
        // });

        // Định nghĩa Gate
        // Gate::define('posts.add',function(User $user){
        //     // dd($user);
        //     return true;
        // });
        // 1. Lấy danh sách module
        $moduleList = modules::all();
        if(!empty($moduleList->count() > 0)){
            foreach($moduleList as $module){
                Gate::define($module->name, function(User $user) use ($module){
                    $roleJson = $user->chucvu->phan_quyen;
                    if(!empty($roleJson)){
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr,$module->name);
                        return $check;
                    }
                    return false;
                });
                Gate::define($module->name.'.add', function(User $user) use ($module){
                    $roleJson = $user->chucvu->phan_quyen;
                    if(!empty($roleJson)){
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr,$module->name,'add');
                        return $check;
                    }
                    return false;
                });
                Gate::define($module->name.'.edit', function(User $user) use ($module){
                    $roleJson = $user->chucvu->phan_quyen;
                    if(!empty($roleJson)){
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr,$module->name,'edit');
                        return $check;
                    }
                    return false;
                });
                Gate::define($module->name.'.delete', function(User $user) use ($module){
                    $roleJson = $user->chucvu->phan_quyen;
                    
                    if(!empty($roleJson)){
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr,$module->name,'delete');
                        // dd($module->name);
                        return $check;
                    }
                    return false;
                });
            }
        }
    }
}
