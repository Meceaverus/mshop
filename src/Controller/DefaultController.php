<?php
/**
 * Created by PhpStorm.
 * User: Olf
 * Date: 08.01.2018
 * Time: 14:21
 */

namespace App\Controller;
use App\Service\Catalogue;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function show(SessionInterface $session)
    {
        return $this->render('default/index.html.twig');
    }
    /**
     * @Route("/to-about")
     */
    public function redirectToShow()
    {
        return $this->redirectToRoute('about_show');
    }
}