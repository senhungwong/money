<?php

namespace App\Models\Neo;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use GraphAware\Neo4j\OGM\Common\Collection;

/**
 * @OGM\Node(label="Store")
 * Class Store
 * @package App\Models\Neo4J
 */
class Store
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
     * @var User[]
     *
     * (:User)-[:HAS_STORE]->(:Store)
     *
     * @OGM\Relationship(
     *     type="HAS_STORE", direction="INCOMING", collection=false,
     *     mappedBy="stores", targetEntity="User")
     */
    protected $user;

    /**
     * @var Service[]|Collection
     *
     * (:Store)-[:PROVIDES]->(:Service)
     *
     * @OGM\Relationship(
     *     type="PROVIDES", direction="OUTGOING", collection=true,
     *     mappedBy="stores", targetEntity="Service")
     */
    protected $services;

    /**
     * @var Transaction[]|Collection
     *
     * (:Transaction)-[:IN_STORE]->(:Store)
     *
     * @OGM\Relationship(
     *     type="IN_STORE", direction="INCOMING", collection=true,
     *     mappedBy="store", targetEntity="Transaction")
     */
    protected $transactions;

    /**
     * Store constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->user = new Collection();
        $this->services = new Collection();
        $this->transactions = new Collection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return User[]
     */
    public function getUser(): array
    {
        return $this->user;
    }

    /**
     * @return Service[]|Collection
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @return Transaction[]|Collection
     */
    public function getTransactions()
    {
        return $this->transactions;
    }
}
