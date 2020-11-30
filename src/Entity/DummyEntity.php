<?php

namespace App\Entity;

use App\Repository\DummyEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Table(name="dummy_entity")
 * @ORM\Entity(repositoryClass=DummyEntityRepository::class)
 * @Serializer\ExclusionPolicy("ALL")
 */
class DummyEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Expose()
     */
    private $myString;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Serializer\Expose()
     */
    private $myText;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Serializer\Expose()
     */
    private $myBoolean;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Serializer\Expose()
     */
    private $myInteger;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     */
    private $myFloat;

    /**
     * @ORM\Column(type="array", nullable=true)
     * @Serializer\Expose()
     */
    private $myArray = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     * @Serializer\Expose()
     */
    private $myJson = [];

    /**
     * @ORM\Column(type="object", nullable=true)
     * @Serializer\Expose()
     */
    private $myObject;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Serializer\Expose()
     */
    private $myDatetime;

    public function __construct()
    {
        $this->setMyDatetime(new \DateTime());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMyString(): ?string
    {
        return $this->myString;
    }

    public function setMyString(?string $myString): self
    {
        $this->myString = $myString;

        return $this;
    }

    public function getMyText(): ?string
    {
        return $this->myText;
    }

    public function setMyText(?string $myText): self
    {
        $this->myText = $myText;

        return $this;
    }

    public function getMyBoolean(): ?bool
    {
        return $this->myBoolean;
    }

    public function setMyBoolean(?bool $myBoolean): self
    {
        $this->myBoolean = $myBoolean;

        return $this;
    }

    public function getMyInteger(): ?int
    {
        return $this->myInteger;
    }

    public function setMyInteger(?int $myInteger): self
    {
        $this->myInteger = $myInteger;

        return $this;
    }

    public function getMyFloat(): ?float
    {
        return $this->myFloat;
    }

    public function setMyFloat(?float $myFloat): self
    {
        $this->myFloat = $myFloat;

        return $this;
    }

    public function getMyArray(): ?array
    {
        return $this->myArray;
    }

    public function setMyArray(?array $myArray): self
    {
        $this->myArray = $myArray;

        return $this;
    }

    public function getMyJson(): ?array
    {
        return $this->myJson;
    }

    public function setMyJson(?array $myJson): self
    {
        $this->myJson = $myJson;

        return $this;
    }

    public function getMyObject()
    {
        return $this->myObject;
    }

    public function setMyObject($myObject): self
    {
        $this->myObject = $myObject;

        return $this;
    }

    public function getMyDatetime(): ?\DateTimeInterface
    {
        return $this->myDatetime;
    }

    public function setMyDatetime(?\DateTimeInterface $myDatetime): self
    {
        $this->myDatetime = $myDatetime;

        return $this;
    }
}
