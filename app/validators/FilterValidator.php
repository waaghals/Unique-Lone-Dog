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
use UniqueLoneDog\Validators\TagValidator;

/**
 * Validate if a filter is valid.
 *
 * @author Patrick
 */
class FilterValidator extends Validator implements ValidatorInterface
{

    /**
     * Executes the validation
     *
     * @param Phalcon\Validation $validator
     * @param string $attribute
     * @return boolean true if tag is valid
     */
    public function validate($validator, $attribute)
    {
        $hasFailed = false;
        $inputData = $validator->getValue($attribute);


        if (\strstr(TagValidator::VALUE_DELIMITER, $inputData)) {
            //If value seperator is found handle it as a normal machine tag
            $tagValidator = new TagValidator();
            return $tagValidator->validate($validator, $attribute);
        } else if (\strstr(TagValidator::PREDICATE_DELIMITER, $inputData)) {

            list($namespace, $predicate) = \explode(
                    TagValidator::PREDICATE_DELIMITER, $inputData);

            //If a predicate seperator is found handle it as a namespace:predicate filter
            //First check the predicate
            if (!$this->isValidPredicate($predicate)) {
                $str = "Predicate <strong>%s</strong> is invalid";

                $message   = new Message(sprintf($str, $predicate), $attribute,
                                                 'Filter');
                $validator->appendMessage($message);
                $hasFailed = true;
            }
        } else {
            $namespace = $inputData;
        }

        if (!$this->isValidNamespace($namespace)) {
            $str       = "Namespace <strong>%s</strong> is invalid";
            $message   = new Message(sprintf($str, $namespace), $attribute,
                                             'Filter');
            $validator->appendMessage($message);
            $hasFailed = true;
        }

        return $hasFailed;
    }

    private function validateSections($inputData, $validator)
    {
        if (\strstr(TagValidator::VALUE_DELIMITER, $inputData)) {
            //If value seperator is found handle it as a normal machine tag
            $tagValidator = new TagValidator();
            return $tagValidator->validate($validator, $attribute);
        } else if (\strstr(TagValidator::PREDICATE_DELIMITER, $inputData)) {

            list($namespace, $predicate) = \explode(
                    TagValidator::PREDICATE_DELIMITER, $inputData);

            //If a predicate seperator is found handle it as a namespace:predicate filter
            //First check the predicate
            if (!$this->isValidPredicate($predicate)) {
                $str = "Predicate <strong>%s</strong> is invalid";

                $message   = new Message(sprintf($str, $predicate), $attribute,
                                                 'Filter');
                $validator->appendMessage($message);
                $hasFailed = true;
            }
        } else {
            $namespace = $inputData;
        }

        if (!$this->isValidNamespace($namespace)) {
            $str       = "Namespace <strong>%s</strong> is invalid";
            $message   = new Message(sprintf($str, $namespace), $attribute,
                                             'Filter');
            $validator->appendMessage($message);
            $hasFailed = true;
        }
    }

    private function isValidNamespace($namespace)
    {
        $pattern = "/%s/";
        return preg_match(sprintf($pattern, TagValidator::REGEX_NAMESPACE),
                                  $namespace);
    }

    private function isValidPredicate($predicate)
    {
        $pattern = "/%s/";
        return preg_match(sprintf($pattern, TagValidator::REGEX_PREDICATE),
                                  $predicate);
    }

}
