<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class MainController
{
    public function index($name)
    {
        return new Response(sprintf('Hello %s !', $name));
    }
}

?>