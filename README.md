mongodb-php-singleton
=====================

A singleton wrapper for the mongo client.

This singleton container does a few cool things.

First and foremost, the reason it was created. This is a singleton. Throughout the life cycle of your application runtime it will create only one instance of itself and only one instance of the database connection to save you some memory.

Secondly,
It is rather simple to use. Just include it with your autoloader or manually and use the following code...

```php
// Returns the MongoClient that you know and love.
$connection = MongoWrapper::connect();

// Returns the database that you can play with.
$database = MongoWrapper::connect("phonebook");
```