<?php
namespace JoranBeaufort\Neo4jPhpOgmTestBundle\Entity;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\User;
use JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\Team;

/**
 * @OGM\RelationshipEntity(type="IN_TEAM")
 */
 
class UserTeam
{
    /**
     * @OGM\GraphId()
     * @var int
     */
    protected $id;
    
    /**
     * @OGM\StartNode(targetEntity="\JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\User")
     * @var \JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\User
     */
    protected $user;

    /**
     * @OGM\EndNode(targetEntity="JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\Team")
     * @var JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\Team
     */
    protected $team;
    
    /**
     * @OGM\Property(type="int")
     * @var int
     */
     
    protected $joined;    


    /**
     * UserResource constructor.
     * @param \JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\User $user
     * @param \JoranBeaufort\Neo4jPhpOgmTestBundle\Team $team
     * @param int $joined
     */
    public function __construct(User $user, Team $team, $joined)
    {
        $this->user = $user;
        $this->team = $team;
        $this->joined = $joined;
    }

        
    /**
     * @return \JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return \JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    
    /**
     * @return int
     */
    public function getJoined()
    {
        return $this->joined;
    }
        
    
}