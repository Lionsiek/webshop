<?php

namespace intakeBundle\Controller;

use intakeBundle\Entity\appointment;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;



/**
 * Product controller.
 *
 * @Route("appointment")
 */
class appointmentController extends Controller
{
    /**
     * Lists all product entities.
     *
     * @Route("/", name="appointment_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $appointment = $em->getRepository('intakeBundle:appointment')->findAll();

        return $this->render('appointment/index.html.twig', array(
            'appointment' => $appointment,
        ));
    }

    /**
     * Creates a new product entity.
     *
     * @Route("/new", name="appointment_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $product = new appointment();
        $form = $this->createForm('intakeBundle\Form\appointmentType', $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {



                $file = $product->getImageUrl();

                // Generate a unique name for the file before saving it
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();

                // Move the file to the directory where brochures are stored
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );

                $product->setImageUrl($fileName);
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();


                return $this->redirectToRoute('appointment_show', array('id' => $product->getId()));
            }



        return $this->render('appointment/new.html.twig', array(
        'product' => $product,
        'form' => $form->createView(),
          ));
    }

    /**
     * Finds and displays a product entity.
     *
     * @Route("/{id}", name="appointment_show")
     * @Method("GET")
     */
    public function showAction(appointment $product)
    {
        $deleteForm = $this->createDeleteForm($product);

        return $this->render('appointment/show.html.twig', array(
            'product' => $product,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing product entity.
     *
     * @Route("/{id}/edit", name="appointment_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, appointment $product)
    {
        $deleteForm = $this->createDeleteForm($product);
        $editForm = $this->createForm('intakeBundle\Form\appointmentType', $product);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $product->setImageUrl(
                new File($this->getParameter('images_directory').'/'.$product->getImageUrl())
            );
            $file = $product->getImageUrl();
            /*            if ($file) {
                            unlink($file);
                        }*/
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );
            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $product->setImageUrl($fileName);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('appointment_edit', array('id' => $product->getId()));
        }

        return $this->render('appointment/edit.html.twig', array(
            'product' => $product,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a product entity.
     *
     * @Route("/{id}", name="appointment_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, appointment $product)
    {
        $form = $this->createDeleteForm($product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush();
        }

        return $this->redirectToRoute('appointment_index');
    }

    /**
     * Creates a form to delete a product entity.
     *
     * @param appointment $product The product entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(appointment $product)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('appointment_delete', array('id' => $product->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
