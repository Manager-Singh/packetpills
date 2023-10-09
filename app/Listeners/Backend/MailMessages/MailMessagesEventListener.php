<?php

namespace App\Listeners\Backend\MailMessages;

/**
 * Class AutoMessagesEventListener.
 */
class MailMessagesEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'MailMessages';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->mailMessage->id)
            ->withText('trans("history.backend.mail-messages.created") <strong>'.$event->mailMessage->message.'</strong>')
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
            ->withEntity($event->mailMessage->id)
            ->withText('trans("history.backend.mail-messages.updated") <strong>'.$event->mailMessage->message.'</strong>')
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
            ->withEntity($event->mailMessage->id)
            ->withText('trans("history.backend.mail-messages.deleted") <strong>'.$event->mailMessage->message.'</strong>')
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
            \App\Events\Backend\MailMessages\MailMessagesCreated::class,
            'App\Listeners\Backend\MailMessages\MailMessagesEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\MailMessages\MailMessagesUpdated::class,
            'App\Listeners\Backend\MailMessages\MailMessagesEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\MailMessages\MailMessagesDeleted::class,
            'App\Listeners\Backend\MailMessages\MailMessagesEventListener@onDeleted'
        );
    }
}
