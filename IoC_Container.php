<?php

/**
 *	Interface that all IoC containers must implement to be used with IoC module
 *
 *	@author	Ashwanth Kumar
 *	@date	07/12/2011
 *
 *	@version 0.1
 *	@module IoC
 **/
interface IoC_Container {

	/**
	 *	Get the Service referenced by $name from the container
	 *
	 *	@param	$name	Name of the Service that needs to be fetched from
	 *					Registry
	 *
	 *	@throws	ServiceNotFoundException If $name is not found in the registry
	 **/
	public function getService($name);
	
	/**
	 *	Adds a Service to the Container refered by the $name and $object 
	 *	instance and optional $description that can be added to better describe
	 *	the work of the Service. 
	 *
	 *	@param	$name			Name of the Service
	 *	@param	$object			Object instance of the service
	 *	@param	$description	Optional description of the Service
	 *
	 *	@throws ServiceNameAlreadyTaken	If there is already another service that
	 *			exist in the same name.
	 **/
	public function addService($name, $object, $description = null);
	
	/**
	 *	List all the Services in the Container in an associative array, each of
	 *	the form:
	 *
	 *		$val['name']		Name of the Service
	 *		$val['object']		Object instance of the Service
	 *		$val['description']	Description the service
	 **/
	public function listAll();
}

