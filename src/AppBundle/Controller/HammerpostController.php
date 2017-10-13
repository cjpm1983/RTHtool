<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Hammerpost;
use AppBundle\Form\HammerpostType;
use Doctrine\DBAL\Types;


/**
 * Hammerpost controller.
 *
 * @Route("/hammerpost")
 */
class HammerpostController extends Controller
{
    /**
     * Lists all Hammerpost entities.
     *
     * @Route("/", name="hammerpost_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $hammerposts = $em->getRepository('AppBundle:Hammerpost')->findAll();

        return $this->render('hammerpost/index.html.twig', array(
            'hammerposts' => $hammerposts,
        ));
    }
    
    
    
        /**
     * Para recibir datos del editor.
     *
     * @Route("/editorpost/{id}", name="editorpost")
     * @Method({"GET", "POST"})
     */
    public function editorpostAction(Request $request,Hammerpost $hp)
    {
            $titulo=$request->query->get('titulo',"");
            $fecha=$request->query->get('fechaCreado',"");
            $editor=$request->query->get('invisible',"");
            
            $dt=new \DateTime($fecha);
            //return new Response(()$fecha);
            
            $em = $this->getDoctrine()->getManager();
            
            $hp->setTitulo($titulo);
            $hp->setFechaCreado($dt);
            $hp->setPost($editor);
            
            
            $em->persist($hp);
            $em->flush();
            
        

            return $this->redirectToRoute('admin_app_hammerpost_list');
        
        
    }
    
    

             /**
     * accion mia para cargar las fotos.
     *
     * @Route("/postacceptor", name="postacceptor")
     * @Method({"GET", "POST"})
     */
    public function postacceptorAction(){
        
//echo $_SERVER["HTTP_HOST"];
//echo 'aa'.$_SERVER['HTTP_ORIGIN'];
  /*******************************************************
   * Only these origins will be allowed to upload images *
   ******************************************************/
  //$accepted_origins = array("http://localhost", "http://192.168.1.1","http://192.168.43.1", "http://192.168.43.73","http://example.com");

  /*********************************************
   * Change this line to set the upload folder *
   *********************************************/
        //esta carpeta la obtenemos del config, aqui definimos donde queremos las imagenes
  $carpeta=$this->container->getParameter('hammerpost_images_location');
  $imageFolder = $_SERVER["DOCUMENT_ROOT"]."/".$carpeta."/";
  $imageUrl=$_SERVER["HTTP_HOST"]."/".$carpeta."/";
  
  //$imageFolder = $_SERVER["DOCUMENT_ROOT"]."/images/images/";
  //$imageUrl=$_SERVER["HTTP_HOST"]."/images/images/";
  
  
  
  
  /*
  echo $imageUrl;
  echo '<br>';
  echo $imageFolder;
  */
  reset ($_FILES);
  $temp = current($_FILES);
  //echo json_encode(array('location' => 'http://localhost/images/blobid1506221658855.jpg'));
  if (is_uploaded_file($temp['tmp_name'])){
    /*  if (isset($_SERVER['HTTP_ORIGIN'])) {
      // same-origin requests won't set an origin. If the origin is set, it must be valid.
      if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
        header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
      } else {
        header("HTTP/1.0 403 Origin Denied");
        return;
      }
     
    }*/

    /*
      If your script needs to receive cookies, set images_upload_credentials : true in
      the configuration and enable the following two headers.
    */
    //header('Access-Control-Allow-Credentials: true');
    //header('P3P: CP="There is no P3P policy."');

    // Sanitize input
    if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
        header("HTTP/1.0 500 Invalid file name.");
        return;
    }

    // Verify extension
    if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
        header("HTTP/1.0 500 Invalid extension.");
        return;
    }

    // Accept upload if there was no origin, or if it is an accepted origin
    $filetowrite = $imageFolder . $temp['name'];
    move_uploaded_file($temp['tmp_name'], $filetowrite);

    $imagenurl="http://".$imageUrl.$temp['name'];
    // Respond to the successful upload with JSON.
    // Use a location key to specify the path to the saved image resource.
    // { location : '/your/uploaded/image/file'}
    echo json_encode(array('location' => $imagenurl));
    //echo json_encode(array('location' => 'http://localhost/images/blobid1506221658855.jpg'));
    
  } else {
    // Notify editor that the upload failed
    header("HTTP/1.0 500 Server Error");
  }
  return new Response('');
  
    }
    
    
    

    /**
     * Creates a new Hammerpost entity.
     *
     * @Route("/new", name="hammerpost_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $hammerpost = new Hammerpost();
        $form = $this->createForm('AppBundle\Form\HammerpostType', $hammerpost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hammerpost);
            $em->flush();

            return $this->redirectToRoute('hammerpost_show', array('id' => $hammerpost->getId()));
        }

        return $this->render('hammerpost/new.html.twig', array(
            'hammerpost' => $hammerpost,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Hammerpost entity.
     *
     * @Route("/{id}", name="hammerpost_show")
     * @Method("GET")
     */
    public function showAction(Hammerpost $hammerpost)
    {
        $deleteForm = $this->createDeleteForm($hammerpost);

        return $this->render('hammerpost/show.html.twig', array(
            'hammerpost' => $hammerpost,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Hammerpost entity.
     *
     * @Route("/{id}/edit", name="hammerpost_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Hammerpost $hammerpost)
    {
        $deleteForm = $this->createDeleteForm($hammerpost);
        $editForm = $this->createForm('AppBundle\Form\HammerpostType', $hammerpost);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hammerpost);
            $em->flush();

            return $this->redirectToRoute('hammerpost_edit', array('id' => $hammerpost->getId()));
        }

        return $this->render('hammerpost/edit.html.twig', array(
            'hammerpost' => $hammerpost,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Hammerpost entity.
     *
     * @Route("/{id}", name="hammerpost_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Hammerpost $hammerpost)
    {
        $form = $this->createDeleteForm($hammerpost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($hammerpost);
            $em->flush();
        }

        return $this->redirectToRoute('hammerpost_index');
    }

    /**
     * Creates a form to delete a Hammerpost entity.
     *
     * @param Hammerpost $hammerpost The Hammerpost entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Hammerpost $hammerpost)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('hammerpost_delete', array('id' => $hammerpost->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
