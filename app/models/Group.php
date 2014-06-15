<?php

namespace UniqueLoneDog\Models;

use Phalcon\Mvc\Model\Validator\Uniqueness;
use UniqueLoneDog\Utils\Slug;

class Group extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $description;

    /**
     *
     * @var string
     */
    public $users;

    /**
     *
     * @var string
     */
    public $slug;

    /**
     *
     * @return boolean False when validation failed.
     */
    public function validation()
    {
        $this->validate(new Uniqueness(array(
            "field"    => "name",
            "required" => true,
        )));

        $this->validate(new Uniqueness(array(
            "field"    => "slug",
            "required" => true,
        )));

        //If validation failed, return false.
        return !$this->validationHasFailed();
    }

    public function latest()
    {
        return $this->getDI()->get('modelsManager')->createBuilder()
                        ->from('UniqueLoneDog\Models\Item')
                        ->join('UniqueLoneDog\Models\Tags\ValueTag')
                        ->join('UniqueLoneDog\Models\Tags\PredicateTag')
                        ->join('UniqueLoneDog\Models\Tags\NamespaceTag')
                        ->inWhere('UniqueLoneDog\Models\Tags\NamespaceTag.part',
                                $this->namespaceFilters())
                        ->inWhere('UniqueLoneDog\Models\Tags\PredicateTag.part',
                                $this->predicateFilters())
                        ->inWhere('UniqueLoneDog\Models\Tags\ValueTag.part',
                                $this->valueFilters())
                        ->groupBy('UniqueLoneDog\Models\Item.id')
                        ->getQuery()
                        ->execute();
    }

    public function initialize()
    {
        $this->hasManyToMany(
                "id", "UniqueLoneDog\Models\UserGroup", "groupId", "userId",
                "UniqueLoneDog\Models\User", "id", array("alias" => "users")
        );

        $this->hasMany('id', 'UniqueLoneDog\Models\Filter', 'groupId',
                array(
            "alias"      => "filters",
            'foreignKey' => array(
                'message' => 'Group cannot be deleted because it still has data in the filter table'
            )
        ));
    }

    public function beforeValidation()
    {
        $this->slug = Slug::generate($this->name);
    }

    private function namespaceFilters()
    {
        return $this->typeFilters("namespace");
    }

    private function predicateFilters()
    {

        return $this->typeFilters("predicate");
    }

    private function valueFilters()
    {
        return $this->typeFilters("value");
    }

    private function typeFilters($type)
    {
        $values = array();
        foreach ($this->filters as $filter) {
            \array_push($values, $filter->{$type});
        }
        return $values;
    }

}
