<?php

/*
 * This file is part of the SymEdit package.
 *
 * (c) Craig Blanchette <craig.blanchette@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SymEdit\Bundle\UserBundle\EventListener;

use FOS\UserBundle\Model\UserManagerInterface;
use Sylius\Component\Resource\Event\ResourceEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * If you update a user's password and don't change anything else
 * the doctrine listeners won't be fired so we need to call this manually
 * just in case.
 */
class UpdatePasswordSubscriber implements EventSubscriberInterface
{
    protected $userManager;

    public function __construct(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    public function updateUser(ResourceEvent $event)
    {
        $user = $event->getSubject();

        $this->userManager->updateUser($user);
    }

    public static function getSubscribedEvents()
    {
        return array(
            'symedit.user.pre_update' => 'updateUser',
        );
    }
}
