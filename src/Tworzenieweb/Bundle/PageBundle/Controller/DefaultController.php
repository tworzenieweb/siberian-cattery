<?php

namespace Tworzenieweb\Bundle\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TworzeniewebPageBundle:Default:index.html.twig');
    }
}
