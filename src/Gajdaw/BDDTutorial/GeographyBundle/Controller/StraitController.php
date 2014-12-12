<?php

namespace Gajdaw\BDDTutorial\GeographyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gajdaw\BDDTutorial\GeographyBundle\Entity\Strait;
use Gajdaw\BDDTutorial\GeographyBundle\Form\StraitType;

/**
 * Strait controller.
 *
 * @Route("/strait")
 */
class StraitController extends Controller
{

    /**
     * Lists all Strait entities.
     *
     * @Route("/", name="strait")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GajdawBDDTutorialGeographyBundle:Strait')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Strait entity.
     *
     * @Route("/", name="strait_create")
     * @Method("POST")
     * @Template("GajdawBDDTutorialGeographyBundle:Strait:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Strait();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('strait_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Strait entity.
     *
     * @param Strait $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Strait $entity)
    {
        $form = $this->createForm(new StraitType(), $entity, array(
            'action' => $this->generateUrl('strait_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Strait entity.
     *
     * @Route("/new", name="strait_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Strait();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Strait entity.
     *
     * @Route("/{id}", name="strait_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawBDDTutorialGeographyBundle:Strait')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Strait entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Strait entity.
     *
     * @Route("/{id}/edit", name="strait_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawBDDTutorialGeographyBundle:Strait')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Strait entity.');
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
    * Creates a form to edit a Strait entity.
    *
    * @param Strait $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Strait $entity)
    {
        $form = $this->createForm(new StraitType(), $entity, array(
            'action' => $this->generateUrl('strait_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Strait entity.
     *
     * @Route("/{id}", name="strait_update")
     * @Method("PUT")
     * @Template("GajdawBDDTutorialGeographyBundle:Strait:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawBDDTutorialGeographyBundle:Strait')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Strait entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('strait_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Strait entity.
     *
     * @Route("/{id}", name="strait_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GajdawBDDTutorialGeographyBundle:Strait')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Strait entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('strait'));
    }

    /**
     * Creates a form to delete a Strait entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('strait_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
