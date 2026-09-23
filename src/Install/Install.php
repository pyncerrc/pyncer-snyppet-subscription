<?php
namespace Pyncer\Snyppet\Subscription\Install;

use Pyncer\Database\Table\Column\IntSize;
use Pyncer\Database\Table\Column\TextSize;
use Pyncer\Database\Table\ReferentialAction;
use Pyncer\Database\Value;
use Pyncer\Snyppet\AbstractInstall;

class Install extends AbstractInstall
{
    protected function safeInstall(): bool
    {
        $this->connection->createTable('subscription')
            ->serial('id')
            ->char('uid', 36)->index()
            ->int('user_id', IntSize::BIG)->null()->index()
            ->string('mark', 250)->null()->index()
            ->dateTime('insert_date_time')->default(Value::NOW)->index()
            ->dateTime('update_date_time')->null()->index()
            ->enum('interval', ['day', 'week', 'month', 'year'])->null()
            ->int('interval_count')->null()
            ->dateTime('next_interval_date_time')->null()->index()
            ->bool('enabled')->default(false)->index()
            ->bool('deleted')->default(false)->index()
            ->index('#unique', 'uid')->unique()
            ->foreignKey(null, 'user_id')
                ->references('user', 'id')
                ->deleteAction(ReferentialAction::CASCADE)
                ->updateAction(ReferentialAction::CASCADE)
            ->execute();

        $this->connection->createTable('subscription__value')
            ->serial('id')
            ->int('subscription_id', IntSize::BIG)->index()
            ->string('key', 50)->index()
            ->string('value', 250)
            ->index('#unique', 'subscription_id', 'key')->unique()
            ->foreignKey(null, 'subscription_id')
                ->references('subscription', 'id')
                ->deleteAction(ReferentialAction::CASCADE)
                ->updateAction(ReferentialAction::CASCADE)
            ->execute();

        $this->connection->createTable('subscription__product')
            ->serial('id')
            ->int('subscription_id', IntSize::BIG)->index()
            ->int('content_id', IntSize::BIG)->index()
            ->enum('status', ['trial', 'active', 'ending', 'canceled', 'expired', 'lifetime'])->null()->index()
            ->dateTime('trial_end_date_time')->null()->index()
            ->dateTime('expire_date_time')->null()->index()
            ->index('#unique', 'subscription_id', 'content_id')->unique()
            ->foreignKey(null, 'subscription_id')
                ->references('subscription', 'id')
                ->deleteAction(ReferentialAction::CASCADE)
                ->updateAction(ReferentialAction::CASCADE)
            ->foreignKey(null, 'content_id')
                ->references('content', 'id')
                ->deleteAction(ReferentialAction::CASCADE)
                ->updateAction(ReferentialAction::CASCADE)
            ->execute();

        $this->connection->createTable('subscription__product__value')
            ->serial('id')
            ->int('subscription_product_id', IntSize::BIG)->index()
            ->string('key', 50)->index()
            ->string('value', 250)
            ->index('#unique', 'subscription_product_id', 'key')->unique()
            ->foreignKey(null, 'subscription_product_id')
                ->references('subscription__product', 'id')
                ->deleteAction(ReferentialAction::CASCADE)
                ->updateAction(ReferentialAction::CASCADE)
            ->execute();

        return true;
    }

    protected function safeUninstall(): bool
    {
        if ($this->connection->hasTable('subscription__product__value')) {
            $this->connection->dropTable('subscription__product__value');
        }

        if ($this->connection->hasTable('subscription__product')) {
            $this->connection->dropTable('subscription__product');
        }

        if ($this->connection->hasTable('subscription__value')) {
            $this->connection->dropTable('subscription__value');
        }

        if ($this->connection->hasTable('subscription')) {
            $this->connection->dropTable('subscription');
        }

        return true;
    }

    public function getRequired(): array
    {
        return [
            'access' => '*',
            'content' => '*',
        ];
    }
}
