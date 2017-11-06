<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Box;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Box controller.
 *
 * @Route("box")
 * @Security("has_role('ROLE_MARKETING')")
 */
class BoxController extends Controller
{
    /**
     * Lists all box entities.
     *
     * @Route("/", name="box_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $boxes = $em->getRepository('AppBundle:Box')->findAll();

        return $this->render('box/index.html.twig', array(
            'boxes' => $boxes,
        ));
    }

    /**
     * Creates a new box entity.
     *
     * @Route("/new", name="box_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $box = new Box();
        $form = $this->createForm('AppBundle\Form\BoxType', $box);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $workflow = $this->get('workflow.box_publishing');
            $workflow->getMarking($box);
            //$box->setStatut('draft');
            $box->setCreatedAt(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($box);
            $em->flush();

            return $this->redirectToRoute('box_show', array('id' => $box->getId()));
        }

        return $this->render('box/new.html.twig', array(
            'box' => $box,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a box entity.
     *
     * @Route("/{id}", name="box_show")
     * @Method("GET")
     */
    public function showAction(Box $box)
    {
        $deleteForm = $this->createDeleteForm($box);

        return $this->render('box/show.html.twig', array(
            'box' => $box,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing box entity.
     *
     * @Route("/{id}/edit", name="box_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Box $box)
    {
        $deleteForm = $this->createDeleteForm($box);
        $editForm = $this->createForm('AppBundle\Form\BoxType', $box);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('box_edit', array('id' => $box->getId()));
        }

        return $this->render('box/edit.html.twig', array(
            'box' => $box,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a box entity.
     *
     * @Route("/{id}", name="box_delete")
     * @Method("DELETE")
     * @Security()
     */
    public function deleteAction(Request $request, Box $box)
    {
        $form = $this->createDeleteForm($box);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($box);
            $em->flush();
        }

        return $this->redirectToRoute('box_index');
    }

    /**
     * Creates a form to delete a box entity.
     *
     * @param Box $box The box entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Box $box)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('box_delete', array('id' => $box->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @Route("/to_review/{id}", name="box_to_review")
     */
    public function workflowToReviewAction(Request $request, ObjectManager $manager, $id)
    {
        $box = $manager->getRepository('AppBundle:Box')->find($id);
        $workflow = $this->get('workflow.box_publishing');
        if ($workflow->can($box, 'to_review')){
            $workflow->apply($box, 'to_review');
            $manager->flush();
        }
        return $this->redirectToRoute('box_show', ['id' => $box->getId()]);


    }
}
