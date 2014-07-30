<?php

/**
 * Class statically creates an instance of the mongo database.
 */
class MongoWrapper
{
	private static $_connection;
	private static $_instance;

	public function __construct(){}
	public function __clone(){}

	public static function connect($database = null)
	{
		/*
		 * Establish a new static object.
		 */
		if(!isset(self::$_instance))
		{
			error_log("creating mongo instance.");
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
			die("Error Connecting to DB.");
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
				die("Could not connect to desired databse.");
			}
		}

		return self::$_connection;
	}
}
