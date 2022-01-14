<?php

namespace Dankerizer\Jokul;
use Illuminate\Support\ServiceProvider;

class DokuJokulServiceProvider extends ServiceProvider{

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/jokul.php', 'jokul'

        );
    }
}
