<?php

namespace M4\MinecraftBundle\Controller;

use M4\MinecraftBundle\Entity\Mc_server;
use M4\MinecraftBundle\Entity\Donut;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    public function addAction(Request $request)
    {
        // создаём задачу и присваиваем ей некоторые начальные данные для примера
        $server = new Mc_server();
        $server->setName('NameServer');
        $server->setIp('127.0.0.1');
        $server->setVer(0);
        $server->setBalls(0);
        $server->setColor('white');
        $server->setRating(0);
        $server->setLocation('ru');

        $user = $this->getUser();
        $userId = $user->getId();
        $server->setIdUser($userId);

        $form = $this->createFormBuilder($server)
            ->add('name', 'text', array('label' => 'Название'))
            ->add('ip', 'text', array('label' => 'IP адресс'))
            ->add('ver', 'text', array('label' => 'Версия'))
            ->add('description','text', array('label' => 'Описание сервера'))
            ->add('website','url', array('label' => 'Сайт'))
            ->getForm();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {

                // выполняем прочие действие, например, сохраняем задачу в базе данных

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($server);
                $em->flush();

                return $this->redirect($this->generateUrl('m4_minecraft_homepage'));
            }
        }

        return $this->render('M4MinecraftBundle:Default:add.html.twig', array(
            'form' => $form->createView(),
        ));

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
            8 /*limit per page */
        );

        return $this->render('M4MinecraftBundle:Default:index.html.twig', array('pagination' => $pagination));
    }

    public function serverAction($id)
    {
        /*
        $em = $this->getDoctrine()->getEntityManager();
        $dql="SELECT m FROM M4MinecraftBundle:Mc_server m ORDER BY m.balls DESC";
        $query = $em->createQuery($dql);
        $mc_server = $query->getResult();
        */
        $s = $this->getDoctrine()
            ->getRepository('M4MinecraftBundle:Mc_server')
            ->find($id);

        if (!$s) {
            throw $this->createNotFoundException('Такого сервера не существует '.$id);
        }

        return $this->render('M4MinecraftBundle:Default:server.html.twig', array('s'=>$s));
    }

    public function donutAction(Request $request){

        $donut = new Donut();
        $donut->setIdServer(1);
        $donut->setSum(1);
        $donut->setDate(new \DateTime);

        $form = $this->createFormBuilder($donut)
            ->add('id_server', 'integer', array('label' => 'Сервер'))
            ->add('sum','integer', array('label' => 'Количество'))
            ->getForm();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {

                // выполняем прочие действие, например, сохраняем задачу в базе данных

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($donut);
                $em->flush();

                return $this->redirect($this->generateUrl('m4_minecraft_homepage'));
            }
        }



        return $this->render('M4MinecraftBundle:Default:donut.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
