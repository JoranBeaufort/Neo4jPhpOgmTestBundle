<?php

namespace JoranBeaufort\Neo4jPhpOgmTestBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 * @OGM\Node(label="TEST_Team")
 */
 
class Team
{
    /**
     * @OGM\GraphId()
     * @var int
     */
    protected $id;
        
    /**
     * @OGM\Property(type="string")
     * @var string
     */
     
    protected $name;

    /**
     * @var UserTeam[]
     *
     * @OGM\Relationship(relationshipEntity="UserTeam", direction="INCOMING", collection=true, mappedBy="team")
     */
    protected $memberships;
    
    public function __construct($teamname)
    {
        $this->name = $teamname;
        $this->memberships = new ArrayCollection();
    }
    
    
    public function getName()
    {
        return $this->name;
    }  
    
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \JoranBeaufort\Neo4jPhpOgmTestBundle\Entity\UserTeam[]
     */
    public function getMemberships()
    {
        return $this->memberships;
    }


}