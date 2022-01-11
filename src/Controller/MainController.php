<?php

namespace App\Controller;

use App\Services\Capitalizer;
use App\Services\DashConverter;
use App\Services\Master;
use App\Services\MonoLogger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Config\Monolog\HandlerConfig\MongoConfig;

class MainController extends AbstractController
{
    #[Route('/main', name: 'main')]
    public function index(Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('msg', TextType::class, ['label' => "Message"])
            ->add('converter', ChoiceType::class, [
                'choices'  => [
                    'Capitalizer' => 0,
                    'Dasher' => 1
                ],
            ])
            ->add('save', SubmitType::class, ['label' => 'Log and Convert Message'])
            ->setAction($this->generateUrl('main'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $msg = $form->getData()['msg'];
            $converterIdx = $form->getData()['converter'];
        } else {
            $msg = "";
        }

        $converterArr = [new Capitalizer(), new DashConverter()];
        $master = new Master(new MonoLogger(), $converterArr[$converterIdx]);
        $convertedMessage = $master->doTheMagic($msg);

        return $this->render('main/index.html.twig', [
            'form' => $form->createView(),
            'msg' => $convertedMessage,
        ]);
    }
}
