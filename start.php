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
        $ip = readline("Seu IP > ");
        $porta = readline("Porta > ");
        $max = readline("Maximo de conexões > ");
        echo "* Aguardando por clientes...\n";
        while(1){
        	$s = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        	socket_bind($s, $ip, $porta);
        	socket_listen($s, $max);
            $aceita = socket_accept($s);
            socket_getpeername($aceita, $raddr, $rport);
            $msg = socket_read($s, 2048);
            echo "[+] Nova conexão de > $raddr:$rport\n";
            echo "* Cliente digitou > $msg\n";
        }
    }
    if($option == 2){
        echo "\nVocê escolheu > Conectar <\n\n";
        $rip = readline("IP > ");
        $cport = readline("PORTA > ");
        $s2 = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_connect($s2, $rip, $cport);
    }
    if($option == 3){
        sair("Ate logo!\n");
    }
}
?>