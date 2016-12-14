<?php

namespace GameBundle\Controller;

use GameBundle\Entity\Challenge;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Challenge controller.
 *
 */
class ChallengeController extends Controller
{
    /**
     * Lists all challenge entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $challenges = $em->getRepository('GameBundle:Challenge')->findAll();

        return $this->render('GameBundle:challenge:index.html.twig', array(
            'challenges' => $challenges,
        ));
    }

    /**
     * Creates a new challenge entity.
     *
     */
    public function newAction(Request $request)
    {
        $challenge = new Challenge();
        $form = $this->createForm('GameBundle\Form\ChallengeType', $challenge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($challenge);
            $em->flush($challenge);

            return $this->redirectToRoute('challenge_show', array('id' => $challenge->getId()));
        }

        return $this->render('GameBundle:challenge:new.html.twig', array(
            'challenge' => $challenge,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a challenge entity.
     *
     */
    public function showAction(Challenge $challenge)
    {
        $deleteForm = $this->createDeleteForm($challenge);

        return $this->render('GameBundle:challenge:show.html.twig', array(
            'challenge' => $challenge,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing challenge entity.
     *
     */
    public function editAction(Request $request, Challenge $challenge)
    {
        $deleteForm = $this->createDeleteForm($challenge);
        $editForm = $this->createForm('GameBundle\Form\ChallengeType', $challenge);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('challenge_edit', array('id' => $challenge->getId()));
        }

        return $this->render('GameBundle:challenge:edit.html.twig', array(
            'challenge' => $challenge,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a challenge entity.
     *
     */
    public function deleteAction(Request $request, Challenge $challenge)
    {
        $form = $this->createDeleteForm($challenge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($challenge);
            $em->flush($challenge);
        }

        return $this->redirectToRoute('challenge_index');
    }

    /**
     * Creates a form to delete a challenge entity.
     *
     * @param Challenge $challenge The challenge entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Challenge $challenge)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('challenge_delete', array('id' => $challenge->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
