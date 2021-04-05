<?php

namespace AppBundle\Controller;

use Pimcore;
use Pimcore\Bundle\AdminBundle\Controller\Rest\AbstractRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\component\HttpFoundation\JsonResponse;

/**
 * Class RestApiController
 * @package AppBundle\Controller
 */
class RestApiController extends AbstractRestController
{
    /**
     * @Route("/webservice/getProduct", methods={"GET"})
     */
    public function getProductAction(Request $request)
    {
       // $this->checkPermission('objects');
        //Products listing
        $products = new Pimcore\Model\DataObject\Demo\Listing();
        foreach ($products as $key => $prod) {
            $data[] = array(
                "name" => $prod->getDemoName(),
              //  "description" => $prod->getDescription()
               
            );
        }

        return $this->adminJson(["success" => true, "data" => $data]);
    }
   }