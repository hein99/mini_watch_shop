<?php
namespace Models;

class Banner extends DataObject
{
    protected $data = [

    ];

    public function greet()
    {
        return "Hello World! Greeting from Banner Models";
    }
}