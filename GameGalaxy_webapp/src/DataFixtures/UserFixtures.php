<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
    private $tokenGenerator;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder,TokenGeneratorInterface $tokenGenerator)
    {
    $this->passwordEncoder = $passwordEncoder;
    $this->tokenGenerator = $tokenGenerator;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
         $token = $this->tokenGenerator->generateToken();
       
    $password_hashed = $this->passwordEncoder->encodePassword($user,"user");
    $user->setPseudo("USER");
    $user->setRoles(['ROLE_USER']);
    $user->setEmail("user@gmail.com");
    $user->setAddresse("18rue10");


    $user->setPassword($password_hashed);
    $manager->persist($user);
    $manager->flush();
   
    } 
   
}
