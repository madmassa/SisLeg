<?php

namespace AppBundle\Entity;

use JMS\Serializer\Annotation\VirtualProperty;
use Doctrine\ORM\Mapping as ORM;


/**
 * Proyecto
 * @ORM\Table(name="proyecto", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_proyecto_expediente_idx",
 *                                                 columns={"idExpediente"}),
 *                                           	  @ORM\UniqueConstraint(name="UNIQ_proyecto_ultimaRevision_idx",
 *                                                 columns={"idUltimaRevision"})},
 *                             indexes={@ORM\Index(name="proyecto_tipoProyecto_idx", columns={"idTipoProyecto"}),
 *                                     
 *                                     }
 *                              )
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProyectoRepository")
 */
class Proyecto
{
    //-----------------------------------------atributos de la clase-------------------------------

    /**
     * @var integer
     *
     * @ORM\Column(name="idProyecto", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Expediente
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Expediente", inversedBy="proyecto", fetch="EAGER" )
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="idExpediente", referencedColumnName="idExpediente")
     * })
     */
     private $expediente;

    /**
     * @var \AppBundle\Entity\TipoProyecto
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TipoProyecto", fetch="EAGER" )
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="idTipoProyecto", referencedColumnName="idTipoProyecto")
     * })
     */
     private $tipoProyecto;

    /**
     * @var text
     *
     * @ORM\Column(name="visto", type="text", nullable=false)
     */
    private $visto;

    /**
     * @var text
     *
     * @ORM\Column(name="considerandos", type="text", nullable=false)
     */
    private $considerandos;

    /**
     * @var array
     *
     * @ORM\Column(name="articulos", type="json_array", nullable=false)
     */
    private $articulos;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Perfil", fetch="EAGER", orphanRemoval=true )
     * @ORM\JoinTable(name="legisladores_proyectos",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idProyecto", referencedColumnName="idProyecto")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idPerfil", referencedColumnName="idPerfil")
     *   }
     * )
     */
    private $concejales;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ProyectoFirma", cascade={"persist"}, mappedBy="proyecto")
     */
    private $firmas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCreacion", type="datetime", nullable=false)
     */
    private $fechaCreacion;


    /**
     * @var string
     *
     * @ORM\Column(name="usuarioCreacion", type="string", length=70, nullable=false)
     */
    private $usuarioCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaModificacion", type="datetime", nullable=true)
     */
    private $fechaModificacion;


    /**
     * @var string
     *
     * @ORM\Column(name="usuarioModificacion", type="string", length=70, nullable=false)
     */
    private $usuarioModificacion;
    
    /**
     * @var \AppBundle\Entity\ProyectoRevision
      *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\ProyectoRevision", fetch="LAZY" )
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="idProyectoRevision", referencedColumnName="idProyectoRevision")
     * })
     */
    private $ultimaRevision;

    //------------------------------------constructor---------------------------------------------

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->concejales = new \Doctrine\Common\Collections\ArrayCollection();
        $this->firmas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    //-------------------------------------setters y getters--------------------------------------
 
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set expediente
     *
     * @param string $expediente
     *
     * @return Proyecto
     */
    public function setExpediente($expediente)
    {
        $this->expediente = $expediente;

        return $this;
    }

    /**
     * Get expediente
     *
     * @return string
     */
    public function getExpediente()
    {
        return $this->expediente;
    }

    /**
     * Set tipoProyecto
     *
     * @param \AppBundle\Entity\TipoProyecto $tipoProyecto
     *
     * @return Proyecto
     */
    public function setTipoProyecto($tipoProyecto)
    {
        $this->tipoProyecto = $tipoProyecto;

        return $this;
    }

    /**
     * Get tipoProyecto
     *
     * @return \AppBundle\Entity\TipoProyecto
     */
    public function getTipoProyecto()
    {
        return $this->tipoProyecto;
    }

    /**
     * Set visto
     *
     * @param text $visto
     *
     * @return Proyecto
     */
    public function setVisto($visto)
    {
        $this->visto = $visto;

        return $this;
    }

    /**
     * Get visto
     *
     * @return text
     */
    public function getVisto()
    {
        return $this->visto;
    }

    /**
     * Set considerandos
     *
     * @param text $considerandos
     *
     * @return Proyecto
     */
    public function setConsiderandos($considerandos)
    {
        $this->considerandos = $considerandos;

        return $this;
    }

    /**
     * Get considerandos
     *
     * @return text
     */
    public function getConsiderandos()
    {
        return $this->considerandos;
    }

    /**
     * Set articulos
     *
     * @param array $articulos
     *
     * @return Proyecto
     */
    public function setArticulos($articulos)
    {
        $this->articulos = $articulos;

        return $this;
    }

    /**
     * Get articulos
     *
     * @return array
     */
    public function getArticulos()
    {
        return $this->articulos;
    } 

    /**
     * set concejales
     *
     * @param array $nuevosConcejales
     *
     * @return Proyecto
     */
    public function setConcejales($nuevosConcejales)
    {
        $collection= new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($nuevosConcejales as $concejal) {
            $collection[]=$concejal;
        }
        $this->concejales = $collection;

        return $this;
    }

    /**
     * Add concejal
     *
     * @param \AppBundle\Entity\Perfil $concejal
     *
     * @return Proyecto
     */
    public function addConcejal(\AppBundle\Entity\Perfil $concejal)
    {
        $this->concejales[] = $concejal;

        return $this;
    }

    /**
     * Remove concejal
     *
     * @param \AppBundle\Entity\Perfil $concejal
     *
     * @return Proyecto
     */
    public function removeConcejal(\AppBundle\Entity\Perfil $concejal)
    {
        $this->concejales->removeElement($concejal);
        return $this;
    }

    /**
     * Get concejales
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConcejales()
    {
        return $this->concejales;
    }

    /**
     * Add firma
     *
     * @param \AppBundle\Entity\ProyectoFirma $firma
     *
     * @return Proyecto
     */
    public function addFirma(\AppBundle\Entity\ProyectoFirma $firma)
    {
        $firma->setProyecto($this);

        $this->firmas[] = $firma;

        return $this;
    }

    /**
     * Remove firma
     *
     * @param \AppBundle\Entity\ProyectoFirma $firma
     *
     * @return Proyecto
     */
    public function removeFirma(\AppBundle\Entity\ProyectoFirma $firma)
    {
        $this->firmas->removeElement($firma);
    }

    /**
     * Get firmas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFirmas()
    {
        return $this->firmas;
    }
    
    /**
     * Set ultimaRevision
     *
     * @param \AppBundle\Entity\ProyectoRevision $ultimaRevision
     *
     * @return Proyecto
     */
    public function setUltimaRevision($ultimaRevision)
    {
    	$this->ultimaRevision = $ultimaRevision;
    	
    	return $this;
    }
    
    /**
     * Get ultimaRevision
     *
     * @return \AppBundle\Entity\ProyectoRevision
     */
    public function getTUltimaRevision()
    {
    	return $this->ultimaRevision;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Perfil
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Get usuarioCreacion
     *
     * @return string
     */
    public function getUsuarioCreacion()
    {
        return $this->usuarioCreacion;
    }

    /**
     * Set usuarioCreacion
     *
     * @param string $usuarioCreacion
     *
     * @return Perfil
     */
    public function setUsuarioCreacion($usuarioCreacion)
    {
        $this->usuarioCreacion = $usuarioCreacion;

        return $this;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     *
     * @return Perfil
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Get usuarioModificacion
     *
     * @return string
     */
    public function getUsuarioModificacion()
    {
        return $this->usuarioModificacion;
    }

    /**
     * Set usuarioModificacion
     *
     * @param string $usuarioModificacion
     *
     * @return Perfil
     */
    public function setUsuarioModificacion($usuarioModificacion)
    {
        $this->usuarioModificacion = $usuarioModificacion;

        return $this;
    }

    //------------------------------Propiedades virtuales-----------------------------------------

    /**
     * Get listaConsejales
     *
     * @return string
     *
     * @VirtualProperty
     */
    public function getListaConcejales()
    {
        $listaConcejales="";
        $concejales=$this->concejales;
        foreach ($concejales as $concejal) {
           $listaConcejales.=($listaConcejales!=""?" / ":"").$concejal->getDescripcion();  
        }
        return $listaConcejales;
    }

    /**
     * Get fechaEntradaFormateada
     *
     * @return string
     *
     * @VirtualProperty
     */
    public function getFechaEntradaFormateada()
    {
        return ((!is_null($this->expediente))
                    ?$this->expediente->getFechaCreacion()->format('d-m-Y')
                    :"---");
    }

    /**
     * Get fechaCreacionFormateada
     *
     * @return string
     *
     * @VirtualProperty
     */
    public function getFechaCreacionFormateada()
    {
        return $this->fechaCreacion->format('d-m-Y');
    }

    /**
     * Get numeroExpediente
     *
     * @return string
     *
     * @VirtualProperty
     */
    public function getNumeroExpediente()
    {
        return ((!is_null($this->expediente))
                    ?$this->expediente->getNumeroCompleto()
                    :"---");
    }

    /**
     * Get estadoExpediente
     *
     * @return string
     *
     * @VirtualProperty
     */
    public function getEstadoExpediente()
    {
        return ((!is_null($this->expediente))
                    ?$this->expediente->getEstadoExpediente()->getEstadoExpediente()
                    :"---");
    }
}
