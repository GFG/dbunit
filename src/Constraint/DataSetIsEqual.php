<?php
/*
 * This file is part of DBUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PHPUnit\Framework\Constraint\Constraint;

/**
 * Asserts whether or not two dbunit datasets are equal.
 */
class PHPUnit_Extensions_Database_Constraint_DataSetIsEqual extends Constraint
{
    /**
     * @var PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    protected $value;

    /**
     * @var string
     */
    protected $failure_reason;

    /**
     * Creates a new constraint.
     *
     * @param PHPUnit_Extensions_Database_DataSet_IDataSet $value
     */
    public function __construct(PHPUnit_Extensions_Database_DataSet_IDataSet $value)
    {
        parent::__construct();
        $this->value = $value;
    }

    /**
     * Evaluates the constraint for parameter $other. Returns TRUE if the
     * constraint is met, FALSE otherwise.
     *
     * This method can be overridden to implement the evaluation algorithm.
     *
     * @param  mixed $other Value or object to evaluate.
     * @return bool
     */
    protected function matches($other)
    {
        if (!$other instanceof PHPUnit_Extensions_Database_DataSet_IDataSet) {
            throw new InvalidArgumentException(
              'PHPUnit_Extensions_Database_DataSet_IDataSet expected'
            );
        }

        return $this->value->matches($other);
    }

    /**
     * Returns the description of the failure
     *
     * The beginning of failure messages is "Failed asserting that" in most
     * cases. This method should return the second part of that sentence.
     *
     * @param  mixed  $other Evaluated value or object.
     * @return string
     */
    protected function failureDescription($other)
    {
        return $other->__toString() . ' ' . $this->toString();
    }

    /**
     * Returns a string representation of the constraint.
     *
     * @return string
     */
    public function toString()
    {
        return sprintf(
          'is equal to expected %s', $this->value->__toString()
        );
    }
}