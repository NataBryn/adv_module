<?php

    namespace Modules\Banners\Facades;

    use Illuminate\Support\Facades\Facade;

    class BannerFacade extends Facade
    {
        protected static function getFacadeAccessor()
        {
            return 'Banner';
        }
    }
