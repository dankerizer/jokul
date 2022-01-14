<?php

namespace Dankerizer\Jokul;
use Illuminate\Support\ServiceProvider;

class DokuJokulServiceProvider extends ServiceProvider{


    public function boot(){
        $this->publishes([
            __DIR__ . '/../config/jokul.php' => config_path('jokul.php'),
        ]);

    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/jokul.php', 'jokul'

        );
    }
}
