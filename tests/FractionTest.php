<?php
/**
 * Test suite for Fraction class.
 */
use \Hijarian\Fraction\Fraction;

class FractionTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function CanRunTests()
    {
        $fraction = new Fraction;
        $this->fail('I am just a failing test, checking that class autoloads correctly!');
    }
}
