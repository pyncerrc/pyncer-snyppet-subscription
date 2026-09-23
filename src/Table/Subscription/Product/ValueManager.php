<?php
namespace Pyncer\Snyppet\Subscription\Table\Subscription\Product;

use Pyncer\Database\ConnectionInterface;
use Pyncer\Snyppet\Subscription\Table\Subscription\Product\ValueMapper;
use Pyncer\Snyppet\Subscription\Table\Subscription\Product\ValueModel;
use Pyncer\Snyppet\Subscription\Table\Subscription\Product\ValueValidator;
use Pyncer\Snyppet\Utility\Data\AbstractDataManager;
use Pyncer\Utility\Params;

class ValueManager extends AbstractDataManager
{
    public function __construct(
        ConnectionInterface $connection,
        protected int $subscriptionProductId
    ) {
        parent::__construct($connection);
    }

    public function load(string ...$keys): static
    {
        $valueMapper = new ValueMapper($this->connection);
        $result = $valueMapper->selectAllByKeys($this->subscriptionProductId, $keys);

        foreach ($result as $valueModel) {
            $this->set($valueModel->getKey(), $valueModel->getValue());
        }

        return $this;
    }

    public function validate(string ...$keys): array
    {
        $errors = [];

        foreach ($keys as $key) {
            $value = $this->getString($key, null);

            if ($value === null) {
                continue;
            }

            $validator = new ValueValidator($connection);
            [$data, $itemErrors] = $validator->validateData([
                'key' => $key,
                'value' => $value,
            ]);

            if ($itemErrors) {
                $errors[$key] = $itemErrors;
            }
        }

        return $errors;
    }

    public function save(string ...$keys): static
    {
        $valueMapper = new ValueMapper($this->connection);

        foreach ($keys as $key) {
            $valueModel = $valueMapper->selectByKey($this->subscriptionProductId, $key);

            $value = $this->getString($key, null);

            if ($value === null) {
                if ($valueModel) {
                    $valueMapper->delete($valueModel);
                }

                continue;
            }

            if (!$valueModel) {
                $valueModel = new ValueModel();
                $valueModel->setSubscriptionProductId($this->subscriptionProductId);
                $valueModel->setKey($key);
            }

            $valueModel->setValue($value);

            $valueMapper->replace($valueModel);
        }

        return $this;
    }
}
