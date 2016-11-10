<?php

namespace GeoBundle\Controller;

use GeoBundle\Entity\Location;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GeoBundle:Default:index.html.twig');
    }

    public function loadentityAction()
    {
        $recup=file_get_contents($this->get('kernel')->getRootDir()."/../web/lyondata.json");
        $data = json_decode($recup, true);
        $sites = $data["features"];
        $em = $this->getDoctrine()->getManager();
        foreach ($sites as $site) {
            $localisation = new Location();
            $localisation->setType($site['properties']['type']);
            $localisation->setTypeDetail($site['properties']['type_detail']);
            $localisation->setName($site['properties']['nom']);
            $localisation->setAddress($site['properties']['adresse']);
            $localisation->setPostalcode($site['properties']['codepostal']);
            $localisation->setTown($site['properties']['commune']);
            $localisation->setPhone($site['properties']['telephone']);
            $localisation->setMail($site['properties']['email']);
            $localisation->setWebsite($site['properties']['siteweb']);
            $localisation->setFacebook($site['properties']['facebook']);
            $localisation->setRank($site['properties']['classement']);
            $localisation->setOpenhour($site['properties']['ouverture']);
            $localisation->setRateclear($site['properties']['tarifsenclair']);
            $localisation->setMinrate($site['properties']['tarifsmin']);
            $localisation->setMaxrate($site['properties']['tarifsmax']);
            $localisation->setProducer($site['properties']['producteur']);
            $localisation->setLatitude($site['geometry']['coordinates'][1]);
            $localisation->setLongitude($site['geometry']['coordinates'][0]);

            $em->persist($localisation);
        }
            $em->flush();
            return $this->render('GeoBundle:Default:index.html.twig');

        }

    public function testmapAction()
    {
        return $this->render('GeoBundle:Default:test.html.twig');
    }
}
