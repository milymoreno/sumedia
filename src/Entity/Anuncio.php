<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use JMS\Serializer\Annotation as Serializer;
/**
 * Anuncio
 *
 * @ORM\Table(name="anuncio", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="fk_tipo", columns={"tipo_id"}), @ORM\Index(name="fk_estado", columns={"estado_id"})})
 * @ORM\Entity
 */
class Anuncio
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
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var int
     *
     * @ORM\Column(name="pos_x", type="integer", nullable=false)
     */
    private $posX;

    /**
     * @var int
     *
     * @ORM\Column(name="pos_y", type="integer", nullable=false)
     */
    private $posY;

    /**
     * @var int
     *
     * @ORM\Column(name="pos_z", type="integer", nullable=false)
     */
    private $posZ;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $fechaCreacion = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_update", type="datetime", nullable=true, options={"default"="current_timestamp()"})
     */
    private $fechaUpdate = 'current_timestamp()';

    /**
     * @var \Estado
     *
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estado_id", referencedColumnName="id")
     * })
     */
    private $estado;

    /**
     * @var \Tipo
     *
     * @ORM\ManyToOne(targetEntity="Tipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_id", referencedColumnName="id")
     * })
     */
    private $tipo;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;
    /*Mily*/
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Texto", mappedBy="anuncio")
     */
    private $textos;

    public function __construct()
    {
        $this->textos = new ArrayCollection();
    }

    /*end mily*/

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getPosX(): ?int
    {
        return $this->posX;
    }

    public function setPosX(int $posX): self
    {
        $this->posX = $posX;

        return $this;
    }

    public function getPosY(): ?int
    {
        return $this->posY;
    }

    public function setPosY(int $posY): self
    {
        $this->posY = $posY;

        return $this;
    }

    public function getPosZ(): ?int
    {
        return $this->posZ;
    }

    public function setPosZ(int $posZ): self
    {
        $this->posZ = $posZ;

        return $this;
    }

    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion(?\DateTimeInterface $fechaCreacion): self
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    public function getFechaUpdate(): ?\DateTimeInterface
    {
        return $this->fechaUpdate;
    }

    public function setFechaUpdate(?\DateTimeInterface $fechaUpdate): self
    {
        $this->fechaUpdate = $fechaUpdate;

        return $this;
    }

    public function getEstado(): ?Estado
    {
        return $this->estado;
    }

    public function setEstado(?Estado $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getTipo(): ?Tipo
    {
        return $this->tipo;
    }

    public function setTipo(?Tipo $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->tipo;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


    /*Mily*/
    public function updatedTimestamps()
    {
        $dateTimeNow = new DateTime('now');
        $this->setFechaUpdate($dateTimeNow);
        if ($this->getFechaCreacion() === null) {
            $this->setFechaCreacion($dateTimeNow);
        }
    }


}
