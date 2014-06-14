<?php

namespace UniqueLoneDog\Controllers;

use Phalcon\Mvc\Controller,
    Phalcon\Mvc\Model\Resultset,
    UniqueLoneDog\Models\Tags\NamespaceTag,
    UniqueLoneDog\Models\Tags\PredicateTag,
    UniqueLoneDog\Models\Tags\ValueTag,
    UniqueLoneDog\Models\User,
    UniqueLoneDog\Random\Breadcrumbs;

/**
 * @property Phalcon\Mvc\Model\Manager $modelsManager Description
 */
class IndexController extends Controller
{

    private $breadcrumbs;

    public function initialize()
    {
        $this->breadcrumbs = new Breadcrumbs();
    }

    public function indexAction()
    {
        $this->view->setVar("breadcrumbs", $this->breadcrumbs->generate());
    }

    public function tagQueryTestAction()
    {
        $tags    = $this->modelsManager->executeQuery("
            SELECT namespace.*, predicate.*, value.*
            FROM UniqueLoneDog\Models\Tags\NamespaceTag AS namespace
            JOIN UniqueLoneDog\Models\Tags\PredicateTag AS predicate
            JOIN UniqueLoneDog\Models\Tags\ValueTag AS value
            ORDER BY namespace.part, predicate.part, value.part");
        $results = $tags->setHydrateMode(Resultset::TYPE_RESULT_FULL);

        foreach ($results as $result) {
            var_dump($result->namespace->predicates);
        }
    }

    public function tagCreateTestAction()
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

        $test = $this->tagFactory->create("content:type=image/jpg");
        if (!$test->save()) {
            foreach ($test->getMessages() as $msg) {
                echo $msg;
            }
        }
    }

    public function reputationTestAction()
    {
        $user      = $this->identity->getUser();
        $otherUser = User::findFirst(3);
        var_dump($user->getReputation());
        $user->increaseReputation(100, $otherUser);
    }

}
