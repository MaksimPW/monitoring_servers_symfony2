<?php

namespace M4\MinecraftBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use M4\MinecraftBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    public function createAction()
    {
        $product = new Product();
        $product->setName('A Foo Bar');
        $product->setPrice('19.99');
        $product->setDescription('Lorem ipsum dolor');

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($product);
        $em->flush();

        return new Response('Created product id '.$product->getId());
    }

    public function indexAction()
    {
        $name= 'name'; 
        return $this->render('M4MinecraftBundle:Default:index.html.twig', array('name' => $name));
    }

    public function showAction()
    {
        $product = $this->getDoctrine()
            ->getRepository('M4\MinecraftBundle\Entity\Product')
            ->findAll();



        return $this->render('M4MinecraftBundle:Default:index.html.twig', array('product' => $product));
        //return new Response('Show Name: '.$product->getName());
    }

}
