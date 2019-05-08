<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

if (CModule::IncludeModule("roman.search")){
    $pos1 = strpos($_SERVER["REQUEST_URI"], '/', 2);
    $buf = substr($_SERVER["REQUEST_URI"], $pos1+1);

    $count = 0;
    for($i = 0; strlen($buf) >= 0; $i++) {
        if($buf[$i] == "/" || strlen($buf) <= $count) break;
        $count++;
    }
    $apiName = substr($buf, 0, $count);

    try {
        $run = new Roman\Search\Route;
        $buf = $run::marsh($apiName);
        echo $buf->run();
    } catch (Exception $e) {
        echo json_encode(Array('error' => $e->getMessage(), 'code' => $e->getCode()));
    }
}

?>