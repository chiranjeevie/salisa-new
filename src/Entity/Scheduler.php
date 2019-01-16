<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SchedulerRepository")
 */
class Scheduler
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="integer")
     */
    private $interval_time;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $last_ran_time;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=65555)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_active;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $is_success;



    public function getId(): ?int
    {
        return $this->id;
    }


    public function getIntervalTime(): ?int
    {
        return $this->interval_time;
    }

    public function setIntervalTime(int $interval_time): self
    {
        $this->interval_time = $interval_time;

        return $this;
    }

    public function getLastRanTime(): ?\DateTimeInterface
    {
        return $this->last_ran_time;
    }

    public function setLastRanTime(?\DateTimeInterface $last_ran_time): self
    {
        $this->last_ran_time = $last_ran_time;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(?bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getIsSuccess(): ?int
    {
        return $this->is_success;
    }

    public function setIsSuccess(?int $is_success): self
    {
        $this->is_success = $is_success;

        return $this;
    }
}
