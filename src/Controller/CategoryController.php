<?php


namespace App\Controller;


use App\Entity\Category;
use App\Form\CategoryAddType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/** 02
 * @Route("/category",name="category")
 */
class CategoryController extends AbstractController
{
    /** 02
     * @Route("/index",name="category_index")
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function index(CategoryRepository $categoryRepository):Response
    {
        return $this->render('wild/d.html.twig',[
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    /** 02
     * @Route("/add",name="add_category")
     * @param Request $request
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function add(Request $request,CategoryRepository $categoryRepository) : Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryAddType::class,$category);
        $form->handleRequest($request);
        if ( $form->isSubmitted() && $form->isValid()){
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->render('wild/d.html.twig',[
                'categories' => $categoryRepository->findAll(),
            ]);
        }


        return $this->render('Form/add_category.html.twig', [
                'form' => $form->createView(),
                'category'=>$category,
            ]
        );


    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }

}