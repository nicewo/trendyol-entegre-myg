<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Trendyol sipariş çıktısı</title>
<style>
	.buton{
		position: fixed;
		border: 1px solid;
		width: 200px;
		height: 25px;
		margin: 0;
		padding: 0;
		top: 20px;
		right: 20px;
		text-align: center;
		background-color: aqua;
	}	
	.buton:hover {
		background-color: aquamarine;
		cursor: pointer;
	}
	.a3{
		position: fixed;
		border: 1px solid;
		width: 25px;
		height: 20px;
		margin: 0;
		padding: 0;
		top: 20px;
		right: 255px;
		text-align: center;
		background-color: aqua;
	}	
	.a3y{
		position: fixed;
		border: 0px solid;
		width: 35px;
		height: 25px;
		margin: 0;
		padding: 0;
		top: 20px;
		right: 220px;
		text-align: left;
	}	
	.dis{
		position: relative;
		border: 1px solid;
		width: 750px;
		height: 200px;
		margin: 0;
		padding: 0;
	}	
	.urun{
		position: absolute;
		border: 0px solid;
		width: 340px;
		height: 113px;
		margin: 0;
		padding: 0;
		top: 0px;
		left: 385px;
	}	
	.icerik{
		position: absolute;
		border: 0px solid;
		width: 350px;
		height: 320px;
		margin: 0;
		padding: 0;
		top: 0;
		left: 25px;
	}	
	.check{
		position: absolute;
		border: 1px solid;
		width: 75px;
		height: 20px;
		margin: 0;
		padding: 0;
		top: 5px;
		left: 5px;
		color: firebrick;
	}	
	.statu{
		position: absolute;
		border: 1px solid;
		width: 100px;
		height: 20px;
		margin: 0;
		padding: 0;
		top: 5px;
		left: 90px;
		color: firebrick;
	}	
	.date{
		position: absolute;
		border: 1px solid;
		width: 180px;
		height: 20px;
		margin: 0;
		padding: 0;
		top: 5px;
		left: 200px;
		color: firebrick;
	}	
	
</style>
</head>

<body>
	

		

		
		
		

	
	<?php
session_start();
ob_start();
date_default_timezone_set('Europe/Istanbul');

		
		
		if(isset($_GET['ses'])) {
			if($_GET['ses'] == "gunumuz") {
				session_destroy();
				header("Location: 1.php");
			}
			elseif($_GET['ses']=="onceki"){
				$_SESSION['ses'] = "onceki";
				$_SESSION['enddate'] = $_SESSION['startdate'];
				$_SESSION['startdate'] = $_SESSION['enddate'] - 1209600000;
				$startdate = $_SESSION['startdate'];
				$enddate = $_SESSION['enddate'];
			}
			elseif($_GET['ses']=="sonraki"){
				$_SESSION['ses'] = "sonraki";
				$_SESSION['startdate'] = $_SESSION['enddate'];
				$_SESSION['enddate'] = $_SESSION['startdate'] + 1209600000;
				$startdate = $_SESSION['startdate'];
				$enddate = $_SESSION['enddate'];
			}
			elseif($_GET['ses']=="gonder"){
				$_SESSION['ses'] = "elle";
				$gelen = $_GET['tarih'];
				$tarih = strtotime($gelen)*1000;
				$_SESSION['startdate'] = $tarih;
				$_SESSION['enddate'] = $_SESSION['startdate'] + 86400000; //başlangıca 1 gün ekledik
				$startdate = $_SESSION['startdate'];
				$enddate = $_SESSION['enddate'];
			}
			else {
			$_SESSION['ses'] = "gunumuz";
			$_SESSION['enddate'] = time()*1000;
			$_SESSION['startdate'] = $_SESSION['enddate'] - 1209600000; //başlangıç tarihi bitişten 14 gün önce olacak
			$startdate = $_SESSION['startdate'];
			$enddate = $_SESSION['enddate'];
			}


			
			
		} else {
			$_SESSION['ses'] = "gunumuz";
			$_SESSION['enddate'] = time()*1000;
			$_SESSION['startdate'] = $_SESSION['enddate'] - 1209600000; //başlangıç tarihi bitişten 14 gün önce olacak
			$startdate = $_SESSION['startdate'];
			$enddate = $_SESSION['enddate'];
		}
				
if($startdate > (time()*1000) - 1209600000) {
	header("Location: 1.php");
}	
if($enddate == time()*1000){
	$_SESSION['ses'] = "gunumuz";
}
?>		
<center>	<a href="?ses=onceki">Önceki 14 Gün </a>---
		Bu Sayfada <b><?=date('d.m.Y-H:i' , $startdate/1000);?></b> ve <b><?=date('d.m.Y-H:i' , $enddate/1000);?></b> Arası Sonuçlar Görüntülenir.
<?php 
if(isset($_SESSION['ses'])){
	if($_SESSION['ses'] == "gunumuz") {
			
	} else {
?>
	---<a href="?ses=sonraki">Sonraki 14 Gün</a>
	<br><a href="1.php"><b>Güncel Tarihe Git</b></a>
<?php } } ?>	
		<br><form method="get" name="ses">Tarihi Gir :<input type="date" name="tarih"><input type="submit" value="gonder" name="ses"></form>
		
		</center>
		
		
		
		
<?php		
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


	<form method="post" enctype="multipart/form-data" action="2.php" target="print_popup" onsubmit="window.open('about:blank','print_popup','width=800,height=800');">
		
		
		
<center>	<h2>Yeni Siparişler</h2>	</center>
		
		
		
		
<?php
$sayora = count($sonuc['content']);
$sayordera = $sayora + 30 ;
$ordera = 0;
while($ordera < $sayordera){
	if (!isset($sonuc['content'][$ordera])) { break ; } else {}
	
$ordersw = $sonuc['content'][$ordera];
$shipmentw=$ordersw['shipmentAddress'];
$invoicew=$ordersw['invoiceAddress'];


	if ($ordersw['shipmentPackageStatus'] == "ReadyToShip" || $ordersw['shipmentPackageStatus'] == "Picking") {
	
?>
	
	
	
	
	
	
	
	
	
<div class="dis">

	<div class="check"><input type="checkbox" name="<?=$ordera;?>" value="<?=$ordera;?>"/>SEÇ-<?php echo $ordera+1;?></div>
	<div class="statu"><?=$ordersw['shipmentPackageStatus'];?></div>
	<div class="date"><?php echo date('d.m.Y H:i:s', $ordersw['orderDate']/1000);?></div>

	
	
	
	<div class="urun">
<?php	
$prpra = 0;	
	while ($prpra < 100){
		if (!isset($ordersw['lines'][$prpra])) { break; }
$prow = $ordersw['lines'][$prpra];
?>
<table width="100%" style="border: 1px solid;">
	<tr>
		<td colspan="3"><?=$prow['productName'];?></td>
	</tr>
	<tr>
		<td>Adet</td>
		<td>Barkod</td>
		<td>Ürün Kodu</td>
	</tr>
	<tr>
		<td><?=$prow['quantity'];?></td>
		<td><?=$prow['barcode'];?></td>
		<td><?=$prow['merchantSku'];?></td>
	</tr>
</table>
		
		
		
<?php
		if ($prow['productName'] != null) { $prpra++; }
	}
?>	
	</div>

	
	
	<div class="icerik">
	<table width="100%" border="0">
		<tr>
			<td colspan="3" height="50"><h2><b>Alıcı Bilgileri</b></h2></td>
		</tr>
		<tr>
			<td width="100"><b>Sipariş No</b></td>
			<td width="5">:</td>
			<td><?=$ordersw['orderNumber'];?></td>
		</tr>
		<tr>
			<td><b>Ad - Soyad</b></td>
			<td>:</td>
			<td><?=$shipmentw['fullName'];?></td>
		</tr>
		<tr>
			<td><b>Adres</b></td>
			<td>:</td>
			<td><?=$shipmentw['address1'];?></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><b><?=$shipmentw['city'];?>-<?=$shipmentw['district'];?></b></td>
		</tr>
	</table>
	</div>
	
</div>
<br><br>

	
	
	
	<?php
	}
		
if ($shipmentw['id']==null) { } else { $ordera++; }
}

	
	?>

	
		
		
		
<hr>		
		
	<center><h2>Diğer Siparişler</h2>	</center>
		
		
		
		
		
		
		
		
		<?php
$sayor = count($sonuc['content']);
$sayorder = $sayor + 30 ;
$order = 0;
while($order < $sayorder){
	if (!isset($sonuc['content'][$order])) { break ; } else {}

$orders = $sonuc['content'][$order];
$shipment=$orders['shipmentAddress'];
$invoice=$orders['invoiceAddress'];

	if ($orders['shipmentPackageStatus'] == "ReadyToShip" || $orders['shipmentPackageStatus'] == "Picking") {	} else {
	
?>
	
	
	
	
	
	
	
	
	
<div class="dis">

	<div class="check"><input type="checkbox" name="<?=$order;?>" value="<?=$order;?>"/>SEÇ-<?php echo $order+1;?></div>
	<div class="statu"><?=$orders['shipmentPackageStatus'];?></div>
	<div class="date"><?php echo date('d.m.Y H:i:s', $orders['orderDate']/1000);?></div>

	
	
	
	<div class="urun">
<?php	
$prpr = 0;	
	while ($prpr < 100){
		if (!isset($orders['lines'][$prpr])) { break; }
$pro = $orders['lines'][$prpr];
?>
<table width="100%" style="border: 1px solid;">
	<tr>
		<td colspan="3"><?=$pro['productName'];?></td>
	</tr>
	<tr>
		<td>Adet</td>
		<td>Barkod</td>
		<td>Ürün Kodu</td>
	</tr>
	<tr>
		<td><?=$pro['quantity'];?></td>
		<td><?=$pro['barcode'];?></td>
		<td><?=$pro['merchantSku'];?></td>
	</tr>
</table>
		
		
		
<?php
		if ($pro['productName'] != null) { $prpr++; }
	}
?>	
	</div>

	
	
	<div class="icerik">
	<table width="100%" border="0">
		<tr>
			<td colspan="3" height="50"><h2><b>Alıcı Bilgileri</b></h2></td>
		</tr>
		<tr>
			<td width="100"><b>Sipariş No</b></td>
			<td width="5">:</td>
			<td><?=$orders['orderNumber'];?></td>
		</tr>
		<tr>
			<td><b>Ad - Soyad</b></td>
			<td>:</td>
			<td><?=$shipment['fullName'];?></td>
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
	</table>
	</div>
	
</div>
<br><br>

	
	
	
	<?php
	}
if ($shipment['id']==null) { } else { $order++; }
}

	
	?>
		
		
		
		
		
		
		
		
		
		
		
		
		
<input class="a3" type="checkbox" name="y" value="a3" /><div class="a3y">A5</div>		
<input class="buton" type="submit" value="Yazdır" />

</form>	
	
</body>
</html>






















