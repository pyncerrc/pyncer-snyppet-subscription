<?php
namespace Pyncer\Snyppet\Subscription\Component\Module\Subscription;

use Pyncer\App\Identifier as ID;
use Pyncer\Component\Module\AbstractPatchItemModule;
use Pyncer\Data\Mapper\MapperInterface;
use Pyncer\Data\MapperQuery\MapperQueryInterface;
use Pyncer\Data\Validation\ValidatorInterface;
use Pyncer\Snyppet\Subscription\Table\Subscription\SubscriptionMapper;
use Pyncer\Snyppet\Subscription\Table\Subscription\SubscriptionMapperQuery;
use Pyncer\Snyppet\Subscription\Table\Subscription\SubscriptionValidator;

use function Pyncer\date_time as pyncer_date_time;

class PatchSubscriptionItemModule extends AbstractPatchItemModule
{
    protected function getRequiredItemData(): array
    {
        $data = parent::getRequiredItemData();

        $data['update_date_time'] = pyncer_date_time();

        return $data;
    }

    protected function forgeValidator(): ?ValidatorInterface
    {
        $connection = $this->get(ID::DATABASE);
        return new SubscriptionValidator($connection);
    }

    protected function forgeMapper(): MapperInterface
    {
        $connection = $this->get(ID::DATABASE);
        return new SubscriptionMapper($connection);
    }

    protected function forgeMapperQuery(): ?MapperQueryInterface
    {
        $connection = $this->get(ID::DATABASE);
        return new SubscriptionMapperQuery($connection);
    }
}
