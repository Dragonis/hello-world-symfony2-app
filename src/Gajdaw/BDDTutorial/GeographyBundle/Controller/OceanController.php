<?php

namespace Gajdaw\BDDTutorial\GeographyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gajdaw\BDDTutorial\GeographyBundle\Entity\Ocean;
use Gajdaw\BDDTutorial\GeographyBundle\Form\OceanType;

/**
 * Ocean controller.
 *
 * @Route("/ocean")
 */
class OceanController extends Controller
{

    /**
     * Lists all Ocean entities.
     *
     * @Route("/", name="ocean")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GajdawBDDTutorialGeographyBundle:Ocean')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Ocean entity.
     *
     * @Route("/", name="ocean_create")
     * @Method("POST")
     * @Template("GajdawBDDTutorialGeographyBundle:Ocean:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Ocean();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ocean_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Ocean entity.
     *
     * @param Ocean $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Ocean $entity)
    {
        $form = $this->createForm(new OceanType(), $entity, array(
            'action' => $this->generateUrl('ocean_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Ocean entity.
     *
     * @Route("/new", name="ocean_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Ocean();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Ocean entity.
     *
     * @Route("/{id}", name="ocean_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawBDDTutorialGeographyBundle:Ocean')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ocean entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Ocean entity.
     *
     * @Route("/{id}/edit", name="ocean_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawBDDTutorialGeographyBundle:Ocean')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ocean entity.');
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
    * Creates a form to edit a Ocean entity.
    *
    * @param Ocean $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Ocean $entity)
    {
        $form = $this->createForm(new OceanType(), $entity, array(
            'action' => $this->generateUrl('ocean_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Ocean entity.
     *
     * @Route("/{id}", name="ocean_update")
     * @Method("PUT")
     * @Template("GajdawBDDTutorialGeographyBundle:Ocean:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawBDDTutorialGeographyBundle:Ocean')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ocean entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ocean_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Ocean entity.
     *
     * @Route("/{id}", name="ocean_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GajdawBDDTutorialGeographyBundle:Ocean')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Ocean entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ocean'));
    }

    /**
     * Creates a form to delete a Ocean entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ocean_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
