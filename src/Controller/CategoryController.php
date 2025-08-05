<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\ImagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    #[Route('/category/{id}', name: 'category')]
    public function index(
        int $id, 
        Request $request, 
        CategoryRepository $categoryRepository,
        ImagesRepository $imagesRepository
        ): Response
    {

        // Je récupère la catégorie depuis le CategoryRepository
        $category = $categoryRepository->find($id);

        // Si Elle n'existe pas, on lance une exception
        if (!$category) {
            throw $this->createNotFoundException('Catégorie non trouvée');
        }

        // Je récupère les produits liés à cette catégorie
        $products = $category->getProducts();
        $categories = $categoryRepository->findAll();

        // Tableaux des images principales indexées par ID de produit
        $mainImages = [];

        foreach ($products as $product) {
            $mainImage = $imagesRepository->findMainImageByProduct($product);
            $mainImages[$product->getId()] = $mainImage;
        }

        // Je rends la vue avec les produits
        return $this->render('category/show.html.twig', [
        'categories' => $categories,
        'category' => $category,
        'products' => $products,
        'mainImages' => $mainImages
        ]);
    }
}
