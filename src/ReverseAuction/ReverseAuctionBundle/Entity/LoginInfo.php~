<?php

namespace ReverseAuction\ReverseAuctionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * LoginInfo
 */
class LoginInfo {
    
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $userType;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return LoginInfo
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return LoginInfo
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set userType
     *
     * @param string $userType
     * @return LoginInfo
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;

        return $this;
    }

    /**
     * Get userType
     *
     * @return string 
     */
    public function getUserType()
    {
        return $this->userType;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     * @return LoginInfo
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
     * @return LoginInfo
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
     * @return LoginInfo
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
