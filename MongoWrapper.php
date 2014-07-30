<?php

/**
 * Class statically creates an instance of the mongo database.
 * @package utils
 * @subpackage mongodb
 */
class MongoWrapper
{
	private static $_connection;
	private static $_instance;

	public function __construct(){}
	public function __clone(){}

	/**
	 * Method will instantiate the object and create a mongo client.
	 * Return value will change depengin on the $database parameter.
	 *
	 *
	 * @todo Get away from the self::$_connection->connected as this
	 * is deprecated and throwing an error,
	 *
	 * @param String $database the database to auto connect to.
	 * @return Object. Either the database object or the MongoClient object.
	 */
	public static function connect($database = null)
	{
		/*
		 * Establish a new static object.
		 */
		if(!isset(self::$_instance))
		{
			self::$_instance = new MongoWrapper();
		}

		/*
		 * Check to make sure that we have an object.
		 */
		if(!isset(self::$_connection))
		{
			error_log("connecting to mongo database");
			self::$_connection = new MongoClient();
		}

		/*
		 * Make sure that a connection has been established.
		 */
		if(!self::$_connection->connected) {
			throw new Exception("Error Connecting to DB.");

		}

		/*
		 * Check to see if the database string is empty. If so return the object instance.
		 */
		if(!empty($database) && is_string($database))
		{
			$connectedDatabase = self::$_connection->{$database};
			if(isset($connectedDatabase)) {
				return $connectedDatabase;
			}else{
				throw new Exception("Could not connect to desired databse.");
			}
		}

		return self::$_connection;
	}
}