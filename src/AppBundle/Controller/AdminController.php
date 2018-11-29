<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Rapport;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/admin")
 * @Security("has_role('ROLE_ADMIN')")
 */
class AdminController extends Controller
{
   //CRUD USERS
   /**
    * @Rest\Post("/post_user")
    * @Rest\View(StatusCode=201)
    * @ParamConverter("user", converter="fos_rest.request_body")
    */
   public function CreateUserAction(User $user)
   {
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return $user;
   }
   
   /**
     * @Rest\Get(
     *          path="/users"
     * )
     * @Rest\View
     */
    public function ReadUsersAction()
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('AppBundle:User');
        $listusers = $repo->findAll();
        return $listusers;
    }
    
   /**
    * @Rest\Post("/user/{id}")
    * @Rest\View()
    * @ParamConverter("user", converter="fos_rest.request_body")
    */
   public function UpdateUserAction(User $user, $id)
   {
        $em = $this->getDoctrine()->getManager();
        $user_id = $em->getRepository('AppBundle:User')->find($id);
        
        if ($user->getUsername() != null)
        {
            $user_id->setUsername($user->getUsername());
        }
        if ($user->getPassword() != null)
        {
            $user_id->setPassword($user->getPassword());
        }
        $em->flush();
        return $user_id;
   }
   
   /**
    * @Rest\Get("/user/{id}")
    * @Rest\View()
    */
    public function ReadUserById(User $user)
    {
         return $user;
    }

   /**
    * @Rest\Get("/user/delete/{id}")
    * @Rest\View()
    */
   public function DeleteUserAction(User $user)
   {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute('app_admin_readusers');
   }
   
   //CRUD RAPPORTS
   /**
    * @Rest\Post("/post_rapport")
    * @Rest\View(StatusCode=201)
    * @ParamConverter("rapport", converter="fos_rest.request_body")
    */
   public function CreateRapportAction(Rapport $rapport)
   {
        $em = $this->getDoctrine()->getManager();
        $em->persist($rapport);
        $em->flush();
        return $rapport;
   }
   
   /**
     * @Rest\Get(
     *          path="/rapports"
     * )
     * @Rest\View
     */
    public function ReadAllRapportsAction()
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('AppBundle:Rapport');
        $listrapports = $repo->findAll();
        return $listrapports;
    }
    
   /**
    * @Rest\Post("/rapport/{id}")
    * @Rest\View()
    * @ParamConverter("rapport", converter="fos_rest.request_body")
    */
   public function UpdateRapportAction(Rapport $rapport, $id)
   {
        $em = $this->getDoctrine()->getManager();
        $rapport_id = $em->getRepository('AppBundle:Rapport')->find($id);
        
        if ($rapport->getCodeChantier() != null)
        {
            $rapport_id->setCodeChantier($rapport->getCodeChantier());
        }
        if ($rapport->getCommentaire() != null)
        {
            $rapport_id->setCommentaire($rapport->getCommentaire());
        }
        $em->flush();
        return $rapport_id;
   }
   
   /**
    * @Rest\Get("/rapport/delete/{id}")
    * @Rest\View()
    */
   public function DeleteRapportAction(Rapport $rapport)
   {
        $em = $this->getDoctrine()->getManager();
        $em->remove($rapport);
        $em->flush();
        return $this->redirectToRoute('api_work_admin_readallrapports');
   }
}
