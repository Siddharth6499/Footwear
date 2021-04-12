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
      if((strcasecmp($size , $pro->getSize()) == 0) && ($pricerange < ($pro->getPrice()) (strcasecmp($category , 
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
                  if($pricerange < ($pro->getPrice()))
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
      {  return [
                'productName' => $p->getName(),
                'description' => $p->getDescription(),
                'brand' => $p->getBrand(),
                'price' => $p->getPrice()->__toString(),
                'size' => $p->getSize(),
                'discount' => $p->getDiscount(),
                'image' => $p->getImage()->getRelativeFileSystemPath(),
                'color' => $p->getColor()->getHex(),
                'category' => $p->getCategory()->getName(),
                'variants' => $p->getVariants(),
                'manufactureDate' => $p->getManufactureDate(),
                'madeIn' => $p->getMadeIn(),
                'IsReturnable' => $p->getReturnable(),
                'groupType' => $p->getGroupType(),
                'status' => $p->getStatus()
    
      ];
      
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
            $productManufactureDate=$ndate;
            $productMadeIn = $d['productMadeIn'];
            $productReturnable = $d['productReturnable'];
            $productGroupType = $d['productGroupType'];
            $productStatus = $d['productStatus'];

            $Types = $d['types'];
            $HeelType = $d['heelType'];
            $SportsShoesType = $d['sportsshoesType'];
    
        
            // Setter Function
            $obj->setKey($key);
            $obj->setParentId(126);
            $obj->setSKU($productSKU);
            $obj->setName($productName);
            $obj->setDescription($productDescription);
            $obj->setBrand($productBrand);
            $unit = DataObject\QuantityValue\Unit::getByAbbreviation('Rs');
            $obj->setPrice(new DataObject\Data\QuantityValue($prod->price, $unit->getId()));
            $obj->setSize($productSize);
            $obj->setDiscount($productDiscount);
            
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

            $obj->setManufactureDate($productManufactureDate);
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


           
            $obj->save();

            

        }
        return $this->adminJson(["success" => true]);

    }
    }
    
?>