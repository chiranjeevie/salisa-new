<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ItemsRepository")
 */
class Items
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
    private $sku;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $displayname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $displayname_ar;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description_ar;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $onlineprice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $availableqty;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getDisplayname(): ?string
    {
        return $this->displayname;
    }

    public function setDisplayname(string $displayname): self
    {
        $this->displayname = $displayname;

        return $this;
    }

    public function getDisplaynameAr(): ?string
    {
        return $this->displayname_ar;
    }

    public function setDisplaynameAr(string $displayname_ar): self
    {
        $this->displayname_ar = $displayname_ar;

        return $this;
    }

    public function getDescriptionAr(): ?string
    {
        return $this->description_ar;
    }

    public function setDescriptionAr(string $description_ar): self
    {
        $this->description_ar = $description_ar;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getOnlineprice()
    {
        return $this->onlineprice;
    }

    public function setOnlineprice($onlineprice): self
    {
        $this->onlineprice = $onlineprice;

        return $this;
    }

    public function getAvailableqty(): ?string
    {
        return $this->availableqty;
    }

    public function setAvailableqty(string $availableqty): self
    {
        $this->availableqty = $availableqty;

        return $this;
    }
}
