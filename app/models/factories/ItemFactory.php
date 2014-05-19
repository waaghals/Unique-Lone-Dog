<?php

namespace UniqueLoneDog\Models\Factories;

use UniqueLoneDog\Models\Item;
use Phalcon\DI\Injectable;

class ItemFactory extends Injectable
{

    public function create($name, $URI, $comment)
    {
        $u = new Item();
        $u->URI = $URI;
        $u->name = $name;
        $u->comment = $comment;
        $u->user = $this->identity->getUser();

        return $u;
    }

}
