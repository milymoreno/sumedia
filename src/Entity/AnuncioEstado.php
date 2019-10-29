<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnuncioEstado
 *
 * @ORM\Table(name="anuncio_estado", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="fk_estado_old", columns={"estado_id_old"}), @ORM\Index(name="fk_estado_new", columns={"estado_id_new"})})
 * @ORM\Entity
 */
class AnuncioEstado
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
     * @var int
     *
     * @ORM\Column(name="anuncio_id", type="bigint", nullable=false, options={"unsigned"=true})
     */
    private $anuncioId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false, options={"default"="current_timestamp()"})
     */
    private $fecha = 'current_timestamp()';

    /**
     * @var \Estado
     *
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estado_id_new", referencedColumnName="id")
     * })
     */
    private $estadoNew;

    /**
     * @var \Estado
     *
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estado_id_old", referencedColumnName="id")
     * })
     */
    private $estadoOld;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getAnuncioId(): ?string
    {
        return $this->anuncioId;
    }

    public function setAnuncioId(string $anuncioId): self
    {
        $this->anuncioId = $anuncioId;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getEstadoNew(): ?Estado
    {
        return $this->estadoNew;
    }

    public function setEstadoNew(?Estado $estadoNew): self
    {
        $this->estadoNew = $estadoNew;

        return $this;
    }

    public function getEstadoOld(): ?Estado
    {
        return $this->estadoOld;
    }

    public function setEstadoOld(?Estado $estadoOld): self
    {
        $this->estadoOld = $estadoOld;

        return $this;
    }


}
