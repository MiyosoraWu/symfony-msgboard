<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Msgboard;

class WriteController extends AbstractController
{
    public function index() {
        $entityManager = $this->getDoctrine()->getManager();

        if ($_POST["write_nick"] == "") {
            echo "請輸入暱稱";
            $back = "refresh:2;url='/'";
            return new Response(
                    header($back)
            );
        }
        $msgboards = $entityManager->getRepository(Msgboard::class)->find($id = $_POST["id"]);
        $nick = $msgboards->getnick();
        if ($nick == $_POST["write_nick"] && $_POST["write_msg"] != "") {
            $msgboards->setNick($_POST["write_nick"]);
            $msgboards->setMsg($_POST["write_msg"]);
            $entityManager->flush();

            $back = "refresh:0;url='/'";
            return new Response(
                    header($back)
            );
        }
        echo "暱稱錯誤或者未輸入修改文字";

        $back = "refresh:2;url='/'";
        return new Response(
                header($back)
        );
        
    }

}
