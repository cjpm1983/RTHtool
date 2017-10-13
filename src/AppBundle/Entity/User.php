<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr",type="string")
 * @ORM\DiscriminatorMap({"user"="User", "cliente"="Cliente"})
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="url_registro", type="string", length=200, nullable=true)
     */
    protected $urlRegistro;
 
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
    
        public function __toString() {
        return $this->username;
    }

    /**
     * Set urlRegistro
     *
     * @param string $urlRegistro
     * @return User
     */
    public function setUrlRegistro($urlRegistro)
    {
        $this->urlRegistro = $urlRegistro;

        return $this;
    }

    /**
     * Get urlRegistro
     *
     * @return string 
     */
    public function getUrlRegistro()
    {
        return $this->urlRegistro;
    }
}
