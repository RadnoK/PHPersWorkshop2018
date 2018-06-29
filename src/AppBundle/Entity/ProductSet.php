<?php

declare(strict_types=1);

namespace AppBundle\Entity;

use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

class ProductSet implements ResourceInterface, CodeAwareInterface
{
    private const STATE_NEW = 'new';

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $code;

    /** @var string */
    private $status = self::STATE_NEW;

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }
}
