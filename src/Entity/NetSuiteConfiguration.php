<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**

 * @ORM\Entity(repositoryClass="App\Repository\NetSuiteConfigurationRepository")
 */
class NetSuiteConfiguration
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
    private $endpoint;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $host_url;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $account;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $consumer_key;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $consumer_secret;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $token;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $token_secret;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $signature_algorithm;

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

    public function getEndpoint(): ?string
    {
        return $this->endpoint;
    }

    public function setEndpoint(string $endpoint): self
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    public function getHostUrl(): ?string
    {
        return $this->host_url;
    }

    public function setHostUrl(string $host_url): self
    {
        $this->host_url = $host_url;

        return $this;
    }

    public function getAccount(): ?string
    {
        return $this->account;
    }

    public function setAccount(string $account): self
    {
        $this->account = $account;

        return $this;
    }

    public function getConsumerKey(): ?string
    {
        return $this->consumer_key;
    }

    public function setConsumerKey(string $consumer_key): self
    {
        $this->consumer_key = $consumer_key;

        return $this;
    }

    public function getConsumerSecret(): ?string
    {
        return $this->consumer_secret;
    }

    public function setConsumerSecret(string $consumer_secret): self
    {
        $this->consumer_secret = $consumer_secret;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getTokenSecret(): ?string
    {
        return $this->token_secret;
    }

    public function setTokenSecret(string $token_secret): self
    {
        $this->token_secret = $token_secret;

        return $this;
    }

    public function getSignatureAlgorithm(): ?string
    {
        return $this->signature_algorithm;
    }

    public function setSignatureAlgorithm(string $signature_algorithm): self
    {
        $this->signature_algorithm = $signature_algorithm;

        return $this;
    }
}
