<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hammerpost
 *
 * @ORM\Table(name="hammerpost")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HammerpostRepository")
 */
class Hammerpost
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
     * @ORM\Column(name="titulo", type="string", length=150)
     */
    private $titulo;
    
         /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creado", type="date")
     */
    private $fechaCreado;
       
    
    /**
     * @var string
     *
     * @ORM\Column(name="post", type="text", nullable=true)
     */
    private $post;


    
        public function __toString() {
        return $this->titulo;
    }
    
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
     * Set post
     *
     * @param string $post
     * @return Hammerpost
     */
    public function setPost($post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return string 
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Hammerpost
     */
    public function setNombre($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->titulo;
    }

    /**
     * Set fechaCreado
     *
     * @param \DateTime $fechaCreado
     * @return Hammerpost
     */
    public function setFechaCreado($fechaCreado)
    {
        $this->fechaCreado = $fechaCreado;

        return $this;
    }

    /**
     * Get fechaCreado
     *
     * @return \DateTime 
     */
    public function getFechaCreado()
    {
        return $this->fechaCreado;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Hammerpost
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }
}
