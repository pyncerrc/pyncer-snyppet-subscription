<?php
namespace Pyncer\Snyppet\Subscription\Table\Subscription;

use Pyncer\Snyppet\Access\Table\User\UserMapper;
use Pyncer\Data\Validation\AbstractValidator;
use Pyncer\Database\ConnectionInterface;
use Pyncer\Validation\Rule\BoolRule;
use Pyncer\Validation\Rule\DateTimeRule;
use Pyncer\Validation\Rule\IdRule;
use Pyncer\Validation\Rule\IntRule;
use Pyncer\Validation\Rule\RequiredRule;
use Pyncer\Validation\Rule\StringRule;
use Pyncer\Validation\Rule\UidRule;

class SubscriptionValidator extends AbstractValidator
{
    public function __construct(ConnectionInterface $connection)
    {
        parent::__construct($connection);

        $this->addRules(
            'uid',
            new RequiredRule(UidRule::EMPTY),
            new UidRule(),
            new StringRule(
                maxLength: 36,
            ),
        );

        $this->addRules(
            'user_id',
            new IntRule(
                minValue: 0,
                allowNull: true,
            ),
            new IdRule(
                mapper: new UserMapper($this->getConnection()),
            ),
        );

        $this->addRules(
            'mark',
            new StringRule(
                maxLength: 250,
                allowNull: true,
            ),
        );

        $this->addRules(
            'insert_date_time',
            new RequiredRule(DateTimeRule::EMPTY),
            new DateTimeRule(),
        );

        $this->addRules(
            'update_date_time',
            new DateTimeRule(
                allowNull: true,
            ),
        );

        $this->addRules(
            'interval',
            new EnumRule(
                values: ['day', 'week', 'month', 'year'],
                allowNull: true,
            ),
        );

        $this->addRules(
            'interval_count',
            new IntRule(
                minValue: 1,
                allowNull: true,
            ),
        );

        $this->addRules(
            'next_interval_date_time',
            new DateTimeRule(
                allowNull: true,
            ),
        );

        $this->addRules(
            'enabled',
            new BoolRule(),
        );

        $this->addRules(
            'deleted',
            new BoolRule(),
        );
    }
}
