<?php

namespace Gajdaw\BDDTutorial\GeographyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gajdaw\BDDTutorial\GeographyBundle\Entity\Continent;
use Gajdaw\BDDTutorial\GeographyBundle\Form\ContinentType;

/**
 * Continent controller.
 *
 * @Route("/continent")
 */
class ContinentController extends Controller
{

    /**
     * Lists all Continent entities.
     *
     * @Route("/", name="continent")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GajdawBDDTutorialGeographyBundle:Continent')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Continent entity.
     *
     * @Route("/", name="continent_create")
     * @Method("POST")
     * @Template("GajdawBDDTutorialGeographyBundle:Continent:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Continent();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('continent_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Continent entity.
     *
     * @param Continent $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Continent $entity)
    {
        $form = $this->createForm(new ContinentType(), $entity, array(
            'action' => $this->generateUrl('continent_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Continent entity.
     *
     * @Route("/new", name="continent_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Continent();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Continent entity.
     *
     * @Route("/{id}", name="continent_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawBDDTutorialGeographyBundle:Continent')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Continent entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Continent entity.
     *
     * @Route("/{id}/edit", name="continent_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawBDDTutorialGeographyBundle:Continent')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Continent entity.');
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
    * Creates a form to edit a Continent entity.
    *
    * @param Continent $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Continent $entity)
    {
        $form = $this->createForm(new ContinentType(), $entity, array(
            'action' => $this->generateUrl('continent_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Continent entity.
     *
     * @Route("/{id}", name="continent_update")
     * @Method("PUT")
     * @Template("GajdawBDDTutorialGeographyBundle:Continent:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawBDDTutorialGeographyBundle:Continent')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Continent entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('continent_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Continent entity.
     *
     * @Route("/{id}", name="continent_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GajdawBDDTutorialGeographyBundle:Continent')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Continent entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('continent'));
    }

    /**
     * Creates a form to delete a Continent entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('continent_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
