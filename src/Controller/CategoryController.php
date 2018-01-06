<?php
/**
 * Created by PhpStorm.
 * User: Olf
 * Date: 05.01.2018
 * Time: 21:01
 */

namespace App\Controller;


use App\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CategoryController extends Controller
{
    /**
     * @Route("/category/{slug}/{page}",
     *     name="category_show",
     *     requirements={"page": "\d+"}
     *     )
     * @ParamConverter("slug", options={"mapping": {"slug": "slug"}})
     *
     * @param Category $category
     * @param $page
     * @param $session
     *
     * @return Response
     */
    public function show(Category $category, $page = 1, SessionInterface $session, Request $request) {
        $session->set('lastVisitedCategory', $category->getId());

        return $this->render('category/show.html.twig', ['category' => $category, 'page' => $page]);
    }

    /**
     * @Route("/categories", name="categories_list")
     */
    public function listCategories()
    {
        $repo = $this->getDoctrine()->getRepository(Category::class);

            $categories = $repo->findAll();

        if ( !$categories ) {
            throw $this->createNotFoundException('Categories not found');
        }

        return $this->render('category/list.html.twig', ['categories' => $categories]);
    }

    /**
     * @Route("category/message", name="category_message")
     */
    public function message(SessionInterface $session)
    {
        $this->addFlash('notice', 'Your message');
        $lastCategory = $session->get('lastVisitedCategory');

        return $this->redirectToRoute('category_show', ['slug' => $lastCategory]);
    }

    /**
     * @Route("download", name="category_download")
     */
    public function fileDownload(){
        $response = new Response();
        $response = $this->setContent('Test content');

        return $response;
    }
}