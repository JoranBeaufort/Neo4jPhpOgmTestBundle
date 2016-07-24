<?php

namespace JoranBeaufort\Neo4jPhpOgmTestBundle\Entity;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

use JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\UserResource;
use JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\Resources;
use JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\UserTeam;
use JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\Team;
use JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\UserTile;
use JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\Tile;
    
/**
 * @OGM\Node(label="TEST_User")
 */
 
class User
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
    private $username;    
    
    /**
     * @OGM\Relationship(type="HAS_ROLE", direction="OUTGOING", targetEntity="Role", collection=true, mappedBy="users")
     * @var ArrayCollection|Role[]
     */
    protected $roles;
        
    /**
     * @OGM\Relationship(relationshipEntity="\JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\UserResource", type="HAS_RESOURCE", direction="OUTGOING", collection=true)
     * @var ArrayCollection|\JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\UserResource[]
     */
    protected $userResources;
    
    /**
     * @OGM\Relationship(relationshipEntity="\JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\UserTeam", type="IN_TEAM", direction="OUTGOING", collection=true)
     * @var  ArrayCollection|\JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\UserTeam[]
     */
    protected $userTeam;
    
    /**
     * @OGM\Relationship(relationshipEntity="\JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\UserTile", type="CAPTURED", direction="OUTGOING", collection=true)
     * @var  ArrayCollection|\JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\UserTile[]
     */
    protected $userTiles;
    
    public function __construct($username)
    {
        $this->username = $username;
        $this->userResources = new ArrayCollection();
        $this->userTeam = new ArrayCollection();
        $this->userTiles = new ArrayCollection();
    }

    // other properties and methods

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }
    
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection|\JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\Role[]
     */
    public function getRoles()
    {
        $roles = array();
        foreach($this->roles as $role){
            array_push($roles,$role->getRoleType());
        }
        
        return $roles;
    }
        
    
    /**
     * @param \JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\Role $role
     */
    public function addRole(Role $role)
    {
        if (!$this->roles->contains($role)) {
            $this->roles->add($role);
        }
    }

    /**
     * @param \JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\Role $role
     */
    public function removeRole(Role $role)
    {
        if ($this->roles->contains($role)) {
            $this->roles->removeElement($role);
        }
    }
    
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection|\JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\UserResource[]
     */
    public function getUserResources()
    {        
        return $this->userResources;
    }
    
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection|\JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\UserResource[]
     * @param string $name
     */
    public function getUserResource($name)
    {

        foreach($this->userResources as $resource){
            if($resource->getResource()->getResourceType() == $name){
                return $resource;
                break;
            }
        }        
    }    
    
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection|\JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\UserResource[]
     * @param int $id
     */
    public function getUserResourceById($id)
    {

        foreach($this->userResources as $resource){
            if($resource->getResource()->getId() == $id){
                return $resource;
                break;
            }
        }        
    }
    

    /**
     * @param JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\Resources $resources
     * @param int $amount
     */
    public function addResource(Resources $resources, $amount)
    {
        $this->userResources->add(new UserResource($this, $resources, $amount));
    }
    
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection|\JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\UserTeam[]
     */   
    public function getTeam()
    {        
        return $this->userTeam->first();
    }
    
    /**
     * @param JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\Team $team
     * @param int $joined
     */
    public function addTeam(Team $team, $joined)
    {
        $this->userTeam->add(new UserTeam($this, $team, $joined));
    }
    
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection|\AppBundle\Entity\UserTile[]
     */
    public function getUserTiles()
    {        
        return $this->userTiles;
    }
    
    
    /**
     * @param JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\Tile $tile
     * @param int $captured
     * @param int $collected
     */
    public function addTile(Tile $tile, $captured, $collected)
    {
        if (!$this->userTiles->contains($tile)) {
            $this->userTiles->add(new UserTile($this, $tile, $captured, $collected));
        }
    }

    /**
     * @param JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\Tile $tile
     */
    public function removeTile(Tile $tile)
    {
        if ($this->userTiles->contains($tile)) {
            $this->userTiles->removeElement($tile);
        }
    }
        
    // other methods, including security methods like getRoles()
}