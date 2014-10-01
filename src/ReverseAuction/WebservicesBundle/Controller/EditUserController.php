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

class EditUserController extends Controller {

    public function EditUserAction(Request $request) {

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
            $password = $request->get('password');
            $confirmPassword = $request->get('confirmPassword');
            $mobile = $request->get('mobile');
            $city = $request->get('city');
            $userType = $request->get('userType');
            $userId = $request->get('userId');
            //$userId = "17";
        } else {
            return new JsonResponse($this->noPostData());
        } 
            
        if ($userId == "") {
            $errorMsg = "User Id Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else {
            $className = "ReverseAuctionReverseAuctionBundle:UserInfo";
            $userInfo = $em->getRepository($className)->find($userId);
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

            /*  $validator = $this->get('validator');
              $errors = $validator->validate($userInfo);
              $result = array();
              if (count($errors) > 0) {
              //$errorsString = (string) $errors;
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
              } */

            $em->flush();

            if ($userInfo->getId() != "") {
                $className = "ReverseAuctionReverseAuctionBundle:LoginInfo";
                $LoginInfo = $em->getRepository($className)->findOneBy(array('email' => $userInfo->getEmail() ));
               
                
                $LoginInfo->setPassword(md5($password));
                $em->flush();

                if ($LoginInfo->getId() != "") {
                    /* User Information */
                    $email = $LoginInfo->getEmail();

                    $fName = $userInfo->getFName($fName);
                    $lName = $userInfo->getLName($lName);

                    if ($email != '' || $email != null) {
                        $adminemail = $this->container->getParameter('admin_email');
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
                                    'password' => $password
                                        )
                                )
                        );
                    }
                }
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

    private function userSuccesfullyInserted($dataQuery) {
        $data = array();

        $data['errorCode'] = "0";
        $data['errorMessage'] = "Success";
        $data['result'] = $dataQuery;

        $mainData = array();
        $mainData['data'] = $data;

        return $mainData;
    }

    public function userUnsuccessful() {
        $data = array();
        $data['errorCode'] = "1";
        $data['errorMessage'] = "User information is missing";
        $data['result'] = "";

        $mainData = array();
        $mainData['data'] = $data;
        return $mainData;
    }

    private function blankField($errorMsg) {
        $data = array();
        $data['errorCode'] = "2";
        $data['errorMessage'] = $errorMsg;
        $data['result'] = "";

        $mainData = array();
        $mainData['data'] = $data;
        return $mainData;
    }

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
