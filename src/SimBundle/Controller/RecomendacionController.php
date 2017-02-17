<?php

namespace SimBundle\Controller;

use SimBundle\Entity\Recomendacion;
use SimBundle\Entity\Solicitud;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Recomendacion controller.
 *
 * @Route("recomendacion")
 */
class RecomendacionController extends Controller
{
    /**
     * Lists all recomendacion entities.
     *
     * @Route("/", name="recomendacion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        // Access control
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Acceso restringido');

        $em = $this->getDoctrine()->getManager();

        $recomendacions = $em->getRepository('SimBundle:Recomendacion')->findAll();

        return $this->render('recomendacion/index.html.twig', array(
            'recomendacions' => $recomendacions,
        ));
    }

    /**
     * Creates a new recomendacion entity.
     *
     * @Route("/{slug}/{correo}/new", name="recomendacion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Solicitud $solicitud, $correo)
    {
        // Valida que sea un correo válido
        if($solicitud->getMailprofesor1() != $correo && $solicitud->getMailprofesor2() != $correo)
            throw $this->createNotFoundException('La recomendación no existe');

        $rec = $solicitud->isRecomended($correo);

        if($rec)
            return $this->redirectToRoute('recomendacion_show', array('id' => $rec->getId()));

        $recomendacion = new Recomendacion();
        $recomendacion->setSolicitud($solicitud);
        $recomendacion->setMail($correo);

        $form = $this->createForm('SimBundle\Form\RecomendacionType', $recomendacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recomendacion);
            $em->flush($recomendacion);

            return $this->redirectToRoute('recomendacion_show', array('id' => $recomendacion->getId()));
        }

        return $this->render('recomendacion/new.html.twig', array(
            'solicitud' => $solicitud,
            'recomendacion' => $recomendacion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a recomendacion entity.
     *
     * @Route("/{id}", name="recomendacion_show")
     * @Method("GET")
     */
    public function showAction(Recomendacion $recomendacion)
    {
        $deleteForm = $this->createDeleteForm($recomendacion);

        return $this->render('recomendacion/show.html.twig', array(
            'recomendacion' => $recomendacion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing recomendacion entity.
     *
     * @Route("/{id}/edit", name="recomendacion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Recomendacion $recomendacion)
    {

        // Access control
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Acceso restringido');

        $deleteForm = $this->createDeleteForm($recomendacion);
        $editForm = $this->createForm('SimBundle\Form\RecomendacionType', $recomendacion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('recomendacion_edit', array('id' => $recomendacion->getId()));
        }

        return $this->render('recomendacion/edit.html.twig', array(
            'recomendacion' => $recomendacion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a recomendacion entity.
     *
     * @Route("/{id}", name="recomendacion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Recomendacion $recomendacion)
    {
        $form = $this->createDeleteForm($recomendacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($recomendacion);
            $em->flush($recomendacion);
        }

        return $this->redirectToRoute('recomendacion_index');
    }

    /**
     * Creates a form to delete a recomendacion entity.
     *
     * @param Recomendacion $recomendacion The recomendacion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Recomendacion $recomendacion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('recomendacion_delete', array('id' => $recomendacion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
