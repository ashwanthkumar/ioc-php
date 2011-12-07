<?php

/**
 *	Registry for maintaing the list of Services to be used for Injection in the
 *	application. 
 *
 *	Registry is a sample Implementation of IoC_Container interface as a 
 *	Container of IoC. It is implemented using a simple Array datastructure. 
 *
 *	I'm totally newbie to this IoC thingy and stuff, any suggestions and 
 *	improvements is highly appreciated. -- 07/12/2011, Ashwanth
 *
 *	@module IoC
 *	@author Ashwanth Kumar <ashwanth@ashwanthkumar.in>
 *	@since	0.1
 **/
class Registry implements IoC_Container {

	/**
	 *	Datastructure that contains the services of IoC and acts as the 
	 *	container.
	 **/
	private $container_array;
	
	/**
	 *	Static instance of the Registry in the memory
	 **/
	private static $registry_instance;
	
	/**
	 *	Default constructor of the Registry, generally you do not need to create
	 *	an object, instead use 
	 *
	 *	Registry::get() to get the Registry Instance
	 **/
	private function __construct() {
		// Initialize the Container Array 
		/**
		 *	Container is arranged in the following manner.
		 *
		 *	$name = 'ServiceName';
		 *	$this->container_array[$name]['object'] -- Returns the object
		 *															 instance
		 *
		 *	$this->container_array[$name]['description'] -- Returns the Service
		 *															Description
		 *
		 *	$name -- Service Name is the key of the array, hence there cannot be
		 *				duplicate service
		 **/
		$this->container_array = array();
		
	}
	
	/**
	 *	Get the static instance of Registry to access the IoC Container services
	 *
	 *	@return	Registry object instance
	 **/
	public static function get() {
		if(!self::$registry_instance) self::$registry_instance = new self();
		
		return self::$registry_instance;
	}
	
	// Implementing the interface IoC_Cotainer
	
	/**
	 *	Get the Service Object instance from the Container and return the Object
	 *	instance.
	 *
	 *	@param	$name	Name of the service to fetch
	 *	
	 *	@return	Object instance, refered by the $name parameter
	 *	@throws ServiceNotFoundException If Service is not found in Container
	 **/
	public function getService($name) {
		if(isset($this->container_array[$name])) 
			return $this->container_array[$name]['object'];
		else
			throw new ServiceNotFoundException;
	}
	
	/**
	 *	Adds the Service to the IoC Container
	 *
	 *	@param	$name			Name of the Service
	 *	@param	$object			Object instance of the service to initialize
	 *	@param	$description	Description of the Service
	 *
	 *	@return	TRUE on successful completion
	 *	@throws ServiceNameAlreadyTaken If service name already exist
	 **/
	public function addService($name, $object, $description = "Sample Description") {
		if(isset($this->container_array[$name])) throw new ServiceNameAlreadyTakenException;
		else {
			// Service can be safely added
			$this->container_array[$name]['object'] = $object;
			$this->container_array[$name]['description'] = $description;
			
			return TRUE;
		}
	}
	
	/**
	 *	Returns the list of all the services available in the IoC Container
	 *
	 *	@return Array of values each of which contains the values in the form:
	 *		$val['name']		Name of the Service
	 *		$val['object']		Object instance of the Service
	 *		$val['description']	Description the service
	 **/
	public function listAll() {
		$service_list = array();
		while($service_name = current($this->container_array)) {
			$service = array();
			$service['name'] = key($this->container_array);
			$service['object'] = $service_name['object'];
			$service['description'] = $service_name['description'];
			
			$service_list[] = $service;
			
			next($this->container_array);
		}
		
		return $service_list;
	}
}

