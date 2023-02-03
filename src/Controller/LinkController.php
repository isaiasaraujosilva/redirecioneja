<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Link;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;

class LinkController extends AbstractController
{
    #[Route('/', name: 'appInsert', methods: ['GET'])]
    public function inserLink(): Response
    {
        $name = "oláMundo";
        return $this->render('insert.html.twig',compact('name'));
    }
    ## Create

    #[Route('/create', name: 'appCreate', methods: ['POST'])]
    public function create(EntityManagerInterface $em, Request $request): Response
    {
        $data = $request->request->all();

        if($data['key'] == "h^89LdX0O8co")
        {
            $link = $em->getRepository(Link::class)->find(4);
            // $link = new Link;
            $link->setUrl($data['url']);
    
            $em->persist($link);
            $em->flush();
        }

        return $this->redirectToRoute('appInsert');
        // return $this->render('');
    }

    #[Route('/redirecionamento', name: 'appRedirecionamento', methods: ['GET'])]
    public function redir(EntityManagerInterface $em): Response
    {
        $link = $em->getRepository(Link::class)->find(4);

        $url = $link->getUrl();

        dump($url);
        
        return $this->render('redirect.html.twig', compact('url'));
        
    }
}
