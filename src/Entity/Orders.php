<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 */
class Orders
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $customerid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $deliveryoption;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $netamount;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phonenumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contactemail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $discountammount;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $loyaltypointsearned;

    /**
     * @ORM\Column(type="datetime")
     */
    private $orderdate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getCustomerid(): ?string
    {
        return $this->customerid;
    }

    public function setCustomerid(string $customerid): self
    {
        $this->customerid = $customerid;

        return $this;
    }

    public function getDeliveryoption(): ?string
    {
        return $this->deliveryoption;
    }

    public function setDeliveryoption(string $deliveryoption): self
    {
        $this->deliveryoption = $deliveryoption;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(string $Status): self
    {
        $this->Status = $Status;

        return $this;
    }

    public function getNetamount(): ?string
    {
        return $this->netamount;
    }

    public function setNetamount(string $netamount): self
    {
        $this->netamount = $netamount;

        return $this;
    }

    public function getPhonenumber(): ?string
    {
        return $this->phonenumber;
    }

    public function setPhonenumber(string $phonenumber): self
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    public function getContactemail(): ?string
    {
        return $this->contactemail;
    }

    public function setContactemail(string $contactemail): self
    {
        $this->contactemail = $contactemail;

        return $this;
    }

    public function getDiscountammount(): ?string
    {
        return $this->discountammount;
    }

    public function setDiscountammount(string $discountammount): self
    {
        $this->discountammount = $discountammount;

        return $this;
    }

    public function getLoyaltypointsearned(): ?string
    {
        return $this->loyaltypointsearned;
    }

    public function setLoyaltypointsearned(string $loyaltypointsearned): self
    {
        $this->loyaltypointsearned = $loyaltypointsearned;

        return $this;
    }

    public function getOrderdate(): ?\DateTimeInterface
    {
        return $this->orderdate;
    }

    public function setOrderdate(\DateTimeInterface $orderdate): self
    {
        $this->orderdate = $orderdate;

        return $this;
    }
}
