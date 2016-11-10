<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 10/11/16
 * Time: 10:00
 */

namespace GeoBundle\Repository;

use Doctrine\ORM\EntityRepository;


class DefaultRepository extends EntityRepository
{
    public function selectTourAction($tour)
    {
        $em = $this->getDoctrine()->getManager();
        $this->container->get('security.context')->getToken()->getUser();

        $user->setCurrent1 = $tour[$i][1];
        $user->setCurrent2 = $tour[$i][2];
        $user->setCurrent3 = $tour[$i][3];
        $user->setCurrent4 = $tour[$i][4];
        $user->setCurrent5 = $tour[$i][5];
        $user->setCurrent6 = $tour[$i][6];

        $em->persist($user);
        $em->flush();
    }
}