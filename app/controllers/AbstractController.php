<?php

namespace UniqueLoneDog\Controllers;

/**
 * Set the stuff like css and js which is the same across all controllers
 *
 * @author Patrick
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
    }

}
