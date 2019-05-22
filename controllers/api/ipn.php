<?php
//print_r($_REQUEST);
//we now route the payment 
if(isset($_REQUEST))
{
//mpesaapi/ipn.php?acc=VANTASHA++ENTERPRISE&amount=1000.00&msisdn=254723710600&sender=TERESIA+WACHUKA+GICHAI+&code=MGC2H3XBZI&till=969610&timestamp=2018-07-12+11%3A46%3A23
$indexesToSearch = ["amount","msisdn","sender","code","till","timestamp"];
if(count(array_intersect(array_keys($_REQUEST), $indexesToSearch)) == count($indexesToSearch))
{

 $pos = strpos($_REQUEST['acc'], "fanaka");
   if ($pos === false) {
die("not allowed");
    }
$url ='https://localhost:8087/mpesaapi/api/safaricom/mpesac2b/confirmation';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); //setting custom header
curl_setopt($curl, CURLINFO_HEADER_OUT, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
$curl_post_data = array(
  //Fill in the request parameters with valid values
  'TransID' => $_REQUEST['code'],
  'TransTime' => $_REQUEST['timestamp'],
  'TransAmount' => $_REQUEST['amount'],
  'BusinessShortCode' => $_REQUEST['till'],
  'BillRefNumber' => $_REQUEST['acc'],
  'MSISDN' => $_REQUEST['msisdn'],
  'FirstName' => $_REQUEST['sender'],
);

$data_string = json_encode($curl_post_data);
//echo $data_string;
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
$curl_response = curl_exec($curl);
if ($curl_response === FALSE) {

                   echo "\n [SEND B2C] ".curl_error($curl);
                   return null;
}
if(curl_error($curl))
{
        echo "\n [FETCH TOKEN] ".curl_error($curl);
                return null;
}
else
{
        echo " \n[RESPONSE ] Response ".$curl_response ;

 return json_decode($curl_response,true);

}

}
else
echo "Invalid";
}
?>
