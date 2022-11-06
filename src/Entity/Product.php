<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @UniqueEntity(fields={"identifier"}, message="Este identificador ya existe. Otro producto lo está usando")
 */
class Product
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
     * @ORM\Column(type="string", length=510)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAvailable;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $identifier;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isForSale;

    /**
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

    /**
     * @ORM\ManyToMany(targetEntity=Budget::class, mappedBy="productos")
     */
    private $budgets;

    /**
     * @ORM\OneToMany(targetEntity=ItemBudget::class, mappedBy="producto")
     */
    private $itemBudgets;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $precio_lista;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $precio_promo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isPromo;

    /**
     * @ORM\OneToOne(targetEntity=StockControl::class, mappedBy="producto", cascade={"persist", "remove"})
     */
    private $stockControl;

    public function __construct()
    {
        $this->budgets = new ArrayCollection();
        $this->itemBudgets = new ArrayCollection();
    }


    public function __toString()
    {
        return $this->title;
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function isIsAvailable(): ?bool
    {
        return $this->isAvailable;
    }

    public function setIsAvailable(bool $isAvailable): self
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function isIsForSale(): ?bool
    {
        return $this->isForSale;
    }

    public function setIsForSale(bool $isForSale): self
    {
        $this->isForSale = $isForSale;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    /**
     * @return User|null
     */
    public function getUpdatedBy(): ?User
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
     * @return Collection<int, Budget>
     */
    public function getBudgets(): Collection
    {
        return $this->budgets;
    }

    public function addBudget(Budget $budget): self
    {
        if (!$this->budgets->contains($budget)) {
            $this->budgets[] = $budget;
            $budget->addProducto($this);
        }

        return $this;
    }

    public function removeBudget(Budget $budget): self
    {
        if ($this->budgets->removeElement($budget)) {
            $budget->removeProducto($this);
        }

        return $this;
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
            $itemBudget->setProducto($this);
        }

        return $this;
    }

    public function removeItemBudget(ItemBudget $itemBudget): self
    {
        if ($this->itemBudgets->removeElement($itemBudget)) {
            // set the owning side to null (unless already changed)
            if ($itemBudget->getProducto() === $this) {
                $itemBudget->setProducto(null);
            }
        }

        return $this;
    }

    public function getPrecioLista(): ?float
    {
        return $this->precio_lista;
    }

    public function setPrecioLista(?float $precio_lista): self
    {
        $this->precio_lista = $precio_lista;

        return $this;
    }

    public function getPrecioPromo(): ?float
    {
        return $this->precio_promo;
    }

    public function setPrecioPromo(?float $precio_promo): self
    {
        $this->precio_promo = $precio_promo;

        return $this;
    }

    public function isIsPromo(): ?bool
    {
        return $this->isPromo;
    }

    public function setIsPromo(?bool $isPromo): self
    {
        $this->isPromo = $isPromo;

        return $this;
    }

    public function getStockControl(): ?StockControl
    {
        return $this->stockControl;
    }

    public function setStockControl(StockControl $stockControl): self
    {
        // set the owning side of the relation if necessary
        if ($stockControl->getProducto() !== $this) {
            $stockControl->setProducto($this);
        }

        $this->stockControl = $stockControl;

        return $this;
    }


}

