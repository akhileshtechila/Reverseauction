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


/**
 * Edit User Information Controller.
 * Author Name: Akhilesh Dahat
 * Date: 08 Sept 2014
 * Description: Edit the User And Send the Updated information With The mail Functionality.
 */
class EditUserController extends Controller {

    /**
     * Edit User User and Send the Mail.
     *
     */
    
    public function EditUserAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        /* Check The request is Post */

        if ($request->getMethod() == "POST") {
            // Get the Posted Data From the Android device
            $fName = $request->get('fName');
            $lName = $request->get('lName');
            $email = $request->get('email');
            $state = $request->get('state');
            $address = $request->get('address');
            $country = $request->get('country');
            $zipCode = $request->get('zipCode');
            $password = $request->get('password');
            $confirmPassword = $request->get('confirmPassword');
            $mobile = $request->get('mobile');
            $city = $request->get('city');
            $userType = $request->get('userType');
            $userId = $request->get('userId');
          
         } else {
            
         /* Return if the request is not post */
            return new JsonResponse($this->noPostData());
        } 
        
         /* Validation the Blank input For the User Input */
        if ($userId == "") {
            $errorMsg = "User Id Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else {
            /*Find the User Object from the UserID provided. */
            $className = "ReverseAuctionReverseAuctionBundle:UserInfo";
            $userInfo = $em->getRepository($className)->find($userId);
           
            /*Set the Variable's into the Setter*/
            $userInfo->setFName($fName);
            $userInfo->setLName($lName);
            $userInfo->setEmail($email);
            $userInfo->setAddress($address);
            $userInfo->setState($state);
            $userInfo->setZipCode($zipCode);
            $userInfo->setUserType($userType);
            $userInfo->setMobile($mobile);
            $userInfo->setCountry($country);
            $userInfo->setCity($city);            
            $em->flush();

            /*Get the User Information of the last Updated User.*/
            if ($userInfo->getId() != "") {
                
                /*Find the User By the Email*/
                $className = "ReverseAuctionReverseAuctionBundle:LoginInfo";
                $LoginInfo = $em->getRepository($className)->findOneBy(array('email' => $userInfo->getEmail() ));
                
                /*Set the Password with encryption.*/
                $LoginInfo->setPassword(md5($password));
                $em->flush();

                if ($LoginInfo->getId() != "") {
                    /* User Information */
                    $email = $LoginInfo->getEmail();

                    $fName = $LoginInfo->getUserInfo()->getFName();
                    $lName = $LoginInfo->getUserInfo()->getLName();;

                    /*Check if the email is Exist*/
                    if ($email != '' || $email != null) {
                        /* Get the Parameters from the Parameters.yml from the app */
                        $adminemail = $this->container->getParameter('admin_email');
                    
                         /* Message Template */
                        $message = \Swift_Message::newInstance()
                                ->setSubject('User Information Updated')
                                ->setFrom($adminemail)
                                ->setTo($email)
                                ->setContentType("text/html")
                                ->setBody(
                                $this->renderView(
                                    'ReverseAuctionWebservicesBundle:EditUser:email.html.twig', array(
                                    'fName' => $fName,
                                    'lName' => $lName,
                                    'username' => $email,
                                    'password' => $password,
                                    'entity'  => $userInfo
                                        )
                                )
                        );
                    }
                }
                /* Message Template End */
                
                /* Send the Mail */
                
                if ($this->get('mailer')->send($message)) {
                    $dataQuery['userId'] = $userInfo->getId();
                    $dataQuery['email'] = $userInfo->getEmail();
                    $dataQuery['fName'] = $fName;
                    $dataQuery['lName'] = $lName;
                    $dataQuery['password'] = $password;
                    $dataQuery['userType'] = $userInfo->getUserType();
                    $dataQuery['address'] = $userInfo->getAddress();
                    $dataQuery['state'] = $userInfo->getState();
                    $dataQuery['city'] = $userInfo->getCity();
                    $dataQuery['country'] = $userInfo->getCountry();
                    $dataQuery['zipCode'] = $userInfo->getZipCode();
                    $dataQuery['mobile'] = $userInfo->getMobile();

                     /* Send the Json Response with the DataQuery. */
                    return new JsonResponse($this->userSuccesfullyInserted($dataQuery));
                } else {
                    return new JsonResponse($this->userUnsuccessful());
                }
                return new JsonResponse($this->userUnsuccessful());
            }

            return new JsonResponse($this->userUnsuccessful());
        }


        return $this->render('ReverseAuctionWebservicesBundle:EditUser:EditUser.html.twig');
    }

     /* After Successfully insertion of the Bid send the Json Response */
    private function userSuccesfullyInserted($dataQuery) {
        $data = array();

        $data['errorCode'] = "0";
        $data['errorMessage'] = "Success";
        $data['result'] = $dataQuery;

        $mainData = array();
        $mainData['data'] = $data;

        return $mainData;
    }

    /* Send the Json Response For the Unsuccessfull Information obtain. */
    public function userUnsuccessful() {
        $data = array();
        $data['errorCode'] = "1";
        $data['errorMessage'] = "User information is missing";
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
