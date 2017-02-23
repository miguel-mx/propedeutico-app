<?php

namespace SimBundle\Controller;

use SimBundle\Entity\Solicitud;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Solicitud controller.
 *
 * @Route("solicitud")
 */
class SolicitudController extends Controller
{
    /**
     * Lists all solicitud entities.
     *
     * @Route("/", name="solicitud_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        // Access control
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Acceso restringido');

        $em = $this->getDoctrine()->getManager();

        $solicituds = $em->getRepository('SimBundle:Solicitud')->findAll();

        return $this->render('solicitud/index.html.twig', array(
            'solicituds' => $solicituds,
        ));
    }

    /**
     * Creates a new solicitud entity.
     *
     * @Route("/new", name="solicitud_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $now = new \DateTime();
        $deadline = new \DateTime('2017-05-06');
        if($now >= $deadline)
            return $this->render(':solicitud:closed.html.twig');

        $solicitud = new Solicitud();
        $form = $this->createForm('SimBundle\Form\SolicitudType', $solicitud);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($solicitud);
            $em->flush($solicitud);
            $https['ssl']['verify_peer'] = FALSE;

            $mailer = $this->get('mailer');

            $transport = $this->get("swiftmailer.mailer.default.transport");
            // disable SSL certificate validation
            $transport->setStreamOptions(array('ssl' => array('allow_self_signed' => true, 'verify_peer' => false)));

            $message = \Swift_Message::newInstance()
                ->setSubject('2da Escuela de Verano en Simetrías de Estructuras Combinatorias')
                ->setFrom('simetrias2017@matmor.unam.mx')
                ->setTo(array($solicitud->getMail()))
                ->setBcc(array('rudos@matmor.unam.mx'))
                ->setBody($this->renderView('solicitud/mail.txt.twig', array('entity' => $solicitud)))
            ;

            $mailer->send($message);

            // Envía correo de solicitud de recomendación 1
            $message = \Swift_Message::newInstance()
                ->setSubject('2da Escuela de Verano en Simetrías de Estructuras Combinatorias')
                ->setFrom('simetrias2017@matmor.unam.mx')
                ->setTo(array($solicitud->getMailprofesor1()))
                ->setBcc(array('rudos@matmor.unam.mx'))
                ->setBody($this->renderView('solicitud/mail-profesor.txt.twig', array('entity' => $solicitud, 'email' => $solicitud->getMailprofesor1())))
            ;

            $mailer->send($message);

            // Envía correo de solicitud de recomendación 2
            $message = \Swift_Message::newInstance()
                ->setSubject('2da Escuela de Verano en Simetrías de Estructuras Combinatorias')
                ->setFrom('simetrias2017@matmor.unam.mx')
                ->setTo(array($solicitud->getMailprofesor2()))
                ->setBcc(array('rudos@matmor.unam.mx'))
                ->setBody($this->renderView('solicitud/mail-profesor.txt.twig', array('entity' => $solicitud, 'email' => $solicitud->getMailprofesor2())))
            ;

            $mailer->send($message);

            return $this->render(':solicitud:confirmacion-registro.html.twig', array('entity'=>$solicitud));
        }

        return $this->render('solicitud/new.html.twig', array(
            'solicitud' => $solicitud,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a solicitud entity.
     *
     * @Route("/{slug}", name="solicitud_show")
     * @Method({"GET", "POST"})
     */
    public function showAction(Solicitud $solicitud)
    {
        // Access control
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Acceso restringido');

        $deleteForm = $this->createDeleteForm($solicitud);

        return $this->render('solicitud/show.html.twig', array(
            'solicitud' => $solicitud,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing solicitud entity.
     *
     * @Route("/{slug}/edit", name="solicitud_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Solicitud $solicitud)
    {
        // Access control
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Acceso restringido');

        $deleteForm = $this->createDeleteForm($solicitud);
        $editForm = $this->createForm('SimBundle\Form\EvalType', $solicitud);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('solicitud_show', array('slug' => $solicitud->getSlug()));
        }

        return $this->render('solicitud/edit.html.twig', array(
            'solicitud' => $solicitud,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Displays a form to eval an existing solicitud entity.
     *
     * @Route("/{slug}/eval", name="solicitud_eval")
     * @Method({"GET", "POST"})
     */
    public function evalAction(Request $request, Solicitud $solicitud)
    {
        // Access control
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Acceso restringido');

        $deleteForm = $this->createDeleteForm($solicitud);
        $editForm = $this->createForm('SimBundle\Form\SolicitudType', $solicitud);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('solicitud_edit', array('id' => $solicitud->getId()));
        }

        return $this->render('solicitud/edit.html.twig', array(
            'solicitud' => $solicitud,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Deletes a solicitud entity.
     *
     * @Route("/{id}", name="solicitud_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Solicitud $solicitud)
    {
        $form = $this->createDeleteForm($solicitud);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($solicitud);
            $em->flush($solicitud);
        }

        return $this->redirectToRoute('solicitud_index');
    }

    /**
     * Creates a form to delete a solicitud entity.
     *
     * @param Solicitud $solicitud The solicitud entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Solicitud $solicitud)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('solicitud_delete', array('id' => $solicitud->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
