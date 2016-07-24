<?php
namespace JoranBeaufort\Neo4jPhpOgmTestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class OgmTestController extends Controller
{    
    public function testAction(Request $request)
    {
        // Get the entity manager
        $em = $this->get('neo4j_php_ogm_test.graph_manager')->getClient();
        
        
        return $this->render('Neo4jPhpOgmTestBundle:default:index.html.twig');
    }

}