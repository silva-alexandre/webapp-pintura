<?php

namespace App\Entity;

use App\Repository\ClienteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClienteRepository::class)]
class Cliente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nome = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $contato = null;

    /**
     * @var Collection<int, Orcamento>
     */
    #[ORM\OneToMany(targetEntity: Orcamento::class, mappedBy: 'id_cliente')]
    private Collection $orcamentos;

    public function __construct()
    {
        $this->orcamentos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): static
    {
        $this->nome = $nome;

        return $this;
    }

    public function getContato(): ?string
    {
        return $this->contato;
    }

    public function setContato(?string $contato): static
    {
        $this->contato = $contato;

        return $this;
    }

    /**
     * @return Collection<int, Orcamento>
     */
    public function getOrcamentos(): Collection
    {
        return $this->orcamentos;
    }

    public function addOrcamento(Orcamento $orcamento): static
    {
        if (!$this->orcamentos->contains($orcamento)) {
            $this->orcamentos->add($orcamento);
            $orcamento->setIdCliente($this);
        }

        return $this;
    }

    public function removeOrcamento(Orcamento $orcamento): static
    {
        if ($this->orcamentos->removeElement($orcamento)) {
            // set the owning side to null (unless already changed)
            if ($orcamento->getIdCliente() === $this) {
                $orcamento->setIdCliente(null);
            }
        }

        return $this;
    }
}
