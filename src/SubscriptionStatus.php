<?php
namespace Pyncer\Snyppet\Subscription;

enum SubscriptionStatus: string
{
    case TRIAL = 'trial';
    case ACTIVE = 'active';
    case ENDING = 'ending';
    case CANCELED = 'canceled';
    case EXPIRED = 'expired';
    case LIFETIME = 'lifetime';
}
