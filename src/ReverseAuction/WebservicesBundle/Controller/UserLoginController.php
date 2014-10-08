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
 * User Login controller.
 * Author Name: Akhilesh Dahat
 * Date: 08 Sept 2014
 * Description: User Login with the Current Available email and Password.
 */
class UserLoginController extends Controller {

    /**
     * User Login or authentication from the User With the Relevant Credentials.
     *
     */
    public function UserLoginAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        //Check The request is Post
        if ($request->getMethod() == "POST") {
            // Get the Posted Data From the Android device
            $email = $request->get('email');
            $password = $request->get('password');
        } else {
            /* Return if the request is not post */
            return new JsonResponse($this->noJsonData());
        }

         /* Validation  For the User Input */
        if ($email == "") {
            $errorMsg = "Email Id Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else if ($password == "") {
            $errorMsg = "Password Empty";
            return new JsonResponse($this->blankField($errorMsg));
        } else {
            /*Encrypted the password Data*/
            $encryptPassword = md5($password);
            
            /*Find the User Credentials Object from the LoginInfo Entity */
            $className = "ReverseAuctionReverseAuctionBundle:LoginInfo";
            $dataQueryInfo = $em->getRepository($className)->findOneBy(
                    array(
                        'email' => $email,
                        'password' => $encryptPassword
                    )
            );

            /*Find the User If is Empty*/
            if ($dataQueryInfo == "" || $dataQueryInfo == null) {
                
                /* Return Response if the Data is Empty*/
                return new JsonResponse($this->loginUnsuccessful());
            }
            /* Get the Information into the array */
            $dataQuery['userId'] = $dataQueryInfo->getId();
            $dataQuery['email'] = $dataQueryInfo->getEmail();
            $dataQuery['userType'] = $dataQueryInfo->getUserInfo()->getUserType();
            $dataQuery['fName'] = $dataQueryInfo->getUserInfo()->getFName();
            $dataQuery['lName'] = $dataQueryInfo->getUserInfo()->getLName();

             /* Pass the Information into the array after the Login Successfull */
            return new JsonResponse($this->loginSuccess($dataQuery));
        }

        return $this->render('ReverseAuctionWebservicesBundle:UserLogin:UserLogin.html.twig');
    }

    /* After Successfully Login send the Json Response */
    private function loginSuccess($dataQuery) {
        $data = array();

        $data['errorCode'] = "0";
        $data['errorMessage'] = "Login successfully done ";
        $data['result'] = $dataQuery;

        $mainData = array();
        $mainData['data'] = $data;

        return $mainData;
    }

    /* After UnSuccessfully Login send the Json Response */
    public function loginUnsuccessful() {
        $data = array();
        $data['errorCode'] = "1";
        $data['errorMessage'] = "Login Unsuccessful.Try Again";
        $data['result'] = "User Name or Password Do not Match";

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
    private function noJsonData() {
        $data = array();
        $data['errorCode'] = "3";
        $data['errorMessage'] = "No Json Data";
        $data['result'] = "";

        $mainData = array();
        $mainData['data'] = $data;
        return $mainData;
    }

}
