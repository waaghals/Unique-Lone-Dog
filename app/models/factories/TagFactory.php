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

namespace UniqueLoneDog\Models\Factories;

use UniqueLoneDog\Models\Tags\NamespaceTag,
    UniqueLoneDog\Models\Tags\PredicateTag,
    UniqueLoneDog\Models\Tags\ValueTag,
    UniqueLoneDog\Validators\TagValidator as Tag;

/**
 * Factory for quickly creating tag structures
 *
 * @author Patrick
 */
class TagFactory
{

    /**
     * Create a machine tag/triple tag
     *
     * @param string $namespace
     * @param string $predicate
     * @param string $value
     * @return \UniqueLoneDog\Models\Tags\ValueTag
     */
    public function build($namespace, $predicate, $value)
    {
        $namespaceModel = $this->createNamespace($namespace);
        $predicateModel = $this->createPredicate($predicate, $namespaceModel);
        $valueModel     = $this->createValue($value, $predicateModel);

        //Join them together
        $valueModel->predicate     = $predicateModel;
        $predicateModel->namespace = $namespaceModel;

        if (!$valueModel->save()) {
            $errors = "";
            foreach ($valueModel->getMessages as $msg) {
                $errors .= $msg;
            }

            throw new \Exception($errors);
        }
        return $valueModel;
    }

    /**
     * Create a machine tag/triple tag from a string reprisentation
     *
     * @param string $machineTag
     * @return \UniqueLoneDog\Models\Tags\ValueTag
     */
    public function create($machineTag)
    {
        if (empty($machineTag)) {
            throw new \Exception("Can't create machinetag from nothing");
        }
        $regex = sprintf('/[%s]/',
                         Tag::PREDICATE_DELIMITER . Tag::VALUE_DELIMITER);
        list($namespace, $predicate, $value) = preg_split($regex, $machineTag);

        return $this->build($namespace, $predicate, $value);
    }

    private function createNamespace($part)
    {
        $namespace = NamespaceTag::query()
                ->where("part = :part:")
                ->bind(array("part" => $part))
                ->execute()
                ->getFirst();

        if (!$namespace) {
            //Namespace does not exist, create one
            $namespace = new NamespaceTag();
            $namespace->setPart($part);
        }

        return $namespace;
    }

    private function createPredicate($part, $namespace)
    {
        if (!isset($namespace->id)) {
            //The namespace is new, no need to search for correct predicate
            $predicateModel = new PredicateTag();
            $predicateModel->setPart($part);
            return $predicateModel;
        }

        $predicateModel = PredicateTag::query()
                        ->where("part = :part:")->andWhere("namespace_id = :id:")
                        ->bind(array("part" => $part, "id" => $namespace->id))
                        ->execute()->getFirst();

        if (!$predicateModel) {
            //Create a new predicateTag
            $predicateModel = new PredicateTag();
            $predicateModel->setPart($part);
        }
        return $predicateModel;
    }

    private function createValue($part, $predicate)
    {
        if (!isset($predicate->id)) {
            //The predicate is new, no need to search for correct value
            $valueModel = new ValueTag();
            $valueModel->setPart($part);

            return $valueModel;
        }

        $valueModel = ValueTag::query()
                        ->where("part = :part:")->andWhere("predicate_id = :id:")
                        ->bind(array("part" => $part, "id" => $predicate->id))
                        ->execute()->getFirst();

        if (!$valueModel) {
            //Create a new predicateTag
            $valueModel = new ValueTag();
            $valueModel->setPart($part);
        }

        return $valueModel;
    }

}
