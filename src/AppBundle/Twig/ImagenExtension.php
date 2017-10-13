<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GfExtension
 *
 * @author orlando
 */
namespace AppBundle\Twig;

use Symfony\Component\Yaml\Parser;

/**
 * Informacion de las imagenes de los productos.
 */
class ImagenExtension extends \Twig_Extension{
    private $em;
    public function __construct($em) {
        $this->em=$em;
    }
    public function getFunctions()
    {
        return array(
            'pathImagen' => new \Twig_Function_Method($this, 'path'),
            'pathMarcas' => new \Twig_Function_Method($this, 'pathMarcas'),
        );
    }
    /**
     * Elementos de una entidad segun condicion
     * @param type $entidad
     * @param array $condition
     * @return type
     */
    public function path($imagen_id) {
        $yaml = new Parser();
        $value = $yaml->parse(file_get_contents('../app/config/config.yml'));
        $dato = $value['vich_uploader']['mappings']['product_images']['upload_destination'];
        $partes = explode('web', $dato);
        $path = $partes[1];
        $entity = $this->em->getRepository('AppBundle:Imagen')->find($imagen_id);
        return $path.'/'.$entity->getImageName();
    }
    
    public function pathMarcas($imagen_id) {
        $yaml = new Parser();
        $value = $yaml->parse(file_get_contents('../app/config/config.yml'));
        $dato = $value['vich_uploader']['mappings']['product_images']['upload_destination'];
        $partes = explode('web', $dato);
        $path = $partes[1];
        $entity = $this->em->getRepository('AppBundle:LogoMarca')->find($imagen_id);
        return $path.'/'.$entity->getImageName();
    }
    public function getName() {
        return "imagen_extension";
    }    //put your code here
}

?>
