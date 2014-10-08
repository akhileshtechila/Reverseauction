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

class ForgetPasswordController extends Controller {

    public function ForgetPasswordAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        if ($request->getMethod() == "POST") {
            // Get the Posted Data From the IOS device
            $email = $request->get('email');
            //$password = $request->get('password');
            //$confirmPassword = $request->get('confirmPassword');
        } else {
            return new JsonResponse($this->noJsonData());
        }
       // $email = "akhilesh.techila@gmail.com";
        if ($email == "") {
            $errorMsg = "Email is Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } /* else if ($password == "") {
          $errorMsg = "Password is Empty";
          return new JsonResponse($this->blankField($errorMsg));
          } else if ($confirmPassword == "") {
          $errorMsg = "Confirm Password is Empty";
          return new JsonResponse($this->blankField($errorMsg));
          } else if ($confirmPassword != $password) {
          $errorMsg = "Password is not matching";
          return new JsonResponse($this->blankField($errorMsg));
          } */ else {
            $randpassword = $this->gen_random_password(8);
            $encryptPassword = md5($randpassword);
            $className = "ReverseAuctionReverseAuctionBundle:LoginInfo";
            $dataQueryInfo = $em->getRepository($className)->findOneBy(
                    array('email' => $email)
            );

            if ($dataQueryInfo == "" || $dataQueryInfo == null) {
                return new JsonResponse($this->userNotFound());
            }
            $dataQueryInfo->setPassword($encryptPassword);
            $em->flush();

            $emailFound = $dataQueryInfo->getEmail();

            if ($emailFound != '' || $emailFound != null) {
                $fName = $dataQueryInfo->getUserInfo()->getFName();
                $lName = $dataQueryInfo->getUserInfo()->getLName();
                $adminemail = $this->container->getParameter('admin_email');
                $message = \Swift_Message::newInstance()
                        ->setSubject('Password Change')
                        ->setFrom($adminemail)
                        ->setTo($emailFound)
                        ->setContentType("text/html")
                        ->setBody(
                        $this->renderView(
                                'ReverseAuctionWebservicesBundle:ForgetPassword:email.html.twig', array(
                            'fName' => $fName,
                            'lName' => $lName,
                            'randpassword' => $randpassword
                                )
                        )
                );
            }

            if ($this->get('mailer')->send($message)) {
                return new JsonResponse($this->userPasswordChange($emailFound));
            } else {
                return new JsonResponse($this->userNotFound());
            }
            return new JsonResponse($this->userNotFound());
        }


        return $this->render('ReverseAuctionWebservicesBundle:ForgetPassword:ForgetPassword.html.twig');
    }

    private function userPasswordChange($emailFound) {
        $data = array();

        $data['errorCode'] = "0";
        $data['errorMessage'] = "Password Change Successfully";
        $data['result'] = $emailFound;

        $mainData = array();
        $mainData['data'] = $data;

        return $mainData;
    }

    public function userNotFound() {
        $data = array();
        $data['errorCode'] = "1";
        $data['errorMessage'] = "User Not Found";
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

    private function noJsonData() {
        $data = array();
        $data['errorCode'] = "3";
        $data['errorMessage'] = "No Post Data";
        $data['result'] = "";

        $mainData = array();
        $mainData['data'] = $data;
        return $mainData;
    }

    private function gen_random_password($length = 8) {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890@#_&$*[]!%abcdefghijklmnopqrstuvwxyz";
        $final_rand = '';
        for ($i = 0; $i < $length; $i++) {
            $final_rand .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $final_rand;
    }

}
