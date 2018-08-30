<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Msgboard;

class MsgController extends AbstractController
{
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        if ($_POST["nick"] == "" || $_POST["msg"] == "") {

            $back = "refresh:2;url='/'";
            return new Response(
                "請輸入暱稱或是內容~".
                header($back)
            );
        } else {
            $msgboard = new msgboard();
            $msgboard->setNick($_POST["nick"]);
            $msgboard->setMsg($_POST["msg"]);
            $msgboard->setMsgtime(date("Y/m/d H:i:s"));
            $entityManager->persist($msgboard);
            $entityManager->flush();

            $back = "refresh:0;url='/'";
            return new Response(
                header($back)
            );
        }
    }
}
