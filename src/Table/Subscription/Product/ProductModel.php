<?php
namespace Pyncer\Snyppet\Subscription\Table\Subscription\Product;

use DateTime;
use DateTimeInterface;
use Pyncer\Data\Model\AbstractModel;
use Pyncer\Snyppet\Subscription\SubscriptionStatus;

use function Pyncer\date_time as pyncer_date_time;

use const Pyncer\DATE_TIME_FORMAT as PYNCER_DATE_TIME_FORMAT;

class ProductModel extends AbstractModel
{
    public function getSubscriptionId(): int
    {
        return $this->get('subscription_id');
    }
    public function setUserId(int $value): static
    {
        $this->set('subscription_id', $value);
        return $this;
    }

    public function getContentId(): int
    {
        return $this->get('content_id');
    }
    public function setContentId(int $value): static
    {
        $this->set('content_id', $value);
        return $this;
    }

    public function getStatus(): ?SubscriptionStatus
    {
        $value = $this->get('status');

        if ($value === null) {
            return null;
        }

        return SubscriptionStatus::from($value);
    }
    public function setStatus(null|string|SubscriptionStatus $value): static
    {
        if ($value instanceof SubscriptionStatus) {
            $value = $value->value;
        }

        $this->set('status', $value);
        return $this;
    }

    public function getTrialEndDateTime(): ?DateTime
    {
        $value = $this->get('trial_end_date_time');
        return pyncer_date_time($value);
    }
    public function setTrialEndDateTime(null|string|DateTimeInterface $value): static
    {
        if ($value instanceof DateTimeInterface) {
            $value = $value->format(PYNCER_DATE_TIME_FORMAT);
        }
        $this->set('trial_end_date_time', $this->nullify($value));
        return $this;
    }

    public function getExpireDateTime(): ?DateTime
    {
        $value = $this->get('expire_date_time');
        return pyncer_date_time($value);
    }
    public function setExpireDateTime(null|string|DateTimeInterface $value): static
    {
        if ($value instanceof DateTimeInterface) {
            $value = $value->format(PYNCER_DATE_TIME_FORMAT);
        }
        $this->set('expire_date_time', $this->nullify($value));
        return $this;
    }

    public static function getDefaultData(): array
    {
        $dateTime = pyncer_date_time()->format(PYNCER_DATE_TIME_FORMAT);

        return [
            'id' => 0,
            'subscription_id' => 0,
            'content_id' => 0,
            'status' => null,
            'trial_end_date_time' => null,
            'expire_date_time' => null,
        ];
    }
}
