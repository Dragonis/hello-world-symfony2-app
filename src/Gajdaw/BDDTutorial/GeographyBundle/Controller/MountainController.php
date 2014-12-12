<?php

namespace Gajdaw\BDDTutorial\GeographyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gajdaw\BDDTutorial\GeographyBundle\Entity\Mountain;
use Gajdaw\BDDTutorial\GeographyBundle\Form\MountainType;

/**
 * Mountain controller.
 *
 * @Route("/mountain")
 */
class MountainController extends Controller
{

    /**
     * Lists all Mountain entities.
     *
     * @Route("/", name="mountain")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GajdawBDDTutorialGeographyBundle:Mountain')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Mountain entity.
     *
     * @Route("/", name="mountain_create")
     * @Method("POST")
     * @Template("GajdawBDDTutorialGeographyBundle:Mountain:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Mountain();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('mountain_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Mountain entity.
     *
     * @param Mountain $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Mountain $entity)
    {
        $form = $this->createForm(new MountainType(), $entity, array(
            'action' => $this->generateUrl('mountain_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Mountain entity.
     *
     * @Route("/new", name="mountain_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Mountain();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Mountain entity.
     *
     * @Route("/{id}", name="mountain_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawBDDTutorialGeographyBundle:Mountain')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mountain entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Mountain entity.
     *
     * @Route("/{id}/edit", name="mountain_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawBDDTutorialGeographyBundle:Mountain')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mountain entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Mountain entity.
    *
    * @param Mountain $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Mountain $entity)
    {
        $form = $this->createForm(new MountainType(), $entity, array(
            'action' => $this->generateUrl('mountain_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Mountain entity.
     *
     * @Route("/{id}", name="mountain_update")
     * @Method("PUT")
     * @Template("GajdawBDDTutorialGeographyBundle:Mountain:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawBDDTutorialGeographyBundle:Mountain')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mountain entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('mountain_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Mountain entity.
     *
     * @Route("/{id}", name="mountain_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GajdawBDDTutorialGeographyBundle:Mountain')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Mountain entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('mountain'));
    }

    /**
     * Creates a form to delete a Mountain entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('mountain_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
