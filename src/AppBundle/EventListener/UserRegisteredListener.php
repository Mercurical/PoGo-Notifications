<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\Configuration;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserRegisteredListener implements EventSubscriberInterface
{
    /**
     * @var EntityManager
     */
    protected $em;

    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_COMPLETED => ['onUserCreation']
        );
    }

    public function onUserCreation(FilterUserResponseEvent $event)
    {
        $user = $event->getUser();
        $user->setRoles([User::ROLE_ADMIN]);

        $config = new Configuration();
        $config->setName('Basic Configuration');
        $config->setIsUsed(true);
        $config->setPokemonIDs('[]');
        $config->setSkypeUsername('');
        $config->setUser($user);

        $this->em->persist($user);
        $this->em->persist($config);

        $this->em->flush();
    }
}