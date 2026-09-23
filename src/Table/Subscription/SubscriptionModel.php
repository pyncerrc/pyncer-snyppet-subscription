<?php
namespace Pyncer\Snyppet\Subscription\Table\Subscription;

use DateTime;
use DateTimeInterface;
use Pyncer\Data\Model\AbstractModel;
use Pyncer\Snyppet\Subscription\SubscriptionInterval;

use function Pyncer\uid as pyncer_uid;
use function Pyncer\date_time as pyncer_date_time;

use const Pyncer\DATE_TIME_FORMAT as PYNCER_DATE_TIME_FORMAT;

class SubscriptionModel extends AbstractModel
{
    public function getUid(): string
    {
        return $this->get('uid');
    }
    public function setUid(string $value): static
    {
        $this->set('uid', $value);
        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->get('user_id');
    }
    public function setUserId(?int $value): static
    {
        $this->set('user_id', $this->nullify($value));
        return $this;
    }

    public function getMark(): ?string
    {
        return $this->get('mark');
    }
    public function setMark(?string $value): static
    {
        $this->set('mark', $this->nullify($value));
        return $this;
    }

    public function getInsertDateTime(): DateTime
    {
        $value = $this->get('insert_date_time');
        return pyncer_date_time($value);
    }
    public function setInsertDateTime(string|DateTimeInterface $value): static
    {
        if ($value instanceof DateTimeInterface) {
            $value = $value->format(PYNCER_DATE_TIME_FORMAT);
        }
        $this->set('insert_date_time', $value);
        return $this;
    }

    public function getUpdateDateTime(): ?DateTime
    {
        $value = $this->get('update_date_time');
        return pyncer_date_time($value);
    }
    public function setUpdateDateTime(null|string|DateTimeInterface $value): static
    {
        if ($value instanceof DateTimeInterface) {
            $value = $value->format(PYNCER_DATE_TIME_FORMAT);
        }
        $this->set('update_date_time', $this->nullify($value));
        return $this;
    }

    public function getInterval(): ?SubscriptionInterval
    {
        $value = $this->get('interval');

        if ($value === null) {
            return null;
        }

        return SubscriptionInterval::from($value);
    }
    public function setInterval(null|string|SubscriptionInterval $value): static
    {
        if ($value instanceof SubscriptionStatus) {
            $value = $value->value;
        }

        $this->set('interval', $value);
        return $this;
    }

    public function getIntervalCount(): ?int
    {
        return $this->get('interval_count');
    }
    public function setIntervalCount(?int $value): static
    {
        $this->set('interval_count', $this->nullify($value));
        return $this;
    }

    public function getNextIntervalDateTime(): ?DateTime
    {
        $value = $this->get('next_interval_date_time');
        return pyncer_date_time($value);
    }
    public function setNextIntervalDateTime(null|string|DateTimeInterface $value): static
    {
        if ($value instanceof DateTimeInterface) {
            $value = $value->format(PYNCER_DATE_TIME_FORMAT);
        }
        $this->set('next_interval_date_time', $this->nullify($value));
        return $this;
    }

    public function getEnabled(): bool
    {
        return $this->get('enabled');
    }
    public function setEnabled(bool $value): static
    {
        $this->set('enabled', $value);
        return $this;
    }

    public function getDeleted(): bool
    {
        return $this->get('deleted');
    }
    public function setDeleted(bool $value): static
    {
        $this->set('deleted', $value);
        return $this;
    }

    public static function getDefaultData(): array
    {
        $dateTime = pyncer_date_time()->format(PYNCER_DATE_TIME_FORMAT);

        return [
            'id' => 0,
            'uid' => pyncer_uid(),
            'user_id' => null,
            'mark' => null,
            'insert_date_time' => $dateTime,
            'update_date_time' => null,
            'interval' => null,
            'interval_count' => null,
            'next_interval_date_time' => null,
            'enabled' => false,
            'deleted' => false,
        ];
    }
}
