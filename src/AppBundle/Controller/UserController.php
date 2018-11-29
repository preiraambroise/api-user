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
 * @Route("/user")
 * @Security("has_role('ROLE_USER')")
 */
class UserController extends Controller
{
    /**
     * @Rest\Post("/post_rapport")
     * @Rest\View(StatusCode=201)
     * @ParamConverter("rapport", converter="fos_rest.request_body")
     */
    public function CreateRapportAction(Rapport $rapport)
    {
        $rapport->setCreatedAt(new \Datetime());
        $current_user = $this->get('security.token_storage')->getToken()->getUser();
        $rapport->setUser($current_user);
        $em = $this->getDoctrine()->getManager();
        $em->persist($rapport);
        $em->flush();
        return $rapport;
    }
    
    /**
     * @Rest\Get(
     *          path="/rapports",
     * )
     * @Rest\View
     */
    public function ReadUserRapportsAction()
    {
        $repo = $this->getDoctrine()->getManager()->getRepository('AppBundle:Rapport');
        $listrapports = $repo->findBy(Array(
            'user' => $this->get('security.token_storage')->getToken()->getUser()
        ));
        return $listrapports;
    }
    
    /**
     * @Rest\Post(
     *          path="/change_password",
     * )
     * @Rest\View
     */
    public function UpdatePasswordAction(Request $rq)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user->setPassword($rq->request->get('password'));
        $em->flush();
    }
}
