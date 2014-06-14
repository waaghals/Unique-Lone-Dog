<?php

namespace UniqueLoneDog\Controllers;

use UniqueLoneDog\Models\Reputation;

/**
 * Set the stuff like css and js which is the same across all controllers
 *
 * @author Patrick
 * @property UniqueLoneDog\Authentification\Identity $identity Identity object
 */
abstract class AbstractController extends \Phalcon\Mvc\Controller
{

    public function initialize()
    {
        $this->assets
                ->addCss('css/kraken.css');


        $this->assets
                ->addJs('js/feature-test.js')
                ->addJs('js/kraken.js');


        $user = $this->identity->getUser();
        if (!is_null($user)) {
            $user->increaseReputation(Reputation::PAGE_VIEW);
        }
    }

}
