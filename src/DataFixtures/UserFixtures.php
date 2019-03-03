<?php

namespace App\DataFixtures;

use Faker;
use Faker\Provider\Base;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends Fixture
{
  private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }


    public function load(ObjectManager $manager)
    {
      $faker = Faker\Factory::create('fr_FR');
      for ($i=0; $i < 10; $i++) {
        $user = new User();
        $user->setUsername($faker->lastName());
        $user->setRoles (array('ROLE_USER'));
        $user->setPassword($this->passwordEncoder->encodePassword(
          $user,
         'dentiste'
        ));
        $manager->persist($user);
      }
      $manager->flush();
    }
}
