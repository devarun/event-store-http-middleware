<?php
/**
 * This file is part of the prooph/event-store-http-middleware.
 * (c) 2018-2018 prooph software GmbH <contact@prooph.de>
 * (c) 2018-2018 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Prooph\EventStore\Http\Middleware\Action;

use Prooph\EventStore\EventStore;
use Prooph\EventStore\Exception\StreamNotFound;
use Prooph\EventStore\StreamName;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class DeleteStream implements RequestHandlerInterface
{
    /**
     * @var EventStore
     */
    private $eventStore;

    /**
     * @var ResponseInterface
     */
    private $responsePrototype;

    public function __construct(EventStore $eventStore, ResponseInterface $responsePrototype)
    {
        $this->eventStore = $eventStore;
        $this->responsePrototype = $responsePrototype;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $streamName = urldecode($request->getAttribute('streamname'));

        try {
            $this->eventStore->delete(new StreamName($streamName));
        } catch (StreamNotFound $e) {
            return $this->responsePrototype->withStatus(404);
        }

        return $this->responsePrototype->withStatus(204);
    }
}