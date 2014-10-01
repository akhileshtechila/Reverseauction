<?php

namespace ReverseAuction\ReverseAuctionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BidsInfo
 */
class BidsInfo {
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $bUserName;

    /**
     * @var string
     */
    private $bEmail;

    /**
     * @var string
     */
    private $bProductName;

    /**
     * @var string
     */
    private $bAmount;

    /**
     * @var \DateTime
     */
    private $createdDate;

    /**
     * @var \DateTime
     */
    private $updatedDate;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $WinnerInfo;

    /**
     * @var \ReverseAuction\ReverseAuctionBundle\Entity\UserInfo
     */
    private $UserInfo;

    /**
     * @var \ReverseAuction\ReverseAuctionBundle\Entity\ProductInfo
     */
    private $ProductInfo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->WinnerInfo = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set bUserName
     *
     * @param string $bUserName
     * @return BidsInfo
     */
    public function setBUserName($bUserName)
    {
        $this->bUserName = $bUserName;

        return $this;
    }

    /**
     * Get bUserName
     *
     * @return string 
     */
    public function getBUserName()
    {
        return $this->bUserName;
    }

    /**
     * Set bEmail
     *
     * @param string $bEmail
     * @return BidsInfo
     */
    public function setBEmail($bEmail)
    {
        $this->bEmail = $bEmail;

        return $this;
    }

    /**
     * Get bEmail
     *
     * @return string 
     */
    public function getBEmail()
    {
        return $this->bEmail;
    }

    /**
     * Set bProductName
     *
     * @param string $bProductName
     * @return BidsInfo
     */
    public function setBProductName($bProductName)
    {
        $this->bProductName = $bProductName;

        return $this;
    }

    /**
     * Get bProductName
     *
     * @return string 
     */
    public function getBProductName()
    {
        return $this->bProductName;
    }

    /**
     * Set bAmount
     *
     * @param string $bAmount
     * @return BidsInfo
     */
    public function setBAmount($bAmount)
    {
        $this->bAmount = $bAmount;

        return $this;
    }

    /**
     * Get bAmount
     *
     * @return string 
     */
    public function getBAmount()
    {
        return $this->bAmount;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     * @return BidsInfo
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime 
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set updatedDate
     *
     * @param \DateTime $updatedDate
     * @return BidsInfo
     */
    public function setUpdatedDate($updatedDate)
    {
        $this->updatedDate = $updatedDate;

        return $this;
    }

    /**
     * Get updatedDate
     *
     * @return \DateTime 
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    /**
     * Add WinnerInfo
     *
     * @param \ReverseAuction\ReverseAuctionBundle\Entity\WinnerInfo $winnerInfo
     * @return BidsInfo
     */
    public function addWinnerInfo(\ReverseAuction\ReverseAuctionBundle\Entity\WinnerInfo $winnerInfo)
    {
        $this->WinnerInfo[] = $winnerInfo;

        return $this;
    }

    /**
     * Remove WinnerInfo
     *
     * @param \ReverseAuction\ReverseAuctionBundle\Entity\WinnerInfo $winnerInfo
     */
    public function removeWinnerInfo(\ReverseAuction\ReverseAuctionBundle\Entity\WinnerInfo $winnerInfo)
    {
        $this->WinnerInfo->removeElement($winnerInfo);
    }

    /**
     * Get WinnerInfo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWinnerInfo()
    {
        return $this->WinnerInfo;
    }

    /**
     * Set UserInfo
     *
     * @param \ReverseAuction\ReverseAuctionBundle\Entity\UserInfo $userInfo
     * @return BidsInfo
     */
    public function setUserInfo(\ReverseAuction\ReverseAuctionBundle\Entity\UserInfo $userInfo = null)
    {
        $this->UserInfo = $userInfo;

        return $this;
    }

    /**
     * Get UserInfo
     *
     * @return \ReverseAuction\ReverseAuctionBundle\Entity\UserInfo 
     */
    public function getUserInfo()
    {
        return $this->UserInfo;
    }

    /**
     * Set ProductInfo
     *
     * @param \ReverseAuction\ReverseAuctionBundle\Entity\ProductInfo $productInfo
     * @return BidsInfo
     */
    public function setProductInfo(\ReverseAuction\ReverseAuctionBundle\Entity\ProductInfo $productInfo = null)
    {
        $this->ProductInfo = $productInfo;

        return $this;
    }

    /**
     * Get ProductInfo
     *
     * @return \ReverseAuction\ReverseAuctionBundle\Entity\ProductInfo 
     */
    public function getProductInfo()
    {
        return $this->ProductInfo;
    }
 
     /**
     * @ORM\PrePersist
     */
    public function setCreatedOnValue() {

        $this->createdDate = new \DateTime();
        $this->updatedDate = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedOnValue() {

        $this->updatedDate = new \DateTime();
    }
    
}
