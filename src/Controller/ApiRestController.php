<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApiRestController extends Controller
{
    /**
     * @Route("/api/rest", name="api_rest")
     */
    public function index()
    {
        return $this->render('api_rest/index.html.twig', [
            'controller_name' => 'ApiRestController',
        ]);
    }

    /**
    * Show the form for creating a new resource
    * GET /posts/create
    * @return Reponse
    */
    public function create()
    {

    }

    /**
    * Store a newky created ressource in storage
    * POSTS /POSTS
    * @return Response
    */
    public function store()
    {

    }

    /**
    * Display the specified resource
    * GET /post/{id}
    * @param int $id
    * @return Response
    */
    public function show($id)
    {

    }

    /**
    * Show the form editinf the specified ressource
    * GET /post/{id}/edit
    * @param int $id
    * @return Response
    */
    public function edit($id)
    {

    }

    /**
    * Update the specified ressource in storage
    * PUT /posts/{id}
    * @param int $id
    * @return Response
    */
    public function update($id)
    {

    }

    /**
    * Remove the specified ressource in storage
    * DELETE /posts/{id}
    * @param int $id
    * @return Response
    */
    public function destroy($id)
    {

    }
}

// curl --header 'Access-Token: o.j87DCMVyxiDqiReTTsxodcqYMzmWWMV' \      https://api.pushbullet.com/v2/users/me
