<?php
/**
 * Created by PhpStorm.
 * User: Olf
 * Date: 05.01.2018
 * Time: 20:34
 */

namespace App\Controller;

use App\Entity\Feedback;
use App\Form\FeedbackType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class About extends Controller
{
    /**
     *
     * @Route("/about", name="about_show")
     */
    public function show(SessionInterface $session){

        $url = $this->generateUrl('category_show', [
            'slug' => 'notebooks',
            'param' => 'getparam',
        ]); UrlGeneratorInterface::ABSOLUTE_URL;

        return $this->render('about/show.html.twig', [
            'notebooksUrl' => $url,
            'lastCategory' => $session->get('lastVisitedCategory')
        ]);
    }

    /**
     * @Route("/to-about")
     */
    public function redirectToShow()
    {
        return $this->redirectToRoute('about_show');
    }

    /**
     * @Route("/feedback", name="feedback")
     *
     * @param Request $request
     */
    public function  feedback(Request $request)
    {
        $form = $this->createForm(FeedbackType::class);

        return $this->render('about/feedback.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}