<?php

namespace Naissance\ApplicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Naissance\ApplicationBundle\Entity\Enquiry;
use Naissance\ApplicationBundle\Form\EnquiryType;

class PageController extends Controller
{	
    public function indexAction()
    {
        $em = $this->getDoctrine()
                   ->getManager();

        $blogs = $em->getRepository('NaissanceApplicationBundle:Blog')
                    ->getLatestBlogs();

        return $this->render('NaissanceApplicationBundle:Page:index.html.twig', array(
            'blogs' => $blogs
        ));
    }

    public function aboutAction()
    {
        return $this->render('NaissanceApplicationBundle:Page:about.html.twig');
    }

    public function contactAction()
	{
        $enquiry = new Enquiry();
        $form = $this->createForm(new EnquiryType(), $enquiry);

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {

            $form->bind($request);

            if ($form->isValid()) {
                // Perform some action, such as sending an email
                // $message = \Swift_Message::newInstance()
                //     ->setSubject('Contact enquiry from symblog')
                //     ->setFrom('enquiries@symblog.co.uk')
                //     ->setTo($this->container->getParameter('naissance_application.emails.contact_email'))
                //     ->setBody($this->renderView('NaissanceApplicationBundle:Page:contactEmail.txt.twig', array('enquiry' => $enquiry)));
                // $this->get('mailer')->send($message);

                $this->get('session')->getFlashBag()->add('blogger-notice', 'Your contact enquiry was successfully sent. Thank you!');

                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('NaissanceApplicationBundle_contact'));
            }
        }

        return $this->render('NaissanceApplicationBundle:Page:contact.html.twig', array(
            'form' => $form->createView()
        ));
	}

    public function sidebarAction()
    {
        $em = $this->getDoctrine()
                   ->getManager();

        $tags = $em->getRepository('NaissanceApplicationBundle:Blog')
                   ->getTags();

        $tagWeights = $em->getRepository('NaissanceApplicationBundle:Blog')
                         ->getTagWeights($tags);

        return $this->render('NaissanceApplicationBundle:Page:sidebar.html.twig', array(
            'tags' => $tagWeights
        ));
    }

    public function translationAction($name)
    {
        return $this->render('NaissanceApplicationBundle:Page:translation.html.twig', array(
            'name' => $name
        ));
    }
}