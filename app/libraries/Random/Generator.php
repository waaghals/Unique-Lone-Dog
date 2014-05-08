<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UniqueLoneDog\Random;

/**
 * Description of Generator
 *
 * @author Patrick
 */
class Generator implements RandomInterface
{

    public function generate($bytes)
    {
        $randomBytes  = openssl_random_pseudo_bytes($bytes);
        $encodedBytes = base64_encode($randomBytes);
        return preg_replace('/[^a-zA-Z0-9]/', '', $encodedBytes);
    }

}
