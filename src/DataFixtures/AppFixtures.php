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
        // Charger les utilisateurs
        // $user = (new User());
        // $user->setEmail('admin@mail.com')
        //     ->setPassword($this->passwordHasher->hashPassword($user, 'admin'))
        //     ->setRoles(['ROLE_ADMIN']);

        // $manager->persist($user);

        // Charger les catégories
        $categories = [];
        for ($i = 1; $i <= 5; $i++) {
            $category = (new Category());
            $category->setName('Category ' . $i);

            $manager->persist($category);
            $categories[] = $category;
        }

        // Charger les produits
        for ($i = 1; $i <= 5; $i++) {
            $product = (new Product());
            $product->setName('Product ' . $i)
                ->setPrice(mt_rand(10, 100))
                ->setCreatedAt(new \DateTimeImmutable())
                ->setCategory($categories[array_rand($categories)]);

            $manager->persist($product);
            $products[] = $product;
        }

        //Charger les images
        for ($i = 1; $i <= 5; $i++){
            $image = (new Images());
            $image->setFile('LD0005921519_1.jpg')
                ->setProduct($products[array_rand($products)])
                ->setMain(1);
        
            $manager->persist($image);
        }
        $manager->flush();

    }
}
