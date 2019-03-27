<?php
	
	namespace AmanAngira\Manager;

	interface ManagerInterface{
		
		/**
		 * Return the required parameter or entire 
		 * configuration tree
		 * @param  string $parameter - full stop seperated string for nested
		 * and simple string to access entire file tree structure. The
		 * parameter string should never contain file extension it
		 * is referencing to.
		 * @param mixed $default - default value to return if file or 
		 * require field is not found
		 * @return mixed - depending on the type of value
		 * being stored for required parameter
		 */
		public function get($parameter, $default);
	}
