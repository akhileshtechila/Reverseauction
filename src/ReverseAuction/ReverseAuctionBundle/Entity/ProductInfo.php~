<?php

namespace ReverseAuction\ReverseAuctionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * ProductInfo
 */
class ProductInfo {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank(message="users.blank.pName")
     * @Assert\Length(
     *      min = "3",
     *      max = "100",
     *      minMessage = "users.error.pName_min",
     *      maxMessage = "users.error.pName_max"
     * )
     */
    private $pName;

    /**
     * @var string
     * @Assert\NotBlank(message="users.blank.pType")
     * @Assert\Length(
     *      min = "3",
     *      max = "100",
     *      minMessage = "users.error.pType_min",
     *      maxMessage = "users.error.pType_max"
     * )
     */
    private $pType;

    /**
     * @var string
     * @Assert\NotBlank(message="users.blank.pBrandName")
     * @Assert\Length(
     *      min = "3",
     *      max = "100",
     *      minMessage = "users.error.pBrandName_min",
     *      maxMessage = "users.error.pBrandName_max"
     * )
     */
    private $pBrandName;

    /**
     * @var string
     * @Assert\NotBlank(message="users.blank.pRetailPrize")
     */
    private $pRetailPrize;

    /**
     * @var string
     */
    private $pImage;

    /**
     * @var string
     * @Assert\NotBlank(message="users.blank.pDescription")
     * @Assert\Length(
     *      min = "3",
     *      max = "300",
     *      minMessage = "users.error.pDescription_min",
     *      maxMessage = "users.error.pDescription_max"
     * )
     */
    private $pDescription;

    /**
     * @var \DateTime
     */
    private $pBidExpiry;

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
    private $BidsInfo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $WinnerInfo;

    /**
     * Constructor
     */
    public function __construct() {
        $this->BidsInfo = new \Doctrine\Common\Collections\ArrayCollection();
        $this->WinnerInfo = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set pName
     *
     * @param string $pName
     * @return ProductInfo
     */
    public function setPName($pName) {
        $this->pName = $pName;

        return $this;
    }

    /**
     * Get pName
     *
     * @return string 
     */
    public function getPName() {
        return $this->pName;
    }

    /**
     * Set pType
     *
     * @param string $pType
     * @return ProductInfo
     */
    public function setPType($pType) {
        $this->pType = $pType;

        return $this;
    }

    /**
     * Get pType
     *
     * @return string 
     */
    public function getPType() {
        return $this->pType;
    }

    /**
     * Set pBrandName
     *
     * @param string $pBrandName
     * @return ProductInfo
     */
    public function setPBrandName($pBrandName) {
        $this->pBrandName = $pBrandName;

        return $this;
    }

    /**
     * Get pBrandName
     *
     * @return string 
     */
    public function getPBrandName() {
        return $this->pBrandName;
    }

    /**
     * Set pRetailPrize
     *
     * @param string $pRetailPrize
     * @return ProductInfo
     */
    public function setPRetailPrize($pRetailPrize) {
        $this->pRetailPrize = $pRetailPrize;

        return $this;
    }

    /**
     * Get pRetailPrize
     *
     * @return string 
     */
    public function getPRetailPrize() {
        return $this->pRetailPrize;
    }

    /**
     * Set pImage
     *
     * @param string $pImage
     * @return ProductInfo
     */
    public function setPImage($pImage) {
        $this->pImage = $pImage;

        return $this;
    }

    /**
     * Get pImage
     *
     * @return string 
     */
    public function getPImage() {
        return $this->pImage;
    }

    /**
     * Set pDescription
     *
     * @param string $pDescription
     * @return ProductInfo
     */
    public function setPDescription($pDescription) {
        $this->pDescription = $pDescription;

        return $this;
    }

    /**
     * Get pDescription
     *
     * @return string 
     */
    public function getPDescription() {
        return $this->pDescription;
    }

    /**
     * Set pBidExpiry
     *
     * @param \DateTime $pBidExpiry
     * @return ProductInfo
     */
    public function setPBidExpiry($pBidExpiry) {
        $this->pBidExpiry = $pBidExpiry;

        return $this;
    }

    /**
     * Get pBidExpiry
     *
     * @return \DateTime 
     */
    public function getPBidExpiry() {
        return $this->pBidExpiry;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     * @return ProductInfo
     */
    public function setCreatedDate($createdDate) {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime 
     */
    public function getCreatedDate() {
        return $this->createdDate;
    }

    /**
     * Set updatedDate
     *
     * @param \DateTime $updatedDate
     * @return ProductInfo
     */
    public function setUpdatedDate($updatedDate) {
        $this->updatedDate = $updatedDate;

        return $this;
    }

    /**
     * Get updatedDate
     *
     * @return \DateTime 
     */
    public function getUpdatedDate() {
        return $this->updatedDate;
    }

    /**
     * Add BidsInfo
     *
     * @param \ReverseAuction\ReverseAuctionBundle\Entity\BidsInfo $bidsInfo
     * @return ProductInfo
     */
    public function addBidsInfo(\ReverseAuction\ReverseAuctionBundle\Entity\BidsInfo $bidsInfo) {
        $this->BidsInfo[] = $bidsInfo;

        return $this;
    }

    /**
     * Remove BidsInfo
     *
     * @param \ReverseAuction\ReverseAuctionBundle\Entity\BidsInfo $bidsInfo
     */
    public function removeBidsInfo(\ReverseAuction\ReverseAuctionBundle\Entity\BidsInfo $bidsInfo) {
        $this->BidsInfo->removeElement($bidsInfo);
    }

    /**
     * Get BidsInfo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBidsInfo() {
        return $this->BidsInfo;
    }

    /**
     * Add WinnerInfo
     *
     * @param \ReverseAuction\ReverseAuctionBundle\Entity\WinnerInfo $winnerInfo
     * @return ProductInfo
     */
    public function addWinnerInfo(\ReverseAuction\ReverseAuctionBundle\Entity\WinnerInfo $winnerInfo) {
        $this->WinnerInfo[] = $winnerInfo;

        return $this;
    }

    /**
     * Remove WinnerInfo
     *
     * @param \ReverseAuction\ReverseAuctionBundle\Entity\WinnerInfo $winnerInfo
     */
    public function removeWinnerInfo(\ReverseAuction\ReverseAuctionBundle\Entity\WinnerInfo $winnerInfo) {
        $this->WinnerInfo->removeElement($winnerInfo);
    }

    /**
     * Get WinnerInfo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWinnerInfo() {
        return $this->WinnerInfo;
    }

    public function getAbsolutePath() {
        return null === $this->pImage ? null : $this->getUploadRootDir() . '/' . $this->pImage;
    }

    public function getWebPath() {
        return null === $this->pImage ? null : $this->getUploadDir() . '/' . $this->pImage;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'images';
    }

    /**
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes = {
     *     "image/png",
     *     "image/gif",
     *     "image/jpeg",
     *     "image/jpg"
     *  },
     *     mimeTypesMessage = "Please upload a valid Image",
     *     maxSizeMessage = "Size to Too big."
     * )
     */
    private $file;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null) {
        $this->file = $file;
        // check if we have an old image path
        /* if (isset($this->image)) {
          // store the old name to delete after the update
          $this->temp = $this->image;
          $this->image = null;
          } else {
          $this->image = 'initial';
          } */

        return $this;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->pImage = $filename . '.' . $this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->pImage);

        // check if we have an old image

        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

    private $temp;

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile() {
        return $this->file;
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
