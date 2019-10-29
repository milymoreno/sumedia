<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Texto
 *
 * @ORM\Table(name="texto", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="anuncio_id", columns={"anuncio_id"})})
 * @ORM\Entity
 */
class Texto
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="cadena", type="string", length=150, nullable=false)
     */
    private $cadena;

    /**
     * @var \Anuncio
     *
     * @ORM\ManyToOne(targetEntity="Anuncio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="anuncio_id", referencedColumnName="id")
     * })
     */
    private $anuncio;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getCadena(): ?string
    {
        return $this->cadena;
    }

    public function setCadena(string $cadena): self
    {
        $this->cadena = $cadena;

        return $this;
    }

    public function getAnuncio(): ?Anuncio
    {
        return $this->anuncio;
    }

    public function setAnuncio(?Anuncio $anuncio): self
    {
        $this->anuncio = $anuncio;

        return $this;
    }


}
