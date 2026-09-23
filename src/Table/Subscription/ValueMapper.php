<?php
namespace Pyncer\Snyppet\Subscription\Table\Subscription;

use Pyncer\Data\Mapper\AbstractMapper;
use Pyncer\Data\Model\ModelInterface;
use Pyncer\Data\Mapper\MapperResultInterface;
use Pyncer\Snyppet\Subscription\Table\Subscription\ValueModel;

class ValueMapper extends AbstractMapper
{
    public function getTable(): string
    {
        return 'subscription__value';
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
        int $subscriptionId,
        string $key,
        ?MapperQueryInterface $mapperQuery = null
    ): ?ModelInterface
    {
        return $this->selectByColumns(
            [
                'subscription_id' => $subscriptionId,
                'key' => $key,
            ],
            $mapperQuery,
        );
    }

    public function selectAllByKeys(
        int $subscriptionId,
        array $keys,
        ?MapperQueryInterface $mapperQuery = null
    ): MapperResultInterface
    {
        return $this->selectAllByColumns(
            [
                'subscription_id' => $subscriptionId,
                'key' => $keys,
            ],
            $mapperQuery,
        );
    }
}
