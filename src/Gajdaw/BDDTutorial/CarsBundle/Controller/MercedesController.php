<?php

namespace Gajdaw\BDDTutorial\CarsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gajdaw\BDDTutorial\CarsBundle\Entity\Mercedes;
use Gajdaw\BDDTutorial\CarsBundle\Form\MercedesType;

/**
 * Mercedes controller.
 *
 * @Route("/admin/mercedes")
 */
class MercedesController extends Controller
{

    /**
     * Lists all Mercedes entities.
     *
     * @Route("/", name="admin_mercedes")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GajdawBDDTutorialCarsBundle:Mercedes')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Mercedes entity.
     *
     * @Route("/", name="admin_mercedes_create")
     * @Method("POST")
     * @Template("GajdawBDDTutorialCarsBundle:Mercedes:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Mercedes();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_mercedes_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Mercedes entity.
     *
     * @param Mercedes $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Mercedes $entity)
    {
        $form = $this->createForm(new MercedesType(), $entity, array(
            'action' => $this->generateUrl('admin_mercedes_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Mercedes entity.
     *
     * @Route("/new", name="admin_mercedes_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Mercedes();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Mercedes entity.
     *
     * @Route("/{id}", name="admin_mercedes_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawBDDTutorialCarsBundle:Mercedes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mercedes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Mercedes entity.
     *
     * @Route("/{id}/edit", name="admin_mercedes_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawBDDTutorialCarsBundle:Mercedes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mercedes entity.');
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
    * Creates a form to edit a Mercedes entity.
    *
    * @param Mercedes $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Mercedes $entity)
    {
        $form = $this->createForm(new MercedesType(), $entity, array(
            'action' => $this->generateUrl('admin_mercedes_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Mercedes entity.
     *
     * @Route("/{id}", name="admin_mercedes_update")
     * @Method("PUT")
     * @Template("GajdawBDDTutorialCarsBundle:Mercedes:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawBDDTutorialCarsBundle:Mercedes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mercedes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_mercedes_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Mercedes entity.
     *
     * @Route("/{id}", name="admin_mercedes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GajdawBDDTutorialCarsBundle:Mercedes')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Mercedes entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_mercedes'));
    }

    /**
     * Creates a form to delete a Mercedes entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_mercedes_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
