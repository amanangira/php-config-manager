<?php
	namespace AmanAngira\Config;
    
    use AmanAngira\ConfigManager\ManagerSkeleton; 

	class JsonManager extends ManagerSkeleton{
		const CONFIG_EXTENSION = '.json';

		public function __construct($configFilesPath){
			$this->setConfigFilesPath($configFilesPath);
			$this->setConfigFileExtension(self::CONFIG_EXTENSION);
		}

		public function get($parameter, $defaultValue){
			$methodNamespace =  __METHOD__;

			if( !is_string($parameter)  )
				throw new \Exception("Parameter provided in $methodNamespace should be a string, " . gettype($parameter) . " given." );
			if( trim($parameter) == '' )
				throw new \Exception("Empty string provided for $methodNamespace.");

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
				$content = file_get_contents($filePath);
				$config = json_decode( $content, true );
				$validJson = (json_last_error() == JSON_ERROR_NONE);
				if($validJson) 
					return $config;
				throw new \Exception( "$methodNamespace invalid JSON in $filePath" );
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
	}
