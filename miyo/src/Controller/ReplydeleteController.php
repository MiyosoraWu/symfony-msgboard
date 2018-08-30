<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Reply;

class ReplydeleteController extends AbstractController
{
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();

        if ($_POST["reply_id"] != ""){
            $reply = $entityManager->getRepository(Reply::class)->find($id = $_POST["reply_id"]);

            if (!$reply) {
                throw $this->createNotFoundException(
                    'No reply found for id '.$id
                );
            }
            $entityManager->remove($reply);
            $entityManager->flush();

            $back = "refresh:0;url='/'";
            return new Response (
                header($back)
            );
        }
    }
}
