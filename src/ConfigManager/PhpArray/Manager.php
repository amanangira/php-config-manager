<?php
	namespace AmanAngira\ConfigManager\PhpArray;
    
    use AmanAngira\ConfigManager\ManagerSkeleton; 

	class Manager extends ManagerSkeleton{
		private $requestCacheManager;
		const CONFIG_EXTENSION = '.php';

		public function __construct($configFilesPath){
			$this->setConfigFilesPath($configFilesPath);
			$this->setConfigFileExtension(self::CONFIG_EXTENSION);
		}

		public function get($parameter, $defaultValue = ManagerSkeleton::NOT_FOUND_FLAG){
			$methodNamespace =  __METHOD__;
			$parameter = trim($parameter);
			$this->validateParameterString($parameter, $methodNamespace);
			$isCached = $this->isRequestCached($parameter);
			if($isCached)
				return $this->getFromRequestCache($parameter);
			list( $file, $params ) = $this->getParamsFromString( $parameter );
			$config = $this->checkAndGetFile($file);
			$value = $this->extractFieldFromConfig($config, $params);
			if( $value == self::NOT_FOUND_FLAG )
				return $defaultValue;
			return $value;
		}

		private function checkAndGetFile($filePath){
			$methodNamespace =  __METHOD__;
			if(file_exists($filePath)){
                $config = include( $filePath );
                if( is_array($config) )
					return $config;
				throw new \Exception( "$methodNamespace invalid PHP array in $filePath" );
			}
			throw new \Exception( "$methodNamespace Config file $filePath not found." );
		}

		private function extractFieldFromConfig($config, $params){
		   	if( count( $params ) < 1 )
	            return $config;
	        $key = $params[0];
	        if( array_key_exists( $key, $config ) ){
	            array_splice( $params, 0, 1);
	            return $this->extractFieldFromConfig( $config[$key], $params );
	        }
	        return self::NOT_FOUND_FLAG;
		}

		private function validateParameterString($parameterString, $namespace){
			if( !is_string($parameterString)  )
				throw new \Exception("Parameter provided in $namespace should be a string, " . gettype($parameterString) . " given." );
			if( $parameterString == '' )
				throw new \Exception("Empty string provided for $namespace.");
		}
	}
