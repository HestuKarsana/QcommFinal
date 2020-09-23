<?php
error_reporting(0);

include('src/BarcodeGenerator.php');
include('src/BarcodeGeneratorPNG.php');
include "phpqrcode/qrlib.php"; 

$vbarcode=strtoupper($_GET['vbarcode']);
//nmsip=YUNDAI&kotasip=BANDUNG&kotasip2=&ktrsip=BANDUNG&kdpsip2=40000&kdpsip=40111&tlpsip=0&emailsip=false&ems5=&perusahaansip=&almsip=JL.KOROPEAK&almsip1=JL.KOROPEAK&almsip2=&almsip3=false&almsip4=JL.KOROPEAK&almsip5=false&kodektrkdptlpsip=BANDUNG%2040111%20/TLP.0&nmsial=XXX&kdsial=0&kdalmsial=&kotasial=KOTA%20SUKABUMI&ktrtuj=KOTA%20SUKABUMI&kdptuj=43111&tlpsial=0&emailsial=false&perusahaansial=&almsial=YYY&almsial1=YYY&almsial2=&almsial3=false&almsial4=YYY&almsial5=false&kodektrkdptlp=KOTA%20SUKABUMI%2043111%20/TLP.0&refpengirim=-&msgpengirim=Tolong%20kirim%20jam%2012%20siang,%20telepon%20di%20depan%20gerbang&resi=1840000000000000138&singkatanktrasal=BAN&kantor=BANDUNG&singkatanktrtujuan=KOT&berat=10000&brtvlm=0&jnstransaksi=NON%20COD&tgltransaksi=07%20Mei%202018&jamtransaksi=09:28:27&estimasi=-&tmpketerangan=PAKETPOS%20BIASA&kdprod=230&jml=28300&nilaibrg=123123

//http://10.33.41.76/posapp/modules/apps/MLO002041/php/shipmentlabel/?nmsip=YUNDAI&kotasip=BANDUNG&kotasip2=&ktrsip=BANDUNG&kdpsip2=40000&kdpsip=40111&tlpsip=0899999999999&emailsip=qweasdfghasdfhg@gmai&ems5=&perusahaansip=PT%20YUYUN&almsip=JL.KOROPEAK&almsip1=JL.KOROPEAK&almsip2=PT%20YUYUN&almsip3=false&almsip4=JL.KOROPEAK&almsip5=false&kodektrkdptlpsip=BANDUNG%2040111%20/TLP.0899999999999&nmsial=IBRAHIM&kdsial=0&kdalmsial=&kotasial=KOTA%20BANDUNG&ktrtuj=KOTA%20BANDUNG&kdptuj=40115&tlpsial=082212311231231&emailsial=qwertyqwertyqwerty@g&perusahaansial=CK.COLL&almsial=PERUM%20MANGLAYANG%20REGENCY%20BLOK%20J.11%20&almsial1=PERUM%20MANGLAYANG%20REGENCY%20BLOK%20J.11%20NO.%201&almsial2=CK.COLL&almsial3=NO.%201&almsial4=PERUM%20MANGLAYANG%20REGENCY%20BLOK%20J.11%20NO.%201&almsial5=NO.%201&kodektrkdptlp=KOTA%20BANDUNG%2040115%20/TLP.082212311231231&refpengirim=-&msgpengirim=Tolong%20kirim%20jam%2012%20siang,%20telepon%20di%20depan%20gerbang&resi=1840000000000000140&singkatanktrasal=BAN&kantor=BANDUNG&singkatanktrtujuan=KOT&berat=10000&brtvlm=0&jnstransaksi=NON%20COD&tgltransaksi=08%20Mei%202018&jamtransaksi=13:03:25&estimasi=-&tmpketerangan=EKSPRESS%20BARANG%20NASIONAL&kdprod=447&jml=101300&nilaibrg=123123&vbarcode=16541450048&provinsisip=SUMBAR&provinsisial=JABAR&tglestimasi=-

//http://localhost/posapp/modules/apps/MLO002041/php/shipmentlabel/?nmsip=YUNDAI&kotasip=BANDUNG&kotasip2=&ktrsip=BANDUNG&kdpsip2=40000&kdpsip=40111&tlpsip=087435129327&emailsip=false&ems5=&perusahaansip=&almsip=JL.KOROPEAK&almsip1=JL.KOROPEAK&almsip2=&almsip3=false&almsip4=JL.KOROPEAK&almsip5=false&kodektrkdptlpsip=BANDUNG%2040111%20/TLP.087435129327&nmsial=INDRA%20TATO%20IPOS%20LOKET&kdsial=0&kdalmsial=&kotasial=KAB.%20BANYUMAS&ktrtuj=KAB.%20BANYUMAS&kdptuj=53111&tlpsial=09872312632192&emailsial=false&perusahaansial=&almsial=GRAHA%20POS%20INDONESIA%20LT.%203%20DIVISI%20TE&almsial1=GRAHA%20POS%20INDONESIA%20LT.%203%20DIVISI%20TEKNOLOGI%20JL.%20BANDA%20NO%2030&almsial2=&almsial3=KNOLOGI%20JL.%20BANDA%20NO%2030&almsial4=GRAHA%20POS%20INDONESIA%20LT.%203%20DIVISI%20TEKNOLOGI%20JL.%20BANDA%20NO%2030&almsial5=KNOLOGI%20JL.%20BANDA%20NO%2030&kodektrkdptlp=KAB.%20BANYUMAS%2053111%20/TLP.09872312632192&refpengirim=-&msgpengirim=-&resi=1840000000000000175&singkatanktrasal=Bd&kantor=BANDUNG&singkatanktrtujuan=Tg&berat=1231&brtvlm=0&jnstransaksi=NON%20COD&tgltransaksi=14%20Mei%202018&jamtransaksi=09:20:03&estimasi=24%20JAM&tmpketerangan=EKSPRESS%20DOKUMEN%20NASIONAL&kdprod=417&jml=69800&nilaibrg=3245677&vbarcode=40000RE00000003&provinsisip=SUMBAR&provinsisial=JABAR&tglestimasi=-&negarasip=INDONESIA&negarasial=INDONESIA&pesan_pelanggan=undefined&isikiriman=baju%20hijab

$vbarcode='123123123';
$tempdir = "qrcode/";
$isi_teks = $vbarcode;
$namafile = $vbarcode.".png";
$quality = 'H';
$ukuran = 4; 
$padding = 0;
QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);

echo
		"<center><img src='qrcode/".$vbarcode.".png' /></center>
		";
/*		echo "<script>window.print();
		window.close()</script>";
*/
//echo "<script>window.alert('$tempdir');</script>";
/*$tempdir = "qrcode/";
$isi_teks = $vbarcode;
$namafile = $vbarcode.".png";
$quality = 'H';
$ukuran = 4; 
$padding = 0;
*/
//http://elevenmillion.blogspot.co.id/2009/12/colspan-dan-rowspan-di-table-html.html
?>