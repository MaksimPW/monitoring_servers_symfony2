<?php

namespace M4\MinecraftBundle\Controller;

use M4\MinecraftBundle\Entity\Mc_server;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use M4\MinecraftBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    public function newAction()
    {
        // создаём задачу и присваиваем ей некоторые начальные данные для примера
        $server = new Mc_server();
        $server->setName('NameServer');
        $server->setIp('127.0.0.1');

        $form = $this->createFormBuilder($server)
            ->add('name', 'text')
            ->add('ip', 'text')
            ->getForm();

        return $this->render('M4MinecraftBundle:Default:lc.html.twig', array(
            'form' => $form->createView(),
        ));

    }


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
        $em = $this->getDoctrine()->getEntityManager();
        $dql="SELECT m FROM M4MinecraftBundle:Mc_server m ORDER BY m.balls DESC";
        $query = $em->createQuery($dql);
        //$mc_server = $query->getResult();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            6 /*limit per page */
        );

        return $this->render('M4MinecraftBundle:Default:index.html.twig', array('pagination' => $pagination));
    }

    public function lcAction()
    {
        return $this->render('M4MinecraftBundle:Default:lc.html.twig');
        //return new Response('Show Name: '.$product->getName());
    }

}
