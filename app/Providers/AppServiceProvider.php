<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        Validator::extend('unique_other_email', function($attribute, $value, $parameters, $validator) {

            $user = User::find($parameters[0]);

            if($user->email != $value){
                $tmp_user = User::where(['email'=>$value])->first();
                if($tmp_user){
                    return false;
                }
            }
            return true;
        });

        Validator::extend('unique_other_phone', function($attribute, $value, $parameters, $validator) {

            $user = User::find($parameters[0]);

            if($user->phone != $value){
                $tmp_user = User::where(['phone'=>$value])->first();
                if($tmp_user){
                    return false;
                }
            }
            return true;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
