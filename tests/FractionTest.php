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

    public function SimplifyingFractions()
    {
       return array(
            array('3/5', '3/5'),
            array('4/8', '1/2'),
            array('0/1', '0'),
            array('12/12', '1'),
            array('8/2', '4'),
        );
    }

    /**
     * @test
     * @dataProvider SimplifyingFractions
     */
    public function SimplifiesFractionsOnInstantiating($given, $expected)
    {
        $fraction = new Fraction($given);

        $this->assertEquals($expected, (string)$fraction);
    }
}
