<?php

/**
 * This file is part of prooph/event-store-http-middleware.
 * (c) 2018-2019 prooph software GmbH <contact@prooph.de>
 * (c) 2018-2019 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Prooph\EventStore\Http\Middleware;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

interface Transformer
{
    /**
     * @param array $result
     * @return ResponseInterface
     */
    public function createResponse(ResponseFactoryInterface $factory, array $result): ResponseInterface;
}
