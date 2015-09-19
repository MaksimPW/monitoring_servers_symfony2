<?php

namespace M4\MinecraftBundle\Controller;

use M4\MinecraftBundle\Entity\Mc_server;
use M4\MinecraftBundle\Entity\Donut;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\DateTimeValidator;

use M4\MinecraftBundle\Form\DonutType;
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
            ->add('website','text', array('label' => 'Сайт'))
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

        $s = $this->getDoctrine()
            ->getRepository('M4MinecraftBundle:Mc_server')
            ->find($id);

        if (!$s) {
            throw $this->createNotFoundException('Такого сервера не существует '.$id);
        }

        return $this->render('M4MinecraftBundle:Default:server.html.twig', array('s'=>$s));
    }



    public function donutAction(Request $request){

        //Вызов формы
        $date_option = new \DateTime();
        $id_user= $this->get('security.context')->getToken()->getUser()->getId();
        $donut = new Donut();
        $form = $this->createForm(new DonutType(), $donut, array('id_user'=>$id_user, 'sum'=>1, 'date_option'=>$date_option));

            if ($request->getMethod() == 'POST') {
                $form->bind($request);

                if ($form->isValid()) {

                    // выполняем прочие действие, например, сохраняем задачу в базе данных donut
                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($donut);
                    $em->flush();

                    //Получаем значения для передачи в робокассу
                    //Номер заказа(номер записи в базе данных)

                    $inv_id= $donut->getId();

                    // регистрационная информация (логин, пароль #1)

                    $mrh_login = "*";
                    $mrh_pass1 = "*";

                    // описание заказа
                    $inv_desc = "Donut balls";

                    // сумма заказа
                    $curs_dollar = 70;
                    $out_summ = $_REQUEST['donut']['sum']*$curs_dollar;

                    // тип товара
                    // code of goods
                    $shp_item = 1;

                    // предлагаемая валюта платежа
                    // default payment e-currency
                    $in_curr = "";

                    // язык
                    // language
                    $culture = "ru";

                    // кодировка
                    // encoding
                    $encoding = "utf-8";

                    // формирование подписи
                    // generate signature
                    $crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item");


                    return $this->render('M4MinecraftBundle:Default:robokassa.html.twig', array(
                        'mrh_login' => $mrh_login, 'out_summ' => $out_summ, 'inv_id' => $inv_id, 'in_curr' => $in_curr, 'inv_desc' => $inv_desc, 'crc' => $crc, 'shp_item' => $shp_item, 'culture' => $culture, 'encoding' => $encoding,
                    ));

                    //Выводим и сохраняем в mc_server
        /*
                    $id_server = $form['id_server']->getData();
                    $add_balls = $form['sum']->getData();

                    $ems = $this->getDoctrine()->getEntityManager();
                    $dql = "UPDATE M4MinecraftBundle:Mc_server s SET s.balls = s.balls +  :add_balls WHERE s.id IN (:id_server)";
                    $query = $ems->createQuery($dql)
                        ->setParameters(array(
                            'add_balls' => $add_balls,
                            'id_server' => $id_server,
                        ));
                    $query->getResult();
                    return $this->redirect($this->generateUrl('m4_minecraft_homepage'));
          */
                }
            }

        return $this->render('M4MinecraftBundle:Default:donut.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function resultAction(){
        //$out_summ=nOutSum
        //$inv_id =nInvId
        //$crc=sSignatureValue
        //$shp_login=Vasya
        //$shp_oplata=1

        $inv_id = $_REQUEST['inv_id'];
        $out_summ= $_REQUEST['out_summ'];
        $crc = $_REQUEST['crc'];
        $shp_login= $_REQUEST['shp_login'];
        $shp_oplata= $_REQUEST['shp_oplata'];


    }

}

