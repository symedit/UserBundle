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

use FOS\UserBundle\Event\UserEvent;
use SymEdit\Bundle\CoreBundle\Util\SymEditMailerInterface;

class RegistrationListener
{
    protected $mailer;
    protected $template;

    public function __construct(SymEditMailerInterface $mailer, $template)
    {
        $this->mailer = $mailer;
        $this->template = $template;
    }

    public function sendNotification(UserEvent $event)
    {
        $this->mailer->sendAdmin($this->template, [
            'user' => $event->getUser(),
        ]);
    }
}
