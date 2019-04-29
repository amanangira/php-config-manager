<?php
    
    namespace AmanAngira\RequestCacheManager;

    use AmanAngira\RequestCacheManager\Manager;

    class RequestCacheFactory{

        public static function build(){
            return new Manager();
        }
    }
