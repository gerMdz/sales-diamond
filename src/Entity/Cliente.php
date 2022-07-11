<?php

namespace App\Entity;

use App\Repository\ClienteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Blameable\Traits\BlameableEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=ClienteRepository::class)
 */
class Cliente
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
     * @ORM\Column(type="string", length=255)
     */
    private $razon_social;

    /**
     * @ORM\Column(type="string", length=510, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emial;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cuit;

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
     *@ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="content_changed_by", referencedColumnName="id")
     * @Gedmo\Blameable(on="change", field={"razon_social", "address", "phone", "emial", "cuit"})
     */
    protected $contentChangedBy;

    /**
     * @ORM\OneToMany(targetEntity=Budget::class, mappedBy="cliente")
     */
    private $budgets;

    public function __construct()
    {
        $this->budgets = new ArrayCollection();
    }

    public function __toString()
    {
     return $this->razon_social;
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getRazonSocial(): ?string
    {
        return $this->razon_social;
    }

    public function setRazonSocial(string $razon_social): self
    {
        $this->razon_social = $razon_social;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmial(): ?string
    {
        return $this->emial;
    }

    public function setEmial(?string $emial): self
    {
        $this->emial = $emial;

        return $this;
    }

    public function getCuit(): ?string
    {
        return $this->cuit;
    }

    public function setCuit(?string $cuit): self
    {
        $this->cuit = $cuit;

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
            $budget->setCliente($this);
        }

        return $this;
    }

    public function removeBudget(Budget $budget): self
    {
        if ($this->budgets->removeElement($budget)) {
            // set the owning side to null (unless already changed)
            if ($budget->getCliente() === $this) {
                $budget->setCliente(null);
            }
        }

        return $this;
    }


}
