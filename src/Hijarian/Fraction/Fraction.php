<?php
/**
 * Simplest possible class for representing rational numbers ("fractions") like 3/5 or 13/4 exactly.
 *
 * @author hijarian <hijarian@gmail.com>
 * @license CC0
 */
namespace Hijarian\Fraction;

class Fraction
{
    /** @var string */
    private $string;

    /** @var integer */
    private $numerator;

    /** @var integer */
    private $denominator;

    /**
     * We make the Fraction object by providing the textual representation of it,
     * for example, "2/5" or "11/7".
     *
     * Ideally, we'll allow any numerical values (floats, other Fractions)
     * in both numerator and denominator posisions, normalizing them if needed.
     *
     * @param string $value Initial textual representation of the fraction.
     */
    public function __construct($value)
    {
        list($numerator, $denominator) = $this->extractFractionParts($value);

        $this->numerator = $numerator;
        $this->denominator = $denominator;

        $this->renewPrintedRepresentation();
    }

    public function isZero()
    {
        return $this->numerator == 0;
    }

    /**
     * Common magic getter, returning value of any requested property,
     * given it was defined on this class.
     *
     * @param string $attr Name of the attribute to get
     * @return mixed
     * @throws \LogicException
     */
    public function __get($attr)
    {
        if (property_exists($this, $attr))
            return $this->{$attr};

        throw new \LogicException(sprintf("No such attribute on %s: '%s'", get_class(), $attr));
    }

    /**
     * Our default textual representation of the Fraction will be it's inner string value.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->string;
    }


    public static function mult($first, $second)
    {
        list($numerator, $denominator) = self::doRationalMultiplication(
            $first->numerator,
            $first->denominator,
            $second->numerator,
            $second->denominator
        );

        $value = sprintf("%s/%s", $numerator, $denominator);
        return new self($value);
    }

    /**
     * Simplest possible implementation of adding two rational numbers
     */
    private static function doRationalMultiplication(
        $numerator_x,
        $denominator_x,
        $numerator_y,
        $denominator_y
    ) {
        $numerator = $numerator_x * $numerator_y;
        $denominator = $denominator_x * $denominator_y;
        return array($numerator, $denominator);
    }

    /**
     * @param self $first
     * @param self $second
     * @return self
     * @throws \InvalidArgumentException
     */
    public static function divide($first, $second)
    {
        if ($second->isZero())
            throw new \InvalidArgumentException("Division by zero: {$first} by {$second}!");

        // NOTE that second fraction parts are reversed!
        list($numerator, $denominator) = self::doRationalMultiplication(
            $first->numerator,
            $first->denominator,
            $second->denominator,
            $second->numerator
        );

        $value = self::makePrintedRepresentation($numerator, $denominator);
        return new self($value);
    }

    /**
     * Adds two Fraction objects together, emitting new Fraction being the sum.
     *
     * @param self $first
     * @param self $second
     * @return self
     */
    public static function add($first, $second)
    {
        list($numerator, $denominator) = self::doFractionAddition(
            $first->numerator,
            $first->denominator,
            $second->numerator,
            $second->denominator
        );
        $value = self::makePrintedRepresentation($numerator, $denominator);
        return new self($value);
    }

    public static function subtract($first, $second)
    {
        // NOTE that second fraction parts are reversed!
        list($numerator, $denominator) = self::doFractionAddition(
            $first->numerator,
            $first->denominator,
            $second->numerator * (-1),
            $second->denominator
        );

        $value = self::makePrintedRepresentation($numerator, $denominator);
        return new self($value);
    }

    /**
     * Simplest possible implementation of adding two rational numbers
     */
    private static function doFractionAddition(
        $numerator_x,
        $denominator_x,
        $numerator_y,
        $denominator_y
    ) {
        $numerator = $numerator_x * $denominator_y + $numerator_y * $denominator_x;
        $denominator = $denominator_x * $denominator_y;
        return array($numerator, $denominator);
    }

    private function extractFractionParts($value)
    {
        list($numerator, $denominator) = $this->getBaseFractionParts($value);

        $this->checkFractionParts($numerator, $denominator);

        list($numerator, $denominator) = $this->simplifyFractionParts($numerator, $denominator);

        return array($numerator, $denominator);
    }

    /**
     * @param $value
     * @return array
     */
    private function getBaseFractionParts($value)
    {
        $parts = explode("/", $value);

        if (empty($parts)) {
            $numerator = 0;
            $denominator = 1;
        } else if (count($parts) < 2) {
            $numerator = $parts[0];
            $denominator = 1;
        } else {
            $numerator = $parts[0];
            $denominator = $parts[1];
        }
        return array($numerator, $denominator);
    }

    private function checkFractionParts($numerator, $denominator)
    {
        if (!is_numeric($numerator))
            throw new \InvalidArgumentException("Numerator '{$numerator}' is not a number!");

        if (!is_numeric($denominator))
            throw new \InvalidArgumentException("Denominator '{$denominator}' is not a number!");

        if ($denominator == 0)
            throw new \InvalidArgumentException("Denominator cannot be zero: we are working with plain old algebra here");
    }

    /**
     * @param $numerator
     * @param $denominator
     * @return array
     */
    private function simplifyFractionParts($numerator, $denominator)
    {
        $gcd = $this->gcdBetween($numerator, $denominator);
        $numerator /= $gcd;
        $denominator /= $gcd;

        if ($denominator < 0) {
            $numerator *= (-1);
            $denominator *= (-1);
        }

        return array($numerator, $denominator);
    }

    /**
     * Calculate the Greatest Common Divisor between two numbers.
     *
     * @param $a
     * @param $b
     * @return mixed
     */
    private function gcdBetween($a, $b)
    {
        while ($b != 0)
        {
            $m = $a % $b;
            $a = $b;
            $b = $m;
        }
        return $a;
    }

    private function renewPrintedRepresentation()
    {
        $this->string = self::makePrintedRepresentation($this->numerator, $this->denominator);
    }

    /**
     * @param int $numerator
     * @param int $denominator
     * @return string
     */
    private static function makePrintedRepresentation($numerator, $denominator)
    {
        if ($numerator == 0) {
            return "0";
        } else if ($numerator == $denominator) {
            return "1";
        } else if ($denominator == 1) {
            return (string)$numerator;
        } else {
            return sprintf("%s/%s", $numerator, $denominator);
        }
    }
}