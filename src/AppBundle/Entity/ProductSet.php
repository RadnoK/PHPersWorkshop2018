<?php

declare(strict_types=1);

namespace AppBundle\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;

class ProductSet implements ResourceInterface
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $code;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }
}
