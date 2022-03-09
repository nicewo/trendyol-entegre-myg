<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>sipariş çıktısı</title>
<style>
	.dis{
		position: relative;
		border: 1px solid;
		width: 750px;
		height: 480px;
		margin: 0;
		padding: 0;
	}	
	.logo{
		position: absolute;
		border: 0px solid;
		width: 250px;
		height: 75px;
		margin: 0;
		padding: 0;
		top: 25px;
		left: 25px;
		text-align: center;
	}	
	.logo2{
		position: absolute;
		border: 0px solid;
		width: 250px;
		height: 75px;
		margin: 0;
		padding: 0;
		top: 25px;
		left: 425px;
	}	
	.urun{
		position: absolute;
		border: 0px solid;
		width: 340px;
		height: 113px;
		margin: 0;
		padding: 0;
		top: 285px;
		left: 385px;
		font-size: 10px;
	}	
	.logo3{
		position: absolute;
		border: 0px solid;
		width: 250px;
		height: 55px;
		margin: 0;
		padding: 0;
		top: 400px;
		left: 25px;
	}	
	.barcode{
		position: absolute;
		border: 0px solid;
		width: 460px;
		height: 150px;
		margin: 0;
		padding: 0;
		top: 130px;
		left: 290px;
		text-align: center;
	}	
	.icerik{
		position: absolute;
		border: 0px solid;
		width: 350px;
		height: 320px;
		margin: 0;
		padding: 0;
		top: 125px;
		left: 25px;
	}	
@media all {
  .page-break { display: none; }
}

@media print {
  .page-break { display: block; page-break-before: always; }
}
</style>
</head>

<body onLoad="window.print();">
	<?php
	$toplamsayi = count($_POST);
	 //var_dump($_POST);
	?>
	
	
	<?php
session_start();
ob_start();
date_default_timezone_set('Europe/Istanbul');
	
	
	
	$startdate = $_SESSION['startdate'];
	$enddate = $_SESSION['enddate'];
	
	
$username="a2nJm3kx0P5Dbnh0WTsO";
$passo="LIraMfjSSvfoAVQhaxH3";
$url="https://api.trendyol.com/sapigw/suppliers/213186/orders?orderByField=PackageLastModifiedDate&orderByDirection=DESC&size=200&startDate=".$startdate."&endDate=".$enddate; 
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

// var_dump($sonuc);



	
	/*	
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
echo $orders['orderDate']."<br>";
echo $orders['tcIdentityNumber']."<br>";
echo $orders['currencyCode']."<br>";
echo $orders['shipmentPackageStatus']."<br>";
	
	
*/
	
?>
	
	
	
	
<?php 
	if (isset($_POST)) {
		$de = 0;
		$adet = 1;
		
		if (isset($_POST['y'])) {$adet=$adet+1;}
		
$ust = count($_POST) ;
		while ($de < $ust+10) {
			if (!isset($_POST[$de])) { $de ++; } else {
				
$order = $_POST[$de];
$shipment=$sonuc['content'][$order]['shipmentAddress'];
$invoice=$sonuc['content'][$order]['invoiceAddress'];
$orders = $sonuc['content'][$order];

	?>	
	
	
<div class="dis">

	<div class="logo"><img src="logo.png" height="75" /></div>
	<div class="logo2"><img src="Trendyol.png" height="75" /></div>
	<div class="logo3"><img src="aras.png" height="55" /></div>
	<div class="urun">
<?php	
$prpr = 0;	
	while ($prpr < 100){

		if (!isset($orders['lines'][$prpr])) { break; } else {
	
$pro = $orders['lines'][$prpr];
?>
<table width="100%" style="border: 1px solid;">
	<tr>
		<td colspan="3"><b><?=$pro['productName'];?></b></td>
	</tr>
	<tr>
		<td><b>Adet</b></td>
		<td><b>Barkod</b></td>
		<td><b>Ürün Kodu</b></td>
	</tr>
	<tr>
		<td><?=$pro['quantity'];?></td>
		<td><?=$pro['barcode'];?></td>
		<td><?=$pro['merchantSku'];?></td>
	</tr>
</table>
		
		
		
<?php
		 $prpr++;  }
	}
?>	
	</div>
	<div class="barcode"><b>Kargo Barkodu</b><img src="barcode.php?f=svg&s=code-128&w=445&h=130&d=<?=$orders['cargoTrackingNumber'];?>"></div>
	<div class="icerik">
	<table width="100%" border="0">
		<tr>
			<td colspan="3" height="50"><h2><b>Alıcı Bilgileri</b></h2></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td width="100"><b>Sipariş No</b></td>
			<td width="5">:</td>
			<td><?=$orders['orderNumber'];?></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td><b>Ad - Soyad</b></td>
			<td>:</td>
			<td><?=$shipment['fullName'];?></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td><b>Adres</b></td>
			<td>:</td>
			<td><?=$shipment['address1'];?></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><b><?=$shipment['city'];?>-<?=$shipment['district'];?></b></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
	</table>
	</div>
	
</div>
	
	<?php
		$bolum=$adet % 2 ; 
	if ($toplamsayi!=$adet) {
		if (isset($_POST['y'])) {
		if ($_POST['y']=='a3'){ echo "<div class='page-break'></div>"; } } else {
			if ($bolum==0) {
			echo "<div class='page-break'></div>"; 
		} else {
			echo "<div style='height: 80px; width: 150px; '></div>";
		}}
	}
	?>


<?php	
				$de ++ ;
				$adet ++;
			}
			
		}
		
		
	}
?>	
	
	
	
</body>
</html>
