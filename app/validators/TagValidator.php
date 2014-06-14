<?php

/*
 * The MIT License
 *
 * Copyright 2014 Patrick.
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

namespace UniqueLoneDog\Validators;

use Phalcon\Validation\Validator,
    Phalcon\Validation\ValidatorInterface,
    Phalcon\Validation\Message;

/**
 * Validate if the tag matches a valid namespace regex
 *
 * @author Patrick
 */
class TagValidator extends Validator implements ValidatorInterface
{

    const REGEX_NAMESPACE     = "[a-z- ]{2,50}";
    const REGEX_PREDICATE     = "[a-z- ]{2,50}";
    const REGEX_VALUE         = "[-'.,&#@:?!()$\/\w]{2,50}$";
    const PREDICATE_DELIMITER = ":";
    const VALUE_DELIMITER     = "=";

    /**
     * Executes the validation
     *
     * @param Phalcon\Validation $validator
     * @param string $attribute
     * @return boolean true if tag is valid
     */
    public function validate($validator, $attribute)
    {
        $value = $validator->getValue($attribute);

        if (empty($value)) {
            //Allow empty values
            return true;
        }

        if (!preg_match(sprintf("/%s/", self::regex()), $value)) {

            //Anything not empty should match the pattern
            $message = $this->getOption('message');
            if (!$message) {
                $message = 'This is not a valid tag';
            }

            $validator->appendMessage(new Message($message, $attribute, 'Tag'));

            return false;
        }

        return true;
    }

    public static function regex()
    {
        return self::REGEX_NAMESPACE . self::PREDICATE_DELIMITER . self::REGEX_PREDICATE . self::VALUE_DELIMITER . self::REGEX_VALUE;
    }

}
