<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;



class ImagenAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            #->add('id')
            ->add('imageName')
            ->add('producto')
            ->add('updatedAt')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            #->add('id')
            ->add('producto')    
            ->add('imageName','text',array('label'=>'Imagen','template'=>'AppBundle:Auto:plantilla_imagen.html.twig'))
            #->add('updatedAt')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
         $subject = $this->getSubject();
         $imageName ="no-image.jpg";   
         
         
         //para usar localmente
         //$path= "/uploads/images/products/";
         
         //para usar en virtual host
         $packages=new Package(new EmptyVersionStrategy());
         $path= $packages->getUrl('/uploads/images/products/');
         
          //si esta embeddido   
         if($this->hasParentFieldDescription()){
           
            $producto=$this->getParentFieldDescription()->getAdmin()->getSubject();
            
            $vimagenes=$producto->getVimagenes();
            
            //Poner el Producto padre a las imagenes hijas
            foreach ($vimagenes as $vimagen){
            $vimagen->setProducto($producto);    
            }
            
            //Si hay mas de una imagen, esto es por el problema que se presento con getImageName NULL
            if (count($vimagenes)>0)
            {
                if ($subject)
                { 
                    if ($subject->getImageName()!='') $imageName =$subject->getImageName();
                }
                
                
            }   
            
            //}
            }
            
            //sin no esta embedido
            else if ($subject->getImageName()!='')
            {
            $imageName =$subject->getImageName();
            }
           // $path=  $this->get('app.imagen.twig.message_extension');
            //$path($subject->getId());
            $helpi = '<p>Imagen Actual</p><img src="'.$path.''.$imageName.'" class="thumbnail" style="width: 400px">';
             //$responsita = new Symfony\Component\HttpFoundation\Response();
            // $cosa=  "holita";//$this->getTemplate('FrontBundle::layout.html.twig');
                     //$this->   renderView('FrontBundle::layout.html.twig'); 
            
            //$cosa = render_template('FrontBundle::layout.html.twig');
            
        $formMapper
            #->add('id')
            #->add('path')
            #->add('producto')
            #->add('ImageName','text',array('help'=>$cosa))
            ->add('imageFile', 'file', array('label'=>'Cargar nueva imagen','required' => false,'help'=>$helpi))
            //->add('imageName','text',array('help'=>$helpi,'required' => false,'read_only'=>true,'label'=>'Imagen Actual'))
        ;
        
        //si esta embedido no debe mostrar el producto 
        if($this->hasParentFieldDescription()){
            $formMapper->add('producto', 'sonata_type_model_hidden'); 
        }
        else{
            $formMapper->add('producto');
        }
        
            
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
         $showMapper
            #->add('id')
            #->add('path')
            ->add('producto')
            ->add('imageName',NULL,array('label'=>'Imagen', 'template'=>'AppBundle:Auto:plantilla_imagen.html.twig'))
        ;
    }
}
