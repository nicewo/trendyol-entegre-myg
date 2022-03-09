<?php
 //       'Authorization: Basic '. base64_encode('a2nJm3kx0P5Dbnh0WTsO:LIraMfjSSvfoAVQhaxH3'),
 //       'Content-Type: application/json',
 //       'User-Agent: 213186 - SelfIntegration'

set_time_limit(0);

  $servername = "localhost";
  $username = "root";
  $password = "68426633";
  $dbname = "trendyol";
  try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->query("SET NAMES 'utf8'");
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Bağlantı Başarılı...<br>"; 
    }
  catch(PDOException $e)
    {
      echo "Bağlantı Hatası: " . $e->getMessage();
    }




/*

$username="a2nJm3kx0P5Dbnh0WTsO";
$passo="LIraMfjSSvfoAVQhaxH3";
$url="https://api.trendyol.com/sapigw/suppliers/213186/v2/product";
$haders=array(
"Authorization: Basic ".base64_encode($username.':'.$passo),
"User-Agent: 213186 - SelfIntegration",
"Content-Type: application/json"
);
$curl=curl_init($url);
curl_setopt($curl,CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($curl,CURLOPT_COOKIESESSION, TRUE);
curl_setopt($curl,CURLOPT_HTTPHEADER, $haders);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl,CURLOPT_FOLLOWLOCATION,1);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,2);
curl_setopt($curl,CURLOPT_UNRESTRICTED_AUTH,1);
//curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,1);
$gonder=curl_exec($curl);
echo json_encode($gonder);
curl_close($curl);
*/



$username="a2nJm3kx0P5Dbnh0WTsO";
$passo="LIraMfjSSvfoAVQhaxH3";
$url="https://api.trendyol.com/sapigw/suppliers/213186/orders?orderByField=PackageLastModifiedDate&orderByDirection=ASC&size=100";
$haders=array(
"Authorization: Basic ".base64_encode($username.':'.$passo),
"User-Agent: 213186 - SelfIntegration",
"Content-Type: application/json"
);
$curl=curl_init($url);
curl_setopt($curl,CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($curl,CURLOPT_COOKIESESSION, TRUE);
curl_setopt($curl,CURLOPT_HTTPHEADER, $haders);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl,CURLOPT_FOLLOWLOCATION,1);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,2);
curl_setopt($curl,CURLOPT_UNRESTRICTED_AUTH,1);
//curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,1);
$gonder=curl_exec($curl);
$sonuc=json_decode($gonder,true);
curl_close($curl);
echo "<br><br><br>--------<br><br>";

// var_dump($sonuc);

$sayor = count($sonuc['content']);
$sayorder = $sayor + 20 ;
$order = 0;
while($order < $sayorder){
$shipment=$sonuc['content'][$order]['shipmentAddress'];
$invoice=$sonuc['content'][$order]['invoiceAddress'];
$orders = $sonuc['content'][$order];
$pro = $sonuc['content'][$order]['lines']['0'];
	
	if ($shipment['id']==null) { break ; }
	
echo $shipment['id']."<br>";
echo $shipment['firstName']."<br>";
echo $shipment['lastName']."<br>";
echo $shipment['address1']."<br>";
echo $shipment['address2']."<br>";
echo $shipment['city']."<br>";
echo $shipment['cityCode']."<br>";
echo $shipment['district']."<br>";
echo $shipment['districtId']."<br>";
echo $shipment['postalCode']."<br>";
echo $shipment['countryCode']."<br>";
echo $shipment['neighborhoodId']."<br>";
echo $shipment['neighborhood']."<br>";
echo $shipment['fullAddress']."<br>";
echo $shipment['fullName']."<br>";

	echo "<br>";
	
echo $orders['orderNumber']."<br>";
echo $orders['grossAmount']."<br>";
echo $orders['totalDiscount']."<br>";
echo $orders['totalPrice']."<br>";
echo $orders['taxNumber']."<br>";
echo $orders['customerFirstName']."<br>";
echo $orders['customerEmail']."<br>";
echo $orders['customerId']."<br>";
echo $orders['customerLastName']."<br>";
echo $orders['id']."<br>";
echo $orders['cargoTrackingNumber']."<br>";
	echo '<img src="barcode.php?f=svg&s=code-128&w=450&h=150&d='.$orders['cargoTrackingNumber'].'">';
echo $orders['cargoTrackingLink']."<br>";
echo $orders['cargoSenderNumber']."<br>";
echo $orders['cargoProviderName']."<br>";
echo date('d.m.Y H:i:s', $orders['orderDate'] / 1000)."<br>";
echo $orders['tcIdentityNumber']."<br>";
echo $orders['currencyCode']."<br>";
echo $orders['shipmentPackageStatus']."<br>";
	
	echo "<br>";
	
echo $pro['quantity']."<br>";
echo $pro['salesCampaignId']."<br>";
echo $pro['productSize']."<br>";
echo $pro['merchantSku']."<br>";
echo $pro['productName']."<br>";
echo $pro['productCode']."<br>";
echo $pro['merchantId']."<br>";
echo $pro['amount']."<br>";
echo $pro['discount']."<br>";
echo $pro['price']."<br>";
echo $pro['currencyCode']."<br>";
echo $pro['productColor']."<br>";
echo $pro['id']."<br>";
echo $pro['sku']."<br>";
echo $pro['vatBaseAmount']."<br>";
echo $pro['barcode']."<br>";
echo $pro['orderLineItemStatusName']."<br>";

 	echo "<br>";
  
echo $pro['discountDetails']['0']['lineItemPrice']."<br>";
echo $pro['discountDetails']['0']['lineItemDiscount']."<br>";

	
$pr = 0;
	
	
if ($shipment['id']==null) { } else { echo "<br><br>------<br><br>"; $order++; }
}



/* $page = 0;
$bos=0;
while($page < 5000){

$url="https://api.trendyol.com/sapigw/brands?size=50&page=".$page;
$haders=array();
$curl=curl_init($url);
curl_setopt($curl,CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($curl,CURLOPT_COOKIESESSION, TRUE);
curl_setopt($curl,CURLOPT_HTTPHEADER, $haders);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl,CURLOPT_FOLLOWLOCATION,1);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,2);
curl_setopt($curl,CURLOPT_UNRESTRICTED_AUTH,1);
//curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,1);
$gonder=curl_exec($curl);
$sonuc = json_decode($gonder,true);
curl_close($curl);
echo "<br>";

$no = 0;
	if ($bos == 0) {
while ($no < 50) {
	if ($sonuc['brands'][$no]['id'] == null ) {
		$bos=1;
		break;
	} else {
$trid = $sonuc['brands'][$no]['id'];
$trname = $sonuc['brands'][$no]['name'];

		// $sqlst = "INSERT INTO marka (trid , trad , trpage) VALUES ('$trid' , '$trname' , '$page')";
		// $conn->exec($sqlst);
		
		echo $no."-----    ".$page.". sayfadaki ".$trname." eklendi..    -----".$bos."<br>";
		
		
		$bos=0;
	}
	$no ++;

	} }
	
	
$page ++;
	if ($bos != 0) {
	break;
	}
}
*/

/*
$curl = curl_init();


curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.trendyol.com/sapigw/suppliers/213186/products',
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'User-Agent: 213186 - SelfIntegration',
	'Content-Type: application/json',
    'Authorization: Basic '.base64_encode('a2nJm3kx0P5Dbnh0WTsO:LIraMfjSSvfoAVQhaxH3')
  ),
));

$response = curl_exec($curl);

echo $curl;
var_dump($response);
echo $response;
*/
?>



