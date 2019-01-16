<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RevelConfigurationRepository")
 */
class RevelConfiguration
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $domain_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $secret;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $revel_key;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDomainName(): ?string
    {
        return $this->domain_name;
    }

    public function setDomainName(string $domain_name): self
    {
        $this->domain_name = $domain_name;

        return $this;
    }

    public function getSecret(): ?string
    {
        return $this->secret;
    }

    public function setSecret(string $secret): self
    {
        $this->secret = $secret;

        return $this;
    }

    public function getRevelKey(): ?string
    {
        return $this->revel_key;
    }

    public function setRevelKey(string $revel_key): self
    {
        $this->revel_key = $revel_key;

        return $this;
    }
}
