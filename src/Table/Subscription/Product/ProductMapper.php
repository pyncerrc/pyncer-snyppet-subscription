<?php
namespace Pyncer\Snyppet\Subscription\Table\Subscription\Product;

use Pyncer\Data\Mapper\AbstractMapper;
use Pyncer\Data\Mapper\MapperResultInterface;
use Pyncer\Data\MapperQuery\MapperQueryInterface;
use Pyncer\Data\Model\ModelInterface;
use Pyncer\Snyppet\Subscription\Table\Subscription\Product\ProductMapperQuery;
use Pyncer\Snyppet\Subscription\Table\Subscription\Product\ProductModel;

class ProductMapper extends AbstractMapper
{
    public function getTable(): string
    {
        return 'subscription__product';
    }

    public function forgeModel(iterable $data = []): ModelInterface
    {
        return new ProductModel($data);
    }

    public function isValidModel(ModelInterface $model): bool
    {
        return ($model instanceof ProductModel);
    }

    public function isValidMapperQuery(MapperQueryInterface $mapperQuery): bool
    {
        return ($mapperQuery instanceof ProductMapperQuery);
    }

    public function selectAllBySubscriptionId(
        int $subscriptionId,
        ?MapperQueryInterface $mapperQuery = null
    ): MapperResultInterface
    {
        return $this->selectAllByColumns(
            ['subscription_id' => $subscriptionId],
            $mapperQuery,
        );
    }
}
