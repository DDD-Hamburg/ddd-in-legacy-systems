<?php

namespace Jimdo;

use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    /**
     * @test
     */
    public function initializeWithConstructorArgs()
    {
        $forename = 'Max';
        $surname = 'Mustermann';

        $customer = new Shop\Customer($forename, $surname);

        $this->assertEquals($forename . ' ' . $surname, $customer->name());
    }
}
