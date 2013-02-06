<?php

namespace Ziki\MusicBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ziki\MusicBundle\Entity\Track;
use Ziki\MusicBundle\Form\TrackType;

/**
 * Track controller.
 *
 * @Route("/track")
 */
class TrackController extends Controller
{
    /**
     * Lists all Track entities.
     *
     * @Route("/", name="track")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ZikiMusicBundle:Track')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Track entity.
     *
     * @Route("/{id}/show", name="track_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZikiMusicBundle:Track')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Track entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Track entity.
     *
     * @Route("/new", name="track_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Track();
        $form   = $this->createForm(new TrackType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Track entity.
     *
     * @Route("/create", name="track_create")
     * @Method("POST")
     * @Template("ZikiMusicBundle:Track:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Track();
        $form = $this->createForm(new TrackType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('track_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Track entity.
     *
     * @Route("/{id}/edit", name="track_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZikiMusicBundle:Track')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Track entity.');
        }

        $editForm = $this->createForm(new TrackType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Track entity.
     *
     * @Route("/{id}/update", name="track_update")
     * @Method("POST")
     * @Template("ZikiMusicBundle:Track:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZikiMusicBundle:Track')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Track entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TrackType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('track_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Track entity.
     *
     * @Route("/{id}/delete", name="track_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZikiMusicBundle:Track')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Track entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('track'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
