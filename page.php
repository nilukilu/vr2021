<?php
    $myname = "Nils von Künnapuu";
    $currenttime = date("d.m.Y H:i:s");
    $timehtml = "\n <p>Lehe avamise hetkel oli: " .$currenttime .".</p>";
    $semesterbegin = new DateTime("2021-1-25");
    $semesterend = new DateTime("2021-06-30");
    $semesterduration = $semesterbegin->diff($semesterend);
    $semesterdurationdays = $semesterduration->format("%r%a");
    $semesterdurhtml = "\n <p>2021 kevadsemester kestus on " .$semesterdurationdays ." päeva.</p> \n";
    $today = date_create();
    $today = new DateTime("now");
    $fromsemesterbegin = $semesterbegin->diff($today);
    $fromsemesterbegindays = $fromsemesterbegin->format("%r%a");

    if($fromsemesterbegindays <= $semesterdurationdays){$semesterprogress = "\n" .'<p>Semester edeneb: <meter min="0" max="' .$semesterdurationdays .'" value="' .$fromsemesterbegindays .'">.</p>' ."\n";}
    else {
        $semesterprogress = "\n <p>Semester on lõppenud.</p> \n";
    }

    //loeme piltide kataloogi sisu
    $picsdir = "../../pics/";
    $allfiles = array_slice(scandir($picsdir), 2);
    //echo $allfiles[0];

    $photocount = count($picfiles);
    $photonum = mt_rand(0, $photocount-1);
    $randomphoto = $picfiles[$photonum];
    $allowedphototypes = ["image/jpeg", "image/png"];

    $picfiles = [];
    foreach($allfiles as $file) {
        $fileinfo = getimagesize($picsdir .$file);
        // var_dump($fileinfo); edastab kogu info
        if(isset($fileinfo[“mime”])) {
            if(in_array($fileinfo[“mime”], $allowedphototypes)) {
                array_push($picfiles, $file);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title>Veebirakendused ja nende loomine 2021</title>
</head>
<body>
    <h1>
    <?php
        echo $myname;
        echo $semesterdurhtml;
        echo $semesterprogress;
        ?>
	<h1>Nils Künnapuu</h1>
    <?=$currenttime ?>
	<p>See leht on valminud õppetöö raames!</p>
    <?=$timehtml ?>
    <img src="<?php echo $picsdir .$randomphoto; ?>" alt="vaade Haapsalus">
</body>
</html>

<?php
	$pagetitle = "Õpime PHP-d";
	$myname = "Juho Kalberg";
	$currenttime = date("d.m.Y H:i:s");
	$timehtml = "\n <p>Lehe avamise hetkel oli: " .$currenttime .".</p> \n";
	$semesterbegin = new DateTime("2021-1-25");
	$semesterend = new DateTime("2021-6-30");
	$semesterduration = $semesterbegin->diff($semesterend);                 // Diff funktsioon võrdleb alguse ja lõpuaega
	$semesterdurationdays = $semesterduration->format("%r%a");              // muudab ajaformaadi päevadeks

	$semesterdurhtml = "\n <p>2021 kevadsemestri kestus on " .$semesterdurationdays ." päeva.</p> \n";
	$today = date_create();                                                 // määrab mutuja tüübi
	$today = new DateTime("now");                                           // määran tänase kuupäeva
	$fromsemesterbegin = $semesterbegin->diff($today);
	$fromsemesterbegindays = $fromsemesterbegin->format("%r%a");
	$semesterprogress = "\n"  .'<p>Semester edeneb: <meter min="0" max="' .$semesterdurationdays .'" value="' .$fromsemesterbegindays .'"></meter>.</p>' ."\n";
	//--------------------------------------KODUTÖÖ-ÜL-1-------------------------------------------------//
	setlocale(LC_TIME, 'et_EE.utf8');                                       // Näitame eesti keeles käesolevat päeva.
	$todayname ="<p> Täna on ". strftime('%A.');
	//--------------------------------------KODUTÖÖ-ÜL-LÕPP----------------------------------------------//
	//--------------------------------------KODUTÖÖ-ÜL-2-------------------------------------------------//
	$today_manually = new DateTime();                                       // seadistame kuupäeva näitamise
	$today_manually->setDate(2020, 5, 10);                                  // muudan kuupäeva vastavalt soovile, et näha mis juhtub, kui oleks vastav kuupäev
	$iftoday = "Kui täna oleks ".$today_manually->format('d.m.Y'.",");
	                                                                        // kontrollime, kas semester kulgeb, on läbi või pole veel alanud, 
	                                                                        // sõltuvalt sellest, mis kuupäeva ülal sisestasime.
	$fromsemesterbegin = $semesterbegin->diff($today_manually);             // diff annab ajavahemiku semestri algusest $today-ni
	$fromsemesterbegindays = $fromsemesterbegin->format("%r%a");            // muuudame päevadeks
	                                                                        // võrdleme kas ajavahemik on vahemikus 0-semestri kestvus või on pikem või hoopis negatiivne
	if($fromsemesterbegindays <= $semesterdurationdays && $fromsemesterbegindays >=0) {
	    $semesterprogress_ver2 = 'leks semester omadega sealmaal: <meter min="0" max="' .$semesterdurationdays 
	    .'" value="' .$fromsemesterbegindays .'"></meter>';                 // ajavahemik on lubatud piires, seega semester kestab ja vormindame HTML muutuja mis näitab semetri kulgu
	    }    
	    else { 
	        if ($fromsemesterbegindays <0) 
	        {$semesterprogress_ver2 = " poleks semester veel alanud."; }    // ajavahemik on negatiivne, seega pole semester veel alanud
	        else {
	        $semesterprogress_ver2 = " oleks semester lõppenud.";}          // ajavahemik oli semestrist pikem ja seega semester on lõppenud
	    }
	//--------------------------------------KODUTÖÖ-ÜL-LÕPP----------------------------------------------//
	$picsdir = "images/";                                                   // loeme pildikataloogi sisu
	$allfiles = array_slice(scandir($picsdir), 2);                          // nr 2 lõpus on scandiriga loetud kaks esimest kirjet, mis räägivad lihtsalt kataloogist, seega need ei ole pildid

	$allowedphototypes = ["image/jpeg", "image/png"];
	$picfiles = [];                                                         //tekitan listi/massiivi $picfiles

	foreach($allfiles as $file) {                                           // for tsükkel et leida vaid pildifailid allfilest ja siis tähista iga võetud fail $file. Tsükkel läbitakse niipalju kordi, kui me $allfilesis leidsime
	    $fileinfo = getimagesize($picsdir .$file);                          // küsime faili suurust, sest selle abil saame me veel hunniku asju teada just sellelt pildilt mh failitüübi, mida meil vaja ongi
	    if(isset($fileinfo["mime"])) {                                      // kui nüüd fileinfos on "mime" siis edasi
	        if(in_array($fileinfo["mime"], $allowedphototypes)) {           // kui arrays on mime ja kas ta on allowed... massiivis
	            array_push($picfiles, $file);                               // array_push tähendab  võtan failime ja panen file picfiles massiivi
	        }
	    }
	}
	//--------------------------------------KODUTÖÖ-ÜL-3-------------------------------------------------//
	$randomphotofunc = array_rand($picfiles,3);                             // kuvame kolme juhuslikku pilti