<?php

namespace GeoBundle\Controller;

use GeoBundle\Entity\Tour;
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

        $allloc = $em->getRepository('GeoBundle:Location')->findBy(
            array('type' => $type),
            array('id' => 'asc'),
            5000,
            0
        );
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

 #       $coord = [];
  #      $k=0;
   #     foreach($coordo as $coordos ){
    #        $coord[$k][1]= $coordos->1;
     #       $coord[$k][0]= $sellocs->latitude;

      #      $j++;
      #  }

        return $this->render('tour/random.html.twig', array(
            'allloc' => $selloc,
            'coordo' => $coordo,
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

        return $this->render('tour/index.html.twig', array(
            'tours' => $tours,
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
            $em->flush($tour);

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
            $em->flush($tour);
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
