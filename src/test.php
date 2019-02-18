<?php
	use AmanAngira\Config\JsonConfig;	

	$path = __DIR__ . '/testConfigFiles';
	$config = new JsonConfig($path);

	$value = $config->get('sample.code');

	print_r($value);

