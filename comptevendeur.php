<?php
session_start();

$bdd = new PDO("mysql:host=127.0.0.1;dbname=ebayece;charset=utf8", "root", "");

if(isset($_GET['id_vendeur']) AND $_GET['id_vendeur'] > 0)
{
	$getid = intval($_GET['id_vendeur']);
	$requser = $bdd->prepare("SELECT * FROM vendeur WHERE id_vendeur = ?");
	$requser->execute(array($getid));
	$userinfosA = $requser->fetch();

	if(isset($_SESSION['id_vendeur']) AND $userinfosA['id_vendeur'] == $_SESSION['id_vendeur'])
	{
		$change = "comptevendeur.php";
	}
    else
	{
		$change = "connexion.php";
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

    <link rel="stylesheet" type="text/css" href="css/comptevendeur.css">

    

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/comptevendeur.js"></script>

    

</head>

<body>
    <!--HEADER ---------------------------------------------------------->
	<header class="colorbar"> 
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-sm-12">

					<a href="<?php echo "main.php?id_vendeur=".$_SESSION['id_vendeur']."" ?>">
						<img src="images/logo.png" width="170px" style="margin-top: 5px; margin-left: 10px"></a>
					
				</div>

				<div class="col-lg-8 col-md-8 col-sm-12">

					<form method="GET" action="recherche.php">
						<table>

							<tr>
								<td> <input type="Search" name ="r" placeholder="Search for products..."style="width: 750px; height: 35px; margin-left: 18px; margin-top: 12px; border-color:#DCDCDC #696969 #696969 #DCDCDC; -webkit-border-radius:5px;">
								</td>
								<td>
									<?php if(isset($_GET['id_acheteur']))
								    {?>
									<input type="hidden"  name = "id_acheteur" value="<?= $_SESSION['id_acheteur'] ?>">
									<?php
							        }?>

							        <?php if(isset($_GET['id_vendeur']))
								    {?>
									<input type="hidden"  name = "id_vendeur" value="<?= $_SESSION['id_vendeur'] ?>">
									<?php
							        }?>

							        <?php if(isset($_GET['pseudo_admin']))
								    {?>
									<input type="hidden"  name = "pseudo_admin" value="<?= $_SESSION['pseudo_admin'] ?>">
									<?php
							        }?>

							        <?php if(!isset($_GET['id_acheteur']) AND !isset($_GET['id_vendeur']) AND !isset($_GET['pseudo_admin']))
								    {?>
								    <input type="hidden"  name = "" value="">
								    <?php
							        }?> 





								</td>
								<td><input  class="bouton" type="submit" name="recherchevalider" value="OK" style="cursor: pointer; -webkit-border-radius:5px;"></td>

							</tr>
						</table>

					   


					</form>
					
				</div>

				<div class="col-lg-2 col-md-2 col-sm-12"> <!--height 80-->

					<a href="<?php echo "panier.php?id_vendeur=".$_SESSION['id_vendeur']."" ?>"><img class="petitlogo" src="images/panier.png" width="25px"></a>
					
					<a href="<?php $change ?>"><img class="petitlogo" src="images/compte.png" width="40px"></a>
					<img class="petitlogo"src="images/admin.png" width="25px">

					<div>
					    <a  class="nav-link style" href="<?php echo "vendre.php?id_vendeur=".$_SESSION['id_vendeur']."" ?>" style="margin-top: 12px; margin-left: 105px; width: 65px;">Sell</a>
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
                             <li class="align"><a class="nav-link style" style="width: 155px; height: 40px;"href="<?php echo "categorie.php?id_vendeur=".$_SESSION['id_vendeur']."" ?>">Ferraille ou Trésor</a></li>
                             <li class="align"><a class="nav-link style" style="width: 155px; height: 40px;"href="<?php echo "categorie2.php?id_vendeur=".$_SESSION['id_vendeur']."" ?>">Bon pour le Musée</a></li>
                             <li class="align"><a class="nav-link style" style="width: 155px; height: 40px;"href="<?php echo "categorie3.php?id_vendeur=".$_SESSION['id_vendeur']."" ?>">Accessoire VIP</a></li>
                             <li class="align"><a class="nav-link style" style="width: 155px; height: 40px;"href="<?php echo "enchere.php?id_vendeur=".$_SESSION['id_vendeur']."" ?>">Enchères</a></li>

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
				
				<div class="col-lg-4 col-md-4 col-sm-12" style="background-color: white;border:1px solid silver; margin-left: 200px; margin-bottom: 10px;">
					<div class="bandeau">
						<div class="bandeau_gauche">
							<div class="titre" >
								<h2 style="text-align: center;"> Settings seller</h2>
							</div>	
							<div class="formulaire" style="margin-top: 50px; margin-bottom: 25px">

							  <form method="GET">
								
						      <input type="text" id="prenom" name="prenom"  value="<?php echo $userinfosA['prenom'];?>">
						 		<br>
						 	  <input type="text" id="nom" name="nom"  value="<?php echo $userinfosA['nom'];?>">
						 		<br>
						      <input type="email" id="email" name="email" value="<?php echo $userinfosA['email'];?>">
						 		<br>
						      
						      <input type="password" id="password" name="password" placeholder="Password">
						        <br> 
						      <input type="password" id="password_repeat" name="password_repeat" placeholder="Confirm Password"
						       oninput="check(this)">
						 		<br>

						      <label style="font-size: 25px">Birthday Date :</label>
						      <input type="date" id="date_anniversaire" name="date_anniversaire"  value="<?php echo $userinfosA['date_anniversaire'];?>">
						      <br>

						     
						      <?php if(isset($_SESSION['id_vendeur']) AND $userinfosA['id_vendeur'] == $_SESSION['id_vendeur'])
	                          {
						      ?>
						       <a href="<?php echo "updatev.php?id_vendeur=".$_SESSION['id_vendeur']."" ?>"><input type="button" value="Change my informations" style="background-color: black; color: white;" /> </a>

						      <a href="sedeconnecter.php">
				      			<input type="button" value=" Se Déconnecter" style="background-color: red; color: white; margin-top: 50px;" >

				      		  </a>
				      		  <?php
				      		   }
				      		   else
				      		   {
				      		   	
				      		   }
				      		  ?>
				      		</form>
							</div>
						</div>
					
					</div>
				</div>
				<div class="casedroite">
					<div class="titre" >
								<h2 style="text-align: center;"> Gestion des ventes</h2>
					</div>
					<a href="<?php echo "gestionventes.php?id_vendeur=".$_SESSION['id_vendeur']."" ?>">
					<input type="button" name="gestionvente" value="Accéder à la Gestion des ventes" style="background-color: blue; color: white;margin-top: 20px;"></a>
					
				</div>	
			</div>
			
		</div>

	</div>			


	<!--FOOTER ---------------------------------------------------------->
	<footer class="footbar">

		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12" style="background:rgb(240,240,240);height: 70px;">
					<p style="color: black; margin-left: 855px; margin-top: 22px;">AS FEATURES ON | EBAY | VENTE PRIVEE | WISH</p>
					
				</div>
			</div>
			

				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-12 " style="height: 275px;">
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
							<li class="footer-link" style="font-size:15px; width: 200px;"><a href="<?php echo "conditions.php?id_vendeur=".$_SESSION['id_vendeur']."" ?>">Conditions d'utilisation</li></a>
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

<?php

}

else
{
	header("location: operation_nonvalide.html");
}

?>