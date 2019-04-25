<?php
    
    namespace AmanAngira\RequestCacheManager;

    class RequestCacheFactory{

        public static function build(){
            return new Manager();
        }
    }
