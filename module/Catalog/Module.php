<?php

namespace Catalog;

use Catalog\Model\MergedProductTable;

use Catalog\Model\MergedProduct;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

use Catalog\Model\CategoryTable;
use	Catalog\Model\ProductTable;
use Catalog\Widget\Product\ProductWidget;

class Module
	implements ConfigProviderInterface, AutoloaderProviderInterface, ServiceProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getAutoloaderConfig()
    {
    	return array(
    		'Zend\Loader\ClassMapAutoloader' => array(
    			__DIR__ . '/autoload_classmap.php',
    		),
    		'Zend\Loader\StandardAutoloader' => array(
    			'namespaces' => array(
  				__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
    			),
    		),
    	);
    }

	public function getServiceConfig()
    {
    	return array(
    		'factories' => array(
    			'Catalog\Model\CategoryTable' => function($sm) {
	    			$adapter = $sm->get('Zend\Db\Adapter\Adapter');
	    			return new CategoryTable($adapter);
    			},
    			'Catalog\Model\ProductTable' => function($sm) {
	    			$adapter = $sm->get('Zend\Db\Adapter\Adapter');
	    			return new ProductTable($adapter);
    			},
    			'Catalog\Model\MergedProduct' => function($sm) {
    				$adapter = $sm->get('Zend\Db\Adapter\Adapter');
    				return new MergedProductTable($adapter);
    			},
    			'Catalog\Model\ProductWidget' => function($sm) {
    				return new ProductWidget();
    			},
    		),
    	);
    }
    
}
