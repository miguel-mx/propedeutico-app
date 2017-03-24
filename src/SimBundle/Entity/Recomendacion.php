<?php

namespace SimBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Recomendacion
 *
 * @ORM\Table(name="recomendacion")
 * @ORM\Entity(repositoryClass="SimBundle\Repository\RecomendacionRepository")
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 *
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
     * @ORM\Column(name="recomendacion", type="text", nullable=true)
     */
    private $recomendacion;

    /**
     * Many Recomendaciones have One Solicitud.
     * @ORM\ManyToOne(targetEntity="Solicitud", inversedBy="recomendaciones")
     * @ORM\JoinColumn(name="solicitud_id", referencedColumnName="id")
     */
    private $solicitud;

    /**
     *
     * @Vich\UploadableField(mapping="carta_recomendacion", fileNameProperty="recomendacionName")
     *
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Favor de subir el archivo en formato PDF"
     * )
     *
     * @var File
     */
    private $recomendacionFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $recomendacionName;

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

    /**
     * @return string
     */
    public function getRecomendacion()
    {
        return $this->recomendacion;
    }

    /**
     * @param string $recomendacion
     */
    public function setRecomendacion($recomendacion)
    {
        $this->recomendacion = $recomendacion;
    }

    /**
     * @return File|null
     */
    public function getRecomendacionFile()
    {
        return $this->recomendacionFile;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $recomendacionFile
     *
     * @return Recomendacion
     */
    public function setRecomendacionFile($recomendacionFile)
    {
        $this->recomendacionFile = $recomendacionFile;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRecomendacionName()
    {
        return $this->recomendacionName;
    }

    /**
     * @param mixed $recomendacionName
     *
     * @return Recomendacion
     */
    public function setRecomendacionName($recomendacionName)
    {
        $this->recomendacionName = $recomendacionName;

        return $this;
    }

}
