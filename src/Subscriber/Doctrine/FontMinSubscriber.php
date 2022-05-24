<?php

namespace App\Subscriber\Doctrine;

use App\Entity\FontMin;
use App\Message\FontMinMessage;
use App\Repository\FontMinRepository;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Messenger\MessageBusInterface;

class FontMinSubscriber implements EventSubscriberInterface
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function postPersist(LifecycleEventArgs $event): void
    {
        $entity = $event->getEntity();
        if ($entity instanceof FontMin) {
            $fontMinMessage = new FontMinMessage($entity->getText(), $entity->getFontFamily(),
                $entity->getNewFontFamily());
            $this->messageBus->dispatch($fontMinMessage);
        }
    }
    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist
        ];
    }
}