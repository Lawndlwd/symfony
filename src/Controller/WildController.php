<?php
// src/Controller/WildController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WildController extends AbstractController
{
    /**
     * @Route("/wild", name="wild_index")
     */
    public function index() :Response
    {

        return $this->render('wild/index.html.twig', [
            'website' => 'Wild Séries',
        ]);
    }
    /**
* Getting a program with a formatted slug for title
*
* @param string $slug The slugger
* @Route("/wild/show/{slug<^[a-z0-9-]+$>}", defaults={"slug" = null}, name="show_program")
     * @return Response
    */
    public function showByProgram(?string $slug):Response
{
    $message=null;
    if (!$slug) {
        $message='Aucune série sélectionnée, veuillez choisir une série';
    }
    $slug = preg_replace(
        '/-/',
        ' ', ucwords(trim(strip_tags($slug)), "-")
    );

    return $this->render('wild/show.html.twig', [
        'slug'  => $slug,
        'message'=>$message,
    ]);
}
}
