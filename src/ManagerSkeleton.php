<?php
	
	namespace AmanAngira\ConfigManager;

	abstract class ManagerSkeleton implements ManagerInterface{
		protected $configFilesPath;
        protected $extension;
        const PARAMETER_DELIMITER = '.';
		const NOT_FOUND_FLAG = null;
        
		/**
		 * Returns the path of directory where the class
		 * would assume the config files to be
		 * @return string 
		 */
		public function getConfigFilesPath(){
			return $this->configFilesPath;
		}
		/**
		 * Setter for path of directory where the class
		 * would assume the config files to be
		 * @return object of extended class
		 */
		protected function setConfigFilesPath($path){
			$this->configFilesPath = $path;
			return $this;
		}
		
		/**
		 * Getter for class implementation to get file
		 * extension of config file
		 * @return string
		 */
		protected function getConfigFileExtension(){
			return $this->extension;
		}

		/**
		 * Setter for class implementation to be invoked
		 * in constructor to set file extension
		 * @param string $extension 
		 */
		protected function setConfigFileExtension($extension){
			$this->extension = $extension;
			return $this;
		}

		protected function createAbsolutePath($fileName){
			return $this->getConfigFilesPath() . '/' . $fileName . $this->getConfigFileExtension();
		}

		protected function getParamsFromString($parameter){
			if( strpos($parameter, self::PARAMETER_DELIMITER) === false )//if no nesting found return $parameters as filename
				return [ 
					$this->createAbsolutePath($parameter) , 
					[]
				];
			$parts = explode(self::PARAMETER_DELIMITER, $parameter);
			$fileName = trim($parts[0]);
			array_splice($parts, 0, 1);//Remove file name from array and sanitize indexes
			return [
				$this->createAbsolutePath($fileName),
				$parts
			];
		}

	}
