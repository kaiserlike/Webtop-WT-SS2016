<?php 
	if(isset($_SESSION["iconPos"])){
		$iconPos = $_SESSION["iconPos"];
	}

	if(isset($_SESSION["windowPos"])){
		$windowPos = $_SESSION["windowPos"];
	}
	
 ?>

<div class="taskbar">
	<a href="#" class="startbutton"></a>
</div>

<div class="startmenu">
	<?php if(isset($_SESSION["profil_pic"])){ ?>
		<img src="img/profilbilder/<?=$_SESSION["profil_pic"];?>" alt="" class="profilpic">
	<?php } ?>
	<ul>
		<li class="startmenu-item">Benutzer: <?php echo $_SESSION["logged-in-user"]; ?></li>
		<li class="startmenu-item"></li>
		<li class="startmenu-item"><a href="index.php?i=0">PHP Info</a></li>
		<li class="startmenu-item"><a href="index.php?i=1">Programm 1</a></li>		
		<li class="startmenu-item"><a href="index.php?i=2">Programm 2</a></li>
		<li class="startmenu-item"><a href="index.php?i=3">Programm 3</a></li>
	</ul>
</div>

<div class="icon-wrap 1 dragbox" id="icon-0" style="
	<?php 
		if($iconPos[0][0] != NULL) {
			echo "top: ".$iconPos[0][1]."px; left: ". $iconPos[0][0] ."px;"; 
		} else {
			echo "top: 30px; left: 20px;";
		}
	?>">
	<a href="index.php?i=0" class="webtop-icon icon-1"><img src="img/icons-png/file-folder.png" alt=""></a>
</div>

<div class="icon-wrap dragbox" id="icon-1" style="
	<?php 
		if($iconPos[1][0] != NULL) {
			echo "top: ".$iconPos[1][1]."px; left: ". $iconPos[1][0] ."px;"; 
		} else {
			echo "top: 110px; left: 20px;";
		}
	?>">
	<a href="index.php?i=1" class="webtop-icon icon-1"><img src="img/icons-png/home-button.png" alt=""></a>
</div>

<div class="icon-wrap dragbox" id="icon-2" style="
	<?php 
		if($iconPos[2][0] != NULL) {
			echo "top: ".$iconPos[2][1]."px; left: ". $iconPos[2][0] ."px;"; 
		} else {
			echo "top: 190px; left: 20px;";
		}
	?>">
	<a href="index.php?i=2" class="webtop-icon icon-1"><img src="img/icons-png/ship-rudder.png" alt=""></a>
</div>

<div class="icon-wrap dragbox" id="icon-3" style="
	<?php 
		if($iconPos[3][0] != NULL) {
			echo "top: ".$iconPos[3][1]."px; left: ". $iconPos[3][0] ."px;"; 
		} else {
			echo "top: 270px; left: 20px;";
		}
	?>">
	<a href="index.php?i=3" class="webtop-icon icon-1"><img src="img/icons-png/up-arrow-upload-button.png" alt=""></a>
</div>

<?php 
	switch($_SESSION["open-window"]){
		case 0:?>
			<div class="webtop-window dragbox" id="fenster-0" style="top: 75px; left: 500px; 
				<?php 
					if($windowPos[0][0] != NULL) {
						echo "top: ".$windowPos[0][1]."px; left: ". $windowPos[0][0] ."px;"; 
					}
				?>">
				<div class="webtop-titlebar">
					<span class="webtop-title-bar-title">PHP-Info</span>
					<a href="index.php?i=-1"><img src="img/close-button.png" alt="" ></a>
				</div>
				<div class="webtop-content">
					<?php
						// display phpinfo without the styles
						ob_start();
						phpinfo();
						$info = ob_get_contents();
						ob_end_clean();
						echo preg_replace('%^.*<body>(.*)</body>.*$%ms', '$1', $info);
					?>
				</div>				
			</div>	
<?php		break;

		case 1: ?>			
			<div class="webtop-window dragbox" id="fenster-1"style="top: 75px; left: 500px; 
				<?php 
					if($windowPos[1][0] != NULL) {
						echo "top: ".$windowPos[1][1]."px; left: ". $windowPos[1][0] ."px;"; 
					}
				?>">
				<div class="webtop-titlebar">
					<a href="index.php?i=-1"><img src="img/close-button.png" alt="" ></a>
					Programm 1 
				</div>
				<div class="webtop-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio eaque, qui aperiam. Quas recusandae soluta tenetur eum velit ullam explicabo veritatis quae fuga atque similique debitis, excepturi quis esse consequatur est, aspernatur inventore dicta iure porro iusto? Molestiae laborum consectetur id aut quaerat distinctio, odio, recusandae quis nisi nobis soluta in ratione nesciunt perspiciatis dolorem aliquid perferendis sapiente, eum modi nostrum! Ipsum sapiente, architecto laudantium necessitatibus eligendi fuga minima optio exercitationem laborum, ipsam aut odit. Libero dolorem quo ipsam asperiores beatae consequuntur commodi, placeat minima, ea officia sunt! Animi recusandae, esse laborum corporis voluptatibus doloribus, ab. Deleniti earum ducimus, pariatur.</div>				
			</div>	
<?php 		break;	

		case 2: ?>			
			<div class="webtop-window dragbox" id="fenster-2"style="top: 75px; left: 500px; 
				<?php 
					if($windowPos[2][0] != NULL) {
						echo "top: ".$windowPos[2][1]."px; left: ". $windowPos[2][0] ."px;"; 
					}
				?>">
				<div class="webtop-titlebar">
					<a href="index.php?i=-1"><img src="img/close-button.png" alt="" ></a>
					Programm 2
				</div>
				<div class="webtop-content">
					<?php include("edit-profile.inc.php") ?>
				</div>
			</div>	
<?php 		break;	

		case 3: ?>			
			<div class="webtop-window dragbox" id="fenster-3"style="top: 75px; left: 500px; 
				<?php 
					if($windowPos[3][0] != NULL) {
						echo "top: ".$windowPos[3][1]."px; left: ". $windowPos[3][0] ."px;"; 
					}
				?>">
				<div class="webtop-titlebar">
					<a href="index.php?i=-1"><img src="img/close-button.png" alt="" ></a>
						Foto-App
				</div>
				<div class="webtop-content">
					<form method="post" action="image-functions.php?action=upload" enctype="multipart/form-data">
  						Foto:
  						
  						<input type="file" name="file">
  						<input type="submit" name="Submit" value="Upload">
					</form>
					<form method="post" action="image-functions.php?action=upload" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone"></form>
			 		
			 		<ul id="galerie">
					<?php
						include("galery.inc.php");
					?>
					</ul>
			</div>	
<?php 		break;	

		case 4: ?>			
			<div class="webtop-window dragbox" id="fenster-4"style="top: 75px; left: 500px; 
				<?php 
					if($windowPos[4][0] != NULL) {
						echo "top: ".$windowPos[4][1]."px; left: ". $windowPos[4][0] ."px;"; 
					}
				?>">
				<div class="webtop-titlebar">
					<a href="index.php?i=-1"><img src="img/close-button.png" alt="" ></a>
					Programm 4
				</div>
				<div class="webtop-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea pariatur ratione eius cumque aspernatur, cum perspiciatis laboriosam numquam, similique rem veritatis, deleniti explicabo quibusdam ducimus fugit in tenetur aut, natus at. Vel dignissimos rerum beatae, libero asperiores tempora, dolor ad similique repellat quia quam amet doloribus iusto. Corporis molestiae natus eligendi reiciendis ad molestias asperiores nihil maiores. Aliquam minima, officia commodi tempore voluptas facere tempora, repudiandae beatae at praesentium suscipit fugit, unde iusto nemo necessitatibus. Aperiam culpa, quod quas quaerat eius facilis consequuntur adipisci reiciendis sed hic quibusdam architecto quis velit, autem repudiandae molestias accusamus asperiores harum voluptas magni porro. Placeat, earum perferendis dignissimos ab, vel error tempora amet voluptatem ipsum ducimus nostrum molestiae ea enim non accusamus mollitia repudiandae reiciendis voluptatum? Quam sapiente non quis incidunt tempore, quisquam tempora! Voluptatem minima consequuntur aliquid maiores, nulla aperiam quae doloribus tempore sunt officiis. Unde iusto odit sint aliquid cupiditate tempore doloribus iste incidunt ullam. Debitis porro illo ipsa nihil impedit. Omnis quia nisi, commodi at deleniti corrupti voluptatum facere deserunt repudiandae beatae. Impedit pariatur illum, soluta provident aspernatur ea eaque explicabo, dolorum nemo modi! In delectus saepe, quis ipsum? Eos deleniti architecto accusantium porro, velit magni quas expedita animi nam unde assumenda, sit iste suscipit aut aliquam officiis provident culpa non!</div>
			</div>	
<?php 		break;	
	}		
?>


<div class="logout-wrap">
	Hallo <?=$_SESSION["logged-in-user"]; ?>! <a href="logout.php">(logout)</a>
</div>