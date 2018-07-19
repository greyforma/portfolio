<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostsController extends Controller
{
    /**
     * @Route("/posts", name="posts")
     */
    public function index() /*RegistryInterface $doctrine*/
    {
/*        return $this->render('posts/index.html.twig', [
            'controller_name' => 'PostsController',
        ]);*/
/*        $posts = $doctrine->getRepository(Post::class)->findAll();
        return $this->render('posts/index.html.twig', compact('posts'));*/
    }
}
