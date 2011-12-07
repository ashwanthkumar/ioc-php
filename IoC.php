<?php

/**
 *	This file acts as the placeholder for the module and includes all the 
 *	necessary files for using IoC module.
 * 
 *	@author	Ashwanth Kumar <ashwanth@ashwanthkumar.in>
 *	@module	IoC
 *	@version 0.1
 **/

// Get the IoC Module Paht
$ioc_module_path = dirname(__FILE__);

// Update the include_path for the module
set_include_path(get_include_path() . PATH_SEPARATOR . $ioc_module_path);

// Include the IoC_Container Interface
require_once("IoC_Container.php");

// Include the Exception classes
require_once("IoC_Exceptions/ServiceNameAlreadyTakenException.php");
require_once("IoC_Exceptions/ServiceNotFoundException.php");

// Include the IoC Implementation, currently called Registry
require_once("Registry.php");

