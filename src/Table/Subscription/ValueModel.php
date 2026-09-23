<?php
namespace Pyncer\Snyppet\Subscription\Table\Subscription;

use Pyncer\Data\Model\AbstractModel;

class ValueModel extends AbstractModel
{
    public function getSubscriptionId(): int
    {
        return $this->get('subscription_id');
    }
    public function setSubscriptionId(int $value): static
    {
        $this->set('subscription_id', $value);
        return $this;
    }

    public function getKey(): string
    {
        return $this->get('key');
    }
    public function setKey(string $value): static
    {
        $this->set('key', $value);
        return $this;
    }

    public function getValue(): ?string
    {
        return $this->get('value');
    }
    public function setValue(?string $value): static
    {
        $this->set('value', $this->nullify($value));
        return $this;
    }

    public static function getDefaultData(): array
    {
        return [
            'id' => 0,
            'subscription_id' => 0,
            'key' => '',
            'value' => null,
        ];
    }
}
