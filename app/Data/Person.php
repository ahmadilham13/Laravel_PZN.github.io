<?php 

namespace App\Data;

class Person
{
    public function __construct(
        string $firstName,
        string $lastName
    ){
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
}
?>