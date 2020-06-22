<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;

class AdminController extends EasyAdminController
{
    protected function persistUserEntity($user)
    {
        // Deze functie gaat het wachtwoord op een correcte manier aanmaken
        // en toevoegen aan een user die nieuw wordt aangemaakt
        $encodedPassword = $this->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($encodedPassword);

        parent::persistEntity($user);
    }

    protected function updateUserEntity($user)
    {
        //Deze functie gaat het wachtwoord op een correcte manier aanmaken en
        //toevoegen aan een user die wordt geüpdatet
        $encodedPassword = $this->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($encodedPassword);

        parent::updateEntity($user);
    }

    private function encodePassword($user, $password)
    {
        //Deze functie zorgt voor de encryptie van het wachtwoord, zodat deze niet open en bloot te grabbelen
        //staat op de database
        $passwordEncoderFactory = new EncoderFactory([
            User::class => new MessageDigestPasswordEncoder('sha512', true, 5000)
        ]);

        $encoder = $passwordEncoderFactory->getEncoder($user);

        return $encoder->encodePassword($password, $user->getSalt());
    }
}