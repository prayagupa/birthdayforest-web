<?php

use models\Country;
use models\PrivilegedUser;
use Doctrine\Common\ClassLoader,
Doctrine\ORM\Configuration,
Doctrine\ORM\EntityManager,
Doctrine\Common\Cache\ArrayCache,
Doctrine\Common\Annotations\AnnotationReader,
Doctrine\ORM\Mapping\Driver\AnnotationDriver,
Doctrine\DBAL\Logging\EchoSqlLogger,
Doctrine\DBAL\Event\Listeners\MysqlSessionInit,
Doctrine\ORM\Tools\SchemaTool,
Doctrine\ORM\Tools\Setup,
Doctrine\Common\EventManager,
Gedmo\Timestampable\TimestampableListener,
Gedmo\Sluggable\SluggableListener,
Gedmo\Tree\TreeListener,
Gedmo\SoftDeleteable\SoftDeleteableListener,
Gedmo\Loggable\LoggableListener;

//if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Doctrine bootstrap library for CodeIgniter
 *
 * @author	Prayag Upd
 */
class Doctrine {

 /**
 *
 * @var Doctrine\ORM\EntityManager
 */
  public $em = null;

  /**
   *
   * @var Doctrine\ORM\Tools\SchemaTool
   */
  public $tool = null;

  public function __construct(){
	  //	spl_autoload_register(function(){});
	 // load database configuration from CodeIgniter

	 if (defined('ENVIRONMENT') AND file_exists(APPPATH.'config/'.ENVIRONMENT.'/database'.EXT)){
		require(APPPATH.'config/'.ENVIRONMENT.'/database'.EXT);
	}else{
		require(APPPATH.'config/database'.EXT);
	}

	if ( ! isset($active_group) OR ! isset($db[$active_group])){
		show_error('You have specified an invalid database connection group.');
	}

	/*bootstrapping doctrine*/
	//Doctrine\ORM\Tools\Setup::registerAutoloadPEAR();
	// Set up class loading. You could use different autoloaders, provided by your favorite framework,
	// if you want to.
	require_once APPPATH.'third_party/Doctrine/Common/ClassLoader.php';

	//Creates a new <tt>ClassLoader</tt> that loads classes of the
	//specified namespace Doctrine from the specified include path APPPATH.'third_party'
	$doctrineClassLoader = new ClassLoader('Doctrine',  APPPATH.'third_party');
	$doctrineClassLoader->register(); //Registers this ClassLoader on the SPL autoload stack.

	// Set up Gedmo
	$classLoader = new ClassLoader('Gedmo', APPPATH.'third_party');
	$classLoader->register();

	// Set up zamoon extensions
	$zamoonExtensionsLoader = new ClassLoader('zamoon', APPPATH.'third_party');
	$zamoonExtensionsLoader->register();

	// Set up models loading with namespace models
	$entitiesClassLoader = new ClassLoader('models', APPPATH);
	$entitiesClassLoader->register();

	// load Symfony2 helpers
        // Don't be alarmed, this is necessary for YAML mapping files
    //$symfonyClassLoader = new \Doctrine\Common\ClassLoader('Symfony', APPPATH.'third_party/Doctrine');
    //$symfonyClassLoader->register();
	/**
	 *
	 * a class loader that either loads only classes
 	 * of a specific namespace or all namespaces and it is suitable for working together
	 * with other autoloaders in the SPL autoload stack.
	 */
	$proxiesClassLoader = new ClassLoader('Proxies', APPPATH.'models/proxies');
	$proxiesClassLoader->register();

	 $ormConfig = new Doctrine\ORM\Configuration;
	 /*************************************** 1 ******************************************/
	 //print ("ensure standard doctrine annotations are registered<br/>");
	 Doctrine\Common\Annotations\AnnotationRegistry::registerFile(APPPATH.'third_party/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php');

	 /*************************************** 2.1 ******************************************/
	 // print("Set up caches with hits/misses/uptime<br/>");
	 $arrayCache = new Doctrine\Common\Cache\ArrayCache;                     // Array cache driver.
	 $annotationReader = new Doctrine\Common\Annotations\AnnotationReader;   // A reader for docblock annotations.
     $cachedAnnotationReader = new Doctrine\Common\Annotations\CachedReader( // A cache aware annotation reader.
    		$annotationReader, // use reader
    		$arrayCache             // and a cacheDriver
     );

      /*************************************** 2.2 ******************************************/
     // create a DriverChain for Doctrine\ORM\Mapping\ClassMetadataInfo reading
     $driverChain = new Doctrine\ORM\Mapping\Driver\DriverChain(); //allows you to add multiple other mapping drivers for certain namespaces

     // load superclass Metadata mapping only, into DriverChain
     // also registers Gedmo annotations.
     // NOTE: you can personalize it
     Gedmo\DoctrineExtensions::registerAbstractMappingIntoDriverChainORM(
    		$driverChain,           // our metadata driver chain, to hook into
    		$cachedAnnotationReader // our cached annotation reader
     );

      /*************************************** 2.3 ******************************************/
	 // now we want to register our application entities,
	 // for that we need another metadata driver used for Entity namespace
	 $annotationDriver = new Doctrine\ORM\Mapping\Driver\AnnotationDriver(
	    $cachedAnnotationReader, // our CachedAnnotationReader
	    array(APPPATH.'models/') // paths to look in
	 );

	 /*************************************** 2.4 ******************************************/
	 // NOTE: driver for application Entity can be different, Yaml, Xml or whatever
	 // register annotation driver for our application Entity namespace
	 $driverChain->addDriver($annotationDriver, 'models');

	 /*********************************PROXY CONFIGURATION********************************/
	 /*************************************** 2.5 ******************************************/
	 /************************************************************************************/
	 // print("ORM PROXY CONFIGURATION");
	 $ormConfig->setProxyDir(APPPATH.'models/proxies'); //Sets the directory where Doctrine generates any necessary Proxy class files.

	 $ormConfig->setProxyNamespace('Proxies'); 	        //Sets the namespace where Proxy Classes reside.
	 $ormConfig->setAutoGenerateProxyClasses(TRUE);     // this can be based on production config.
	 												    //indicates whether Proxy classes should always be regenerated  during each script execution.
	 // register metadata driver
	 $ormConfig->setMetadataDriverImpl($driverChain);   // Sets the CacheDriver Implementation that is used for metadata caching.
	 // use our already initialized CacheDriver
	 $ormConfig->setMetadataCacheImpl($arrayCache);     // Sets the CacheDriver Implementation that is used for metadata caching.
	 $ormConfig->setQueryCacheImpl($arrayCache);        // Sets the CacheDriver Implementation that is used for the QueryCache (SQL cache).

	 //$driverImpl = $ormConfig->newDefaultAnnotationDriver(array(APPPATH.'models/'));

	 /**************************************END OF PROXY CONFIGURATION*********************************/

     /*************************************** 3 ******************************************/

	 $evm = new Doctrine\Common\EventManager();         //the central point of Doctrine's event listener system.

	 //print("gedmo extension listeners");
	 // sluggable
	 $sluggableListener = new Gedmo\Sluggable\SluggableListener;
	 // you should set the used annotation reader to listener, to avoid creating new one for mapping drivers
	 $sluggableListener->setAnnotationReader($cachedAnnotationReader);
	 $evm->addEventSubscriber($sluggableListener);

	 //loggable
	 $loggableListener = new Gedmo\Loggable\LoggableListener;
	 $loggableListener->setAnnotationReader($cachedAnnotationReader);
	 $evm->addEventSubscriber($loggableListener);


	 // timestampable
	 //handles the update of dates on creation and update.
	 $timestampableListener = new Gedmo\Timestampable\TimestampableListener;
	 $timestampableListener->setAnnotationReader($cachedAnnotationReader);
	 $evm->addEventSubscriber($timestampableListener);



	 //soft-delete
	 //SoftDeleteable listener
	 $softdeletelistener = new Gedmo\SoftDeleteable\SoftDeleteableListener;
	 $softdeletelistener->setAnnotationReader($cachedAnnotationReader);
	 $evm->addEventSubscriber($softdeletelistener);

	 //setup soft-delete filter
	 //Add a filter soft-deleteable to the list of possible filters $_attributes[''] of Doctrine\DBAL\Configuration.
	 $ormConfig->addFilter('soft-deleteable', 'Gedmo\SoftDeleteable\Filter\SoftDeleteableFilter');
	 /******************************************** 4 ************************************************/
	 // Database connection information
	 $connectionOptions = array(
        'driver' => 'pdo_mysql',
        'user' =>     $db[$active_group]['username'],
        'password' => $db[$active_group]['password'],
        'host' =>     $db[$active_group]['hostname'],
        'dbname' =>   $db[$active_group]['database']
	 );
	//central access point to ORM functionality.
	// Factory method that Creates a new Doctrine\ORM\EntityManager that operates on the given database connection
    // and uses the given Configuration and EventManager implementations.
	 $this->em = EntityManager::create($connectionOptions, $ormConfig, $evm);

	 //create/drop/update database schemas based on  <tt>ClassMetadata</tt> class descriptors.
	 $this->tool = new SchemaTool($this->em);
	 
  }
}
