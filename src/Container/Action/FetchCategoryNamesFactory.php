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

namespace Prooph\EventStore\Http\Middleware\Container\Action;

use Prooph\EventStore\EventStore;
use Prooph\EventStore\Http\Middleware\Action\FetchCategoryNames;
use Prooph\EventStore\Http\Middleware\Transformer;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;

final class FetchCategoryNamesFactory
{
    public function __invoke(ContainerInterface $container): FetchCategoryNames
    {
        $actionHandler = new FetchCategoryNames($container->get(EventStore::class), $container->get(ResponseInterface::class));

        $actionHandler->addTransformer(
            $container->get(Transformer::class),
            'application/atom+json',
            'application/json'
        );

        return $actionHandler;
    }
}
