<?php

namespace App\Entity;

use App\Repository\ServicoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicoRepository::class)]
class Servico
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $tipo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $detalhe = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $preco = null;

    #[ORM\Column(nullable: true)]
    private ?array $foto = null;

    /**
     * @var Collection<int, Orcamento>
     */
    #[ORM\OneToMany(targetEntity: Orcamento::class, mappedBy: 'id_servico')]
    private Collection $orcamentos;

    public function __construct()
    {
        $this->orcamentos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getDetalhe(): ?string
    {
        return $this->detalhe;
    }

    public function setDetalhe(?string $detalhe): static
    {
        $this->detalhe = $detalhe;

        return $this;
    }

    public function getPreco(): ?string
    {
        return $this->preco;
    }

    public function setPreco(string $preco): static
    {
        $this->preco = $preco;

        return $this;
    }

    public function getFoto(): ?array
    {
        return $this->foto;
    }

    public function setFoto(?array $foto): static
    {
        $this->foto = $foto;

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
            $orcamento->setIdServico($this);
        }

        return $this;
    }

    public function removeOrcamento(Orcamento $orcamento): static
    {
        if ($this->orcamentos->removeElement($orcamento)) {
            // set the owning side to null (unless already changed)
            if ($orcamento->getIdServico() === $this) {
                $orcamento->setIdServico(null);
            }
        }

        return $this;
    }
}
