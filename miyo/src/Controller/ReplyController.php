<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Reply;
use App\Entity\Msgboard;

class ReplyController extends AbstractController
{
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        if ($_POST["reply_nick"] == "" || $_POST["reply_msg"] == "") {
            $back = "refresh:2;url='/'";
            return new Response(
                "請輸入暱稱或是內容~".
                header($back)
            );
        } else {
            $replyid = $entityManager->getRepository(Msgboard::class)->find($id = $_POST["reply_id"]);
            $reply = new reply();
            $reply->setMsgid($replyid);
            $reply->setReplymsg($_POST["reply_msg"]);
            $reply->setReplynick($_POST["reply_nick"]);
            $reply->setReplytime(date("Y/m/d H:i:s"));
            $entityManager->persist($reply);
            $entityManager->flush();

            $back = "refresh:0;url='/'";
            return new Response (
                header($back)
            );
        }
    }
}
