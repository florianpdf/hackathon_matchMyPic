<?php

namespace GameBundle\Controller;

use GameBundle\Entity\Challenge;
use GameBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

/**
 * Challenge controller.
 *
 */
class ChallengeController extends Controller
{
    const PHOTO_MENEUR = 1;
    const PHOTO_MENEUR_TROUVEE = 2;
    const PHOTO_USER = 3;
    const PHOTO_USER_REJETEE = 4;
    const PHOTO_USER_VALIDEE = 5;

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
        $em = $this->getDoctrine()->getManager();
//        $user = new User();
//        $em->persist($user);
//        $challenge->addUser($user);
        $form = $this->createForm('GameBundle\Form\ChallengeType', $challenge);
        $form->remove('users');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user= $this->get('security.token_storage')->getToken()->getUser();

            $challenge->setUserCreateur($user);
            $challenge->setUserMeneur($user);
            $challenge->setDateCreate(new \DateTime());
            $em->persist($challenge);
            $em->flush($challenge);

            return $this->redirectToRoute('challenge_show', array('id' => $challenge->getId()));
        }

        return $this->render('GameBundle:challenge:new.html.twig', array(
            'challenge' => $challenge,
            'form' =>   $form->createView(),
        ));
    }

    /**
     * Finds and displays a challenge entity.
     *
     */
    public function showAction(Request $request, Challenge $challenge)
    {
        $em = $this->getDoctrine()->getManager();

        $user= $this->get('security.token_storage')->getToken()->getUser();

        $users = $em->getRepository('UserBundle:User')->findUserNotCreateur($challenge->getUserCreateur()->getId());
        


        if (isset($_POST['user'])) {
            var_dump($_POST);
        }

        return $this->render('GameBundle:challenge:show.html.twig', array(
            'challenge' => $challenge,
            'users' => $users,
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



    public function addImageMeneurAction(Challenge $challenge, Request $request)
    {
        $image = new Image();
        $form = $this->createForm('GameBundle\Form\ImageType', $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $user= $this->get('security.token_storage')->getToken()->getUser();

            $image->setDate(new \DateTime());
            $image->setType(self::PHOTO_MENEUR);
            $image->setValidee(null);
            $image->setUsers($user);
            $em->persist($image);
            $em->flush($image);

            return $this->redirectToRoute('challenge_show', array('id' => $challenge->getId()));
        }

        return $this->render('GameBundle:challenge:add_image_meneur.html.twig', array(
            'challenge' => $challenge,
            'image' => $image,
            'form' => $form->createView(),
        ));
    }
}
