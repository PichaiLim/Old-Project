<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => '2PM4You',
    // preloading 'log' component
    'preload' => array('log', 'bootstrap'),
    // setting language
    'language' => 'th',
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.helpers.*', // EXTENSIONS IMAGE
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '1234',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array(
                'bootstrap.gii',
            ),
        ),
    ),
    // application components
    'components' => array(
        'email' => array(
            'class' => 'application.extensions.email.Email',
            'delivery' => 'php', //Will use the php mailing function.  
        //May also be set to 'debug' to instead dump the contents of the email into the view
        ),
        // within array components IMAGE
        'image'=>array(
          'class'=>'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver'=>'GD',
            // ImageMagick setup path
            'params'=>array('directory'=>'/opt/local/bin'),
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // Bootstrap
        'bootstrap' => array(
            'class' => 'ext.bootstrap.components.Bootstrap',
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'urlSuffix' => '.html',
            'rules' => array(
                '/'=>'',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                /*
                 '<user:\w+>'=>'<user>',
                '<user:\w+>/<controller:\w+>/<id:\d+>' => '<user>/<controller>/view',
                '<user:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<user>/<controller>/<action>',
                '<user:\w+>/<controller:\w+>/<action:\w+>' => '<user>/<controller>/<action>',
                 */
            ),
        ),
        /*
        'db' => array(
            'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
        ),
         */
        // uncomment the following to use a MySQL database
/**/
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=db_monavie',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
        ),
        /**/
        /*
          'db' => array(
          'connectionString' => 'mysql:host=localhost;dbname=pichai_monavie',
          'emulatePrepare' => true,
          'username' => 'pichai_monavie',
          'password' => '2pm4you',
          'charset' => 'utf8',
          ),
         /**/
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'Pichai.Limpanitivat@Gmail.com',
    ),
);