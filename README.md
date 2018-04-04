An advanced boilerplate of codeigniter.

## Prerequisities
* PHP 7.1+
* PDO extension.
* Composer or composer.phar.
* NPM (for )

## Getting started
Clone the repo.
Install dependencies
```
composer install
```
```
npm install
```
Migrate database
```
php app migrate
```
Voila you are ready to GO!

## Features
* Twig templating engine.
* Aauth access control library for user access based on roles and permissions.
* Common Symphony CLI commands for common tasks, such as development server, generating models, controllers etc.
* Eloquent ORM.
* Custom exception handling for managing response based on request type.
* Webpack and laravel mix for concatenation and minification of js and css libraries.
* Classmap autoloading for loading custom classes.  
* Global javascript events.

## Basics
### Development Server:
To start the development server, run following command.
```
php app serve
```
You may also change the default host and port as
```
php app serve <host> <port>
```

### Generating Models
To generate a model, run following command.
```
php app create:model <model_name>
```
You may defined sub-directories by adding '/' between directories. Please note that the models will be autoloaded using composer classmap autoloading, so you will need to run 'composer dump-autoload' if creating models manually.

By default all the models will be extended to Eloquent ORM base class, if you wish to use CI query builder, extend model to 'CI_Model' instead of Eloquent in 'MY_Model' class in core directory.

### Generating Controllers
To generate a controller, run following command.
```
php app create:controller <controller_name> <core_class>
```
Here core class can be 'AdminController', 'GuestController' or 'UserController'. 

### Models
Eloquent ORM has been integrated, to use it effective you will be required to create seperate models for each database table. To use a model, load it using following snippet
```
$this->load->model(<Model>)
```
Once loaded you can access the table as per eloquent syntax, for example:
```
Model::get(id)
```
To learn more about using eloquent, refer the Laravel's Eloquent [user guide](https://laravel.com/docs/5.5/eloquent)

### Exception handling
To throw an exception use following:
```
show_error($error_heading, $message, $template, $error_code) 
```
The exception class sends response according to the request type; such that json will be returned in case of ajax, plain text in cli and html in browser.

### Javascript events
To support common crud functions, global events have been added which be readily used for speedy development.
* Form Event:


## Built with:
* [codeigniter-ss-twig](https://github.com/kenjis/codeigniter-ss-twig) - Twig wrapper for codeigniter
* [Eloquent](https://github.com/illuminate/database) - ORM ported from laravel
* [Symphony Console](https://github.com/symfony/console) - CLI tools from symphony
* [CodeIgniter-Aauth](https://github.com/magefly/CodeIgniter-Aauth) - ACL library
