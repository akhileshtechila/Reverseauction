<?php

namespace ReverseAuction\WebservicesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use ReverseAuction\ReverseAuctionBundle\Entity\UserInfo;
use ReverseAuction\ReverseAuctionBundle\Entity\LoginInfo;
use ReverseAuction\ReverseAuctionBundle\Entity\ProductInfo;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

/**
 * Product Listing Controller.
 * Author Name: Akhilesh Dahat
 * Date: 08 Sept 2014
 * Description: Product Listing from the Webservices.
 */
class ProductListingController extends Controller {

    /**
     * Product Listing Action with the Lisiting and Json response with the Object.
     *
     */
    public function ProductListingAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        //$entities = $em->getRepository('ReverseAuctionReverseAuctionBundle:ProductInfo')->findAll();
        $entities = $em->getRepository('ReverseAuctionReverseAuctionBundle:ProductInfo')->productDisplay();
       
        if (!$entities) {
            $errorMsg = "No Data Found";
            return new JsonResponse($this->blankField($errorMsg));
        }

        ######################################################
        /* VerY Very Important COde */
        $dataentity = array();
        $productList = array();
        foreach ($entities as $product) {
            $productList['productId'] = $product->getId();
            $productList['pName'] = $product->getPName();
            $productList['pType'] = $product->getPType();
            $productList['pBrandName'] = $product->getPBrandName();
            $productList['pRetailPrize'] = $product->getPRetailPrize();
            $productList['pImage']=  $product->getPImage(); 
            $productList['pDescription'] = $product->getPDescription();
            $productList['pBidExpiry'] = $product->getPBidExpiry();
          
            /*Push the Product List array into Dataentity.*/
            array_push($dataentity, $productList);
            
            
        }
                 
        if (!empty($dataentity) || $dataentity != null) { 
            
          /* return new Json Response With the product listing object in json  */
            return new JsonResponse($this->productListing($dataentity));
            
        } else {
            return new JsonResponse($this->productNotFound());
        }
        return $this->render('ReverseAuctionWebservicesBundle:ProductListing:ProductListing.html.twig');
    }

    /*Return the Response For the Listing*/
    private function productListing($dataentity) {
        $data = array();
        $data['errorCode'] = "0";
        $data['errorMessage'] = "Deal listing";
        $data['result'] = $dataentity;
        $mainData = array();
        $mainData['data'] = $data;

        return $mainData;
    }

    
    /* Send the Json Response If the Productis not obtain. */
    public function productNotFound() {
        $data = array();
        $data['errorCode'] = "1";
        $data['errorMessage'] = "Product not found";
        $data['result'] = "";

        $mainData = array();
        $mainData['data'] = $data;
        return $mainData;
    }

    
    /* Error Checking for the Blank Field. */
    private function blankField($errorMsg) {
        $data = array();
        $data['errorCode'] = "2";
        $data['errorMessage'] = $errorMsg;
        $data['result'] = "";

        $mainData = array();
        $mainData['data'] = $data;
        return $mainData;
    }

    
    /* Check for the Post Data */
    private function noPostData() {
        $data = array();
        $data['errorCode'] = "3";
        $data['errorMessage'] = "No Post Data";
        $data['result'] = "";

        $mainData = array();
        $mainData['data'] = $data;
        return $mainData;
    }

}
