<?php

namespace App\DataFixtures;

use App\Entity\Personnality;
use App\Entity\User;
use App\Entity\Villager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->passwordHasher = $userPasswordHasher;
    }
    
    public function load(ObjectManager $manager): void
    {
        $users = [
            'admin' => [
                'email' => 'admin@gmail.fr',
                'password' => 'adminadmin',
            ],
            'mathilde' => [
                'email' => 'mathilde@gmail.fr',
                'password' => 'mathildee',
            ]
        ];
        $personnalities = ['Cranky', 'Jock', 'Lazy', 'Normal', 'Peppy', 'Smug', 'Snooty', 'Sisterly', 'Special'];
        $villagers = [
            'Anchovy' => [
                'type' => 'Bird',
                'ugliness' => 2,
                'personnality' => 'Lazy',
                'image' => 'anchovy.png',
            ],
            'Barold' => [
                'type' => 'Bear',
                'ugliness' => 5,
                'personnality' => 'Lazy',
                'image' => 'barold.png',
            ],
            'Biskit' => [
                'type' => 'Dog',
                'ugliness' => 4,
                'personnality' => 'Lazy',
                'image' => 'biskit.png',
            ],
            'Jitters' => [
                'type' => 'Bird',
                'ugliness' => 4,
                'personnality' => 'Jock',
                'image' => 'jitters.png',
            ],
            'Pietro' => [
                'type' => 'Sheep',
                'ugliness' => 5,
                'personnality' => 'Smug',
                'image' => 'pietro.png',
            ],
            'Resetti' => [
                'type' => 'Mole',
                'ugliness' => 2,
                'personnality' => 'Special',
                'image' => 'resetti.png',
            ],
            'Ricky' => [
                'type' => 'Squirrel',
                'ugliness' => 3,
                'personnality' => 'Cranky',
                'image' => 'ricky.png',
            ],
            'Rodney' => [
                'type' => 'Hamster',
                'ugliness' => 1,
                'personnality' => 'Smug',
                'image' => 'rodney.png',
            ],
            'Tabby' => [
                'type' => 'Cat',
                'ugliness' => 4,
                'personnality' => 'Peppy',
                'image' => 'tabby.png',
            ],
        ];

        foreach ($users as $username => $user) {
            $dbUser = new User();
            $dbUser->setUsername($username);
            $dbUser->setEmail($user['email']);
            $dbUser->setPassword($user['password']);
            $dbUser->setPassword(
                $this->passwordHasher->hashPassword(
                    $dbUser,
                    $user['password']
                )
            );
            if ($username === 'admin') {
                $dbUser->setRoles(['ROLE_ADMIN']);
            }
            $manager->persist($dbUser);
            $this->addReference($username, $dbUser);
        }

        foreach ($personnalities as $perso) {
            $personnality = new Personnality();
            $personnality->setName($perso);
            $manager->persist($personnality);
            $this->addReference($perso, $personnality);
        }

        foreach ($villagers as $name => $villager) {
            $dbVillager = new Villager();
            $dbVillager->setName($name);
            $dbVillager->setType($villager['type']);
            $dbVillager->setUgliness($villager['ugliness']);
            $dbVillager->setPersonnality($this->getReference($villager['personnality']));
            $dbVillager->setImageUrl($villager['image']);

            $manager->persist($dbVillager);
            $this->addReference($name, $dbVillager);
        }

        $manager->flush();
    }
}
