<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

// ...
use App\Entity\Product;

class ProductController extends Controller
{
    /**
     * @Route("/product", name="product")
     */
    public function index()
    {
     // you can fetch the EntityManager via $this->getDoctrine()
     // or you can add an argument to your action: index(EntityManagerInterface $em)
     $em = $this->getDoctrine()->getManager();

     $product = new Product();
     $product->setName('Keyboard');
     $product->setPrice(19.99);
     $product->setDescription('Ergonomic and stylish!');

     // tell Doctrine you want to (eventually) save the Product (no queries yet)
     $em->persist($product);

     // actually executes the queries (i.e. the INSERT query)
     $em->flush();

     return new Response('Saved new product with id '.$product->getId());
     }

    /**
    *@Route("/testPatate", name="testPatate")
    */
     public function test(){
            $em = $this->getDoctrine()->getManager();
            $test = new Product();
            $test->setName('uhbqermg');
            $test->setPrice(165);
            $test->setDescription('hvmjbùpmkn');

             $em->persist($test);
             $em->flush();

             $products = $this->getDoctrine()
             ->getRepository(Product::class)
             ->findAll();

             return $this->render("product/index.html.twig", array("products" => $products));
     }
}
