<?php

namespace M4\MinecraftBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $name= 'name'; 
        return $this->render('M4MinecraftBundle:Default:index.html.twig', array('name' => $name));
    }
}
