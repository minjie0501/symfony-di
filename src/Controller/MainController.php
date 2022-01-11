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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Config\Monolog\HandlerConfig\MongoConfig;

class MainController extends AbstractController
{
    #[Route('/main', name: 'main')]
    public function index(Request $request): Response
    {
        $form = $this->createFormBuilder()
        ->add('msg', TextType::class, ['label' => "Message"])
        ->add('save', SubmitType::class, ['label' => 'Save Name'])
        ->setAction($this->generateUrl('main'))
        ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $msg = $form->getData()['msg'];
        }else{
            $msg = "";
        }

        $master = new Master(new MonoLogger(),new Capitalizer());
        $convertedMessage = $master->doTheMagic($msg);

        return $this->render('main/index.html.twig', [
            'form' => $form->createView(),
            'msg' => $convertedMessage,
        ]);
    }
}
