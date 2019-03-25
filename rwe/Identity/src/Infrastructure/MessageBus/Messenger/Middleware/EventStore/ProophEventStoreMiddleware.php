<?php
/**
 * Created by PhpStorm.
 * User: zero
 * Date: 29/11/18
 * Time: 18.44.
 */

namespace Identity\Infrastructure\MessageBus\Messenger\Middleware\EventStore;

use Prooph\EventStore\EventStore;
use Prooph\EventStore\StreamName;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;

class ProophEventStoreMiddleware implements MiddlewareInterface
{
    private $eventStore;

    public function __construct(EventStore $eventStore)
    {
        $this->eventStore = $eventStore;
    }

    /**
     * @param object $message
     *
     * @return mixed
     */
    public function handle($message, callable $next)
    {
        // TODO: Implement handle() method.
        //$next($message);
        $this->eventStore->appendTo(
            new StreamName('event_stream'),
            new \ArrayIterator([$message])
        );

        return $next($message);
    }
}
