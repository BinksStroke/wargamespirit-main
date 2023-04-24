<?php 

namespace App\EventSubscriber;

use App\Model\TimestampedInterface;
use Doctrine\Common\EventSubscriber;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AdminSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
    //    définir un tableau avec les fonctions qui seront exécuté avant la création de l'entité
       return [
          BeforeEntityPersistedEvent::class => ['setEntityCreatedAt'],
          BeforeEntityUpdatedEvent::class => ['setEntityUpdatedAt']
       ];
    }

    public function setEntityCreatedAt(BeforeEntityPersistedEvent $event): void
    {
        $entity = $event->getEntityInstance();
        // Retourne rien si l'entité n'est pas de l'instance TimestampedInterface
        if (!$entity instanceof TimestampedInterface) {
            return;
        }
        //

        $entity->setCreatedAt(new \DateTime());

    }

    public function setEntityUpdatedAt(BeforeEntityUpdatedEvent $event): void
    {
        $entity = $event->getEntityInstance();
        // Retourne rien si l'entité n'est pas de l'instance TimestampedInterface
        if (!$event instanceof TimestampedInterface) {
            return;
        }

        $entity->setUpdatedAt(new \DateTime());

    }

}