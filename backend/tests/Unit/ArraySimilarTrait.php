<?php
namespace Tests\Unit;

trait ArraySimilarTrait
{
    /**
     * PHPUnit assert arrays ignore orders.
     *
     * @param array $expected
     * @param array $actual
     */
    protected function assertArraySimilar(array $expected, array $actual)
    {
        $this->assertSame([], array_diff_key($actual, $expected));

        array_multisort($expected);
        array_multisort($actual);

        foreach ($expected as $key => $value) {
            if (is_array($value)) {
                $this->assertArraySimilar($value, $actual[$key]);
            } else {
                $this->assertContains($value, $actual);
            }
        }
    }
}