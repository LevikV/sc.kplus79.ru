<?php
echo "Программа прайса ВТТ";
echo '<br>';
$wsdl_url = 'http://api.vtt.ru:8048/Portal.svc?singleWsdl'; //ссылка для обращения к API
$login = 'am-072'; // логин
$password = '211212'; // пароль
$f = 0;
$t = 15;
$itemId = '120012111';
$data = load_data();
//write_to_log("Сведения о товарах получены. Всего товаров ".count($data->GetItemsResult->ItemDto));
echo count($data->GetItemsResult->ItemDto);

echo '<pre>';
print_r($data);
echo '</pre>';



function load_data()
{
    global $wsdl_url, $login, $password, $itemId, $f, $t;
    $params = array("login" => $login , "password" => $password);
    //$paramsid = array("login" => $login , "password" => $password, "itemId" => $itemId);
    $paramsportion = array("login" => $login , "password" => $password, "from" => $f, "to" => $t);
    try
    {
        $client = new SoapClient($wsdl_url, $params);
        //$dates = $client->GetItem($paramsid);
        $dates = $client->GetItemPortion($paramsportion);
        return $dates;
    }
    catch (SoapFault $E)
    {
        //write_to_log("Ошибка: ".$E->faultstring);
        echo "Error";
        echo '<br>';
        echo $E->faultstring;
        echo '<br>';
        print_r($paramsportion);
        die;
    }
}
?>