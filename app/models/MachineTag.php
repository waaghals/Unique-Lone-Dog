<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UniqueLoneDog\Models;

use UniqueLoneDog\Models\Behaviors\TreeBehavior;

/**
 * A single machine tag with a namespace, predicate and a value
 *
 * @author Patrick
 */
class MachineTag extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    private $id;

    /**
     *
     * @var string
     */
    private $namespace;

    /**
     *
     * @var string
     */
    private $predicate;

    /**
     *
     * @var string
     */
    private $value;

    /**
     *
     * @var integer
     */
    private $parentId;

    /**
     *
     * @var integer
     */
    private $lft;

    /**
     *
     * @var integer
     */
    private $rght;

    /**
     * @inheritdoc
     */
    public function initialize()
    {
        $this->addBehavior(new TreeBehavior());
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id'        => 'id',
            'namespace' => 'namespace',
            'predicate' => 'predicate',
            'value'     => 'value',
            'parent_id' => 'parentId',
            'lft'       => 'lft',
            'rght'      => 'rght'
        );
    }

    public function getSource()
    {
        return 'machine_tag';
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNamespace()
    {
        return $this->namespace;
    }

    public function getPredicate()
    {
        return $this->predicate;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function getLft()
    {
        return $this->lft;
    }

    public function getRght()
    {
        return $this->rght;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    }

    public function setPredicate($predicate)
    {
        $this->predicate = $predicate;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    public function setLft($lft)
    {
        $this->lft = $lft;
    }

    public function setRght($rght)
    {
        $this->rght = $rght;
    }

}
