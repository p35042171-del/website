<?php
// Povolíme přijímání dat z vaší stránky
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

// 1. Načtení dat, která poslal JavaScript
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

if ($data) {
    $ip = $data['ip'] ?? 'Neznámá';
    $mesto = $data['mesto'] ?? 'Neznámé';
    $stat = $data['stat'] ?? 'Neznámý';
    $prohlizec = $data['prohlizec'] ?? 'Neznámý';
    $cas = date('Y-m-d H:i:s');

    // 2. Formátování řádku pro zápis
    $radek = "[$cas] IP: $ip | Poloha: $mesto, $stat | Zařízení: $prohlizec" . PHP_EOL;

    // 3. Uložení do souboru s názvem "seznam_ip.txt"
    // Parametr FILE_APPEND zajistí, že se nové IP adresy budou řadit pod sebe
    file_put_contents('seznam_ip.txt', $radek, FILE_APPEND);
    
    echo "Zapsáno";
} else {
    echo "Žádná data";
}
?>