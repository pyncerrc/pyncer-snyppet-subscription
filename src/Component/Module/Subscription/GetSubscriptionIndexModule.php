<?php
namespace Pyncer\Snyppet\Subscription\Component\Module\Subscription;

use Pyncer\App\Identifier as ID;
use Pyncer\Component\Module\AbstractGetIndexModule;
use Pyncer\Data\Mapper\MapperInterface;
use Pyncer\Data\MapperQuery\MapperQueryInterface;
use Pyncer\Snyppet\Subscription\Table\Subscription\SubscriptionMapper;
use Pyncer\Snyppet\Subscription\Table\Subscription\SubscriptionMapperQuery;
use Pyncer\Snyppet\Subscription\Table\Subscription\SubscriptionModel;

class GetSubscriptionIndexModule extends AbstractGetIndexModule
{
    protected function forgeMapper(): MapperInterface
    {
        $connection = $this->get(ID::DATABASE);
        return new SubscriptionMapper($connection);
    }

    protected function forgeMapperQuery(): ?MapperQueryInterface
    {
        $connection = $this->get(ID::DATABASE);
        return new SubscriptionMapperQuery($connection, $this->request);
    }
}
