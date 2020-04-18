<?php
session_start();

$bdd = new PDO("mysql:host=127.0.0.1;dbname=ebayece;charset=utf8", "root", "");

if(isset($_GET['id_vendeur']) AND $_GET['id_vendeur'] > 0)
{
     $requsermodif = $bdd->prepare("SELECT * FROM vendeur WHERE id_vendeur = ?");
     $requsermodif->execute(array($_GET['id_vendeur']));
     $usermodif = $requsermodif->fetch();


     if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $usermodif['prenom'])
     {
     	$newprenom = htmlspecialchars($_POST['newprenom']);
     	$insertprenom = $bdd->prepare("UPDATE vendeur SET prenom = ? WHERE id_vendeur = ?");
     	$insertprenom->execute(array($newprenom, $_GET['id_vendeur']));
     	header("Location: admin.php?id_vendeur=".$_GET['id_vendeur']);

     }

      if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $usermodif['nom'])
     {
     	$newnom = htmlspecialchars($_POST['newnom']);
     	$insertnom = $bdd->prepare("UPDATE vendeur SET nom = ? WHERE id_vendeur = ?");
     	$insertnom->execute(array($newnom, $_GET['id_vendeur']));
     	header("Location: admin.php?id_vendeur=".$_GET['id_vendeur']);

     }

     if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $usermodif['email'])
     {
     	$reqmail = $bdd->prepare("SELECT * FROM vendeur WHERE email = ?");
     	$reqmail->execute(array($_POST['newmail']));
     	$mailexist = $reqmail->rowCount();

     	if($mailexist == 0)
        {
     	    $newmail = htmlspecialchars($_POST['newmail']);
     	    $insertmail = $bdd->prepare("UPDATE vendeur SET email = ? WHERE id_vendeur = ?");
     	    $insertmail->execute(array($newmail, $_GET['id_vendeur']));
     	    header("Location: admin.php?id_vendeur=".$_GET['id_vendeur']);
     	}
     	else
        {
     	    $msg = "Le mail existe déjà!";
     	}

     }

     if(isset($_POST['newmdp']) AND !empty($_POST['newmdp']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
     {
     	$newmdp = sha1($_POST['newmdp']);
     	$newmdp2 = sha1($_POST['newmdp2']);

     	if($newmdp == $newmdp2)
     	{
     		$insertmdp = $bdd->prepare("UPDATE vendeur SET password = ? WHERE id_vendeur = ?");
     	    $insertmdp->execute(array($newmdp, $_GET['id_vendeur']));
     	    header("Location: admin.php?id_vendeur=".$_GET['id_vendeur']);
     	}
     	else
     	{
     		$msg = "vos mots de passe de correspondent pas!";
     	}
  
     	

     }


	$getid = intval($_GET['id_vendeur']);
	$requser = $bdd->prepare("SELECT * FROM vendeur WHERE id_vendeur = ?");
	$requser->execute(array($getid));
	$userinfosA = $requser->fetch();

	
				   

?>


<!DOCTYPE html>
<html>
<head>
	<title> Ebay ECE: La vente aux enchères en ligne pour la communauté ECE Paris </title>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/compteacheteur.css">

    

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/compteacheteur.js"></script>

    

</head>

<body>
    <!--HEADER ---------------------------------------------------------->
	<header class="colorbar"> 
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-sm-12">


                  
					   
                         <a href="<?php echo "main.php?pseudo_admin=".$_SESSION['pseudo_admin']."" ?>">
						<img src="images/logo.png" width="170px" style="margin-top: 5px; margin-left: 10px">
						</a>

					
					
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

					<a href="<?php echo "panier.php?pseudo_admin=".$_SESSION['pseudo_admin']."" ?>"><img class="petitlogo" src="images/panier.png" width="25px"></a>

				   <img class="petitlogo" src="images/compte.png" width="40px">
				    				
					<a href="<?php echo "admin.php?pseudo_admin=".$_SESSION['pseudo_admin']."" ?>"><img class="petitlogo"src="images/admin.png" width="25px"></a>

					<div>
					    <a  class="nav-link style" href="<?php echo "panier.php?pseudo_admin=".$_SESSION['pseudo_admin']."" ?>" style="margin-top: 12px; margin-left: 105px; width: 65px;">Sell</a>
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
                             <li class="align"><a class="nav-link style" style="width: 155px; height: 40px;"href="<?php echo "categorie.php?pseudo_admin=".$_SESSION['pseudo_admin']."" ?>">Ferraille ou Trésor</a></li>
                             <li class="align"><a class="nav-link style" style="width: 155px; height: 40px;"href="<?php echo "categorie2.php?pseudo_admin=".$_SESSION['pseudo_admin']."" ?>">Bon pour le Musée</a></li>
                             <li class="align"><a class="nav-link style" style="width: 155px; height: 40px;"href="<?php echo "categorie3.php?pseudo_admin=".$_SESSION['pseudo_admin']."" ?>">Accessoire VIP</a></li>
                             <li class="align"><a class="nav-link style" style="width: 155px; height: 40px;"href="<?php echo "enchere.php?pseudo_admin=".$_SESSION['pseudo_admin']."" ?>">Enchères</a></li>

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
				
				<div class="col-lg-8 col-md-8 col-sm-12" style="background-color: white;border:1px solid silver; margin-left: 250px;; margin-top: 50px; margin-bottom: 50px;">
					<div class="bandeau">
						<div class="bandeau_gauche">
							<div class="titre" >
								<h2 style="text-align: center;"> Settings seller admin</h2>
							</div>	
							<div class="formulaire" style="margin-top: 50px; margin-bottom: 25px">

							  <form method="POST">
								
						      <input type="text" id="prenom" name="newprenom" value="<?php echo $userinfosA['prenom']?>" placeholder="prenom">
						 		<br>
						 	  <input type="text" id="nom" name="newnom" value="<?php echo $userinfosA['nom']?>" placeholder="nom">
						 		<br>
						      <input type="email" id="email" name="newmail"  value="<?php echo $userinfosA['email']?>"placeholder="email non modifiable">
						 		<br>
						      
						      <input type="password" id="password" name="newmdp" placeholder="password">
						        <br>
						        <input type="password" id="password" name="newmdp2" placeholder="re-type password">
						        <br> 

						      <label style="font-size: 25px">Birthday Date :</label>
						      <input type="date" id="date_anniversaire" value="<?php echo $userinfosA['date_anniversaire']?>" name="newdate">
						      <br>

						       <input type="submit" value="update my informations" style="background-color: black; color: white;" /> 
					        

						     
				      		</form>

				      		<?php
				               if(isset($msg)){
					              echo '<p style="margin-left:150px; color:red">'. $msg."</p>";
				                  }
				                ?>
							</div>
						</div>
						<div class="bandeau_droite">
							<div class="titre" >
								<h2 style="text-align: center;"> Shipping</h2>
							</div>
							<div class="formulaire" style="margin-top: 50px; margin-bottom: 25px">

							  <form oninput="total.value = (nights.valueAsNumber * 99) + ((guests.valueAsNumber - 1) * 10)">
							  <input type="text" id="pays" name="pays" placeholder="Pays vendeur" required>
						 		<br>
						      <input type="text" id="prenom" name="prenom" placeholder="Prenom vendeur" required>
						 		<br>
						 	  <input type="text" id="nom" name="nom" placeholder="Nom vendeur" required>
						 		<br>
						      <input type="text" id="adresse" name="adresse"placeholder="adresse vendeur" required>
						 		<br>
						      
						      <input type="text" id="region" name="region" placeholder="Région vendeur" required>
						        <br> 
						      <input type="text" id="ville" name="ville" placeholder="Ville vendeur" required>
						 		<br>
						 	  <input type="text" id="code_postal" name="code_postale" placeholder="code postal vendeur" required>
						 		<br>	
						      
						      <input type="text" id="telephone" name="telephone" placeholder="Telephone vendeur" required>
						      <br>

						      <input type="submit" value="Update my shipping" style="background-color: black; color: white;margin-top: 32px;" /> 
						      
							</div>
						</div>
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
							<li class="footer-link" style="font-size:15px; width: 200px;"><a href="<?php echo "conditions.php?pseudo_admin=".$_SESSION['pseudo_admin']."" ?>">Conditions d'utilisation</li></a>
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
	header("location: connexionadmin.php");
}

?>