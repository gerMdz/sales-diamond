<?php

namespace App\Entity;

use App\Repository\BudgetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\GeneratedValue;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=BudgetRepository::class)
 */
class Budget
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
     * @ORM\ManyToOne(targetEntity=Cliente::class, inversedBy="budgets")
     */
    private $cliente;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, inversedBy="budgets")
     */
    private $productos;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $aclaraciones;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $cliente_confirma;

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
     * @Gedmo\Blameable(on="change", field={"aclaraciones", "cliente_confirma"})
     */
    protected $contentChangedBy;

    /**
     * @ORM\OneToMany(targetEntity=ItemBudget::class, mappedBy="budget")
     */
    private $itemBudgets;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $total;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $nro_budget;

    /**
     * @ORM\OneToOne(targetEntity=NroFactura::class, mappedBy="budget", cascade={"persist", "remove"})
     */
    private $nroFactura;

    public function __construct()
    {
        $this->productos = new ArrayCollection();
        $this->itemBudgets = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProductos(): Collection
    {
        return $this->productos;
    }

    public function addProducto(Product $producto): self
    {
        if (!$this->productos->contains($producto)) {
            $this->productos[] = $producto;
        }

        return $this;
    }

    public function removeProducto(Product $producto): self
    {
        $this->productos->removeElement($producto);

        return $this;
    }

    public function getAclaraciones(): ?string
    {
        return $this->aclaraciones;
    }

    public function setAclaraciones(?string $aclaraciones): self
    {
        $this->aclaraciones = $aclaraciones;

        return $this;
    }

    public function getClienteConfirma(): ?string
    {
        return $this->cliente_confirma;
    }

    public function setClienteConfirma(?string $cliente_confirma): self
    {
        $this->cliente_confirma = $cliente_confirma;

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

    /**
     * @return Collection<int, ItemBudget>
     */
    public function getItemBudgets(): Collection
    {
        return $this->itemBudgets;
    }

    public function addItemBudget(ItemBudget $itemBudget): self
    {
        if (!$this->itemBudgets->contains($itemBudget)) {
            $this->itemBudgets[] = $itemBudget;
            $itemBudget->setBudget($this);
        }

        return $this;
    }

    public function removeItemBudget(ItemBudget $itemBudget): self
    {
        if ($this->itemBudgets->removeElement($itemBudget)) {
            // set the owning side to null (unless already changed)
            if ($itemBudget->getBudget() === $this) {
                $itemBudget->setBudget(null);
            }
        }

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(?float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getNroBudget(): ?int
    {
        return $this->nro_budget;
    }

    public function setNroBudget(int $nro_budget): self
    {
        $this->nro_budget = $nro_budget;

        return $this;
    }

    public function getNroFactura(): ?NroFactura
    {
        return $this->nroFactura;
    }

    public function setNroFactura(?NroFactura $nroFactura): self
    {
        // unset the owning side of the relation if necessary
        if ($nroFactura === null && $this->nroFactura !== null) {
            $this->nroFactura->setBudget(null);
        }

        // set the owning side of the relation if necessary
        if ($nroFactura !== null && $nroFactura->getBudget() !== $this) {
            $nroFactura->setBudget($this);
        }

        $this->nroFactura = $nroFactura;

        return $this;
    }
}
