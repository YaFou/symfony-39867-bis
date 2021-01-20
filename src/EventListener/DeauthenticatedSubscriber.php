<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Http\Event\DeauthenticatedEvent;

class DeauthenticatedSubscriber implements EventSubscriberInterface
{
    /**
     * @var Request|null
     */
    private $request;

    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();
    }

    public function onDeauthenticated(DeauthenticatedEvent $event): void
    {
        $this->request->getSession()->getBag('flashes')->add('success', 'event triggered!');
    }

    public static function getSubscribedEvents(): array
    {
        return [DeauthenticatedEvent::class => 'onDeauthenticated'];
    }
}
