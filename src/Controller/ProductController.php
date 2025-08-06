<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

final class ProductController extends AbstractController
{
    #[Route('/product/{id}', name: 'product')]
    public function index(
        int $id,
        ProductRepository $productRepository
    ): Response
    {
        // Je récupère le produit depuis le ProductRepository
        $product = $productRepository->find($id);

        // Si le produit n'existe pas, on lance une exception
        if (!$product) {
            throw $this->createNotFoundException('Produit non trouvé');
        }

        return $this->render('product/product.html.twig', [
            'product' => $product
        ]);
    }
}
