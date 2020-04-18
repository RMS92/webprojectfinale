<?php
session_start();

   $bdd = new PDO("mysql:host=127.0.0.1;dbname=ebayece;charset=utf8", "root", "");

   if(isset($_POST['inscriptionconnect']))
   {
   	    $emailconnect = htmlspecialchars($_POST['emailconnect']);
   	    $mdpconnect = $_POST['mdpconnect'];

   	    if(!empty($emailconnect) AND !empty($mdpconnect))
   	    {
   	    	$requser = $bdd->prepare("SELECT * FROM admin WHERE email = ? AND password = ?");
            $requser->execute(array($emailconnect, $mdpconnect));
            $exist = $requser->rowCount();

            if($exist == 1)
            {
            	$userinfosA = $requser->fetch();
            	$_SESSION['pseudo_admin'] = $userinfosA['pseudo_admin'];
            	$_SESSION['email'] = $userinfosA['email'];
            	header("Location: admin.php?pseudo_admin=".$_SESSION['pseudo_admin']);
            }
            	
            else 
            {
            	$erreur = "Identifiants incorrects";
            }
   	    }
   	    else
   	    {
   	    	$erreur = "Tous les champs doivent etre complétés!";
   	    }
   }


?>


<!DOCTYPE html>
<html>
<head>
	<title> Ebay ECE: La vente aux enchères en ligne pour la communauté ECE Paris </title>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/connexion.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/connexion.js"></script>
</head>

<body>

    <!--HEADER ---------------------------------------------------------->
	<header class="colorbar"> 
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-sm-12">

					<a href=main.php><img src="images/logo.png" width="170px" style="margin-top: 5px; margin-left: 10px"></a>
					
				</div>

				<div class="col-lg-8 col-md-8 col-sm-12">

					<form>
						<table>
							<tr>
								<td> <input type="search" placeholder="Search for products..."style="width: 750px; height: 35px; margin-left: 18px; margin-top: 12px; border-color:#DCDCDC #696969 #696969 #DCDCDC; -webkit-border-radius:5px;">
								</td>
								<td><img class="petitlogo" src="images/loupe.png" width="25px" style="margin-left: 0px;"></td>
							</tr>
						</table>

					   


					</form>
					
				</div>

				<div class="col-lg-2 col-md-2 col-sm-12"> <!--height 80-->

					<a href="panier.php"><img class="petitlogo" src="images/panier.png" width="25px"></a>
					<a href="connexion.php"><img class="petitlogo" src="images/compte.png" width="40px"></a>
					<a href="connexionadmin.php"><img class="petitlogo"src="images/admin.png" width="25px"></a>

					<div>
					    <a  class="nav-link style" href="vendre.php" style="margin-top: 12px; margin-left: 105px; width: 65px;">Sell</a>
				    </div>
					
				</div>

			</div>
			
		</div>
	</header>

	<!--NAV ---------------------------------------------------------->
	<nav class="colorbar">

		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-7 col-md-7 col-sm-12"><!--height 65-->

					<div>
                         <ul class="stylelist">
                             <li class="align"><a class="nav-link style" style="width: 155px; height: 40px;"href="categorie.php">Ferraille ou Trésor</a></li>
                             <li class="align"><a class="nav-link style" style="width: 155px; height: 40px;"href="categorie2.php">Bon pour le Musée</a></li>
                             <li class="align"><a class="nav-link style" style="width: 155px; height: 40px;"href="categorie3.php">Accessoire VIP</a></li>
                             <li class="align"><a class="nav-link style" style="width: 155px; height: 40px;"href="enchere.php">Enchères</a></li>

                        </ul>
                    </div>
					
				</div>

				<div class="col-lg-5 col-md-5 col-sm-12">

					<div>
						<h6 style="margin-top:5px;margin-left: 62px;font-style: italic; font-size: 16px;">Ebay ECE: La vente aux enchères en ligne</h6> 
						<h6 style="margin-left: 230px;font-style: italic; font-size: 16px;"> pour la communauté ECE Paris</h6>

					</div>
					
					
				</div>
				<hr align="center" width="95.9%" color="grey" size="3" style="margin-top: -5px;">

			</div>
			
			
		</div>
	</nav>


    <!--PARTIE DU MILIEU---------------------------------------------------------->
	<div class="milieu">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-sm-12" style="background-color: white">
					
				</div>
				<div class="col-lg-7 col-md-7 col-sm-12" style="background-color: white;border:1px solid silver;">
					<div class="titre" style="margin-top: 40px">
						<h2 style="text-align: center;"> Connexion à votre compte admin</h2>	
					</div>
					
					<div class="formulaire" style="margin-top: 50px">

					 <form method="POST">
						
				      <input type="email" id="email" name="emailconnect"placeholder="E-mail">
				 		<br>
				      
				      <input type="password" id="password" name="mdpconnect" placeholder="Password">
				        <br> 
				      
				      <input type="submit"  name="inscriptionconnect" value="Sign up" /> 
				      <br>
				  </form>
				  <?php
				if(isset($erreur)){
					echo '<p style="margin-left:150px; color:red">'. $erreur."</p>";
				}
				?>
				     
					</div>

				</div>
				
			</div>
		</div>

	</div>			


	<!--FOOTER ---------------------------------------------------------->
	<footer class="footbar" style="margin-top: 17px">

		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12" style="background:rgb(240,240,240);height: 70px;">
					<p style="color: black; margin-left: 855px; margin-top: 22px;">AS FEATURES ON | EBAY | VENTE PRIVEE | WISH</p>
					
				</div>
			</div>
			

				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-12" style="height: 275px;">
						<p class="stylefooter" style="font-size: 17px; width: 300px; margin-left: 40px; margin-top: 15px;">Quoi de neuf sur ECE ebay?</p>
					    <p   style="font-size: 12px; width: 300px;margin-left: 40px;margin-bottom: 20px;">INSCRIVEZ-VOUS POUR AVOIR UN ACCÈS EXCLUSIF À LA VENTE ET À DE NOUVELLES ARRIVÉES SUR MESURE</p>

                           <form>
                           	    <table>
                           	    	<tr>
                           	    		<td><input type="text" name="" placeholder="E-mail" style=" margin-left: 37px; width: 220px; -webkit-border-radius:5px;"></td>
                           	    		<td><input type="submit" name="" value="sign up" style=" margin-left: 2px; cursor: pointer; -webkit-border-radius:5px;"></td>
                           	    	</tr>
                           	    </table>
                           </form>
                           <a href="https://www.facebook.com"><img src="images/fb.png" width="20px" style="margin-left: 40px;cursor: pointer;margin-top: 45px;"></a>
					       <a href="https://www.instagram.com"><img src="images/insta.png" width="20px" style="margin-left:7px;cursor: pointer;margin-top: 45px;"></a>
					       <a href="https://www.twitter.com"><img src="images/twitter.png" width="20px" style="margin-left: 7px;cursor: pointer;margin-top: 45px;"></a>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12" style="height: 275px;">
						<p class="stylefooter" style="font-size: 17px; width: 300px; margin-left: 40px; margin-top: 15px;">A propos de nous</p>
						<ul style="list-style: none; margin-left: 100px;" >
							<li class="footer-link" style="font-size: 15px; width:200px;">Carrière</li>
							<li class="footer-link" style="font-size: 15px; width:200px;">Blog</li>
							<li class="footer-link" style="font-size: 15px; width:200px;">Impressions</li>
							<li class="footer-link" style="font-size:15px; width: 200px;"><a href="conditions.php">Conditions d'utilisation</li></a>
							<li  class="footer-link" style="font-size: 15px; width: 200px ">Politique de confidentialité</li>
						</ul>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12" style="height: 275px;">
						<p class="stylefooter" style="font-size: 17px; width: 300px; margin-left: 40px; margin-top: 15px;">Service client</p>
						<ul style="list-style: none; margin-left: 100px;">
							<li  class="footer-link" style="font-size: 15px; width: 200px;">Comment vendre?</li>
							<li  class="footer-link" style="font-size: 15px; width:200px;">Comment acheter?</li>
							<li  class="footer-link" style="font-size: 15px; width:200px;">Commande et livraisons</li>
							<li  class="footer-link" style="font-size: 15px; width: 200px;">Comment ça marche?</li>
							<li  class="footer-link" style="font-size: 15px; width: 200px;">Support</li>
						</ul>
					</div>

					<hr align="center" width="95.9%" color="#fff" size="3" style="margin-top: -55px;">
					<p style="margin-left: 997px; font-size: 12px; margin-top: -50px;">&copy; ECE ebay ° Est.2020 ° Made in Europe </p>
										
				</div>					
			
		</div>
		
	</footer>

</body>
</html>