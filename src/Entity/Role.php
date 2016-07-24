<?php
namespace JoranBeaufort\Neo4jPhpOgmTestBundle\Entity;

// Remember to create the role nodes in the neo4j graph
// create (r:Role{roleType:'ROLE_USER'})
// Add as many roles as needed.

use Doctrine\Common\Collections\ArrayCollection;
use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 * @OGM\Node(label="TEST_Role")
 */
 
class Role
{
    /**
     * @OGM\GraphId()
     * @var int
     */
    private $id;
    
    /**
     * @OGM\Relationship(type="HAS_ROLE", direction="INCOMING", targetEntity="\JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\User", collection=true)
     * @var ArrayCollection|\JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\User[]
     */
     
    protected $users;
    
    /**
     * @OGM\Property(type="string")
     * @var string
     */
     
    private $roleType;
    
    /**
     * @OGM\Relationship(type="HAS_METAROLE", direction="OUTGOING", targetEntity="\JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\MetaRole", collection=false)
     * @var \JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\MetaRole
     */
    protected $metaRole;

        
    
    
    public function __construct($roleType)
    {
        $this->users = new ArrayCollection();
        $this->roleType = $roleType;
    }
    
    
    public function getRoleType()
    {
        return $this->roleType;
    }

    public function setRoleType($roleType)
    {
        $this->roleType = $roleType;
    }

    
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection|\JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\User[]
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param \JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\User $user
     */
    public function addUser(User $user)
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
        }
    }

    /**
     * @param \JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\User $user
     */
    public function removeUser(User $user)
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
        }
    }
    
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection|\JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\MetaRole
     */
    public function addMetaRole()
    {
        $this->metaRole = $metaRole;
    }
    
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection|\JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\MetaRole
     */
    public function getMetaRole()
    {
        return $this->metaRole;
    }

}