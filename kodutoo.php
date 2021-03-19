<?php
	$myname = "Nils Von Künnapuu";
	$pagetitle = "Vebirakenduste kodukas";
	$currenttime = date("d.m.Y H:i:s");
	$timehtml = "\n <p>Lehe avamise hetkel oli: " .$currenttime .".</p> \n";
	$semesterbegin = new DateTime("2021-1-25");
	$semesterend = new DateTime("2021-6-30");
	$semesterduration = $semesterbegin->diff($semesterend);
	$semesterdurationdays = $semesterduration->format("%r%a");

	$semesterdurhtml = "\n <p>2021 kevadsemestri kestus on " .$semesterdurationdays ." päeva.</p> \n";
	$today = date_create();  
	$today = new DateTime("now");                              
	$fromsemesterbegin = $semesterbegin->diff($today);
	$fromsemesterbegindays = $fromsemesterbegin->format("%r%a");
	$semesterprogress = "\n"  .'<p>Semester edeneb: <meter min="0" max="' .$semesterdurationdays .'" value="' .$fromsemesterbegindays .'"></meter>.</p>' ."\n";
	setlocale(LC_TIME, 'et_EE.utf8');                                    
	$todayname ="<p> Hetkel on ". strftime('%A.');
	$today_manually = new DateTime();                               
	$today_manually->setDate(2020, 5, 10);                            
	$iftoday = "Kui oleks ".$today_manually->format('d.m.Y'.",");                                                                
	$fromsemesterbegin = $semesterbegin->diff($today_manually);          
	$fromsemesterbegindays = $fromsemesterbegin->format("%r%a");                 
	if($fromsemesterbegindays <= $semesterdurationdays && $fromsemesterbegindays >=0) {
	    $semesterprogress_ver2 = 'leks semester omadega sealmaal: <meter min="0" max="' .$semesterdurationdays 
	    .'" value="' .$fromsemesterbegindays .'"></meter>';        
	    }    
	    else { 
	        if ($fromsemesterbegindays <0) 
	        {$semesterprogress_ver2 = " siis ei käiks veel semesteer"; }  
	        else {
	        $semesterprogress_ver2 = " semester oleks läbi";}    
	    }
	$picsdir = "pics/";                                   
	$allfiles = array_slice(scandir($picsdir), 2); 
	$allowedphototypes = ["image/jpeg", "image/png"];
	$picfiles = [];                                                       
	foreach($allfiles as $file) {                                           
	    $fileinfo = getimagesize($picsdir .$file);                       
	    if(isset($fileinfo["mime"])) {                                   
	        if(in_array($fileinfo["mime"], $allowedphototypes)) {     
	            array_push($picfiles, $file);                
	        }
	    }
	}

	$randomphotofunc = array_rand($picfiles,3);
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Veebirakendused ja nende loomine 2021</title>
	<link rel="stylesheet" href="assets/css/starter.css">
	<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body class="container bg-gradient-secondary text-bright">
	<h1>
	<?php
		echo $pagetitle;
	?>
	</h1>
	<h2>
	<?php
		echo $myname;
	?>
	</h2>
	<p>See leht on valminud õppetöö raames!</p>
	<?php
		echo $timehtml;
		echo $semesterdurhtml;
		echo $semesterprogress;
		echo "<p>";
		echo $iftoday;
		echo $semesterprogress_ver2;
		echo "</p>";
		echo $todayname;
	?>

	<div class="row">
		<h2 class="col-12">Pildid</h2>
		<div class="d-md-flex">
			<img class="img-fluid col-md-4 mb-3" src="<?php echo $picsdir .$picfiles[$randomphotofunc[0]]; ?>" alt="pilt haapsalust">
			<img class="img-fluid col-md-4 mb-3" src="<?php echo $picsdir .$picfiles[$randomphotofunc[1]]; ?>" alt="pilt haapsalust">
			<img class="img-fluid col-md-4 mb-3" src="<?php echo $picsdir .$picfiles[$randomphotofunc[2]]; ?>" alt="pilt haapsalust">
</body>
</html>