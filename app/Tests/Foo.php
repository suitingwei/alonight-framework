<?php

namespace App\Tests;

class Foo
{
    private $words = [];

    public function transform($input)
    {
        var_dump($this->words);
        if (isset($this->words[$input])) {
            return $this->words[$input];
        }
        return $this->words[$input] = str_shuffle($input);
    }
}
