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
 * Product Listing Controller.
 * Author Name: Akhilesh Dahat
 * Date: 08 Sept 2014
 * Description: Registartion Controller for the User and Admin Registration Webservices.
 */

class RegistrationController extends Controller {

    /**
     * Registartion Controller and Json response with the Object.
     *
     */
    public function RegistrationAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        /* Check The request is Post */
         if ($request->getMethod() == "POST") {          
          $fName = $request->get('fName');
          $lName = $request->get('lName');
          $email = $request->get('email');
          $state = $request->get('state');
          $address = $request->get('address');
          $country = $request->get('country');
          $zipCode = $request->get('zipCode');
          $mobile = $request->get('mobile');
          $city = $request->get('city');
          $userType = $request->get('userType');
          } else {
             /* Return if the request is not post */
             return new JsonResponse($this->noPostData());
          } 
         
        /* Validation  For the User Input */
        if ($email == "") {
            $errorMsg = "Email Id Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else if ($fName == "") {
            $errorMsg = "First Name Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else if ($lName == "") {
            $errorMsg = "Last Name Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else if ($state == "") {
            $errorMsg = "State Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else if ($mobile == "") {
            $errorMsg = "Mobile no Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else if ($userType == "") {
            $errorMsg = "User Type Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else if ($country == "") {
            $errorMsg = "Country Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else if ($zipCode == "") {
            $errorMsg = "ZipCode is Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else if ($city== "") {
            $errorMsg = "City is Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else if ($address== "") {
            $errorMsg = "Address is Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else {

      /* Instantiate the UserInfo and the Set the Variables into the Setter's */
            $userInfo = new UserInfo();
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
            $userInfo->setBidPoints(10);

            /*Validator for the Entity Validation*/
            $validator = $this->get('validator');
            $errors = $validator->validate($userInfo);
            $result = array();
            if (count($errors) > 0) {
                //$errorsString = (string) $errors;
                
                /*Iterate the Errors*/
                foreach ($errors as $error) {
                    $result[] = $this->get('translator')->trans($error->getMessage());
                }
                $data = array();
                $data['errorMessage'] = "Duplicate Entries";
                $data['errorCode'] = "4";
                $data['result'] = $result;

                $mainData = array();
                $mainData['data'] = $data;

                return new JsonResponse($mainData);
            }

            /*Persist The object*/
            $em->persist($userInfo);
            $em->flush();

            if ($userInfo->getId() != "") {

                /*Generate the Random password */
                $randpassword = $this->gen_random_password(8);

    /* Instantiate the LoginInfo and the Set the Variables into the Setter's */ 
                $LoginInfo = new LoginInfo();
                $LoginInfo->setEmail($userInfo->getEmail());
                $LoginInfo->setUserInfo($userInfo);
                $LoginInfo->setPassword(md5($randpassword));
                $em->persist($LoginInfo);
                $em->flush();

                if ($LoginInfo->getId() != "") {
                    /* User Information */
                    $email = $LoginInfo->getEmail();
                    $password = $randpassword;

                    $fName = $userInfo->getFName($fName);
                    $lName = $userInfo->getLName($lName);

                    /*Set the mail*/
                    if ($email != '' || $email != null) {
                        $adminemail = $this->container->getParameter('admin_email');
                        $message = \Swift_Message::newInstance()
                                ->setSubject('Registration User')
                                ->setFrom($adminemail)
                                ->setTo($email)
                                ->setContentType("text/html")
                                ->setBody(
                                $this->renderView(
                                    'ReverseAuctionWebservicesBundle:Registration:email.html.twig', array(
                                    'fName' => $fName,
                                    'lName' => $lName,
                                    'username' => $email,
                                    'password' => $password
                                        )
                                )
                        );
                    }
                }
                
                /*Send the Mail*/
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
                    $dataQuery['bidPoints'] = $userInfo->getBidPoints();
                    
                    /*Send the Json response*/
                    return new JsonResponse($this->userSuccesfullyInserted($dataQuery));
                } else {
                    return new JsonResponse($this->userUnsuccessful());
                }
                return new JsonResponse($this->userUnsuccessful());
            }

            return new JsonResponse($this->userUnsuccessful());
        }


        return $this->render('ReverseAuctionWebservicesBundle:Registration:Registration.html.twig');
    }

    /*Return the Response For Success*/
    private function userSuccesfullyInserted($dataQuery) {
        $data = array();

        $data['errorCode'] = "0";
        $data['errorMessage'] = "Success";
        $data['result'] = $dataQuery;

        $mainData = array();
        $mainData['data'] = $data;

        return $mainData;
    }

    
    /*Return the Response with the Unsuccessful message*/
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

    /*Method for the Generation of the Random passsword.*/
    private function gen_random_password($length = 8) {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890@#_&$*[]!%abcdefghijklmnopqrstuvwxyz";
        $final_rand = '';
        for ($i = 0; $i < $length; $i++) {
            $final_rand .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $final_rand;
    }

}
