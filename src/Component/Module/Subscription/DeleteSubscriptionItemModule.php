<?php
namespace Pyncer\Snyppet\Subscription\Component\Module\Subscription;

use Pyncer\App\Identifier as ID;
use Pyncer\Component\Module\AbstractDeleteItemModule;
use Pyncer\Data\Mapper\MapperInterface;
use Pyncer\Data\MapperQuery\MapperQueryInterface;
use Pyncer\Data\Model\ModelInterface;
use Pyncer\Database\Exception\QueryException;
use Pyncer\Snyppet\Subscription\Table\Subscription\SubscriptionMapper;
use Pyncer\Snyppet\Subscription\Table\Subscription\SubscriptionMapperQuery;
use Pyncer\Snyppet\Utility\Component\SoftDeleteTrait;

class DeleteSubscriptionItemModule extends AbstractDeleteItemModule
{
    use SoftDeleteTrait;

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

    protected function deleteItem(ModelInterface $model): array
    {
        if (!$this->getSoftDelete()) {
            return parent::deleteItem($model);
        }

        $errors = [];

        try {
            $mapper = $this->forgeMapper();
            $model->setDeleted(true);
            $mapper->update($model);
        } catch (QueryException) {
            $errors['general'] = 'delete';
        }

        return $errors;
    }
}
