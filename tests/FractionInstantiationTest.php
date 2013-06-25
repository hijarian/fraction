<?php
/**
 * Test suite for Fraction class.
 *
 * This test cases checks how the Fraction can be instantiated.
 */
use \Hijarian\Fraction\Fraction;

class FractionInstantiationTest extends PHPUnit_Framework_TestCase
{
    public function NormalImproperFractions()
    {
        return array(
            array('3/5', '3/5'),
            array('2/3', '2/3'),
            array('27/8', '27/8'),
            array('11/9', '11/9'),
        );
    }

    /**
     * @test
     * @dataProvider NormalImproperFractions()
     */
    public function CanCreateNormalImproperFractions($input, $expected)
    {
        $this->checkCreation($input, $expected);
    }

    public function SimplifyingFractions()
    {
        return array(
            array('4/8', '1/2'),
            array('3/6', '1/2'),
        );
    }

    /**
     * @test
     * @dataProvider SimplifyingFractions
     */
    public function SimplifiesFractionsOnInstantiating($input, $expected)
    {
        $this->checkCreation($input, $expected);
    }

    public function SimplifyingToWholeNumbers()
    {
        return array(
            array('0', '0'),
            array('0/1', '0'),
            array('1', '1'),
            array('27/1', '27'),
            array('12/12', '1'),
            array('8/2', '4'),
            array('30/10', '3'),
        );
    }

    /**
     * @test
     * @dataProvider SimplifyingFractions
     */
    public function WhenFractionSimplifiesToWholeNumberItBecomesThatNumber($input, $expected)
    {
        $this->checkCreation($input, $expected);
    }

    public function InvalidInputs()
    {
        return array(
            array('abcde'),
            array('abcde/deadbeef'),
            array('1/xxx'),
            array('xxx/123'),
        );
    }

    /**
     * @test
     * @dataProvider InvalidInputs
     * @expectedException \InvalidArgumentException
     */
    public function ThrowsExceptionWhenNonNumericInput($input)
    {
        new Fraction($input);
    }

    public function NegativeFractions()
    {
        return array(
            array('-1/2', '-1/2'),
            array('-1/-2', '1/2'),
            array('1/-2', '-1/2'),
            array('-4/8', '-1/2'),
            array('38/-2', '-19'),
            array('-25/15', '-5/3')
        );
    }

    /**
     * @test
     * @dataProvider NegativeFractions
     */
    public function CanCreateNegativeFractions($input, $expected)
    {
        $this->checkCreation($input, $expected);
    }

    private function checkCreation($input, $expected)
    {
        $fraction = new Fraction($input);
        $this->assertEquals($expected, (string)$fraction);
    }
}
