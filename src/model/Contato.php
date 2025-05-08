<?php

namespace Teste\Magazord\Model;

use Doctrine\ORM\Mapping as ORM;
use Teste\Magazord\Model\Pessoa;

#[ORM\Entity]
#[ORM\Table(name: "contato")]
class Contato
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue]
    private $idcontato;

    #[ORM\ManyToOne(targetEntity: Pessoa::class)]
    #[ORM\JoinColumn(name: "idpessoa", referencedColumnName: "idpessoa")]
    private $idpessoa;

    #[ORM\Column(type: "integer")]
    private $tipocontato;

    #[ORM\Column(type: "string")]
    private $descricaocontato;

    public function getIdcontato()
    {
        return $this->idcontato;
    }

    public function getIdpessoa()
    {
        return $this->idpessoa;
    }

    public function setIdpessoa($idpessoa)
    {
        $this->idpessoa = $idpessoa;
    }

    public function setPessoa($pessoa)
    {
        $this->idpessoa = $pessoa;
    }

    public function getTipocontato()
    {
        return $this->tipocontato;
    }

    public function setTipocontato($tipocontato)
    {
        $this->tipocontato = $tipocontato;
    }

    public function getDescricaocontato()
    {
        return $this->descricaocontato;
    }

    public function setDescricaocontato($descricaocontato)
    {
        $this->descricaocontato = $descricaocontato;
    }

}
