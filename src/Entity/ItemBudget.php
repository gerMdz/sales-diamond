<?php

namespace App\Entity;

use App\Repository\ItemBudgetRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=ItemBudgetRepository::class)
 */
class ItemBudget
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="doctrine.uuid_generator")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Budget::class, inversedBy="itemBudgets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $budget;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $costo;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $unidad_costo;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cantidad_costo;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="itemBudgets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $producto;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $excendentes;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $excedentes_costo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observacion;

    /**
     * @var string|null
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id")
     */

    protected $createdBy;

    /**
     * @var string|null
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="updated_by", referencedColumnName="id")
     */
    protected $updatedBy;

    /**
     * @var string|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="content_changed_by", referencedColumnName="id")
     * @Gedmo\Blameable(on="change", field={"title", "descripcion", "isAvailable", "identifier", "isForSale"})
     */
    protected $contentChangedBy;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getBudget(): ?Budget
    {
        return $this->budget;
    }

    public function setBudget(?Budget $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getCosto(): ?float
    {
        return $this->costo;
    }

    public function setCosto(?float $costo): self
    {
        $this->costo = $costo;

        return $this;
    }

    public function getUnidadCosto(): ?string
    {
        return $this->unidad_costo;
    }

    public function setUnidadCosto(?string $unidad_costo): self
    {
        $this->unidad_costo = $unidad_costo;

        return $this;
    }

    public function getCantidadCosto(): ?float
    {
        return $this->cantidad_costo;
    }

    public function setCantidadCosto(?float $cantidad_costo): self
    {
        $this->cantidad_costo = $cantidad_costo;

        return $this;
    }

    public function getProducto(): ?Product
    {
        return $this->producto;
    }

    public function setProducto(?Product $producto): self
    {
        $this->producto = $producto;

        return $this;
    }

    public function getExcendentes(): ?string
    {
        return $this->excendentes;
    }

    public function setExcendentes(?string $excendentes): self
    {
        $this->excendentes = $excendentes;

        return $this;
    }

    public function getExcedentesCosto(): ?float
    {
        return $this->excedentes_costo;
    }

    public function setExcedentesCosto(?float $excedentes_costo): self
    {
        $this->excedentes_costo = $excedentes_costo;

        return $this;
    }

    public function getObservacion(): ?string
    {
        return $this->observacion;
    }

    public function setObservacion(?string $observacion): self
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    /**
     * @return string|null
     */
    public function getUpdatedBy(): ?string
    {
        return $this->updatedBy;
    }

    /**
     * @return string|null
     */
    public function getContentChangedBy(): ?string
    {
        return $this->contentChangedBy;
    }
}
