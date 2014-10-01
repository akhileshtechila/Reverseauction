<?php

namespace ReverseAuction\ReverseAuctionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WinnerInfo
 */
class WinnerInfo{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $wUserName;

    /**
     * @var string
     */
    private $wProductName;

    /**
     * @var string
     */
    private $pType;

    /**
     * @var string
     */
    private $pBrandName;

    /**
     * @var string
     */
    private $pRetailPrize;

    /**
     * @var string
     */
    private $bidAmount;

    /**
     * @var \DateTime
     */
    private $createdDate;

    /**
     * @var \DateTime
     */
    private $updatedDate;

    /**
     * @var \ReverseAuction\ReverseAuctionBundle\Entity\UserInfo
     */
    private $UserInfo;

    /**
     * @var \ReverseAuction\ReverseAuctionBundle\Entity\ProductInfo
     */
    private $ProductInfo;

    /**
     * @var \ReverseAuction\ReverseAuctionBundle\Entity\BidsInfo
     */
    private $BidsInfo;


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
     * Set wUserName
     *
     * @param string $wUserName
     * @return WinnerInfo
     */
    public function setWUserName($wUserName)
    {
        $this->wUserName = $wUserName;

        return $this;
    }

    /**
     * Get wUserName
     *
     * @return string 
     */
    public function getWUserName()
    {
        return $this->wUserName;
    }

    /**
     * Set wProductName
     *
     * @param string $wProductName
     * @return WinnerInfo
     */
    public function setWProductName($wProductName)
    {
        $this->wProductName = $wProductName;

        return $this;
    }

    /**
     * Get wProductName
     *
     * @return string 
     */
    public function getWProductName()
    {
        return $this->wProductName;
    }

    /**
     * Set pType
     *
     * @param string $pType
     * @return WinnerInfo
     */
    public function setPType($pType)
    {
        $this->pType = $pType;

        return $this;
    }

    /**
     * Get pType
     *
     * @return string 
     */
    public function getPType()
    {
        return $this->pType;
    }

    /**
     * Set pBrandName
     *
     * @param string $pBrandName
     * @return WinnerInfo
     */
    public function setPBrandName($pBrandName)
    {
        $this->pBrandName = $pBrandName;

        return $this;
    }

    /**
     * Get pBrandName
     *
     * @return string 
     */
    public function getPBrandName()
    {
        return $this->pBrandName;
    }

    /**
     * Set pRetailPrize
     *
     * @param string $pRetailPrize
     * @return WinnerInfo
     */
    public function setPRetailPrize($pRetailPrize)
    {
        $this->pRetailPrize = $pRetailPrize;

        return $this;
    }

    /**
     * Get pRetailPrize
     *
     * @return string 
     */
    public function getPRetailPrize()
    {
        return $this->pRetailPrize;
    }

    /**
     * Set bidAmount
     *
     * @param string $bidAmount
     * @return WinnerInfo
     */
    public function setBidAmount($bidAmount)
    {
        $this->bidAmount = $bidAmount;

        return $this;
    }

    /**
     * Get bidAmount
     *
     * @return string 
     */
    public function getBidAmount()
    {
        return $this->bidAmount;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     * @return WinnerInfo
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
     * @return WinnerInfo
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
     * Set UserInfo
     *
     * @param \ReverseAuction\ReverseAuctionBundle\Entity\UserInfo $userInfo
     * @return WinnerInfo
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
     * @return WinnerInfo
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
     * Set BidsInfo
     *
     * @param \ReverseAuction\ReverseAuctionBundle\Entity\BidsInfo $bidsInfo
     * @return WinnerInfo
     */
    public function setBidsInfo(\ReverseAuction\ReverseAuctionBundle\Entity\BidsInfo $bidsInfo = null)
    {
        $this->BidsInfo = $bidsInfo;

        return $this;
    }

    /**
     * Get BidsInfo
     *
     * @return \ReverseAuction\ReverseAuctionBundle\Entity\BidsInfo 
     */
    public function getBidsInfo()
    {
        return $this->BidsInfo;
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
