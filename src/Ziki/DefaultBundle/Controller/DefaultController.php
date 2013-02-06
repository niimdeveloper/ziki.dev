<?php

namespace Ziki\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Artist controller.
 *
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ZikiMusicBundle:Artist')->findLatest();  //limit to x

        $albums = $em->getRepository('ZikiMusicBundle:Album')->findAll();

        return array(
            'artists' => $entities,
            'albums'  => $albums
        );
    }

    /**
     * @Route("/about", name="about")
     * @Template()
     */
    public function aboutAction()
    {
//        $em = $this->getDoctrine()->getManager();
//
//        $entities = $em->getRepository('ZikiMusicBundle:Artist')->findAll();
//
        return array(
            'page' => 'homepage',
        );
    }
}
