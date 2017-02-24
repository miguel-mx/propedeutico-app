<?php

namespace SimBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Recomendacion
 *
 * @ORM\Table(name="recomendacion")
 * @ORM\Entity(repositoryClass="SimBundle\Repository\RecomendacionRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Recomendacion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="comparacion", type="string", length=60)
     * @Assert\NotBlank()
     */
    private $comparacion;

    /**
     * @var string
     *
     * @ORM\Column(name="materias", type="string", length=500)
     * @Assert\NotBlank()
     */
    private $materias;

    /**
     * @var string
     *
     * @ORM\Column(name="participacion", type="string", length=500)
     * @Assert\NotBlank()
     */
    private $participacion;

    /**
     * @var string
     *
     * @ORM\Column(name="utilidad", type="string", length=1000)
     * @Assert\NotBlank()
     */
    private $utilidad;

    /**
     * @var string
     *
     * @ORM\Column(name="motivacion", type="string", length=1000)
     * @Assert\NotBlank()
     */
    private $motivacion;

    /**
     * Many Recomendaciones have One Solicitud.
     * @ORM\ManyToOne(targetEntity="Solicitud", inversedBy="recomendaciones")
     * @ORM\JoinColumn(name="recomendacion_id", referencedColumnName="id")
     */
    private $solicitud;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=140)
     */
    private $mail;

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set comparacion
     *
     * @param string $comparacion
     *
     * @return Recomendacion
     */
    public function setComparacion($comparacion)
    {
        $this->comparacion = $comparacion;

        return $this;
    }

    /**
     * Get comparacion
     *
     * @return string
     */
    public function getComparacion()
    {
        return $this->comparacion;
    }

    /**
     * Set materias
     *
     * @param string $materias
     *
     * @return Recomendacion
     */
    public function setMaterias($materias)
    {
        $this->materias = $materias;

        return $this;
    }

    /**
     * Get materias
     *
     * @return string
     */
    public function getMaterias()
    {
        return $this->materias;
    }

    /**
     * Set participacion
     *
     * @param string $participacion
     *
     * @return Recomendacion
     */
    public function setParticipacion($participacion)
    {
        $this->participacion = $participacion;

        return $this;
    }

    /**
     * Get participacion
     *
     * @return string
     */
    public function getParticipacion()
    {
        return $this->participacion;
    }

    /**
     * Set utilidad
     *
     * @param string $utilidad
     *
     * @return Recomendacion
     */
    public function setUtilidad($utilidad)
    {
        $this->utilidad = $utilidad;

        return $this;
    }

    /**
     * Get utilidad
     *
     * @return string
     */
    public function getUtilidad()
    {
        return $this->utilidad;
    }

    /**
     * Set motivacion
     *
     * @param string $motivacion
     *
     * @return Recomendacion
     */
    public function setMotivacion($motivacion)
    {
        $this->motivacion = $motivacion;

        return $this;
    }

    /**
     * Get motivacion
     *
     * @return string
     */
    public function getMotivacion()
    {
        return $this->motivacion;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Recomendacion
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Recomendacion
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set solicitud
     *
     * @param \SimBundle\Entity\Solicitud $solicitud
     *
     * @return Recomendacion
     */
    public function setSolicitud(\SimBundle\Entity\Solicitud $solicitud = null)
    {
        $this->solicitud = $solicitud;

        return $this;
    }

    /**
     * Get solicitud
     *
     * @return \SimBundle\Entity\Solicitud
     */
    public function getSolicitud()
    {
        return $this->solicitud;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Form
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

}
