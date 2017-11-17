<?php     
  include("./inc/connect.inc.php");
include("./inc/header.inc.php");

if($_POST){//Form gönderildi mi?
	if ($_FILES["resim"]["size"]<1024*1024){//Dosya boyutu 1Mb tan az olsun
		if ($_FILES["resim"]["type"]=="image/jpeg"){//dosya tipi jpeg olsun
			
			$dosya_adi=$_FILES["resim"]["name"];
			//Dosyaya yeni bir isim oluşturuluyor
			$uret=array("as","rt","ty","yu","fg");
			$uzanti=substr($dosya_adi,-4,4);
			$sayi_tut=rand(1,10000);
			$yeni_ad="dosyalar/".$uret[rand(0,4)].$sayi_tut.$uzanti;
			//Dosya yeni adıyla dosyalar klasörüne kaydedilecek
			if (move_uploaded_file($_FILES["resim"]["tmp_name"],$yeni_ad)){
				echo 'Dosya başarıyla yüklendi.';

                               
				$sorgu=mysqli_query($mysqli,"insert into pictures values ('$username' , '$yeni_ad')");
				if ($sorgu){
					
				}else{
					
				}
			}else{
				
			}
		}else{
			
		}
	}else{			
		
	}
}
?>

