# PHP Configuration Manager

This library allows developers to use file based configurations in easy, organized and syntax friendly way. The library has 
been built keeping ease and minimal effort for developer in mind. It currently supports only two types i.e. JSON and PHP 
arrays. The base classes are easily extendible for further file type supports. 

## Installation
### Composer
`composer require amanangira/php-config-manager`

### Git 
`git clone https://github.com/amanangira/php-config-manager.git`

## Usage

## Initializing

### Php Array based configuration manager
```
use AmanAngira\ConfigManager\PhpArray\Manager;

$path = __DIR__ . '/config'; //Directory where the library expects the configuration files
$manager = new Manager($path); //Initializing object with the configurations path
```

### JSON based configuration manager
```
use AmanAngira\ConfigManager\Json\Manager;

$path = __DIR__ . '/config'; //Directory where the library expects the configuration files
$manager = new Manager($path); //Initializing object with the configurations path
```

## Accessing Configuration Value
```
$value = $manager->get('foo.var'); //use file name only (without extension) followed by full stop to access child values
if( $value === Manager::NOT_FOUND_FLAG ) //library flag if a value is not defined 
  echo "Value not defined";
else
  echo $value;
```
