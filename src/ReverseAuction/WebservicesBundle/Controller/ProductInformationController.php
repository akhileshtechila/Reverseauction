<?php

namespace ReverseAuction\WebservicesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use ReverseAuction\ReverseAuctionBundle\Entity\ProductInfo;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * Product Information Controller.
 * Author Name: Akhilesh Dahat
 * Date: 08 Sept 2014
 * Description: Product Information with the User Input and Product image upload from the Webservices..
 */
class ProductInformationController extends Controller {

    
    /**
     * Product Information Controller Action To add the product
     *
     */    
    public function ProductInformationAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        /* Check The request is Post */
        if ($request->getMethod() == "POST") {
            
            // Get the Posted Data From the Android device
            $pName = $request->get('pName');
            $pType = $request->get('pType');
            $pBrandName = $request->get('pBrandName');
            $pRetailPrize = $request->get('pRetailPrize');
            $pImage = $request->file->get('pImage');
            $pDescription = $request->get('pDescription');
            $pBidExpiry = $request->get('pBidExpiry');
        } else {
             /* Return if the request is not post */
            return new JsonResponse($this->noPostData());
        }
        
       /* Validation the Blank input For the User Input */
        if ($pName == "") {
            $errorMsg = "Product Name Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else if ($pType == "") {
            $errorMsg = "Product Type is Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else if ($pBrandName == "") {
            $errorMsg = "Product Brand Name Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else if ($pRetailPrize == "") {
            $errorMsg = "Product Retail Prize Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else if ($pImage == "") {
            $errorMsg = "Product Image Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else if ($pDescription == "") {
            $errorMsg = "Product Description Type Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else if ($pBidExpiry == "") {
            $errorMsg = "Product Bid Expiry Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else {
            
            /* Instantiate the ProductInfo and the Set the Variables into the Setter's */
            $ProductInfo = new ProductInfo();
            $ProductInfo->setPName($pName);
            $ProductInfo->setPType($pType);
            $ProductInfo->setPBrandName($pBrandName);
            $ProductInfo->setPRetailPrize($pRetailPrize);
            $ProductInfo->setPImage($pImage);
            $ProductInfo->setPDescription($pDescription);
            $ProductInfo->setPBidExpiry($pBidExpiry);
            $ProductInfo->setMailsendflag(0);

            /* Validation the for the Entity Validation and Messages */
            $validator = $this->get('validator');
            $errors = $validator->validate($ProductInfo);
            $result = array();
            if (count($errors) > 0) {
                //$errorsString = (string) $errors;
                
                /*Iterate Over the Errors object*/
                foreach ($errors as $error) {
                    $result[] = $this->get('translator')->trans($error->getMessage());
                }
                $data = array();
                $data['message'] = "Duplicate Entries";
                $data['code'] = "4";
                $data['result'] = $result;

                $mainData = array();
                $mainData['data'] = $data;

                return new JsonResponse($mainData);
            }
            /*Persist The Object*/
            $em->persist($ProductInfo);
            $em->flush();

            if ($ProductInfo->getId() != "") {
                /* Send the Json Response with the Product added successfully. */
                return new JsonResponse($this->productAddedsuccessfully());
            }

            return new JsonResponse($this->productUnsuccessful());
        }



        return $this->render('ReverseAuctionWebservicesBundle:ProductInformation:ProductInformation.html.twig');
    }

    
    /* After Successfully insertion of the Bid send the Json Response */
    private function productAddedsuccessfully() {
        $data = array();

        $data['errorCode'] = "0";
        $data['errorMessage'] = "Product Added successfully created";
        $data['result'] = "Product Added";

        $mainData = array();
        $mainData['data'] = $data;

        return $mainData;
    }

    
    /* Send the Json Response For the Unsuccessfull Information obtain. */
    private function productUnsuccessful() {
        $data = array();

        $data['errorCode'] = "1";
        $data['errorMessage'] = "Product is not created";
        $data['result'] = "Product not Added";

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
