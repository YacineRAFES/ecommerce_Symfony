<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Images;
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
        // Créer les catégories
        $categories = [];
        for ($i = 1; $i <= 5; $i++) {
            $category = new Category();
            $category->setName('Category ' . $i);

            $manager->persist($category);
            $categories[] = $category;
        }

        // Créer les produits
        for ($i = 1; $i <= 5; $i++) {
            // Choisir une catégorie aléatoire
            $category = $categories[array_rand($categories)];

            $product = new Product();
            $product->setName('Product ' . $i)
                    ->setPrice(mt_rand(10, 100))
                    ->setCreatedAt(new \DateTimeImmutable())
                    ->setCategory($category);

            // Créer une image pour ce produit
            $image = new Images();
            $image->setFile("LD0005921519_1.jpg");

            // Lier l'image au produit
            $product->setImage($image);
            $image->setProduct($product);

            $manager->persist($product);
            $manager->persist($image);
        }

        $manager->flush();
    }
}
