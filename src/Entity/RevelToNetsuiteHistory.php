<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RevelToNetsuiteHistoryRepository")
 */
class RevelToNetsuiteHistory
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
    private $is_success;

    /**
     * @ORM\Column(type="string", length=65555, nullable=true)
     */
    private $error;

    /**
     * @var datetime $ran_time
     *
     * @ORM\Column(type="datetime")
     */
    public $ran_time;

    /**
     * @ORM\Column(type="bigint")
     */
    private $processed_records_count;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsSuccess(): ?int
    {
        return $this->is_success;
    }

    public function setIsSuccess(int $is_success): self
    {
        $this->is_success = $is_success;

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

    /**
     * Gets triggered only on insert

     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->ran_time = new \DateTime("now");
    }

    public function getProcessedRecordsCount(): ?int
    {
        return $this->processed_records_count;
    }

    public function setProcessedRecordsCount(int $processed_records_count): self
    {
        $this->processed_records_count = $processed_records_count;

        return $this;
    }

}
