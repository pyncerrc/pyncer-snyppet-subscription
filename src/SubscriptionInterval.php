<?php
namespace Pyncer\Snyppet\Subscription;

enum SubscriptionInterval: string
{
    case DAY = 'day';
    case WEEK = 'week';
    case MONTH = 'month';
    case YEAR = 'year';
}
