<?php

     $bdd = new PDO("mysql:host=127.0.0.1;dbname=ebayece;charset=utf8", "root", "");

     if(isset($_POST['inscription'])) 
     {
     	$prenom = htmlspecialchars($_POST['prenom']);
     	$nom = htmlspecialchars($_POST['nom']);
     	$email = htmlspecialchars($_POST['email']);
     	$mdp = sha1($_POST['mdp']);
     	$mdp2 = sha1($_POST['mdp2']);
     	$date = htmlspecialchars($_POST['date']);

     	if(!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['email']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND !empty($_POST['date']) AND !empty($_POST['acceptterms']) AND(!empty($_POST['choixV']) AND empty($_POST['choixA'])) OR (empty($_POST['choixV']) AND !empty($_POST['choixA'])))
     	{
     		/*$acceptterms = htmlspecialchars($_POST['acceptterms']);
     		$choixA = htmlspecialchars($_POST['choixA']);
     		$choixV = htmlspecialchars($_POST['choixV']);*/

     		$prenomtaille = strlen($prenom);
     		if($prenomtaille <= 25)
     		{
     			$nomtaille = strlen($nom);
     			if($nomtaille <= 25)
     			{
     				$emailtaille = strlen($email);
     				
     					if($emailtaille <= 50)
     					{
     						if(filter_var($email, FILTER_VALIDATE_EMAIL))
     						{
     							$reqmail = $bdd->prepare("SELECT * FROM acheteur WHERE email = ?");
     							$reqmail->execute(array($email));
     							$mailexist = $reqmail->rowCount();

     							$reqmail2 = $bdd->prepare("SELECT * FROM vendeur WHERE email = ?");
     							$reqmail2->execute(array($email));
     							$mailexist2 = $reqmail2->rowCount();

                                if($mailexist == 0 OR $mailexist2==0)
                                {
     						        if($mdp == $mdp2)
     						        {
     						    	    if(!empty($_POST['choixV']) AND empty($_POST['choixA']))
     						    	    {
     						    		    /*VENDEUR*/
     						    		    $insertacheteur = $bdd->prepare("INSERT INTO vendeur(prenom, nom, email, password, date_anniversaire) VALUES (?,?,?,?,?)");

     						    		    $insertacheteur->execute(array($prenom, $nom, $email, $mdp, $date));
     						    		    $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\"> Me connecter </a>";
     						    		    

     						    	    }
     						    	    else if(empty($_POST['choixV']) AND !empty($_POST['choixA']))
     						    	    {
     						    		    /*ACHETEUR*/
     						    		    $insertacheteur = $bdd->prepare("INSERT INTO acheteur(prenom, nom, email, password, date_anniversaire) VALUES (?,?,?,?,?)");

     						    		    $insertacheteur->execute(array($prenom, $nom, $email, $mdp, $date));
     						    		    $erreur = "Votre compte a bien été créé !";
     						    		    $_SESSION['comptecree'] = "Votre compte a bien été créé !";
     						    		    $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\"> Me connecter </a>";
     						    	    }

     						        }    
     						        else
     						        {
     						    	$erreur = "Vos mots de passe ne correspondent pas !";
     						        }

     						    }
     						    else
     						    {
     						    	$erreur = "Votre mail existe déjà!";
     						    }

     						}
     						else
     						{
     							$erreur ="Votre e-mail n'est pas valide !";
     						}
     					}
     					else
     					{
     					   $erreur = "Votre e-mail ne doit pas dépasser 50 caractères !";
     				    }
     				

     			}
     			else
     			{
     				$erreur = "Votre nom ne doit pas dépasser 25 caractères !";
     			}

     		}
     		else
     		{
     			$erreur = "Votre prénom ne doit pas dépasser 25 caractères !";
     		}

     	}
     	else
     	{
     		$erreur = "Tous les champs doivent etre complétés !";
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

    <link rel="stylesheet" type="text/css" href="css/inscription.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/inscription.js"></script>
</head>

<body>

    <!--HEADER ---------------------------------------------------------->
	<header class="colorbar"> 
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-sm-12">

					<a href="main.php"><img src="images/logo.png" width="170px" style="margin-top: 5px; margin-left: 10px"></a>
					
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
				<div class="col-lg-7" style="background-color: white;border:1px solid silver; margin-bottom: 50px">
					<div class="titre" style="margin-top: 40px">
						<h2 style="text-align: center;"> Register for a free account</h2>	
					</div>
					
					<div class="formulaire" style="margin-top: 50px; margin-bottom: 25px">

			    <form method="POST">
						
				      <input type="text" id="prenom" name="prenom" placeholder="Prenom" value="<?php if(isset($prenom)){ echo $prenom; } ?>">
				 		<br>
				 	  <input type="text" id="nom" name="nom" placeholder="Nom" value="<?php if(isset($nom)){ echo $nom;}?>">
				 		<br>
				      <input type="text" id="email" name="email"placeholder="E-mail" value="<?php if(isset($email)){ echo $email;}?>">
				 		<br>
				      
				      <input type="password" id="password" name="mdp" placeholder="Password" >
				        <br> 

				      <input type="password" id="password_repeat" name="mdp2" placeholder="Confirm Password">
				 		<br>

				      <label style="font-size: 25px">Birthday Date :</label>
				      <input type="date" id="date_anniversaire" name="date" placeholder="Birthday date" value="<?php if(isset($date)){ echo $date;}?>">
				      <br>

				      <label style="font-size: 25px">Voulez- vous créer un compte : </label>
				      <br>
				      <label style="font-size: 25px; margin-top: 20px;"> Vendeur :</label>
							<input type="checkbox" name="choixV" value="vendeur" style="font-size: 25px" />
							<label style="font-size: 25px"> Acheteur :</label>

							<input type="checkbox" name="choixA" value="acheteur" />
					   <br>

					   <table>
					   	<tr>
					   		<td><input id="acceptTerms" type="checkbox" name="acceptterms" style="width: 20px; height: 20px; padding-bottom: 0px; margin-top: 0px; margin-left: 2px;"/></td>

					   		<td><label for="acceptTerms" style="margin-left: 10px;"> I agree to the <a href="conditions.html">Terms and Conditions</a> and <a>Privacy Policy</a> </label></td>
					   	</tr>
					   </table>
				      
 						<br>

				      <input type="submit" name = "inscription" value="Sign up" style="margin-left: 50px" /> 
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
	<footer class="footbar">

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