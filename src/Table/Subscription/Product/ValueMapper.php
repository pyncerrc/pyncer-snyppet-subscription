<?php
namespace Pyncer\Snyppet\Subscription\Table\Subscription\Product;

use Pyncer\Data\Mapper\AbstractMapper;
use Pyncer\Data\Model\ModelInterface;
use Pyncer\Data\Mapper\MapperResultInterface;
use Pyncer\Snyppet\Subscription\Table\Subscription\Product\ValueModel;

class ValueMapper extends AbstractMapper
{
    public function getTable(): string
    {
        return 'subscription__product__value';
    }

    public function forgeModel(iterable $data = []): ModelInterface
    {
        return new ValueModel($data);
    }

    public function isValidModel(ModelInterface $model): bool
    {
        return ($model instanceof ValueModel);
    }

    public function selectByKey(
        int $subscriptionProductId,
        string $key,
        ?MapperQueryInterface $mapperQuery = null
    ): ?ModelInterface
    {
        return $this->selectByColumns(
            [
                'subscription_product_id' => $subscriptionProductId,
                'key' => $key,
            ],
            $mapperQuery,
        );
    }

    public function selectAllByKeys(
        int $subscriptionProductId,
        array $keys,
        ?MapperQueryInterface $mapperQuery = null
    ): MapperResultInterface
    {
        return $this->selectAllByColumns(
            [
                'subscription_product_id' => $subscriptionProductId,
                'key' => $keys,
            ],
            $mapperQuery,
        );
    }
}
