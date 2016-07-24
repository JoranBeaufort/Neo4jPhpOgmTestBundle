<?php
namespace JoranBeaufort\Neo4jPhpOgmTestBundle\Controller;

use GraphAware\Neo4j\OGM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\User;
use JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\UserTeam;
use JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\Team;
use JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\Role;
use JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\MetaRole;

class OgmTestController extends Controller
{    
    public function testAction(Request $request)
    {

        // Get the entity manager
        /** @var EntityManager $em */
        $em = $this->get('neo4j_php_ogm_test.graph_manager')->getClient();
        // $em->getDatabaseDriver()->run("MATCH (n) DETACH DELETE n");
        
        // Create new test team
        $team = new Team('Blue Berries');
        
        // Create new test role
        $role = new Role('role_user');
        
        // create new metarole
        $metarole = new MetaRole('meta_role_user');
        
        // add meta role to role
        $role->addMetaRole($metarole);
        
        // Create new test user
        $user = new User('Bob');
       

        // Create new relationship user -[in_team]-> team
        $user->addTeam($team, time());
        
        // Create new relationship user -[role]-> role
        $user->addRole($role);
        
        // persist all the things
        $em->persist($user);
        $em->persist($team);
        $em->flush();

        // Clearing the UOW to make sure we retrieve objects from the database and not from the mapping context
        $em->clear();


        echo 'User Role: '.$user->getRole()->getMetaRole()->getMetaRoleType().'<br>';
        echo 'User Team: '.$user->getTeam()->getTeam()->getName().' at '.$user->getTeam()->getJoined().'<br>';

        die;
        return $this->render('Neo4jPhpOgmTestBundle:default:index.html.twig');
    }

}