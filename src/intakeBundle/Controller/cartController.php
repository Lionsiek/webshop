<?php
/**
 * Created by PhpStorm.
 * admin: lions
 * Date: 7-6-2018
 * Time: 13:06
 */

namespace Tests\intakeBundle\Controller;
namespace intakeBundle\Controller;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use intakeBundle\Entity\appointment;
use intakeBundle\Entity\admin;


/**
 * Cart controller.
 *
 * @Route("cart")
 */
class cartController extends Controller
{



    /**
     * @Route("/", name="cart")
     */
    public function indexAction()
    {
        // get the cartController from  the session
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();
        // $cartController = $session->set('cartController', '');
        $cart = $session->get('cartController', array());
        // $cartController = array_keys($cartController);
        // print_r($cartController); die;
        // fetch the information using query and ids in the cartController
        if ($cart != '') {
            if (isset($cart)) {
                $em = $this->getDoctrine()->getEntityManager();
                $product = $em->getRepository('intakeBundle:appointment')->findAll();
            } else {
                return $this->render('@intake/cart/index.html.twig', array(
                    'empty' => true,
                ));
            }
            return $this->render('@intake/cart/index.html.twig', array(
                'empty' => false,
                'product' => $product,
            ));
        } else {
            return $this->render('@intake/cart/index.html.twig', array(
                'empty' => true,
            ));
        }
    }
    /**
     * @Route("/add/{id}", name="cart_add")
     */
    public function addAction($id)
    {
        // fetch the cartController
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('appointment.php')->find($id);
        //print_r($product->getId()); die;
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();
        $cart = $session->get('cartController', array());
        // check if the $id already exists in it.
        if ($product == NULL) {
            $this->get('session')->setFlash('notice', 'This product is not     available in Stores');
            return $this->redirect($this->generateUrl('cart'));
        } else {
            if (isset($cart[$id])) {
                ++$cart[$id];
                /*  $qtyAvailable = $product->getQuantity();
                  if ($qtyAvailable >= $cartController[$id]['quantity'] + 1) {
                      $cartController[$id]['quantity'] = $cartController[$id]['quantity'] + 1;
                  } else {
                      $this->get('session')->setFlash('notice', 'Quantity     exceeds the available stock');
                      return $this->redirect($this->generateUrl('cartController'));
                  } */
            } else {
                // if it doesnt make it 1
                $cart[$id] = 1;
                //$cartController[$id]['quantity'] = 1;
            }
            $session->set('cartController', $cart);
            //echo('<pre>');
            //print_r($cartController); echo ('</pre>');die();
            return $this->redirect($this->generateUrl('cart'));
        }
    }
    /**
     * @Route("/checkout", name="checkout")
     */
    public function checkoutAction()
    {
        // verwerken van regels in de nieuwe factuur voor de huidige klant.
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();
        // $cartController = $session->set('cartController', '');
        $cart = $session->get('cartController', array());
        // aanmaken factuur regel.
        $em = $this->getDoctrine()->getManager();
        $userAdress = $em->getRepository('AppBundle:User')->findOneBy(array('id' => $this->getUser()->getId()));
        // new UserAdress if no UserAdress found...
        if (!$userAdress) {
            $userAdress = new User();
            $userAdress->setId($this->getUser()->getId());
        }
        $factuur = new Factuur();
        $factuur->setdate(new \DateTime("now"));
        $factuur->setuserId($this->getUser());
        //var_dump($cartController);
        // vullen regels met orderregels.
        // put invoice in dbase.
        if (isset($cart)) {
            // $data = $this->get('request_stack')->getCurrentRequest()->request->all();
            $em->persist($factuur);
            $em->flush();
            // put basket in dbase
            foreach ($cart as $id => $quantity) {
                $regel = new Regel();
                $regel->setFactuurId($factuur);
                $em = $this->getDoctrine()->getManager();
                $products = $em->getRepository('appointment.php')->find($id);
                $regel->setAantal($quantity);
                $regel->setProductId($products);
                $em = $this->getDoctrine()->getManager();
                $em->persist($regel);
                $em->flush();
            }
        }
        $session->clear();
        return $this->redirectToRoute('factuur_index');
    }
    /**
     * @Route("/remove/{id}", name="cart_remove")
     */
    public function removeAction($id)
    {
        // check the cartController
        $session = $this->get('request_stack')->getCurrentRequest()->getSession();
        $cart = $session->get('cartController', array());
        // if it doesn't exist redirect to cartController index page. end
        if(!$cart[$id]) { $this->redirect( $this->generateUrl('cart') ); }
        // check if the $id already exists in it.
        if( isset($cart[$id]) ) {
            $cart[$id] = $cart[$id] - 1;
            if ($cart[$id] < 1) {
                unset($cart[$id]);
            }
        } else {
            return $this->redirect( $this->generateUrl('cart') );
        }
        $session->set('cartController', $cart);
        //echo('<pre>');
        //print_r($cartController); echo ('</pre>');die();
        return $this->redirect( $this->generateUrl('cart') );
    }
}