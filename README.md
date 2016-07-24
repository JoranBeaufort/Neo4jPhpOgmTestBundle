# Neo4jUserBundle

This bundle connects Symfony 3+ with Neo4j 3+ to store and retrieve user information from the neo4j-graph. 
This Bundle requires the Neo4j-PHP-OGM plugin from GraphAware: https://github.com/graphaware/neo4j-php-ogm
I have also used the MaterialDesignBootstrap framework in my TWIG files: http://mdbootstrap.com/

### Install

To install include following in your composer.json:

```
...
    "repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/joranbeaufort/neo4jphpogmtestbundle"
        }
    ]
...
"require": {
    "joranbeaufort/neo4jphpogmtestbundle":"dev-master"
}
...
```

Next, add following config to your `/app/config/config.yml` depending on your connection to Neo4j:

```
neo4j_php_ogm_test:
    username: neo4j
    password: neo4j
    url: localhost
    port: 7474       # Carefull, for bolt change to: 7687
    protocol: bolt   # Default: http
```

### Routes
This bundle comes with a few predefined routes:
```
neo4j_php_ogm_test:
    path:     /test/neo4j/ogm
    defaults: { _controller: Neo4jPhpOgmTestBundle:OgmTest:test }
```