<?php
namespace JoranBeaufort\Neo4jPhpOgmTestBundle\Entity;

// Remember to create the role nodes in the neo4j graph
// create (r:Role{roleType:'ROLE_USER'})
// Add as many roles as needed.

use Doctrine\Common\Collections\ArrayCollection;
use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 * @OGM\Node(label="TEST_MetaRole")
 */
 
class MetaRole
{
    /**
     * @OGM\GraphId()
     * @var int
     */
    private $id;
        
    /**
     * @OGM\Property(type="string")
     * @var string
     */
     
    private $metaRoleType;
        
    
    
    public function __construct($metaRoleType)
    {
        $this->metaRoleType = $metaRoleType;
    }
    
    
    public function getMetaRoleType()
    {
        return $this->metaRoleType;
    }

    public function setMetaRoleType($metaRoleType)
    {
        $this->metaRoleType = $metaRoleType;
    }

    
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection|\JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\User[]
     */
    public function getUsers()
    {
        return $this->users;
    }
}