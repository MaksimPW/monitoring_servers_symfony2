<?php
/**
 * Created by PhpStorm.
 * User: maksimpw
 * Date: 15.09.15
 * Time: 22:00
 */

namespace M4\MinecraftBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

use M4\MinecraftBundle\Entity\Mc_server;
use M4\MinecraftBundle\Entity\Donut;
use Doctrine\ORM\EntityRepository;



class DonutType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       //$id_user= $this->get('security.context')->getToken()->getUser()->getId();
        //$ems_select = $this->getDoctrine()->getEntityManager();
        //Задаем default values
        //$donut = new Donut();
       //$builder->setIdServer(1);
        //$builder->setSum(1);
        //$builder->setDate(new \DateTime);

        $id_user = $options['id_user'];

        //Создаем форму

        $builder->add('sum','integer', array('label' => 'Количество шариков','data' => $options['sum']))
            ->add('id_server', 'entity', array(
                'label' => 'Выберите ваш сервер',
                'attr' => array('class' => 'browser-default'),
                'required' => false,
                'class'  => 'M4MinecraftBundle:Mc_server',
                'query_builder' => function(EntityRepository $ems_select) use($id_user){
                    return $ems_select->createQueryBuilder('s')
                        ->where('s.id_user IN (:id_user)')
                        ->setParameter('id_user', $id_user);},
                'property'=> 'name'
            ))
            ->add('date', 'date', array('data' => $options['date']))
            ->getForm();

    }

    public function getName()
    {
        return 'donut';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
       /* $resolver->setIdServer(1);
        $resolver->setSum(1);
        $resolver->setDate(new \DateTime);
*/
        //$resolver->setDefined('id_user');
       // $date = $resolver->setDate(new \DateTime);

        $date = new \DateTime('tomorrow');
        $date = date_format($date, 'yyyy-MM-dd HH:mm:ss');
        $resolver->setDefaults(array(
            'data_class' => 'M4\MinecraftBundle\Entity\Donut',
            'id_user' => 0,
            'sum' => 1,
            'date' => $date,
        ));
    }


}