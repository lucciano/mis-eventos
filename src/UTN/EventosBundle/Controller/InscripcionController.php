<?php

namespace UTN\EventosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use UTN\EventosBundle\Entity\Inscripcion;
use UTN\EventosBundle\Form\InscripcionType;

/**
 * Inscripcion controller.
 *
 */
class InscripcionController extends Controller
{
    /**
     * Lists all Inscripcion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UTNEventosBundle:Inscripcion')->findAll();

        return $this->render('UTNEventosBundle:Inscripcion:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Inscripcion entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Inscripcion();

        $form = $this->createForm(new InscripcionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('home'));
        }

        return $this->render('UTNEventosBundle:Inscripcion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Inscripcion entity.
     *
     */
    public function newAction(Request $request)
    {

        $entity = new Inscripcion();
        $evento_id = $request->get('evento');

        if($evento_id){
            $evento = $this->getDoctrine()->getRepository('UTNEventosBundle:Evento')
                ->findOneById($evento_id);
            $entity->setEvento($evento);
        }

        $form   = $this->createForm(new InscripcionType(), $entity);

        return $this->render('UTNEventosBundle:Inscripcion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Inscripcion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UTNEventosBundle:Inscripcion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inscripcion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UTNEventosBundle:Inscripcion:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Inscripcion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UTNEventosBundle:Inscripcion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inscripcion entity.');
        }

        $editForm = $this->createForm(new InscripcionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UTNEventosBundle:Inscripcion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Inscripcion entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UTNEventosBundle:Inscripcion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inscripcion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new InscripcionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('inscripcion_edit', array('id' => $id)));
        }

        return $this->render('UTNEventosBundle:Inscripcion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Inscripcion entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UTNEventosBundle:Inscripcion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Inscripcion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('inscripcion'));
    }

    /**
     * Creates a form to delete a Inscripcion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
