<?php

declare(strict_types=1);

namespace Dimkinthepro\Http\Infrastructure\EventListener;

use Dimkinthepro\Http\Application\Component\Exception\ValidationExceptionInterface;
use Dimkinthepro\Http\Application\UseCase\ExceptionHandler;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

readonly class ValidationExceptionEventListener implements EventSubscriberInterface
{
    public function __construct(
        private bool $handleValidationErrors,
        private ExceptionHandler $exceptionHandler,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ExceptionEvent::class => [
                ['onExceptionEvent', 100],
            ],
        ];
    }

    public function onExceptionEvent(ExceptionEvent $event): void
    {
        if (false === $this->handleValidationErrors) {
            return;
        }

        $exception = $event->getThrowable();
        if (!$exception instanceof ValidationExceptionInterface) {
            return;
        }

        $event->setResponse($this->exceptionHandler->handleException($exception));
    }
}
