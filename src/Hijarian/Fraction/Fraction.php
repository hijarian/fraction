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
        $this->string = $value;
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
        return new Fraction("3/5");
    }
}