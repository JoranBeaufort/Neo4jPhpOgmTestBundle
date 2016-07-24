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
        print('new team created');
        echo('\n');
        $em->persist($team);
        
        // Create new test role
        $team = new Role('role_user');
        print('new role created');
        echo('
        ');
        $em->persist($team);

        
        // Create new test user
        $user = new User('Bob');
        print('new user created');
        echo('\n');
        

        // Create new relationship user -[in_team]-> team
        $user->addTeam($team, time());
        print('new user added to new team');
        echo('\n');
        
        // Create new relationship user -[role]-> role
        $user->addRole($role,);
        print('new role added to new user');
        echo('\n');
        
        // persist all the things
        $em->persist($user);
        $em->flush(); 
        print('flushed');die;
        
        var_dump($user->getTeam());die;
        
        
        return $this->render('Neo4jPhpOgmTestBundle:default:index.html.twig');
    }

}