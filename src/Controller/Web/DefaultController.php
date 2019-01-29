<?php

namespace App\Controller\Web;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {

        return new Response(
            '<html><body>Home</body></html>'
        );
    }

}