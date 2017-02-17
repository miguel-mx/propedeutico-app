<?php

namespace SimBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Solicitud
 *
 * @ORM\Table(name="solicitud")
 * @ORM\Entity(repositoryClass="SimBundle\Repository\SolicitudRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Solicitud
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
     * @ORM\Column(name="nombre", type="string", length=60)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="paterno", type="string", length=60)
     */
    private $paterno;

    /**
     * @var string
     *
     * @ORM\Column(name="materno", type="string", length=60)
     */
    private $materno;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=2)
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=140)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="procedencia", type="string", length=100)
     * @Assert\NotBlank()
     */
    private $procedencia;

    /**
     * @var string
     *
     * @ORM\Column(name="carrera", type="string", length=100)
     * @Assert\NotBlank()
     */
    private $carrera;

    /**
     * @var string
     *
     * @ORM\Column(name="universidad", type="string", length=120)
     */
    private $universidad;

    /**
     * @var string
     *
     * @ORM\Column(name="programa", type="string", length=40)
     */
    private $programa;

    /**
     * @var string
     *
     * @ORM\Column(name="avance", type="string", length=20)
     */
    private $avance;

    /**
     * @var string
     *
     * @ORM\Column(name="promedio", type="string", length=20)
     */
    private $promedio;

    /**
     * @var string
     *
     * @ORM\Column(name="profesor1", type="string", length=50, nullable=true)
     * @Assert\NotBlank(groups={"estudiantes"})
     */
    private $profesor1;

    /**
     * @var string
     *
     * @ORM\Column(name="univprofesor1", type="string", length=100, nullable=true)
     * @Assert\NotBlank(groups={"estudiantes"})
     */
    private $univprofesor1;

    /**
     * @var string
     *
     * @ORM\Column(name="mailprofesor1", type="string", length=50, nullable=true)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true)
     * @Assert\NotBlank(groups={"estudiantes"})
     */

    private $mailprofesor1;

    /**
     * @var string
     *
     * @ORM\Column(name="profesor2", type="string", length=50, nullable=true)
     * @Assert\NotBlank(groups={"estudiantes"})
     */
    private $profesor2;

    /**
     * @var string
     *
     * @ORM\Column(name="univprofesor2", type="string", length=100, nullable=true)
     * @Assert\NotBlank(groups={"estudiantes"})
     */
    private $univprofesor2;

    /**
     * @var string
     *
     * @ORM\Column(name="mailprofesor2", type="string", length=50, nullable=true)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true)
     * @Assert\NotBlank(groups={"estudiantes"})
     */

    private $mailprofesor2;

    /**
     * @var string
     *
     * @ORM\Column(name="razones", type="string", length=1000, nullable=true)
     * @Assert\Length(
     *      max = 1000,
     *      maxMessage = "No se permiten más de {{ limit }} caracteres"
     * )
     */
    private $razones;


    /**
     * @var string
     *
     * @ORM\Column(name="beca", type="string", length=40)
     */
    private $beca;

    /**
     * @var bool
     *
     * @ORM\Column(name="confirmado", type="boolean", nullable=true)
     */
    private $confirmado;

    /**
     * @var bool
     *
     * @ORM\Column(name="aceptado", type="boolean", nullable=true)
     */
    private $aceptado;

    /**
     * @var string
     *
     * @ORM\Column(name="comentarios", type="string", length=5000, nullable=true)
     * @Assert\Length(
     *      max = 3000,
     *      maxMessage = "No se permiten más de {{ limit }} caracteres"
     * )
     */
    private $comentarios;

      /**
     * @Gedmo\Slug(fields={"nombre", "paterno", "materno"})
     * @ORM\Column(length=64, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $createdAt;

    /**
     * One Solicitud has Many Recomendaciones.
     * @ORM\OneToMany(targetEntity="Recomendacion", mappedBy="solicitud")
     */
    private $recomendaciones;

    public function __construct() {
        $this->recomendaciones = new ArrayCollection();
    }

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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Solicitud
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set paterno
     *
     * @param string $paterno
     *
     * @return Solicitud
     */
    public function setPaterno($paterno)
    {
        $this->paterno = $paterno;

        return $this;
    }

    /**
     * Get paterno
     *
     * @return string
     */
    public function getPaterno()
    {
        return $this->paterno;
    }

    /**
     * Set materno
     *
     * @param string $materno
     *
     * @return Solicitud
     */
    public function setMaterno($materno)
    {
        $this->materno = $materno;

        return $this;
    }

    /**
     * Get materno
     *
     * @return string
     */
    public function getMaterno()
    {
        return $this->materno;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     *
     * @return Solicitud
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
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
     * Get sexo
     *
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set procedencia
     *
     * @param string $procedencia
     * @return Form
     */
    public function setProcedencia($procedencia)
    {
        $this->procedencia = $procedencia;

        return $this;
    }

    /**
     * Get procedencia
     *
     * @return string
     */
    public function getProcedencia()
    {
        return $this->procedencia;
    }

    /**
     * Set carrera
     *
     * @param string $carrera
     * @return Form
     */
    public function setCarrera($carrera)
    {
        $this->carrera = $carrera;

        return $this;
    }

    /**
     * Get carrera
     *
     * @return string
     */
    public function getCarrera()
    {
        return $this->carrera;
    }

    /**
     * Set universidad
     *
     * @param string $universidad
     *
     * @return Solicitud
     */
    public function setUniversidad($universidad)
    {
        $this->universidad = $universidad;

        return $this;
    }

    /**
     * Get universidad
     *
     * @return string
     */
    public function getUniversidad()
    {
        return $this->universidad;
    }

    /**
     * Set programa
     *
     * @param string $programa
     *
     * @return Solicitud
     */
    public function setPrograma($programa)
    {
        $this->programa = $programa;

        return $this;
    }

    /**
     * Get programa
     *
     * @return string
     */
    public function getPrograma()
    {
        return $this->programa;
    }

    /**
     * Set avance
     *
     * @param string $avance
     *
     * @return Solicitud
     */
    public function setAvance($avance)
    {
        $this->avance = $avance;

        return $this;
    }

    /**
     * Get avance
     *
     * @return string
     */
    public function getAvance()
    {
        return $this->avance;
    }

    /**
     * Set promedio
     *
     * @param string $promedio
     *
     * @return Solicitud
     */
    public function setPromedio($promedio)
    {
        $this->promedio = $promedio;

        return $this;
    }

    /**
     * Get promedio
     *
     * @return string
     */
    public function getPromedio()
    {
        return $this->promedio;
    }

    /**
     * Set profesor1
     *
     * @param string $profesor
     * @return Form
     */
    public function setProfesor1($profesor)
    {
        $this->profesor1 = $profesor;

        return $this;
    }

    /**
     * Get profesor1
     *
     * @return string
     */
    public function getProfesor1()
    {
        return $this->profesor1;
    }

    /**
     * Set univprofesor1
     *
     * @param string $univprofesor
     * @return Form
     */
    public function setUnivprofesor1($univprofesor)
    {
        $this->univprofesor1 = $univprofesor;

        return $this;
    }

    /**
     * Get univprofesor1
     *
     * @return string
     */
    public function getUnivprofesor1()
    {
        return $this->univprofesor1;
    }

    /**
     * Set mailprofesor1
     *
     * @param string $mailprofesor
     * @return Form
     */
    public function setMailprofesor1($mailprofesor)
    {
        $this->mailprofesor1 = $mailprofesor;

        return $this;
    }

    /**
     * Get mailprofesor1
     *
     * @return string
     */
    public function getMailprofesor1()
    {
        return $this->mailprofesor1;
    }

    /**
     * Set profesor2
     *
     * @param string $profesor
     * @return Form
     */
    public function setProfesor2($profesor)
    {
        $this->profesor2 = $profesor;

        return $this;
    }

    /**
     * Get profesor2
     *
     * @return string
     */
    public function getProfesor2()
    {
        return $this->profesor2;
    }

    /**
     * Set univprofesor2
     *
     * @param string $univprofesor
     * @return Form
     */
    public function setUnivprofesor2($univprofesor)
    {
        $this->univprofesor2 = $univprofesor;

        return $this;
    }

    /**
     * Get univprofesor2
     *
     * @return string
     */
    public function getUnivprofesor2()
    {
        return $this->univprofesor2;
    }

    /**
     * Set mailprofesor2
     *
     * @param string $mailprofesor
     * @return Form
     */
    public function setMailprofesor2($mailprofesor)
    {
        $this->mailprofesor2 = $mailprofesor;

        return $this;
    }

    /**
     * Get mailprofesor2
     *
     * @return string
     */
    public function getMailprofesor2()
    {
        return $this->mailprofesor2;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Form
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
     * @return Form
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
     * @return string
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * @param string $comentarios
     */
    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;
    }

    /**
     * @return boolean
     */
    public function isConfirmado()
    {
        return $this->confirmado;
    }

    /**
     * @param boolean $confirmado
     */
    public function setConfirmado($confirmado)
    {
        $this->confirmado = $confirmado;
    }

    /**
     * @return boolean
     */
    public function isAceptado()
    {
        return $this->aceptado;
    }

    /**
     * @param boolean $aceptado
     */
    public function setAceptado($aceptado)
    {
        $this->aceptado = $aceptado;
    }

    public function getSlug()
    {
        return $this->slug;
    }

      /**
     * Set razones
     *
     * @param string $razones
     * @return Form
     */
    public function setRazones($razones)
    {
        $this->razones = $razones;

        return $this;
    }

    /**
     * Get razones
     *
     * @return string
     */
    public function getRazones()
    {
        return $this->razones;
    }

    /**
     * Set beca
     *
     * @param string $beca
     * @return Form
     */
    public function setBeca($beca)
    {
        $this->beca = $beca;

        return $this;
    }

    /**
     * Get beca
     *
     * @return string
     */
    public function getBeca()
    {
        return $this->beca;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function updateModifiedDatetime() {

        $this->setUpdatedAt(new \DateTime());
    }


    /**
     * Get confirmado
     *
     * @return boolean
     */
    public function getConfirmado()
    {
        return $this->confirmado;
    }

    /**
     * Get aceptado
     *
     * @return boolean
     */
    public function getAceptado()
    {
        return $this->aceptado;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Solicitud
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Add recomendacione
     *
     * @param \SimBundle\Entity\Recomendacion $recomendacione
     *
     * @return Solicitud
     */
    public function addRecomendacione(\SimBundle\Entity\Recomendacion $recomendacione)
    {
        $this->recomendaciones[] = $recomendacione;

        return $this;
    }

    /**
     * Remove recomendacione
     *
     * @param \SimBundle\Entity\Recomendacion $recomendacione
     */
    public function removeRecomendacione(\SimBundle\Entity\Recomendacion $recomendacione)
    {
        $this->recomendaciones->removeElement($recomendacione);
    }

    /**
     * Get recomendaciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRecomendaciones()
    {
        return $this->recomendaciones;
    }

    public function __toString()
    {
        return $this->getSlug();
    }

    /**
     * isRecomended
     *
     * @return Recomendacion
     */
    public function isRecomended($email)
    {
        foreach($this->recomendaciones as $recomendacion ) {
            if($recomendacion->getMail() == $email)
                return $recomendacion;
        }

        return NULL;
    }
}
