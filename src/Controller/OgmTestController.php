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

use JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\User;
use JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\UserTeam;
use JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\Team;

class OgmTestController extends Controller
{    
    public function testAction(Request $request)
    {
        // Get the entity manager
        $em = $this->get('neo4j_php_ogm_test.graph_manager')->getClient();
        
        // Create new test user
        $user = new User('Bob');
        
        // Create new test team
        $team = new Team('Blue Berries');

        // Create new relationship user -[in_team]-> team
        $user->addTeam($team, time());
        
        // persist all the things
        $em->persist($team);
        $em->persist($user);
        $em->flush(); 
        
        var_dump($user->getTeam());die;
        
        
        return $this->render('Neo4jPhpOgmTestBundle:default:index.html.twig');
    }

}