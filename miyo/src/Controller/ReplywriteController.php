<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Reply;

class ReplywriteController extends AbstractController
{
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();

        if ($_POST["reply_nick"] == "") {
            echo "請輸入暱稱";
            $back = "refresh:2;url='/'";
            return new Response (
                header($back)
            );
        }
        $reply = $entityManager->getRepository(Reply::class)->find($id = $_POST["reply_id"]);
        $nick = $reply->getreplynick();
        if($nick == $_POST["reply_nick"] && $_POST["reply_write_msg"] !="") {
            $reply->setReplymsg($_POST["reply_write_msg"]);
            $reply->setReplynick($_POST["reply_nick"]);
            $entityManager->flush();

            $back = "refresh:0;url='/'";
            return new Response (
                header($back)
            );
        }
        echo "暱稱錯誤或者未輸入修改文字";

        $back = "refresh:2;url='/'";
        return new Response (
            header($back)
        );
    }
}
