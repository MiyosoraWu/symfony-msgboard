<?php 
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Msgboard;
use App\Entity\Reply;

class index extends AbstractController
{   
    public function home()
    {
        $repository = $this->getDoctrine()->getRepository(Msgboard::class);
        $msgboards = $repository->findAll();
        $entityManager = $this->getDoctrine()->getManager();
        return $this->render('index.html.php',array(
            'msgboards' => $msgboards,
            'entityManager' => $entityManager,
        ));
    }
}