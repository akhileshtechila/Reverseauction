<?php
namespace ReverseAuction\WebservicesBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use ReverseAuction\ReverseAuctionBundle\Entity\ProductInfo;
use ReverseAuction\ReverseAuctionBundle\Entity\BidsInfo;
use ReverseAuction\ReverseAuctionBundle\Entity\UserInfo;
 
class BidWinnerCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('Akhilesh:BidWinnerCommand')
            ->setDescription('This Command will run the Cron job for getting the Bid winner information')
            ->addArgument('my_argument', InputArgument::OPTIONAL, 'Argument description');
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        // Do whatever
        $output->writeln('Hello World');
       /* $em->flush();
    }*/  
    
    
      /*if ($request->getMethod() == "POST") {
            $userId = $request->get('userId');
            $productId = $request->get('productId');
            $bEmail = $request->get('bEmail');
            $bProductName = $request->get('bProductName');
            $bAmount = $request->get('bAmount');
        } else {
            /* Return if the request is not post */
           /* return new JsonResponse($this->noPostData());
        }*/
        
        
            $userId = 57;
            $productId = 12;
            $bEmail = "sam@sams.com";
            $bProductName = "jhgh" ;
            $bAmount = 3.39;
        
        /* Validation  For the User Input */
        if ($userId == "") {
            $errorMsg = "UserID Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else if ($productId == "") {
            $errorMsg = "ProductId is Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else if ($bEmail == "") {
            $errorMsg = "User Name Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else if ($bProductName == "") {
            $errorMsg = "Product Name is Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else if ($bAmount == "") {
            $errorMsg = "Bid Amount is Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else {

            /* Find the User Object from the UserInfo Entity */

            $classUserInfoName = "ReverseAuctionReverseAuctionBundle:UserInfo";
            $userInfo = $em->getRepository($classUserInfoName)->find($userId);
            
            if($userInfo == "" ){
                 $errorMsg = "User is not available";
                 return new JsonResponse($this->blankField($errorMsg));
            }
            $bidsPoints = $userInfo->getBidPoints();
            
            if ($bidsPoints != null || $bidsPoints != "") {
                $updatedBidPoints = $bidsPoints - 1;

                $userInfo->setBidPoints($updatedBidPoints);
                $em->flush();
            }

            /* Find the Product Object from the ProductInfo Entity */
            $classProductInfoName = "ReverseAuctionReverseAuctionBundle:ProductInfo";
            $productInfo = $em->getRepository($classProductInfoName)->find($productId);

            if($productInfo == "" ){
                 $errorMsg = "Product is not available";
                 return new JsonResponse($this->blankField($errorMsg));
            }
            
            /* Instantiate the BidsInfo and the Set the Variables into the Settter's */

            $BidsInfo = new BidsInfo();
            $BidsInfo->setUserInfo($userInfo);
            $BidsInfo->setProductInfo($productInfo);
            $BidsInfo->setBEmail($bEmail);
            $BidsInfo->setBUserName($bEmail);
            $BidsInfo->setBProductName($bProductName);
            $BidsInfo->setBAmount($bAmount); 
            
            /* Persist the Object */
            $em->persist($BidsInfo);
            $em->flush();

            /* Check Whether the Record is inserted. */
            if ($BidsInfo->getId() != "") {
                /* Get The Email from the BidsInfo Object */
                $emailFound = $BidsInfo->getBEmail();
                if ($emailFound != '' || $emailFound != null) {
                    
                    /* Get The First Name and Last Name from the BidsInfo object */
                    $fName = $BidsInfo->getUserInfo()->getFName();
                    $lName = $BidsInfo->getUserInfo()->getLName();

                    /* Get the Parameters from the Parameters.yml from the app */
                    $adminemail = $this->container->getParameter('admin_email');
                    
                    /* Message Template */
                    $message = \Swift_Message::newInstance()
                            ->setSubject('Bids Apply Successfully!')
                            ->setFrom($adminemail)
                            ->setTo($emailFound)
                            ->setContentType("text/html")
                            ->setBody(
                            $this->renderView(
                                    'ReverseAuctionWebservicesBundle:ApplyBids:email.html.twig', array(
                                'fName' => $fName,
                                'lName' => $lName,
                                'BidsInfo' => $BidsInfo
                                    )
                            )
                    );
                }
                /* Message Template End */
                
                /* Send the Mail */
                if ($this->get('mailer')->send($message)) {
                    
                    $dataQuery['userId'] = $BidsInfo->getUserInfo()->getId();
                    $dataQuery['productInfo'] = $BidsInfo->getBProductName();
                    $dataQuery['email'] = $BidsInfo->getBEmail();
                    $dataQuery['bAmount'] = $BidsInfo->getBAmount();
                    
                    /* Send the Json Response with the DataQuery. */
                    return new JsonResponse($this->bidsApplySuccessFully($dataQuery));
                } else {
                    return new JsonResponse($this->bidsUnsuccessful());
                }
                return new JsonResponse($this->bidsUnsuccessful());
            }
            return new JsonResponse($this->bidsUnsuccessful());
        }
        return $this->render('ReverseAuctionWebservicesBundle:ApplyBids:ApplyBids.html.twig');
    }

    /* After Successfully insertion of the Bid send the Json Response */

    private function bidsApplySuccessFully($dataQuery) {
        $data = array();

        $data['errorCode'] = "0";
        $data['errorMessage'] = "Success";
        $data['result'] = $dataQuery;

        $mainData = array();
        $mainData['data'] = $data;

        return $mainData;
    }

    /* Send the Json Response For the Unsuccessfull Information obtain. */

    public function bidsUnsuccessful() {
        $data = array();
        $data['errorCode'] = "1";
        $data['errorMessage'] = "Bids information is missing";
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
?>