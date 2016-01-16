[![No Maintenance Intended](http://unmaintained.tech/badge.svg)](http://unmaintained.tech/)

# IoC (Inversion of Control) Module of BlueIgnis
#### Written by Ashwanth Kumar \<ashwanth@ashwanthkumar.in\>
#### Version 0.1

## Introduction
An attempt to create a dependency injection for PHP. Current this module independently implements a IoC container (called Registry) for storing all the Services and their corresponding object to service the request which can be injected dynamically. 

## Design Goal:
- Add an Annotation @Inject("ServiceName") to dynamically assign the value of the property or object from our little IoC (Inversion of Control) Registry. 
- Create a Registry of Services, which are loaded and can always be re-used anytime in the code using @Inject("ServiceName")

This module uses [**ARO**](https://github.com/ashwanthkumar/aro-php "Visit ARO project website") in *BlueIgnis* for implementing @Inject style dependency injection. For normal independent usages refer **Usages Example**

##  Usage Examples:

### Add a service to the IoC Container
	// Load the IoC Module
	require_once("/path/to/lib/ioc/IoC.php");
	
	// Create a DB Connection
	$dao = new PDO($dsn, $user, $pass);

	// Get the Registry Instance
	$container = Registry::get();
	$container->addService("DAO", $dao, "DB Connection");	// Valid
	
	// throws ServiceNameAlreadyTakenException Exception
	$container->addService("DAO", new stdClass, "Another sample Object Instance");

 
### Get a particular Service
	// Load the IoC Module
	require_once("/path/to/lib/ioc/IoC.php");
	
	// Get the Registry Instance
	$registry = Registry::get();
	$db = $registry->getService("DAO");	// Valid
	$db = $registry->getService("DoNotExist"); // throws ServiceNotFound Exception


### Get all the services
	// Load the IoC Module
	require_once("/path/to/lib/ioc/IoC.php");

	// Get the Registry Instance
	$registry = Registry::get();
	$service_list = $registry->listAll();

	// Loop through the list of services and display its properties
	foreach($service_list as $service) {
		echo $service['name'] . '\n'; 		// Name of the service
		$obj = $service['object'] . '\n'; 	// Object Instance
		echo $service['description'] . '\n'; // Description of the Service
	}

