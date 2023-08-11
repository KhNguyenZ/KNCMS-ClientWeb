<?php
require_once('include/vendor/autoload.php');
use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\WebSockets\Intents;
use Discord\WebSockets\Event;

$dis_bottoken = 'MTAxNDQwNTM1NjQwMDY4OTIxMg.GwkabF.3avlZ2WxynMh-WSjpv9zgerB9I390yLNeGMdbA';
$discord = new Discord([
    'token' => $dis_bottoken,
    'intents' => Intents::getDefaultIntents()
]);

$discord->on('ready', function ($discord) {
    echo "Bot is ready!", PHP_EOL;
    $discord->getChannel('1139452363564912670')->sendMessage('Bot is connected!');
    $discord->on('message', 
    function($message, $discord){
        print($message->content);
        $conten = $message->content;
        if($conten === "!help" || $conten === "/help")
        {
            $message->Reply('
            ```
Owner: KNCMS ( Khôi Nguyên )
FB: https://kb.com/KhNguyenDev.MazTech
##########################
Đây là máy chủ của KNCMS - Laucher
Laucher này dành cho các server 03DL(037 nếu có nhu cầu)
Thông tin thêm: 
    + Không bắt buộc người chơi tải cache thủ công
    + Phải được phê duyệt server thì laucher mới connect tới server đó được
    + Các chức năng tính phí:
        - Tự động tải cache
        - Anti cheat (theo whilelist / anticheat default của KNCMS)
        - Chặn kết nối người chơi khi connect bằng SA-MP Client
        - Hỗ trợ Vehicle Custom (Thuê)
    + Tất cả thông tin người thuê/mua/bán sẽ được bảo mật hoàn toàn
    + Cam kết Laucher không có Virus/RAT/Trojan/...
                                                    _XIN CẢM ƠN_
                                                     KhNguyenz
            ```');
        }
    }
    );
});

$discord->run();
?>