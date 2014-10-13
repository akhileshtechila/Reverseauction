<?php

namespace ReverseAuction\WebservicesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use ReverseAuction\ReverseAuctionBundle\Entity\ProductInfo;
use ReverseAuction\ReverseAuctionBundle\Entity\BidsInfo;
use ReverseAuction\ReverseAuctionBundle\Entity\BidsInfoRepository;
use ReverseAuction\ReverseAuctionBundle\Entity\UserInfo;

class BidWinnersController extends Controller {

    public function BidsWinnersAction() {

        $em = $this->getDoctrine()->getManager();

        /* Find the User Object from the UserID provided. */
        $productclassName = "ReverseAuctionReverseAuctionBundle:ProductInfo";
        $ProductInfo = $em->getRepository($productclassName)->findAll();
        if ($ProductInfo == "" || $ProductInfo == null) {
            $errorMsg = "No Data Found";
            return new JsonResponse($this->blankField($errorMsg));
        }

        $className = "ReverseAuctionReverseAuctionBundle:BidsInfo";

        ######################################################
        /* VerY Very Important COde */
        $dataentity = array();
        $productList = array();
        foreach ($ProductInfo as $product) {

            $productList['expiryDate'] = $product->getPBidExpiry();
            $productList['expDate'] = $productList['expiryDate']->format("Y-m-d H:i:s");
            $productList['sysDate'] = new \DateTime();
            $productList['currentSysDate'] = $productList['sysDate']->format("Y-m-d H:i:s");

            if ($productList['currentSysDate'] > $productList['expDate']) {
                $bidWinner = $em->getRepository($className)->findbidWinnerQuery($product->getId());
                if ($bidWinner == "" || $bidWinner == null) {
                    $errorMsg = "No Data Found";
                    return new JsonResponse($this->blankField($errorMsg));
                }
                foreach ($bidWinner as $winner) {
                    $productList['email'] = $winner->getBEmail();
                    $productList['bAmount'] = $winner->getBAmount();
                    $productList['bProductName'] = $winner->getBProductName();
                    $productList['bProductId'] = $winner->getProductInfo()->getId();
                    $productList['sendmailflag'] = $winner->getProductInfo()->getMailsendflag();
                }
                /* Push the Product List array into Dataentity. */
                array_push($dataentity, $productList);
            } else {
                $errorMsg = "No Product Found";
                return new JsonResponse($this->blankField($errorMsg));
            }
        }

        // echo "<pre>"; print_r($dataentity); exit;       
        //exit;
        if (!empty($dataentity) || $dataentity != null) {
            /* return new Json Response With the product listing object in json  */
            /* Get the Parameters from the Parameters.yml from the app */
            $adminemail = $this->container->getParameter('admin_email');
            $bidwinnermailsend = $this->container->getParameter('bidder_send_mail');
            /* Message Template */
           /* $message = \Swift_Message::newInstance()
                    ->setSubject('Bids Apply Successfully!')
                    ->setFrom($adminemail)
                    ->setTo($bidwinnermailsend)
                    ->setContentType("text/html")
                    ->setBody(
                    $this->renderView(
                            'ReverseAuctionWebservicesBundle:BidWinners:email.html.twig'
                    )
            );*/

            $datasend = array();
            foreach ($dataentity as $ent) {
                $sendEmailflag = $ent['sendmailflag'];                
                if ($sendEmailflag == 0 || $sendEmailflag == null) {
                    
                     $message = \Swift_Message::newInstance()
                    ->setSubject('Bids Apply Successfully!')
                    ->setFrom($adminemail)
                    ->setTo($bidwinnermailsend)
                    ->setContentType("text/html")
                    ->setBody(
                    $this->renderView(
                            'ReverseAuctionWebservicesBundle:BidWinners:email.html.twig',array(
                                'ProductName' => $ent['bProductName'],
                                'bAmount' => $ent['bAmount'],
                                'email' =>  $ent['email']
                            )
                    )
            );
                    
                    $this->get('mailer')->send($message);
                    $ProductInfo = $em->getRepository($productclassName)->find($ent['bProductId']);

                    $ProductInfo->setMailsendflag(1);
                    $em->flush();
                } else {
                    $errorMsg = "Mail Can not be send";
                    return new JsonResponse($this->blankField($errorMsg));
                }
            }
        } else {
            return new JsonResponse($this->productNotFound());
        }
        return $this->render('ReverseAuctionWebservicesBundle:BidWinners:BidsWinners.html.twig');
    }

    /* Return the Response For the Listing */

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
