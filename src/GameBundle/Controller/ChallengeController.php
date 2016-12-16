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

    public function thumbnailAction(Challenge $challenge)
    {
        $em = $this->getDoctrine()->getManager();
        $image = $em->getRepository('GameBundle:Image')->findOneBy(array('challenge'=>$challenge, 'type'=>self::PHOTO_MENEUR));
        return $this->render('GameBundle:challenge:imageThumbnail.html.twig', array(
            'image' => $image,
        ));

    }

    /**
     * Creates a new challenge entity.
     *
     */
    public function newAction(Request $request)
    {
        $challenge = new Challenge();
        $challenge->setDuree(1);
        $challenge->setType('public');
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm('GameBundle\Form\ChallengeType', $challenge);
        $form->remove('users');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user= $this->get('security.token_storage')->getToken()->getUser();

            $challenge->setUserCreateur($user);
            $challenge->setUserMeneur($user);
            $challenge->setDateCreate(new \DateTime());
            $challenge->setEtat(false);
            $em->persist($challenge);
            $em->flush($challenge);

            if ($challenge->getType() == "private") {
                return $this->redirectToRoute('challenge_show', array('id' => $challenge->getId()));
            } else {
                return $this->redirectToRoute('challenge_add_image_meneur', array('id' => $challenge->getId()));
            }
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
    public function showAction(Challenge $challenge)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('UserBundle:User')->findUserNotCreateur($challenge->getUserCreateur()->getId());

        return $this->render('GameBundle:challenge:show.html.twig', array(
            'challenge' => $challenge,
            'users' => $users,
        ));
    }

    /**
     * Inscription des users sur un challenge privé
     *
     */
    public function inscriptionChallengeAction(Challenge $challenge){
        $em = $this->getDoctrine()->getManager();

        $users = $_REQUEST['user_id'];
        $participants = $em->getRepository('UserBundle:User')->findById($users);

        foreach ($participants as $participant){
            $challenge->addUser($participant);
            $participant->addChalenge($challenge);
            $em->persist($participant);
            $em->persist($challenge);
        }
        $em->flush();

        return $this->redirectToRoute('challenge_show', array('id' => $challenge->getId()));
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
            $challenge->setEtat(1);
            $em->persist($challenge);
            $image->setChallenge($challenge);
            $image->setDate(new \DateTime());
            $image->setType(self::PHOTO_MENEUR);
            $image->setValidee(null);
            $image->setUsers($user);
            $em->persist($image);
            $em->flush();

            return $this->redirectToRoute('challenge_show', array('id' => $challenge->getId()));
        }

        return $this->render('GameBundle:challenge:add_image_meneur.html.twig', array(
            'challenge' => $challenge,
            'image' => $image,
            'form' => $form->createView(),
        ));
    }


    public function challengeMeneurPasseAction(Challenge $challenge)
    {
        $em = $this->getDoctrine()->getManager();
       // requete pour recup des users appartenant au group et n'étant pas le meneur actuel
        $users = $em->getRepository('UserBundle:User')->findByChalenges($challenge);
        $meneur = $users[array_rand($users)];
        $challenge->setUserMeneur($meneur);

        $this->addFlash(
            'success',
            'Vous n\'êtes plus meneur!'
        );
        // service pour envoyer un mail et un push au new meneur
        // ...
        // ...

        return $this->redirectToRoute('challenge_index');

    }

    public function challengePublicInscriptionAction(Challenge $challenge)
    {
        $em = $this->getDoctrine()->getManager();

        $user= $this->get('security.token_storage')->getToken()->getUser();

        $challenge->addUser($user);
        $user->addChalenge($challenge);
        $em->persist($user);
        $em->persist($challenge);

        $em->flush();

        return $this->redirectToRoute('challenge_show', array('id' => $challenge->getId()));
    }

    public function challengeEnCoursAction()
    {
        $user= $this->get('security.token_storage')->getToken()->getUser();

        return $this->render('GameBundle:challenge:challenge_en_cours.html.twig', array(
            'user' => $user,
        ));
    }

    public function challengeDesinscriptionAction(Challenge $challenge)
    {
        $em = $this->getDoctrine()->getManager();

        $user= $this->get('security.token_storage')->getToken()->getUser();

        $challenge->removeUser($user);
        $user->removeChalenge($challenge);
        $em->persist($user);
        $em->persist($challenge);

        $em->flush();

        return $this->redirectToRoute('game_homepage');
    }
}
