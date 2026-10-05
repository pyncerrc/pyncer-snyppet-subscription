<?php
namespace Pyncer\Snyppet\Subscription\Component\Module\Subscription;

use Pyncer\App\Identifier as ID;
use Pyncer\Component\Module\AbstractPostItemModule;
use Pyncer\Data\Mapper\MapperInterface;
use Pyncer\Data\Validation\ValidatorInterface;
use Pyncer\Snyppet\Subscription\Table\Subscription\SubscriptionMapper;
use Pyncer\Snyppet\Subscription\Table\Subscription\SubscriptionValidator;

class PostSubscriptionItemModule extends AbstractPostItemModule
{
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
}
