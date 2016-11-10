<?php

namespace GeoBundle\Controller;

use GeoBundle\Entity\Location;
use GeoBundle\Entity\Tour;
use GeoBundle\Repository\DefaultRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tour controller.
 *
 */
class TourController extends Controller
{
    public function randomAction($type, $n)
    {
        $em = $this->getDoctrine()->getManager();
        if ($type=='ALL')
            {
            $allloc = $em->getRepository('GeoBundle:Location')->findAll();
            }
            else
            {
                $allloc = $em->getRepository('GeoBundle:Location')->findBy(
                    array('type' => $type),
                    array('id' => 'asc'),
                    5000,
                    0
                );
            };
        $keys = array_rand($allloc, $n);
        $selloc = [];
        $i=0;
        foreach($keys as $key) {
            $selloc[$i] = $allloc[$key];
            $i++;
        }

        $coordo = [];
        $j=0;
        foreach($selloc as $sellocs ){
            $coordo[$j]['longitude']= $sellocs->longitude;
            $coordo[$j]['latitude']= $sellocs->latitude;

            $j++;
        }
        return $this->render('tour/random.html.twig', array(
            'allloc' => $selloc,
            'coordo' => $coordo,
        ));
    }

    public function currenttourAction($tour1, $tour2, $tour3, $tour4, $tour5)
    {
        $em = $this->getDoctrine()->getManager();
        $use = $this->container->get('security.context')->getToken()->getUser();
        $use->setCurrent1 = $tour1;
        $use->setCurrent2 = $tour2;
        $use->setCurrent3 = $tour3;
        $use->setCurrent4 = $tour4;
        $use->setCurrent5 = $tour5;

        return $this->render('default/index.html.twig', array(
    ));

    }
    /**
     * Lists all tour entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tours = $em->getRepository('GeoBundle:Tour')->findAll();

        $selloc = [];
        $i=0;
        foreach($tours as $tour) {
            $selloc[$i] = $tour->name;
            $i++;
        };
        $j=0;
        foreach($selloc as $sello ) {
            $recup = $em->getRepository('GeoBundle:Location')->findBy(
                array('name' => $sello)
            );
            $localisation[$j] = new Location();
            $localisation[$j]->setType($recup['type']);
            $localisation[$j]->setTypeDetail($recup->type_detail);
            $localisation[$j]->setName($recup->nom);
            $localisation[$j]->setAddress($recup->adresse);
            $localisation[$j]->setPostalcode($recup->codepostal);
            $localisation[$j]->setTown($recup->commune);
            $localisation[$j]->setPhone($recup->telephone);
            $localisation[$j]->setMail($recup->email);
            $localisation[$j]->setWebsite($recup->siteweb);
            $localisation[$j]->setFacebook($recup->facebook);
            $localisation[$j]->setRank($recup->classement);
            $localisation[$j]->setOpenhour($recup->ouverture);
            $localisation[$j]->setRateclear($recup->tarifsenclair);
            $localisation[$j]->setMinrate($recup->tarifsmin);
            $localisation[$j]->setMaxrate($recup->tarifsmax);
            $localisation[$j]->setProducer($recup->producteur);
            $localisation[$j]->setLatitude($recup->coordinates[1]);
            $localisation[$j]->setLongitude($recup->coordinates[0]);
            $j++;
        }

#        $coordo = [];
 #       $j=0;
  #      foreach($selloc as $sellocs ){
   #         $coordo[$j]['longitude']= $sellocs->longitude;
    #        $coordo[$j]['latitude']= $sellocs->latitude;

     #       $j++;

       # return $this->render('tour/random.html.twig', array(
        #    'allloc' => $selloc,
         #   'coordo' => $coordo,
       # ))

        return $this->render('tour/index.html.twig', array(
            'tours' => $tours,
            'local' => $localisation
        ));
    }

    /**
     * Creates a new tour entity.
     *
     */
    public function newAction(Request $request)
    {
        $tour = new Tour();
        $form = $this->createForm('GeoBundle\Form\TourType', $tour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tour);
            $em->flush();

            return $this->redirectToRoute('tour_show', array('id' => $tour->getId()));
        }

        return $this->render('tour/new.html.twig', array(
            'tour' => $tour,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tour entity.
     *
     */
    public function showAction(Tour $tour)
    {
        $deleteForm = $this->createDeleteForm($tour);

        return $this->render('tour/show.html.twig', array(
            'tour' => $tour,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tour entity.
     *
     */
    public function editAction(Request $request, Tour $tour)
    {
        $deleteForm = $this->createDeleteForm($tour);
        $editForm = $this->createForm('GeoBundle\Form\TourType', $tour);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tour_edit', array('id' => $tour->getId()));
        }

        return $this->render('tour/edit.html.twig', array(
            'tour' => $tour,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tour entity.
     *
     */
    public function deleteAction(Request $request, Tour $tour)
    {
        $form = $this->createDeleteForm($tour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tour);
            $em->flush();
        }

        return $this->redirectToRoute('tour_index');
    }

    /**
     * Creates a form to delete a tour entity.
     *
     * @param Tour $tour The tour entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tour $tour)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tour_delete', array('id' => $tour->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
