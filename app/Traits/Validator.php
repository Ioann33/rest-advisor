<?php
namespace Traits;

trait Validator
{
    public function requiredValidator(array $source, string $needle): bool
    {
        return isset($source[$needle]);
    }

    public function stringValidator(array $source, string $needle): bool
    {
        return is_string($source[$needle] ?? null);
    }

    public function integerValidator(array $source, string $needle): bool
    {
        return is_numeric($source[$needle] ?? null);
    }

    public function matchValidator(array $source, string $needle): bool
    {
        return in_array($needle, $source);
    }

    public function rangeValidator(int $min, int $max, int $value): bool
    {
        return $value >= $min && $value <= $max;
    }

    public function checkRules(array $rules, callable $func): void
    {
        foreach ($rules as $key => $field) {
            $func($field, $key);
        }
    }
}