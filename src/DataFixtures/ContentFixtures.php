<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Doctrine\ORM\EntityManager;

use App\Entity\Content;
use App\Entity\User;

class ContentFixtures extends Fixture
{


	
    public function load(ObjectManager $manager)
    { 

        $content = new Content();
        $content->setTitle('My first title');
        $content->setDescription('My first description');
        $content->setContent('My first content');
        $content->setEmail('user@app.com');
        $content->setUserId(2);
        $content->setStatus(1);
        $content->setCreatedAt(date("Y-m-d H:i:s"));
        $content->setUpdatedAt(date("Y-m-d H:i:s"));
       

        //$user = $manager->getRepository(User::class)->findOneById(1);
        //$content->setUser($user);
        $manager->persist($content);
        $manager->flush();


        $content = new Content();
        $content->setTitle('My first title');
        $content->setDescription('My first description');
        $content->setContent('My first content');
        $content->setEmail('user@app.com');
        $content->setUserId(2);
        $content->setCreatedAt(date("Y-m-d H:i:s"));
        $content->setUpdatedAt(date("Y-m-d H:i:s"));
        $manager->persist($content);
        $manager->flush();
       

        
    }
}
