<?php
namespace webshopBundle\Controller;
use webshopBundle\Entity\Factuur;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use webshopBundle\Entity\products;
use webshopBundle\Entity\Regel;
use AppBundle\Entity\User;

/**
 * Factuur controller.
 *
 * @Route("factuur")
 */
class FactuurController extends Controller
{
    /**
     * Lists all factuur entities.
     *
     * @Route("/", name="factuur_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $invoices = $em->getRepository('webshopBundle:Factuur')->findAll();
        } else {
            $invoices = $em->getRepository('webshopBundle:Factuur')->findBy(['userId' => $this->getUser()]);
        }
        return $this->render('webshopBundle:invoice:index.html.twig', array(
            'factuurs' => $invoices,
        ));
    }
    /**
     * Creates a new factuur entity.
     *
     * @Route("/new", name="factuur_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $invoice = new Factuur();
        $invoice->setdate(new \DateTime("now"));
        $form = $this->createForm('webshopBundle\Form\FactuurType', $invoice);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($invoice);
            $em->flush();
            return $this->redirectToRoute('factuur_show', array('id' => $invoice->getId()));
        }
        return $this->render('webshopBundle:invoice:new.html.twig', array(
            'factuur' => $invoice,
            'form' => $form->createView(),
        ));
    }
    /**
     * Finds and displays a factuur entity.
     *
     * @Route("/{id}", name="factuur_show")
     * @Method("GET")
     */
    public function showAction(Factuur $invoice)
    {
        $em = $this->getDoctrine()->getManager();
        $regels = $em->getRepository('webshopBundle:Regel')->findby(['factuurId' => $invoice->getId()]);
        $products = $em->getRepository(products::class)->findall();
        $users = $em->getRepository(User::class)->findAll(['id' => $invoice->getuserId()]);

//         Uncomment this if you need to see the outcomes of your code. This can be used for troubleshooting.
//         dump($invoice->getuserId());
//         dump($regels);
//         dump($users);
//         die();
        
        $deleteForm = $this->createDeleteForm($invoice);
        return $this->render('webshopBundle:invoice:show.html.twig', array(
            'factuur' => $invoice,
            'products' => $products,
            'regels' => $regels,
            'users' => $users,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing factuur entity.
     *
     * @Route("/{id}/edit", name="factuur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Factuur $invoice)
    {
        $em = $this->getDoctrine()->getManager();
        $regels = $em->getRepository(Regel::class)->findby(['factuurId' => $invoice->getId()]);
        $products = $em->getRepository(products::class)->findall();
        $invoice->setRegels($regels);
        $deleteForm = $this->createDeleteForm($invoice);
        $editForm = $this->createForm('webshopBundle\Form\FactuurType', $invoice);
        $previousCollections = array(
            'regels' => $invoice->getRegels(),
        );
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->deleteCollections($em, $previousCollections, $invoice);
            // put in collection of forms items
            foreach ($invoice->getRegels() as $regel) {
                $em->persist($regel);
            }
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('factuur_edit', array('id' => $invoice->getId()));
        }
        return $this->render('webshopBundle:invoice:edit.html.twig', array(
            'factuur' => $invoice,
            'products' => $products,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * to remove collection of forms items
     * @param $em
     * @param $init
     * @param $final
     */
    private function deleteCollections($em, $init, $final)
    {
        if (empty($init)) {
            return;
        }
        if (!$final->getRegels() instanceof \Doctrine\ORM\PersistentCollection) {
            foreach ($init['regels'] as $addr) {
                $em->remove($addr);
            }
        }
    }
    /**
     * Deletes a factuur entity.
     *
     * @Route("/{id}", name="factuur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Factuur $invoice)
    {
        $form = $this->createDeleteForm($invoice);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invoice);
            $em->flush();
        }
        return $this->redirectToRoute('factuur_index');
    }
    /**
     * Creates a form to delete a factuur entity.
     *
     * @param Factuur $factuur The factuur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Factuur $invoice)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('factuur_delete', array('id' => $invoice->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}