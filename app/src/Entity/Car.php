<?php

declare(strict_types = 1);

namespace App\Entity;

use App\Entity\ValueObject\Money;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 * @ORM\Table(name="cars")
 */
class Car
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=CarBrand::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private CarBrand $brand;

    /**
     * @ORM\ManyToOne(targetEntity=CarModel::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private CarModel $model;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $photo;

    /**
     * @ORM\Column(type="integer")
     */
    private int $price;

    public function __construct(
        CarBrand $brand,
        CarModel $model,
        string $photo,
        int $price
    )
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->photo = $photo;
        $this->price = $price;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function getBrand(): ?CarBrand
    {
        return $this->brand;
    }

    public function getModel(): ?CarModel
    {
        return $this->model;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function setBrand(?CarBrand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function setModel(?CarModel $model): self
    {
        $this->model = $model;

        return $this;
    }
}