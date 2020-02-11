<?php
//create_product.php
namespace Controllers;
use Entity\Product;
// create_product.php <name>

class ProductController extends Controller
{
  
 Private $EntityManager;
 
 /*public function __construct(EntityManager $EntityManager)
 {  
   $this->EntityManager = $EntityManager;
 }*/
 public function list($request)
    {
      
      $productRepository = $request->getEm()->getRepository('Entity\Product');
      $products = $productRepository->findAll();
      echo $this->twig->render('list.html',
        [
          "products" => $products,
          "nbProducts" => count($products)
        ]
      );
    }
 
 /*public function create()
 {
    $newProductName = $argv[1];

    $product = new Product();
    $product->setName($newProductName);

    $entityManager->persist($product);
    $entityManager->flush();

    echo "Created Product with ID " . $product->getId() . "\n";
 }*/
}
