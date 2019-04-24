<?php

// RequestCacheManager
class Manager{
    
    /**
     * a shared variable across all objects, which would be 
     * used to set and get config values under current
     * request scope. Will contain key - value of getter string and volume
     */
    private static $currentScopeConfigs = [];

    protected function isConfigRequestCached($parameterString){
        return array_key_exists( trim($parameterString), ManagerSkeleton::$currentScopeConfigs );
        
    }

    protected function getConfigFromRequestCache($parameterString){
        if( $this->isConfigRequestCached( $parameterString ) )
            return ManagerSkeleton::$currentScopeConfigs[$parameterString];
        throw new \Exception("No config request cached for $parameterString");
    }

    protected function setConfigInRequestCache($parameterString, $value){
        ManagerSkeleton::$currentScopeConfigs[$parameterString] = $value;	
    }
}