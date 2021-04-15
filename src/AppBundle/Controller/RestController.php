<?php

namespace AppBundle\Controller;

use DateTime;
use Pimcore;
use Pimcore\Bundle\AdminBundle\Controller\Rest\AbstractRestController;
use Pimcore\Bundle\AdminBundle\HttpFoundation\JsonResponse;
use Pimcore\Bundle\AdminBundle\Security\BruteforceProtectionHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Pimcore\Model\DataObject\Product;
use Pimcore\Model\DataObject\Category;
use Pimcore\Model\DataObject;
use Pimcore\Model\Asset\MetaData\ClassDefinition\Data\Asset;
//use Pimcore\Model\DataObject\Objectbrick\Data\CookiePack;
//use Pimcore\Model\DataObject\Product\SpecificFeatures;


/**
 * Class RestController
 * @package AppBundle\Controller
 */

 class RestController extends AbstractRestController
 {
     CONST BASE_API_SERVICE = 'base_api_service';

     /**
      * @Route("/webservice/ListProducts")
      * @Method({"GET"})
      * @param Request $request
      * @return \Symfony\Component\HttpFoundation\JsonResponse
      * @throws \Pimcore\Http\Exception\ResponseException
      * @throws \Exception
      */
    public function getProductList(Request $request, BruteforceProtectionHandler $bruteforceProtectionHandler)
    {
        $data = [];
        $product = new \Pimcore\Model\DataObject\Product\Listing();
                
        $product->getObjects();
        foreach ($product as $pro)
        {
            $data[] = $this->getProduct($pro);
            
        }
        
        if (!empty($data)) {
            return $this->createSuccessResponse($data, true);
        }
        return $this->createErrorResponse("No product found!", Response::HTTP_NOT_FOUND);
     
       
       
    }
    
    
    /**
      * @Route("/webservice/filterProduct")
      * @Method({"GET"})
      * @param Request $request
      * @return \Symfony\Component\HttpFoundation\JsonResponse
      * @throws \Pimcore\Http\Exception\ResponseException
      * @throws \Exception
      */
    public function getProductfilter(Request $request, BruteforceProtectionHandler $bruteforceProtectionHandler)
    {   
        $size = $request->query->get('size');
        $pricerange = $request->query->get('pricerange');
        $category = $request->query->get('category');
        $data = [];
        $product = new \Pimcore\Model\DataObject\Product\Listing();
        $product->getObjects();
        foreach ($product as $pro)
       {
        if($size) {
                   if($pricerange) {
                                if((strcasecmp($size , $pro->getSize()) == 0) && ($pricerange > ($pro->getPrice()))) 
                                   {
                                    $data[] = $this->getProduct($pro);
                                   }
                               }
                   
                   elseif($category) {
      if((strcasecmp($size , $pro->getSize()) == 0) && ($pricerange > ($pro->getPrice()) (strcasecmp($category , 
      $pro->getCategoryType() == 0))))
                            {
                                $data[] = $this->getProduct($pro);
                            }

                        }
                  
                   else {
                           if(strcasecmp($size, $pro->getsize()) == 0 )
                             {
                               $data[] = $this->getProduct($pro);
                             }

                       }
                  }
              
              
         elseif($pricerange) {
                  if($pricerange > ($pro->getPrice()))
                            {
                                $data[] = $this->getProduct($pro);
                            }

                        }
          else {
                $data[] = $this->getProduct($pro);
               }
            
          } 
          if (!empty($data)) 
          {
            return $this->createSuccessResponse($data, true);
          }
          return $this->createErrorResponse("No product found with given filter(s)!", Response::HTTP_NOT_FOUND);  
                
        
        
     
      
      }
      
      function getProduct(Product $p)
      {  
          if($p->getCategory()->getName() == "Sandals")
          {
              
          return [

                'productName' => $p->getName(),
                'description' => $p->getDescription(),
                'brand' => $p->getBrand(),
                'price' => $p->getPrice()->__toString(),
                'size' => $p->getSize(),
                'discount' => $p->getDiscount(),
                'image' => $p->getImage()->getRelativeFileSystemPath(),
                'color' => $p->getColor()->getHex(),
                'category' => $p->getCategory()->getName(), 
                'variants' => $p->getVariants()->getSandals()->getHeelType(),
                'manufactureDate' => $p->getManufactureDate(),
                'madeIn' => $p->getMadeIn(),
                'IsReturnable' => $p->getReturnable(),
                'groupType' => $p->getGroupType(),
                'status' => $p->getStatus()
    
      ];
    }
      elseif($p->getCategory()->getName() == "Shoes")
      {
        return [

            'productName' => $p->getName(),
            'description' => $p->getDescription(),
            'brand' => $p->getBrand(),
            'price' => $p->getPrice()->__toString(),
            'size' => $p->getSize(),
            'discount' => $p->getDiscount()->__toString(),
            'image' => $p->getImage()->getRelativeFileSystemPath(),
            'color' => $p->getColor()->getHex(),
            'category' => $p->getCategory()->getName(), 
            'variants' => $p->getVariants()->getShoes()->getShoesType(), 
            'manufactureDate' => $p->getManufactureDate(),
            'madeIn' => $p->getMadeIn(),
            'IsReturnable' => $p->getReturnable(),
            'groupType' => $p->getGroupType(),
            'status' => $p->getStatus()

  ];
      }
      elseif($p->getCategory()->getName() == "Boots")
      {
        return [

            'productName' => $p->getName(),
            'description' => $p->getDescription(),
            'brand' => $p->getBrand(),
            'price' => $p->getPrice()->__toString(),
            'size' => $p->getSize(),
            'discount' => $p->getDiscount(),
            'image' => $p->getImage()->getRelativeFileSystemPath(),
            'color' => $p->getColor()->getHex(),
            'category' => $p->getCategory()->getName(), 
            'variants' => $p->getVariants()->getSports()->getSportsshoesType(),
            'manufactureDate' => $p->getManufactureDate(),
            'madeIn' => $p->getMadeIn(),
            'IsReturnable' => $p->getReturnable(),
            'groupType' => $p->getGroupType(),
            'status' => $p->getStatus()

  ];
      }
      else{
        return [

            'productName' => $p->getName(),
            'description' => $p->getDescription(),
            'brand' => $p->getBrand(),
            'price' => $p->getPrice()->__toString(),
            'size' => $p->getSize(),
            'discount' => $p->getDiscount(),
            'image' => $p->getImage()->getRelativeFileSystemPath(),
            'color' => $p->getColor()->getHex(),
            'category' => $p->getCategory()->getName(), 
            'variants' => $p->getVariants()->getCasual()->getTypes(),
            'manufactureDate' => $p->getManufactureDate(),
            'madeIn' => $p->getMadeIn(),
            'IsReturnable' => $p->getReturnable(),
            'groupType' => $p->getGroupType(),
            'status' => $p->getStatus()

  ];
      }
    
    
      }
    

     /**
     * @Route("/webservice/addproduct", methods={"PUT"})
     */
    public function addProduct(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        dump($data);

        $cdate=date_create()->format('d-m-Y');
        $ndate = new DateTime($cdate);

        foreach($data as $d)
        {
            $obj = new \Pimcore\Model\DataObject\Product();
            $key=$d['key'];
            $parentID=$d['parentID'];
            $published= $d['published'];
            $productSKU =$d['productSKU'];
            $productName= $d['productName'];
            $productDescription =$d['productDescription'];  
            $productBrand=$d['productBrand'];
            $productPrice=$d['productPrice'];
            $productSize =$d['productSize'];
            $productDiscount =$d['productDiscount'];
            $productImage = $d['productImage'];
            $productColour = $d['productColour'];
            $productCategory = $d['productCategory'];
            $productManufactureDate= $d['productManufactureDate'];
            $productMadeIn = $d['productMadeIn'];
            $productReturnable = $d['productReturnable'];
            $productGroupType = $d['productGroupType'];
            $productStatus = $d['productStatus'];

            $Types = $d['types'];
            $HeelType = $d['heelType'];
            $SportsShoesType = $d['sportsshoesType'];
            $ShoesType = $d['shoesType'];
    
            
            // Setter Function
            if($key != NULL)
            {
            try{
            $obj->setKey($key);
            $obj->setParentId(126);
            $obj->setPublished(true);
            $obj->setSKU($productSKU);
            $obj->setName($productName);
            $obj->setDescription($productDescription);
            $obj->setBrand($productBrand);
            $unit = DataObject\QuantityValue\Unit::getByAbbreviation('Rs');
            $obj->setPrice(new DataObject\Data\QuantityValue($productPrice, $unit->getId()));
            $obj->setSize($productSize);
            $unit1 = DataObject\QuantityValue\Unit::getByAbbreviation('%');
            $obj->setDiscount(new DataObject\Data\QuantityValue($productDiscount, $unit1->getId()));
            
            $image = \Pimcore\Model\Asset::getByPath($productImage);
            $obj->setImage($image);

            $t = new \Pimcore\Model\DataObject\Data\RgbaColor();
            $t->setRgba($productColor);
            $obj->setColor($t);
            
            $category = new \Pimcore\Model\DataObject\Category\Listing();
            $category->setCondition('name = ?', $productCategory);
            $category->setLimit(1);
                foreach ($category as $cat) {
                    $obj->setCategory($cat);
                }     

            $manufactureDate = \Carbon\Carbon::parse($productManufactureDate);
            $obj->setManufactureDate($manufactureDate);

            $obj->setReturnable($productReturnable);
            $obj->setGroupType($productGroupType);
            $obj->setStatus($productStatus);
            $obj->setMadeIn($productMadeIn);

            

             // setting objectBrick object
                $objBrick = new DataObject\Objectbrick\Data\Casual($obj);
                $objBrick->setTypes($Types);
                $obj->getVariants()->setCasual($objBrick);

                $objBrick = new DataObject\Objectbrick\Data\Sandals($obj);
                $objBrick->setHeelType($HeelType);
                $obj->getVariants()->setSandals($objBrick);

                $objBrick = new DataObject\Objectbrick\Data\Sports($obj);
                $objBrick->setSportsshoesType($SportsShoesType);
                $obj->getVariants()->setSports($objBrick);

                $objBrick = new DataObject\Objectbrick\Data\Shoes($obj);
                $objBrick->setShoesType($ShoesType);
                $obj->getVariants()->setShoes($objBrick);


           
            $obj->save();

            }
            catch(\Exception $e){
                $msg = "";
                    if($key==NULL)
                    {
                     $msg .= "SKU is given NULL. \n";
                    }
                    if($productName==NULL)
                    {
                    $msg .= "Name is given NULL. \n";
                    }
                    if($productPrice==NULL)
                    {
                        $msg .= "Price is given NULL. \n";
                    }
                    if($productBrand==NULL)
                    {
                        $msg .= "Brand is given NULL. \n";
                    }
                    if($productSize==NULL)
                    {
                        $msg .= "Size is given NULL. \n";
                    }
                    if($productDescription==NULL)
                    {
                        $msg .= "Description is given NULL. \n";
                    }
                    if($productDiscount==NULL)
                    {
                        $msg .= "Discount is given NULL. \n";
                    }
                    if($productMadeIn==NULL)
                    {
                        $msg .= "MadeIn is given NULL. \n";
                    }
                    if($productStatus==NULL)
                    {
                        $msg .= "Status is given NULL. \n";
                    }
                    if($productGroupType==NULL)
                    {
                        $msg .= "Group Type is given NULL. \n";
                    }
                    if($productImage==NULL)
                    {
                        $msg .= "Image is given NULL. \n";
                    }
                    
                    else
                    {
                        $msg = "Data Imported Successfully";
                    }


                        $logMsg=new \Pimcore\Model\DataObject\Log();        
                        $logMsg->setKey("$key");
                        $logMsg->setPublished(true);
                        $logMsg->setParentId(74);
                        $logMsg->setMessage($msg);
                        $logMsg->save();
                        $this->dump($logMsg->getKey()) or die;

                        continue;
            }
            $msg = "";
            if($key==NULL)
            {
             $msg .= "SKU is given NULL. \n";
            }
            if($productName==NULL)
            {
            $msg .= "Name is given NULL. \n";
            }
            if($productPrice==NULL)
            {
                $msg .= "Price is given NULL. \n";
            }
            if($productBrand==NULL)
            {
                $msg .= "Brand is given NULL. \n";
            }
            if($productSize==NULL)
            {
                $msg .= "Size is given NULL. \n";
            }
            if($productDescription==NULL)
            {
                $msg .= "Description is given NULL. \n";
            }
            if($productDiscount==NULL)
            {
                $msg .= "Discount is given NULL. \n";
            }
            if($productMadeIn==NULL)
            {
                $msg .= "MadeIn is given NULL. \n";
            }
            if($productStatus==NULL)
            {
                $msg .= "Status is given NULL. \n";
            }
            if($productGroupType==NULL)
            {
                $msg .= "Group Type is given NULL. \n";
            }
            if($productImage==NULL)
            {
                $msg .= "Image is given NULL. \n";
            }
            else
            {
                $msg = "Data Imported Successfully";
            }

                
                    $logMsg=new \Pimcore\Model\DataObject\Log();        
                    $logMsg->setKey("$key");
                    $logMsg->setPublished(true);
                    $logMsg->setParentId(74);
                    $logMsg->setMessage($msg);
                    $logMsg->save();

                    $log=new \Pimcore\Model\DataObject\Import\Listing();
                    foreach($log as $prod)
                    {                    
                        $prod->setStatus(true);
                        $prod->save();
                    }

            

        }
    }
        return $this->adminJson(["success" => true]);

    }
    }
    
?>