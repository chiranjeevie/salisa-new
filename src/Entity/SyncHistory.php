<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SyncHistoryRepository")
 * @ORM\Table(name="sync_history")
 */
class SyncHistory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=65555)
     */
    private $source;

    /**
     * @ORM\Column(type="json_array")
     */
    private $transaction_record;

    /**
     * @ORM\Column(type="integer")
     */
    private $is_success;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $destination;

    /**
     * @ORM\Column(type="string", length=65555, nullable=true)
     */
    private $error;


    /**
     * @var datetime $created_at
     *
     * @ORM\Column(type="datetime")
     */
    public $created_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $module_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $module_entity;

    /**
     * @ORM\Column(type="integer", nullable=true, length=255)
     */
    private $entity_id;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(string $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getTransactionRecord()
    {
        return $this->transaction_record;
    }

    public function setTransactionRecord($transaction_record): self
    {
        $this->transaction_record = $transaction_record;

        return $this;
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

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

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
        $this->created_at = new \DateTime("now");
    }

    public function getModuleName(): ?string
    {
        return $this->module_name;
    }

    public function setModuleName(string $module_name): self
    {
        $this->module_name = $module_name;

        return $this;
    }

    public function getModuleEntity(): ?string
    {
        return $this->module_entity;
    }

    public function setModuleEntity(string $module_entity): self
    {
        $this->module_entity = $module_entity;

        return $this;
    }

    public function getEntityId(): ?int
    {
        return $this->entity_id;
    }

    public function setEntityId(?int $entity_id): self
    {
        $this->entity_id = $entity_id;

        return $this;
    }

}
