<?php

// Get the IoC Instance
require_once("../IoC.php");

/**
 *	IoC Test class implemented using PHPUnit
 *
 *	@author Ashwanth Kumar <ashwanth@ashwanthkumar.in>
 **/
class IoCTest extends PHPUnit_Framework_TestCase {

	private $registry; 
	
	/**
	 *	Test the Registry::get() method
	 *
	 *	@test
	 **/
	public function RegistryGetCheck() {
		// Get the Registry reference
		$this->registry = Registry::get();
		
		$this->assertEquals('Registry', get_class($this->registry));
	}
	
	/**
	 *	Test for adding a Service Object to the registry
	 *
	 *	@test
	 *	@depends RegistryGetCheck
	 **/
	public function AddServiceCheck() {	
		if(!isset($this->registry))	$this->registry = Registry::get();
		
		$testObject = new stdClass;
		$testObject->value = "Value";
		$testObject->number = 1;
		
		$add_service_test = $this->registry->addService("Test", $testObject);
		
		$this->assertTrue($add_service_test);
	}
	
	/**
	 *	Test for getting the service we get at the previous method of test
	 *
	 *	@test
	 *	@depends RegistryGetCheck
	 *	@depends AddServiceCheck
	 **/
	public function GetServiceCheck() {
		if(!isset($this->registry))	$this->registry = Registry::get();

		$test_service = $this->registry->getService("Test");
		
		$this->assertEquals(1, $test_service->number);
		$this->assertEquals("Value", $test_service->value);
	}
	
	/**
	 *	Testing if the listAll() is working properly of the Registry
	 *
	 *	@test
	 **/
	public function ListAllCheck() {
		if(!isset($this->registry))	$this->registry = Registry::get();
		
		$service_list = $this->registry->listAll();
		
		$this->assertEquals(1, count($service_list));
	}
	
	/**
	 *	Testing if the ServiceNotFoundException exception is thrown properly by the Registry.
	 *
	 *	@expectedException	ServiceNotFoundException
	 *	@test
	 **/
	public function ServiceNotFoundExceptionCheck() {
		if(!isset($this->registry))	$this->registry = Registry::get();
		
		$this->registry->getService("ThisServiceDoesNotExist");
	}
	
	/**
	 *	Testing if the ServiceNameAlreadyTakenException Exception is thrown properly by the Registry.
	 *
	 *	@expectedException ServiceNameAlreadyTakenException
	 *	@test
	 **/
	public function ServiceNameAlreadyTakenExceptionCheck() {
		if(!isset($this->registry))	$this->registry = Registry::get();
		
		$this->registry->addService("Test", new stdClass, "Another Service to be added");
	}
}

