<?php

declare(strict_types=1);

namespace Dimkinthepro\Http\Infrastructure\EventListener;

use Dimkinthepro\Http\Application\UseCase\DataBuilder;
use Dimkinthepro\Http\Application\UseCase\DataValidator;
use Dimkinthepro\Http\Application\UseCase\RequestDataExtractor;
use Dimkinthepro\Http\Domain\DTO\ValidatedDTOInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;

readonly class ControllerArgumentsEventListener implements EventSubscriberInterface
{
    public function __construct(
        private bool $requestValidationEnabled,
        private DataBuilder $dataBuilder,
        private DataValidator $dataValidator,
        private RequestDataExtractor $requestDataExtractor,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ControllerArgumentsEvent::class => [
                ['onControllerArgumentsEvent', 100],
            ],
        ];
    }

    public function onControllerArgumentsEvent(ControllerArgumentsEvent $event): void
    {
        if (false === $this->requestValidationEnabled) {
            return;
        }

        $requestData = $this->requestDataExtractor->getData($event->getRequest());

        foreach ($event->getArguments() as $argument) {
            if ($argument instanceof ValidatedDTOInterface) {
                $this->dataBuilder->fill($argument, $requestData);
                $this->dataValidator->validate($argument);
            }
        }
    }
}
