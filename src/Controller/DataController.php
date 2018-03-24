<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Flower;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

use Doctrine\ORM\EntityManagerInterface;

class DataController extends Controller
{
    /**
     * @Route("/data", name="data")
     */
    public function index(Request $request)
    {
        $flower = $this->getDoctrine()->getRepository(Flower::class)->findAll();
        return $this->render('data/index.html.twig', array('flowers' => $flower));
    }

    /**
     * @Route("/data/add", name="add")
     */
    public function add(Request $request)
    {
        $flower = new Flower;
        $form = $this->createFormBuilder($flower)
            ->setAction($this->generateUrl('save'))//se utilizeaza numele controlului adnotat!!!
            ->setMethod('POST')
            ->add('nume', TextType::class)
            ->add('culoare', TextType::class)
            ->add('marime', TextType::class)
            ->add('pret', NumberType::class)
            ->add('submit', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        return $this->render('data/add.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/data/save", name="save")
     */
    public function save(Request $request)
    {
        $flower = new Flower;
        $var = $request->request->all();
        $nume = $var['form']['nume'];
        $culoare = $var['form']['culoare'];
        $marime = $var['form']['marime'];
        $pret = $var['form']['pret'];
//se apeleaza functiile set din Flower.php
        $flower->setNume($nume);
        $flower->setCuloare($culoare);
        $flower->setMarime($marime);
        $flower->setPret($pret);


        $em = $this->getDoctrine()->getManager();
        //informeaza Doctrine ca urmeaza sa salvam datele
        $em->persist($flower);
        //executa interogarea
        $em->flush();


        return $this->redirectToRoute('data');
    }

    /**
     * @Route("/show/{id}")
     * @Method({"GET", "POST"})
     */
    public function show($id)
    {

        $flower = $this->getDoctrine()->getRepository(Flower::class)->find($id);

        return $this->render('data/show.html.twig', array('flower' => $flower));

    }
    /**
     * @Route("/edit/{id}")
     * @Method({"GET", "POST"})
     */
    public function editAction($id,Request $request){
        // $flower=new Flower;
        $flower = $this->getDoctrine()->getRepository(Flower::class)->find($id);

        $form=$this->createFormBuilder($flower)
            ->setAction($this->generateUrl('update'))//se utilizeaza numele controlului adnotat!!!
            ->setMethod('POST')
            ->add('id', HiddenType::Class)
            ->add('nume',TextType::class)
            ->add('culoare',TextType::class)
            ->add('marime',TextType::class)
            ->add('pret',NumberType::class)
            ->add('submit', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        return $this->render('data/edit.html.twig',array('form'=>$form->createView()));
    }
    /**
     * @Route("/data/update", name="update")
     */
    public function updateAction(Request $request){
        $var = $request->request->all();
        $id=$var['form']['id'];
        $nume=$var['form']['nume'];
        $culoare=$var['form']['culoare'];
        $marime=$var['form']['marime'];
        $pret=$var['form']['pret'];

        $flower = $this->getDoctrine()->getRepository(Flower::class)->find($id);
        //se apeleaza functiile set din Flower.php
        $flower->setNume($nume);
        $flower->setCuloare($culoare);
        $flower->setMarime($marime);
        $flower->setPret($pret);


        $em=$this->getDoctrine()->getManager();
        //informeaza Doctrine ca urmeaza sa salvam datele
        // $em->persist($flower);
        //executa interogarea
        $em->flush();

        return $this->redirectToRoute('data');
    }
    /**
     * @Route("/delete/{id}")
     * @Method({"GET", "POST"})
     */
    public function deleteAction($id){
        $em=$this->getDoctrine()->getManager();
        $flower = $this->getDoctrine()-> getRepository(Flower::class)->find($id);
        $em->remove($flower);
        $em->flush();
        return $this->redirectToRoute('data');
    }

}