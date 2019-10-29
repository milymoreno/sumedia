<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/*Mily*/
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * Multimedia
 *
 * @ORM\Table(name="multimedia", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="fk_anuncio", columns={"anuncio_id"})})
 * @ORM\Entity
 */
class Multimedia
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
     * @ORM\Column(name="enlace_ruta", type="string", length=150, nullable=false)
     */
    private $enlaceRuta;

    /**
     * @var string
     *
     * @ORM\Column(name="formato", type="string", length=20, nullable=false)
     */
    private $formato;

    /**
     * @var float
     *
     * @ORM\Column(name="peso", type="float", precision=10, scale=0, nullable=false)
     */
    private $peso;

    /**
     * @var string
     *
     * @ORM\Column(name="ancho", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $ancho;

    /**
     * @var string
     *
     * @ORM\Column(name="alto", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $alto;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_multimedia", type="string", length=20, nullable=false)
     */
    private $tipoMultimedia;

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

    public function getEnlaceRuta(): ?string
    {
        return $this->enlaceRuta;
    }

    public function setEnlaceRuta(string $enlaceRuta): self
    {
        $this->enlaceRuta = $enlaceRuta;

        return $this;
    }

    public function getFormato(): ?string
    {
        return $this->formato;
    }

    public function setFormato(string $formato): self
    {
        $this->formato = $formato;

        return $this;
    }

    public function getPeso(): ?float
    {
        return $this->peso;
    }

    public function setPeso(float $peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    public function getAncho(): ?string
    {
        return $this->ancho;
    }

    public function setAncho(string $ancho): self
    {
        $this->ancho = $ancho;

        return $this;
    }

    public function getAlto(): ?string
    {
        return $this->alto;
    }

    public function setAlto(string $alto): self
    {
        $this->alto = $alto;

        return $this;
    }

    public function getTipoMultimedia(): ?string
    {
        return $this->tipoMultimedia;
    }

    public function setTipoMultimedia(string $tipoMultimedia): self
    {
        $this->tipoMultimedia = $tipoMultimedia;

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
