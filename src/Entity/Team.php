<?php
namespace JoranBeaufort\Neo4jPhpOgmTestBundle\Entity;


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
    
    public function __construct($teamname)
    {
        $this->name = $teamname;
    }
    
    
    public function getName()
    {
        return $this->name;
    }  
    
    public function getId()
    {
        return $this->id;
    }    
}