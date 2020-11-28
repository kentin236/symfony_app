<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TestSubSubscriber implements EventSubscriberInterface
{
    public function onWorkerMessageFailedEvent($event)
    {
        // ...
    }

    public static function getSubscribedEvents()
    {
        return [
            'WorkerMessageFailedEvent' => 'onWorkerMessageFailedEvent',
        ];
    }
}
