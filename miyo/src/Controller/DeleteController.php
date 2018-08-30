<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Msgboard;
use App\Entity\Reply;

class DeleteController extends AbstractController
{
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $msgboard = $entityManager->getRepository(Msgboard::class)->find($id = $_POST["id"]);
        if ($_POST["id"] != "") {
            if (!$msgboard) {
                throw $this->createNotFoundException(
                    'No msgboard found for id '.$id
                );
            }

            $entityManager->remove($msgboard);
            $entityManager->flush();

            $back = "refresh:0;url='/'";
            return new Response (
                header($back)
            );
        }
    }
}