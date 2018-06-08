<?php


namespace webshopBundle\Controller;

use webshopBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;





class userController extends Controller
{
    /**
     * Lists all customer entities.
     *
     * @Route("/users", name="users")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('webshopBundle:User')->findAll();

        return $this->render('@webshop/users/index.html.twig', array(
            'users' => $users,
        ));
    }


    /**
     * Lists all invoice entities.
     *
     * @Route("/{id}", name="role_action")
     * @Method("GET")
     */
    public function roleAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        //Get the user with name admin
        $user= $em->getRepository("webshopBundle:User")->find($id);

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
        $users = $em->getRepository('webshopBundle:User')->findAll();

        return $this->render('@webshop/users/index.html.twig', array(
            'users' => $users,
        ));
    }

}