<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StockControlRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=StockControlRepository::class)
 */
class StockControl
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Product::class, inversedBy="stockControl", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $producto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProducto(): ?Product
    {
        return $this->producto;
    }

    public function setProducto(Product $producto): self
    {
        $this->producto = $producto;

        return $this;
    }
}
