<?php

declare(strict_types=1);

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class AddProductSetAction
{
    public function __invoke(Request $request): Response
    {
        return new Response();
    }
}
