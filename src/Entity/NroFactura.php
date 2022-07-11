<?php

namespace App\Entity;

use App\Repository\NroFacturaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NroFacturaRepository::class)
 */
class NroFactura
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Budget::class, inversedBy="nroFactura", cascade={"persist", "remove"})
     */
    private $budget;

    public function getId(): ?int
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
}
