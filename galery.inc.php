<?php
// creates revert img folder
if (!is_dir("img/upload/revert")) {
    mkdir("img/upload/revert",0777);
}

$ordner = "img/upload/";
$allebilder = scandir($ordner);

foreach ($allebilder as $bild) {
	$bildinfo = pathinfo($ordner."/".$bild); 
	$size = ceil(filesize($ordner."/".$bild)/1024); 

	if ($bild != "." && $bild != ".."  && $bild != "_notes" && $bildinfo['basename'] != "Thumbs.db" && $bild != "revert" && $bild != ".DS_Store") { 
	?>
	
    <li class="gallery">
		<a class="fancybox" href="<?php echo $bildinfo['dirname']."/".$bildinfo['basename'];?>">
		<img src="<?php echo $bildinfo['dirname']."/".$bildinfo['basename'];?>" alt="Vorschau"/></a>
		<span><?php echo $bildinfo['filename']; ?> (<?php echo $size ; ?>kb)
			<a href="image-functions.php?action=to_del&path=<?php echo $bildinfo['dirname']."/".$bildinfo['basename']; ?>">
				<img src="img/close-button.png" alt="" class="bearbeitungs-icons">
			</a>
			<a href="image-functions.php?action=to_grey&path=<?php echo $bildinfo['dirname']."/".$bildinfo['basename']; ?>">
				<img src="img/icons-png/icon-122119.png" class="bearbeitungs-icons">
			</a>
			<a href="image-functions.php?action=to_rotate&path=<?php echo $bildinfo['dirname']."/".$bildinfo['basename']; ?>&dir=right">
				<img src="img/icons-png/returning-right-arrow.png" class="bearbeitungs-icons">
			</a>
			<a href="image-functions.php?action=to_rotate&path=<?php echo $bildinfo['dirname']."/".$bildinfo['basename']; ?>&dir=left">
				<img src="img/icons-png/return-button.png" class="bearbeitungs-icons">
			</a>			
			<a href="image-functions.php?action=to_mirror&path=<?php echo $bildinfo['dirname']."/".$bildinfo['basename']; ?>">
				<img src="img/icons-png/square-camera-viewfinder.png" class="bearbeitungs-icons">
			</a>  
			<a href="image-functions.php?action=to_down&path=<?php echo $bildinfo['dirname']."/".$bildinfo['basename']; ?>">
				<img src="img/icons-png/down-arrow-download-button.png" class="bearbeitungs-icons">
			</a>  
			<a href="image-functions.php?action=undo&path=<?php echo $bildinfo['dirname']."/".$bildinfo['basename'];?>">
				undo
			</a>
			
		</span>
		<form action="image-functions.php?action=to_crop&path=<?php echo $bildinfo['dirname']."/".$bildinfo['basename']; ?>" method="post">
		width: <br> <input type="number" name="width"> <br>
		height: <br> <input type="number" name="height"> <br>
		X: <br> <input type="number" name="X"> <br>
		Y: <br> <input type="number" name="Y"> <br>
		<input type="submit" value="crop image" name="submit">
		</form>
   		
    </li>

<?php
	};
 };
?>
