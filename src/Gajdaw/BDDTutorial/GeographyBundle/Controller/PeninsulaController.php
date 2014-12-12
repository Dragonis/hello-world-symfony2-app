<?php

namespace Gajdaw\BDDTutorial\GeographyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Gajdaw\BDDTutorial\GeographyBundle\Entity\Peninsula;
use Gajdaw\BDDTutorial\GeographyBundle\Form\PeninsulaType;

/**
 * Peninsula controller.
 *
 * @Route("/peninsula")
 */
class PeninsulaController extends Controller
{

    /**
     * Lists all Peninsula entities.
     *
     * @Route("/", name="peninsula")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GajdawBDDTutorialGeographyBundle:Peninsula')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Peninsula entity.
     *
     * @Route("/", name="peninsula_create")
     * @Method("POST")
     * @Template("GajdawBDDTutorialGeographyBundle:Peninsula:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Peninsula();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('peninsula_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Peninsula entity.
     *
     * @param Peninsula $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Peninsula $entity)
    {
        $form = $this->createForm(new PeninsulaType(), $entity, array(
            'action' => $this->generateUrl('peninsula_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Peninsula entity.
     *
     * @Route("/new", name="peninsula_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Peninsula();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Peninsula entity.
     *
     * @Route("/{id}", name="peninsula_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawBDDTutorialGeographyBundle:Peninsula')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Peninsula entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Peninsula entity.
     *
     * @Route("/{id}/edit", name="peninsula_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawBDDTutorialGeographyBundle:Peninsula')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Peninsula entity.');
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
    * Creates a form to edit a Peninsula entity.
    *
    * @param Peninsula $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Peninsula $entity)
    {
        $form = $this->createForm(new PeninsulaType(), $entity, array(
            'action' => $this->generateUrl('peninsula_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Peninsula entity.
     *
     * @Route("/{id}", name="peninsula_update")
     * @Method("PUT")
     * @Template("GajdawBDDTutorialGeographyBundle:Peninsula:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GajdawBDDTutorialGeographyBundle:Peninsula')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Peninsula entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('peninsula_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Peninsula entity.
     *
     * @Route("/{id}", name="peninsula_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GajdawBDDTutorialGeographyBundle:Peninsula')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Peninsula entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('peninsula'));
    }

    /**
     * Creates a form to delete a Peninsula entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('peninsula_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
