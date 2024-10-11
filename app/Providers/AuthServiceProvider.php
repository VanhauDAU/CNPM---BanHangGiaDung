<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\PostPolicy;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
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
        Gate::define('posts.add',[PostPolicy::class,'add']);
        Gate::define('posts.edit',[PostPolicy::class,'edit']);
    }
}
