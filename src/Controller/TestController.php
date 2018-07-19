<?php
// src/Controller/TestController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{

    /**
     * @Route("/test", name="test")
     */
     public function test()
     {
         return $this->render('test.html.twig', array()
     );
     }
 }
