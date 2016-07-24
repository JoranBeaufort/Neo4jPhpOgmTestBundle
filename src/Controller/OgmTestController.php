<?php
namespace JoranBeaufort\Neo4jPhpOgmTestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

use JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\User;
use JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\UserTeam;
use JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\Team;
use JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\Role;

class OgmTestController extends Controller
{    
    public function testAction(Request $request)
    {
        // Get the entity manager
        $em = $this->get('neo4j_php_ogm_test.graph_manager')->getClient();
        
        // Create new test team
        $team = new Team('Blue Berries');
        
        // Create new test role
        $role = new Role('role_user');
        
        // Create new test user
        $user = new User('Bob');
       

        // Create new relationship user -[in_team]-> team
        $user->addTeam($team, time());
        
        // Create new relationship user -[role]-> role
        $user->addRole($role);
        
        // persist all the things
        $em->persist($user);
        $em->flush(); 

        $user = $em->getRepository(User::class)->findOneBy('username','Bob');
        
        echo 'User Role: '.$user->getRole()->getRoleType();

        
        return $this->render('Neo4jPhpOgmTestBundle:default:index.html.twig');
    }

}