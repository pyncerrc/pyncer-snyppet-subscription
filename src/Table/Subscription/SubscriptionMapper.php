<?php
namespace Pyncer\Snyppet\Subscription\Table\Subscription;

use Pyncer\Data\Mapper\AbstractMapper;
use Pyncer\Data\Model\ModelInterface;
use Pyncer\Data\MapperQuery\MapperQueryInterface;
use Pyncer\Snyppet\Subscription\Table\Subscription\SubscriptionMapperQuery;
use Pyncer\Snyppet\Subscription\Table\Subscription\SubscriptionModel;

class SubscriptionMapper extends AbstractMapper
{
    public function getTable(): string
    {
        return 'subscription';
    }

    public function forgeModel(iterable $data = []): ModelInterface
    {
        return new SubscriptionModel($data);
    }

    public function isValidModel(ModelInterface $model): bool
    {
        return ($model instanceof SubscriptionModel);
    }

    public function isValidMapperQuery(MapperQueryInterface $mapperQuery): bool
    {
        return ($mapperQuery instanceof SubscriptionMapperQuery);
    }

    public function selectByUid(
        string $uid,
        ?MapperQueryInterface $mapperQuery = null
    ): ?ModelInterface
    {
        return $this->selectByColumns(['uid' => $uid], $mapperQuery);
    }
}
