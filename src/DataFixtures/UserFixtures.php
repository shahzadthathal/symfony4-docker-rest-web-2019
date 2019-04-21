<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
	private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
         $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    { 

        $user = new User();
        $user->setEmail('admin@app.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setFullName('Admin');
        $user->setCreatedAt(date("Y-m-d H:i:s"));

        $user->setPassword($this->passwordEncoder->encodePassword(
             $user,
             '123456'
         ));

        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('user@app.com');
        $user->setRoles(['ROLE_USER']);
        $user->setFullName('User');
        $user->setApiToken('xyz');
        $user->setCreatedAt(date("Y-m-d H:i:s"));

        $user->setPassword($this->passwordEncoder->encodePassword(
             $user,
             '123456'
         ));

        $manager->persist($user);
        $manager->flush();


        
    }
}
