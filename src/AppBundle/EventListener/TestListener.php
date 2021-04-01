<?php
namespace AppBundle\EventListener;
  
use Pimcore\Event\Model\ElementEventInterface;
use Pimcore\Event\Model\DataObjectEvent;
use Pimcore\Event\Model\AssetEvent;
use Pimcore\Event\Model\DocumentEvent;
use Pimcore\Model\DataObject\Demo;

class TestListener {
    
    public function onPreUpdate(DataObjectEvent $e)
    {
    
    if($e->getObject() instanceOf Product)
   {
   	$product = $e->getObject();
    $date = date("Y-m-d");
   	if($product->getManufacturedate() > $date)
   	{
           
   	throw new \Pimcore\Model\Element\ValidationException("Invalid Date !!!!!!!!!!!!!!!!!");
   	}
   
   }
    
    }    
}