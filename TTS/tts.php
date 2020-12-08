<!DOCTYPE html>
<html>
<head>
	<title>Text-to-Speech</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
	<div class="container col-md-10 p-2 pt-5">
		<div>
			<center>
				<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
			  		<div class="carousel-inner">
			    		<div class="carousel-item active col-md-3">
			      			<img src="logo_tba.png" width="10px" height="180px" class="d-block w-100" alt="...">
			      		</div>
			      	</div>
				</div>
			</center>
		</div>
		
		<?php 
		require_once "penggalan.php";
		$penggalanobjek = new penggalan;
		$idsubmit="";
		$bicara="";
		if(isset($_POST['text'])){
			$idsubmit = "1";
			$isikalimat = $_POST['kalimat'];
			$contohsatu = $penggalanobjek::processpenggalan($isikalimat);
			$parsetoarray = json_decode($contohsatu,true);
		} elseif(isset($_POST['speech'])) {
			$idsubmit = "2";
			$bicara=$_POST['bicara'];
  			$speech=htmlspecialchars($bicara);
  			$speech=rawurlencode($speech);
  			$html=file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$speech.'&tl=en-IN');
  			$player="<audio controls='controls' autoplay><source src='data:audio/mpeg;base64,".base64_encode($html)."'></audio>";
  			echo $player;
		} else {
			$isikalimat = "belum ada";
		}
		 ?>
		 <form method="POST">
			<div class="row">
				<div class="col-md-6">
			    <label for="exampleFormControlTextarea1" class="form-label">Masukan teks :</label>
  				<textarea class = "form-control" name="kalimat" id="kalimat" rows="3"> </textarea>
  				
		  	</div>
			<div class="col-md-6">
			    <label for="exampleFormControlTextarea1" class="form-label">Hasil :</label>
  				<textarea class="form-control" name="bicara" id="bicara" rows="3">
  				<?php if($idsubmit==1) {
					for($i=0; $i < count($parsetoarray); $i++){
						echo $parsetoarray[$i]." ";
					} 
				} else {
						echo $bicara;
				} ?>
  				</textarea>
			</div>
			</div>
		  <div class="mt-3">
		  	<button type="submit" name="text" class="btn btn-primary">Text</button>
		  	<button type="submit" name="speech" class="btn btn-primary">Speech</button>
		  </div>
		</form>
	</div>
</body>
</html>

