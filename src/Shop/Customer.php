<?php

namespace Jimdo\Shop;

class Customer
{
    /**
     * @param string $forename
     * @param string $surname
     */
    public function __construct($forename, $surname)
    {
        $this->forename = $forename;
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->forename . ' ' . $this->surname;
    }
}
