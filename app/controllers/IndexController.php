<?php

namespace UniqueLoneDog\Controllers;

use Phalcon\Mvc\Controller;
use UniqueLoneDog\Models\Tags\NamespaceTag;
use UniqueLoneDog\Models\Tags\PredicateTag;
use UniqueLoneDog\Models\Tags\ValueTag;

class IndexController extends Controller
{

    public function indexAction()
    {

    }

    public function testAction()
    {
        $contentNamespace = new NamespaceTag();
        $contentNamespace->setPart("content");
        $authorNamespace  = new NamespaceTag();
        $authorNamespace->setPart("author");

        $namePredicate    = new PredicateTag();
        $namePredicate->setPart("name");
        $websitePredicate = new PredicateTag();
        $websitePredicate->setPart("website");
        $emailPredicate   = new PredicateTag();
        $emailPredicate->setPart("email");
        $typePredicate    = new PredicateTag();
        $typePredicate->setPart("type");

        $nameValue  = new ValueTag();
        $nameValue->setPart("Patrick Berenschot");
        $emailValue = new ValueTag();
        $emailValue->setPart("parberen@avans.nl");
        $imageValue = new ValueTag();
        $imageValue->setPart("image/jpg");


        // content:type=image/jpg
        /* $imageValue->predicate    = $typePredicate;
          $typePredicate->namespace = $contentNamespace;
          $contentNamespace->save();
          $typePredicate->save();
          $imageValue->save();
         */

        // author:name="Patrick Berenschot"
        $nameValue->predicate     = $namePredicate;
        $namePredicate->namespace = $authorNamespace;
        $nameValue->save();

        // author:email="parberen@avans.nl"
        $emailValue->predicate     = $emailPredicate;
        $emailPredicate->namespace = $authorNamespace;
        $emailValue->save();
    }

}
