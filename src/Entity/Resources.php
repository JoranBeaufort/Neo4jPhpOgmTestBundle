<?php
namespace JoranBeaufort\Neo4jPhpOgmTestBundle\Entity;


use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 * @OGM\Node(label="TEST_Resources")
 */
 
class Resources
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

    
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getName()
    {
        return $this->icon;
    }
    
}