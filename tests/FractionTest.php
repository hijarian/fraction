<?php
/**
 * Test suite for Fraction class.
 */
use \Hijarian\Fraction\Fraction;

class FractionTest extends PHPUnit_Framework_TestCase
{
//-INSTANTIATING TESTS-BEGIN----------------------------------------------------------------------
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
//-INSTANTIATING TESTS-END----------------------------------------------------------------------

//-BINARY OPERATIONS-BEGIN----------------------------------------------------------------------
    public function FractionsAddition()
    {
        return array(
            array('0/1', '0/2', '0'),
            array('2/5', '3/5', '1'),
            array('2/5', '2/5', '4/5'),
            array('2/4', '1/3', '5/6'),
            array('2/5', '4/5', '6/5'),
            array('7/9', '3/9', '10/9'),
            array('2/9', '1/9', '1/3'),
            array('2/5', '1/5', '3/5'),
            array('1', '2', '3')
        );
    }

    /**
     * @test
     * @dataProvider FractionsAddition
     */
    public function CanAddFractions($first_value, $second_value, $expected_result)
    {
        $first = new Fraction($first_value);
        $second = new Fraction($second_value);
        $result = Fraction::add($first, $second);

        $this->assertEquals($expected_result, (string)$result);
    }

    public function FractionsMultiplication()
    {
        return array(
            array('1/2', '1/3', '1/6'),
            array('2/5', '3/2', '3/5'),
            array('5/5', '3/2', '3/2'),
            array('4/3', '3/4', '1'),
            array('3/4', '4/3', '1'),
            array('0', '1', '0'),
            array('1', '0', '0'),
            array('4/3', '1', '4/3'),
            array('1', '4/3', '4/3'),
        );
    }

    /**
     * @test
     * @dataProvider FractionsMultiplication
     */
    public function CanMultiplyFractions($first_value, $second_value, $expected_result)
    {
        $first = new Fraction($first_value);
        $second = new Fraction($second_value);
        $result = Fraction::mult($first, $second);

        $this->assertEquals($expected_result, (string)$result);
    }

    public function FractionsDivision()
    {
        return array(
            array('1/2', '1/3', '3/2'),
            array('2/5', '3/2', '4/15'),
            array('5/5', '3/2', '2/3'),
            array('4/3', '3/4', '16/9'),
            array('3/4', '4/3', '9/16'),
            array('0', '1', '0'),
            array('4/3', '1', '4/3'),
            array('1', '4/3', '3/4'),
        );
    }

    /**
     * @test
     * @dataProvider FractionsDivision
     */
    public function CanDivideFractions($first_value, $second_value, $expected_result)
    {
        $first = new Fraction($first_value);
        $second = new Fraction($second_value);
        $result = Fraction::divide($first, $second);

        $this->assertEquals($expected_result, (string)$result);
    }

    public function DivisionByZero()
    {
        return array(
            array('0'),
            array('0/10'),
        );
    }

    /**
     * @test
     * @dataProvider DivisionByZero
     * @expectedException \InvalidArgumentException
     */
    public function ThrowsExceptionOnDivisionByZeroFraction($divisor)
    {
        $arbitrary_fraction = '1/2';
        $first = new Fraction($arbitrary_fraction);
        $second = new Fraction($divisor);

        Fraction::divide($first, $second);
    }

    public function SubtractFractions()
    {
        return array(
            array('1/2', '1/2', '0'),
            array('1', '2', '-1'),
            array('3/2', '1/2', '1'),
            array('-3/4', '1/4', '-1')
        );
    }

    /**
     * @test
     * @dataProvider SubtractFractions()
     */
    public function CanSubtractFractions($first_value, $second_value, $expected_result)
    {
        $first = new Fraction($first_value);
        $second = new Fraction($second_value);
        $result = Fraction::subtract($first, $second);

        $this->assertEquals($expected_result, (string)$result);
    }

//-BINARY OPERATIONS-END----------------------------------------------------------------------

}
