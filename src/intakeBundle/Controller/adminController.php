<?php


namespace intakeBundle\Controller;

use intakeBundle\Entity\admin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;





class adminController extends Controller
{
    /**
     * Lists all customer entities.
     *
     * @Route("/admins", name="admins")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('intakeBundle:admin')->findAll();

        return $this->render('@intake/admin/index.html.twig', array(
            'user' => $users,
        ));
    }


    /**
     * Lists all invoice entities.
     *
     * @Route("/admins/{id}", name="role_action_admins")
     * @Method("GET")
     */
    public function roleAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        //Get the user with name admin
        $user= $em->getRepository("intakeBundle:admin")->find($id);

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
        $users = $em->getRepository('intakeBundle:admin.php')->findAll();

        return $this->render('@intake/admin/index.html.twig', array(
            'user' => $users,
        ));
    }

}