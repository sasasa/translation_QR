<?php
// 注文が来るとサーバー側でorder.fileを作るとする
// ポーリングして音だけを鳴らす

function cli_beep()
{
    echo "\x07";
}

while(true) {
    if ( file_exists('public/order.file') ) {
        cli_beep();
        unlink('public/order.file');
    }
    sleep(1);
}