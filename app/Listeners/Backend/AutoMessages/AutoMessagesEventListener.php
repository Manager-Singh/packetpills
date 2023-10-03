<?php

namespace App\Listeners\Backend\AutoMessages;

/**
 * Class AutoMessagesEventListener.
 */
class AutoMessagesEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'AutoMessages';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->autoMessage->id)
            ->withText('trans("history.backend.auto-messages.created") <strong>'.$event->autoMessage->message.'</strong>')
            ->withIcon('plus')
            ->withClass('bg-green')
            ->log();
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->autoMessage->id)
            ->withText('trans("history.backend.auto-messages.updated") <strong>'.$event->autoMessage->message.'</strong>')
            ->withIcon('save')
            ->withClass('bg-aqua')
            ->log();
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->autoMessage->id)
            ->withText('trans("history.backend.auto-messages.deleted") <strong>'.$event->autoMessage->message.'</strong>')
            ->withIcon('trash')
            ->withClass('bg-maroon')
            ->log();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\AutoMessages\AutoMessagesCreated::class,
            'App\Listeners\Backend\AutoMessages\AutoMessagesEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\AutoMessages\AutoMessagesUpdated::class,
            'App\Listeners\Backend\AutoMessages\AutoMessagesEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\AutoMessages\AutoMessagesDeleted::class,
            'App\Listeners\Backend\AutoMessages\AutoMessagesEventListener@onDeleted'
        );
    }
}
