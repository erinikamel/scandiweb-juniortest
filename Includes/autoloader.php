<?php

define("DS",DIRECTORY_SEPARATOR);
define("ROOT_PATH",dirname(__DIR__).DS);
define("CONTROLLER", ROOT_PATH.'Controller'.DS);
define("MODEL", ROOT_PATH.'Model'.DS);
define("VIEW", ROOT_PATH.'View'.DS);

//autoload all classes
$module = [ROOT_PATH, CONTROLLER, MODEL, VIEW];
set_include_path(get_include_path().PATH_SEPARATOR.implode(PATH_SEPARATOR, $module));

spl_autoload_register('spl_autoload');