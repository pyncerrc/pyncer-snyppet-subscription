<?php
namespace Pyncer\Snyppet\Subscription\Table\Subscription\Product;

use Pyncer\Snyppet\Content\Table\Content\ContentMapper;
use Pyncer\Snyppet\Subscription\Table\Subscription\SubscriptionMapper;
use Pyncer\Data\Validation\AbstractValidator;
use Pyncer\Database\ConnectionInterface;
use Pyncer\Validation\Rule\BoolRule;
use Pyncer\Validation\Rule\DateTimeRule;
use Pyncer\Validation\Rule\EnumRule;
use Pyncer\Validation\Rule\IdRule;
use Pyncer\Validation\Rule\IntRule;
use Pyncer\Validation\Rule\RequiredRule;
use Pyncer\Validation\Rule\StringRule;
use Pyncer\Validation\Rule\UidRule;

class ProductValidator extends AbstractValidator
{
    public function __construct(ConnectionInterface $connection)
    {
        parent::__construct($connection);

        $this->addRules(
            'subscription_id',
            new RequireRule(IntRule::EMPTY),
            new IntRule(
                minValue: 0,
            ),
            new IdRule(
                mapper: new SubscriptionMapper($this->getConnection()),
            ),
        );

        $this->addRules(
            'content_id',
            new RequireRule(IntRule::EMPTY),
            new IntRule(
                minValue: 0,
            ),
            new IdRule(
                mapper: new ContentMapper($this->getConnection()),
            ),
        );

        $this->addRules(
            'status',
            new EnumRule(
                values: ['trial', 'active', 'ending', 'canceled', 'expired', 'lifetime'],
                allowNull: true,
            ),
        );

        $this->addRules(
            'trial_end_date_time',
            new DateTimeRule(
                allowNull: true,
            ),
        );

        $this->addRules(
            'expire_date_time',
            new DateTimeRule(
                allowNull: true,
            ),
        );
    }
}
