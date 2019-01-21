<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class FormGroupServiceProvider extends ServiceProvider
{
    // use \Form;
    
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Form::component('textGroup','components.text', ['params','errors']);
        Form::component('textGroup','components.text', ['fieldParams','errors','info']);
        Form::component('textAreaGroup','components.textarea', ['fieldParams','errors','info']);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
