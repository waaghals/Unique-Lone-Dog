<?php

namespace UniqueLoneDog\Forms\Fields;

use Phalcon\Forms\Element\Text;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use UniqueLoneDog\Validators\URIValidator;

/*
 * The MIT License
 *
 * Copyright 2014 Tojba.
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

class URI extends Text
{

    public function __construct()
    {
        parent::__construct('URI');

        $this->setLabel('URI');

        $this->addValidator(new PresenceOf(array(
            'message' => 'URI is required.'
        )));

        //$validation = new URIValidator();
        //$message = $validation->validate(array($_POST['URI']));
        //echo $message;



        $this->addValidator(new URIValidator(array(
            'message' => 'This URI is not valid.'
        )));
    }

}
