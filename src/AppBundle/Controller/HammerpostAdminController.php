<?php

namespace AppBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\CompraProductoCaract;
use AppBundle\Form\CompraProductoCaractType;

class HammerpostAdminController extends CRUDController
{
 public function htmlAction() {
      
        $objeto=  $this->admin->getSubject();
       
         return $this->render('AppBundle:CRUD:hammerpost_html.html.twig',array('object'=>$objeto));
       
    }
 public function editorAction() {
       // $html = render_template('FrontBundle::layout.html.twig');
        //return new Response($html);
            /*
     $accepted_origins = array("http://localhost", "http://192.168.1.1","http://192.168.43.1", "http://192.168.43.73","http://example.com");
      if (isset($_SERVER['HTTP_ORIGIN'])) {
      // same-origin requests won't set an origin. If the origin is set, it must be valid.
      if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
        header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
      } else {
        header("HTTP/1.0 403 Origin Denied");
        return;
      }}
      */
        $objeto=  $this->admin->getSubject();
        //return $this->render('AppBundle:CRUD:comprodcaract.html.twig',array('object'=>$objeto));
         return $this->render('AppBundle:CRUD:hammerpost_editor.html.twig',array('object'=>$objeto));
       // return new RedirectResponse($this->admin->generateUrl('list'));
    }    
    


    
}
