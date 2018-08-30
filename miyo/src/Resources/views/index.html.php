<!DOCTYPE html>
<html class="ui-mobile">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><base href=".">
<title>留言板</title>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>	
</head>
<body class="ui-mobile-viewport ui-overlay-a"> 
    <div style ="margin: 0px auto;">
        <div style=" position:absolute; top:1%;right:25%;left:25%;  ">
            <div  data-role="collapsible" data-theme="b" class="ui-collapsible ui-collapsible-inset ui-corner-all ui-collapsible-themed-content" >
                <h3 class="ui-collapsible-heading">
                    新增文章
                </h3>
                <form action="create" method="post" data-ajax="false">
                    <input type="text" name="nick" placeholder="請輸入暱稱">  
                    <textarea type="text" name="msg" placeholder="內容" wrap="Virtual" class="ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all ui-textinput-autogrow" style="height: 51px;"></textarea>
                    <input type="submit" value="送出">
                </form>
            </div>
            <div>
                <?php  
                foreach (array_reverse($msgboards) as $msgboard) {
                    echo "<ul data-role='listview' data-inset='true' style='margin:0px auto;' class='ui-listview ui-listview-inset ui-corner-all ui-shadow'>"
                            . "<li data-role='divider ' class='ui-btn ui-btn-b ui-li-static ui-body-inherit ui-first-child'>發文者：" . $msgboard->getnick() . "</li>"
                                . "<li data-role='footer' class='ui-li-static ui-body-inherit ui-last-child ui-footer ui-bar-inherit' role='contentinfo'>"
                                    . "<pre>"
                                        . "<font  style='word-break: break-all;font-size:18px;'>" . $msgboard->getmsg() . "</font>"
                                    . "</pre>"
                                . "</li>";
                                $dql = "SELECT r FROM App\Entity\Reply r where r.msgid = ".$msgboard->getid();
                                $query = $entityManager->createQuery($dql);
                                $replys = $query->getResult();
                                foreach (array_reverse($replys) as $reply) {
                                            echo "<li  data-role='footer' class='ui-li-static ui-body-inherit ui-last-child ui-footer ui-bar-inherit' >"
                                                    . "<table width='100%' >"
                                                        . "<tr >"
                                                            . "<td style=' width:50px;text-align:left' >"
                                                            . $reply->getreplynick()
                                                            . "</td>"
                                                            . "<td style='width:100px;'>：留言說："
                                                            . "</td>"
                                                            . "<td style='word-break: break-all;text-align:left;width:300px;' >"
                                                            . $reply->getreplymsg() 
                                                            . "</td>"
                                                            . "<td style='text-align:right'>"
                                                                . "<td style=' width:50px;text-align:right'>"
                                                                . "<a href='#reply_write" . $reply->getid() . "' data-rel='popup' data-position-to='window' "
                                                                .  "class='ui-btn ui-btn-b ui-corner-all ui-shadow ui-btn-inline' data-transition='pop'>"
                                                                . "修　改</a>"
                                                                . "</td>"
                                                                . "<td style=' width:50px; text-align:right'>"
                                                                . "<form action='replydelete' method='post' data-ajax='false' >"
                                                                    . "<input type='hidden' name='reply_id'  value='" . $reply->getid() . "'>"
                                                                    . "<button class='ui-btn ui-btn-b ui-corner-all ui-shadow' type='submit' data-ajax='false'>刪　除</button>"
                                                                . "</form>"
                                                                . "<td>"
                                                            . "</td>"
                                                        . "</tr>"
                                                    . "</table>"
                                                . "</li>";
                                            echo "<div data-role='popup' id='reply_write" . $reply->getid() . "' data-theme='a' class='ui-corner-all'>"
                                                    . "<form action='replywrite' method='post' data-ajax='false' >"
                                                        . "<div style='padding:10px 20px;'>"
                                                            . "<input type='text' name='reply_nick' placeholder='請輸入暱稱'>"
                                                            . "<textarea type='text' name='reply_write_msg' placeholder='內容' wrap='Virtual'"
                                                            . "class='ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all ui-textinput-autogrow' style='height: 51px;'></textarea>"
                                                            . "<input type='hidden' name='reply_id'  value='" . $reply->getid() . "'>"
                                                            . "<input type='submit' value='修改送出'>"
                                                        . "</div>"
                                                    . "</form>"
                                                . "</div>";
                                        }
                            echo "<li data-role='footer' class=' ui-li-static ui-body-inherit ui-last-child ui-footer ui-bar-inherit' role='contentinfo'>"
                                    . "<table width='100%' >"
                                        . "<tr>"
                                        . "<td style='width:98px'>"
                                            . "<a href='#write" .  $msgboard->getid() . "' data-rel='popup' data-position-to='window' "
                                            . "class='ui-btn ui-btn-b ui-corner-all ui-shadow ui-btn-inline' data-transition='pop'>修　改</a>"
                                        . "</td>"
                                        . "<td style='width:98px'>"
                                            . "<a href='#reply" . $msgboard->getid() . "' data-rel='popup' data-position-to='window'"
                                            . "class='ui-btn ui-btn-b ui-corner-all ui-shadow ui-btn-inline' data-transition='pop'>回　應</a>"
                                        . "</td>"
                                        . "<td style='width:98px'>"
                                            . "<form action='delete' method='post' data-ajax='false' >"
                                                . "<input type='hidden' name='id'  value='" . $msgboard->getid() . "'>"
                                                . "<button class='ui-btn ui-btn-b ui-corner-all ui-shadow' type='submit' data-ajax='false'>刪　除</button>"
                                            . "</form>"
                                        . "</td>"
                                        . "<td align='right'>"
                                            . $msgboard->getmsgtime()
                                        . "</td>"
                                        . "</tr>"
                                    .  "</table>"
                                . "</li>"
                            . "</ul>"
                            . "<br>";
                    echo "<div data-role='popup' id='write" . $msgboard->getid() . "' data-theme='a' class='ui-corner-all'>"
                            . "<form action='write' method='post' data-ajax='false' >"
                                . "<div style='padding:10px 20px;'>"
                                    . "<input type='text' name='write_nick' placeholder='請輸入暱稱'>"
                                    . "<textarea type='text' name='write_msg' placeholder='內容' wrap='Virtual'"
                                    . "class='ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all ui-textinput-autogrow' style='height: 51px;'></textarea>"
                                    . "<input type='hidden' name='id'  value='" . $msgboard->getid() . "'>"
                                    . "<input type='submit' value='修改送出'>"
                                . "</div>"
                            . "</form>"
                        . "</div>";
                    echo "<div data-role='popup' id='reply" . $msgboard->getid() . "' data-theme='a' class='ui-corner-all'>"
                            . "<form action='reply' method='post' data-ajax='false' >"
                                . "<div style='padding:10px 20px;'>"
                                    . "<input type='text' name='reply_nick' placeholder='請輸入暱稱'>"
                                    . "<textarea type='text' name='reply_msg' placeholder='內容' wrap='Virtual'"
                                    . "class='ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all ui-textinput-autogrow' style='height: 51px;'></textarea>"
                                    . "<input type='hidden' name='reply_id'  value='" . $msgboard->getid() . "'>"
                                    . "<input type='submit' value='回覆送出'>"
                                . "</div>"
                            . "</form>"
                        . "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>