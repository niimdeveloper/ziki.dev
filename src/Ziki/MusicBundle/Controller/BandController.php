<?php

namespace Ziki\MusicBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ziki\MusicBundle\Entity\Band;
use Ziki\MusicBundle\Form\BandType;

/**
 * Band controller.
 *
 * @Route("/band")
 */
class BandController extends Controller
{
    /**
     * Lists all Band entities.
     *
     * @Route("/", name="band")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ZikiMusicBundle:Band')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Band entity.
     *
     * @Route("/{id}/show", name="band_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZikiMusicBundle:Band')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Band entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Band entity.
     *
     * @Route("/new", name="band_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Band();
        $form   = $this->createForm(new BandType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Band entity.
     *
     * @Route("/create", name="band_create")
     * @Method("POST")
     * @Template("ZikiMusicBundle:Band:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Band();
        $form = $this->createForm(new BandType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('band_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Band entity.
     *
     * @Route("/{id}/edit", name="band_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZikiMusicBundle:Band')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Band entity.');
        }

        $editForm = $this->createForm(new BandType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Band entity.
     *
     * @Route("/{id}/update", name="band_update")
     * @Method("POST")
     * @Template("ZikiMusicBundle:Band:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZikiMusicBundle:Band')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Band entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new BandType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('band_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Band entity.
     *
     * @Route("/{id}/delete", name="band_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZikiMusicBundle:Band')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Band entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('band'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
