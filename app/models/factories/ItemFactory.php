<?php

namespace UniqueLoneDog\Models\Factories;

use UniqueLoneDog\Models\Item;
use Phalcon\DI\Injectable;

class ItemFactory extends Injectable
{

    public function create($name, $URI, $comment)
    {
        $item          = new Item();
        $item->URI     = $URI;
        $item->name    = $name;
        $item->comment = $comment;
        $item->user    = $this->identity->getUser();

        return $item;
    }

}
