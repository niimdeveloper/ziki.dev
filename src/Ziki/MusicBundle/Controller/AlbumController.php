<?php

namespace Ziki\MusicBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ziki\MusicBundle\Entity\Album;
use Ziki\MusicBundle\Form\AlbumType;

/**
 * Album controller.
 *
 * @Route("/album")
 */
class AlbumController extends Controller
{
    /**
     * Lists all Album entities.
     *
     * @Route("/", name="album")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ZikiMusicBundle:Album')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Album entity.
     *
     * @Route("/{id}/show", name="album_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZikiMusicBundle:Album')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Album entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Album entity.
     *
     * @Route("/new", name="album_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Album();
        $form   = $this->createForm(new AlbumType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Album entity.
     *
     * @Route("/create", name="album_create")
     * @Method("POST")
     * @Template("ZikiMusicBundle:Album:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Album();
        $form = $this->createForm(new AlbumType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('album_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Album entity.
     *
     * @Route("/{id}/edit", name="album_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZikiMusicBundle:Album')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Album entity.');
        }

        $editForm = $this->createForm(new AlbumType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Album entity.
     *
     * @Route("/{id}/update", name="album_update")
     * @Method("POST")
     * @Template("ZikiMusicBundle:Album:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZikiMusicBundle:Album')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Album entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AlbumType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('album_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Album entity.
     *
     * @Route("/{id}/delete", name="album_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZikiMusicBundle:Album')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Album entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('album'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
