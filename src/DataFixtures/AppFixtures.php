<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Category;
use App\Entity\Product;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Charger les utilisateurs
        // $user = (new User());
        // $user->setEmail('admin@mail.com')
        //     ->setPassword($this->passwordHasher->hashPassword($user, 'admin'))
        //     ->setRoles(['ROLE_ADMIN']);

        // $manager->persist($user);

        // // Charger les catégories
        // for ($i = 1; $i <= 5; $i++) {
        //     $category = (new Category());
        //     $category->setName('Category ' . $i);
        //     $manager->persist($category);
        // }

        // // Charger les produits (catégories_id 5 à 9, nom_produit, price, created_at)
        for ($i = 1; $i <= 5; $i++) {
            $product = (new Product());
            $product->set

        $manager->flush();

    }
}
