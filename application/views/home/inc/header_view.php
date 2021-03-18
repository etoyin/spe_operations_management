<!doctype>
<html lang="en">
	<head>
		<title>SPE</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?=base_url()?>public/css/template.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/style.css"/>
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/bootstrap-responsive.min.css"/>
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"/>
		<link rel="icon" type="image/png" href="<?=base_url()?>public/images/spe3.png"/>

		<script src="<?=base_url()?>public/js/bootstrap.js" type="text/javascript"></script>
		<script src="<?=base_url()?>public/js/jquery-3.2.1.min.js" type="text/javascript"></script>
		<script src="<?=base_url()?>public/js/jquery-1.7.js" type="text/javascript"></script>
		<script src="<?=base_url()?>public/js/script.js" type="text/javascript"></script>
		<style>
			body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
			body {font-size:16px;}
			.w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
			.w3-half img:hover{opacity:1}
		</style>
		<script>
			$(document).ready(function(){
				 if(localStorage.getItem('login') && localStorage.getItem('login') == 'success'){
					 $('#logout').removeClass('displayNone');
				 }
			})
		</script>
		

	</head>
	<body>
		<!-- Sidebar/menu -->
		<nav class="w3-sidebar w3-green bg-stripes w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
      <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
      <div class="w3-container">
        <h3 class="w3-padding-64"><b>Operations<br>Management</b></h3>
      </div>
      <div class="w3-bar-block">
        <a href="Home" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Home</a> 
        <a href="Salary_Progression" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Salary Progression Evaluator</a> 
        <a href="<?=base_url()?>Home/logout" onclick="w3_close()" id='logout' class="w3-bar-item displayNone w3-button w3-hover-white">Logout</a> 
        
      </div>
    </nav>

    <!-- Top menu on small screens -->
    <header class="w3-container w3-top w3-hide-large w3-green w3-xlarge w3-padding">
      <a href="javascript:void(0)" class="w3-button w3-red w3-margin-right" onclick="w3_open()">☰</a>
      <span>Operations Manager</span>
    </header>

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

    <!-- !PAGE CONTENT! -->
    <div class="w3-main" style="margin-left:340px;margin-right:40px">

		<div >
