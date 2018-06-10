<?php


namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;





class usersController extends Controller
{
    /**
     * Lists all customer entities.
     *
     * @Route("/user", name="user")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('@App/user/index.html.twig', array(
            'user' => $user,
        ));
    }


    /**
     * Lists all invoice entities.
     *
     * @Route("/admin/{id}", name="role_action_users")
     * @Method("GET")
     */
    public function roleAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        //Get the user with name admin
        $user= $em->getRepository("AppBundle:User")->find($id);

        if ($user) {
            if (in_array("ROLE_SUPER_ADMIN", $user->getRoles())  ) {
                $user->removeRole ("ROLE_SUPER_ADMIN");
            } else {
                //Set the admin role
                $user->addRole("ROLE_SUPER_ADMIN");
                //$user->removeRole("ROLE_USER");
            }
            //Save it to the database
            $em->persist ($user);
            $em->flush ();
        }
        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('@App/user/index.html.twig', array(
            'user' => $users,
        ));
    }

}