<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NetsuiteToRevelHistoryRepository")
 */
class NetsuiteToRevelHistory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ran_time;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=65555, nullable=true)
     */
    private $error;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRanTime(): ?\DateTimeInterface
    {
        return $this->ran_time;
    }

    public function setRanTime(\DateTimeInterface $ran_time): self
    {
        $this->ran_time = $ran_time;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getError(): ?string
    {
        return $this->error;
    }

    public function setError(?string $error): self
    {
        $this->error = $error;

        return $this;
    }
}
