<?php

define("SEP",DIRECTORY_SEPARATOR);
define("ROOTPATH",dirname(__DIR__).SEP);
define("CONTROLLER", ROOTPATH.'Controller'.SEP);
define("MODEL", ROOTPATH.'Model'.SEP);
define("VIEW", ROOTPATH.'View'.SEP);

//autoload all classes
$options = [ROOTPATH, CONTROLLER, MODEL, VIEW];
set_include_path(get_include_path().PATH_SEPARATOR.implode(PATH_SEPARATOR, $options));

spl_autoload_register('spl_autoload');