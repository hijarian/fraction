<?php
/**
 * Test suite for Fraction class.
 */
use \Hijarian\Fraction\Fraction;

class FractionTest extends PHPUnit_Framework_TestCase
{

    /** @test */
    public function CanAddFractions()
    {
        $first = new Fraction("2/5");
        $second = new Fraction("1/5");
        $result = Fraction::add($first, $second);

        $this->assertEquals("3/5", $result->string);
    }

    /** @test */
    public function CanGetStringValueOfFraction()
    {
        $fraction = new Fraction("2/5");

        $this->assertEquals("2/5", $fraction->string);
    }
}
