<?php

/*
 * The MIT License
 *
 * Copyright 2014 Waaghals.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace UniqueLoneDog\Models\Behaviours;

use Phalcon\Mvc\Model\Behavior,
    Phalcon\Mvc\Model\BehaviorInterface;
use UniqueLoneDog\Utils\Slug;

/**
 * Description of Sluggable
 *
 * @author Waaghals
 */
class Sluggable extends Behavior implements BehaviorInterface
{

    /**
     * Receives notifications from the Models Manager
     *
     * @param string $eventType
     * @param Phalcon\Mvc\ModelInterface $model
     */
    public function notify($eventType, $model)
    {
        $options = $this->getOptions();

        if (!isset($options['source'])) {
            throw new \Exception("The option 'source' is required");
        }

        if (!isset($options['field'])) {
            $options['field'] = "slug";
        }

        switch ($eventType) {
            case 'beforeValidation':

                //Create a slug before validation
                $sourceVal = $model->readAttribute($options['source']);
                $slug      = Slug::generate($sourceVal);

                //Nope
                $model->writeAttribute($options['field'], $slug);

                //Not even manually
                $model->{$options['field']} = $slug;
                break;
        }
    }

}
