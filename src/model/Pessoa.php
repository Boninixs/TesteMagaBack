<?php

namespace Teste\Magazord\Model;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "pessoa")]
class Pessoa
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue]
    private int $idpessoa;

    #[ORM\Column(type: "string")]
    private string $nomepessoa;

    #[ORM\Column(type: "string")]
    private string $cpfpessoa;

    // Getters e Setters
    public function getIdpessoa(): int
    {
        return $this->idpessoa;
    }

    public function getNomepessoa(): string
    {
        return $this->nomepessoa;
    }

    public function setNomepessoa(string $nome): void
    {
        $this->nomepessoa = $nome;
    }

    public function getCpfpessoa(): string
    {
        return $this->cpfpessoa;
    }

    public function setCpfpessoa(string $cpf): void
    {
        $this->cpfpessoa = $cpf;
    }
}
