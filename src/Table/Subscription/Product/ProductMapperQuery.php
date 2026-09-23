<?php
namespace Pyncer\Snyppet\Subscription\Table\Subscription\Product;

use Pyncer\Data\MapperQuery\AbstractRequestMapperQuery;
use Pyncer\Database\ConnectionInterface;
use Pyncer\Database\Record\SelectQueryInterface;

class ProductMapperQuery extends AbstractRequestMapperQuery
{
    protected function isValidFilter(
        string $left,
        mixed $right,
        string $operator,
    ): bool
    {
        if ($left === 'subscription_id' &&
            is_int($right) &&
            $operator === '='
        ) {
            return true;
        }

        if ($left === 'content_id' &&
            is_int($right) &&
            $operator === '='
        ) {
            return true;
        }

        if ($left === 'status' &&
            is_string($right) &&
            ($operator === '=' || $operator === '!=')
        ) {
            return true;
        }

        return parent::isValidFilter($left, $right, $operator);
    }

    protected function isValidOrderBy(string $key, string $direction): bool
    {
        switch ($key) {
            case 'subscription_id':
            case 'content_id':
                return true;
        }

       return parent::isValidOrderBy($key, $direction);
    }
}
