<?php

namespace ReverseAuction\ReverseAuctionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ReverseAuctionReverseAuctionBundle:Default:index.html.twig', array('name' => $name));
    }
}
