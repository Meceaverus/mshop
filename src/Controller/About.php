<?php
/**
 * Created by PhpStorm.
 * User: Olf
 * Date: 05.01.2018
 * Time: 20:34
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class About extends Controller
{
    /**
     *
     * @Route("/mshop/about")
     */
    public function showAbout(){
        return $this->render('mshop/about.html.twig');
    }
}