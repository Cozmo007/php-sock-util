<?php
/*
	-------
	Simples utilitario de SOCKET feito em PHP
    -------
*/
//error_reporting(0);
require_once "telaMenu.php";
while(1){
    exibeMenu();
    $option = readline("Opção > ");
    if($option == 1){
        echo "\nVocê escolheu > Listar <\n\n";
        while(1){
        	$s = socket_create_listen(0);
            socket_getsockname($s, $saddr, $sport);
            echo "* Aguardando por clientes em $saddr porta $sport...\n\n";
            $aceita = socket_accept($s);
            socket_getpeername($aceita, $raddr, $rport);
            $msg = socket_read($aceita, 2048);
            echo "[+] Nova conexão de > $raddr:$rport\n";
            echo "[+] Cliente digitou > $msg\n";
        }
    }
    if($option == 2){
        echo "Você escolheu > Conectar <\n\n";
        $rip = readline("IP > ");
        $cport = readline("PORTA > ");
        $send = readline("MENSAGEM > ");
        $modify = str_replace(" ", "-", $send);
        $s2 = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        echo "* Conectando...\n";
        socket_connect($s2, $rip, $cport) or die("[-] Host invalida!\n");
        socket_write($s2, $modify);
        echo "\n[+] Mensagem > $modify < enviada!\n\n";
    }
    if($option == 3){
        sair("Ate logo!\n");
    }
}
?>