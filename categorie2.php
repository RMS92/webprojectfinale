<?php
session_start();

$bdd = new PDO("mysql:host=127.0.0.1;dbname=ebayece;charset=utf8", "root", "");

if((isset($_GET['id_acheteur']) AND $_GET['id_acheteur'] > 0) OR (isset($_GET['id_vendeur']) AND $_GET['id_vendeur'] > 0) OR (!isset($_GET['id_vendeur']) AND isset($_GET['id_acheteur'])) OR (isset($_GET['id_vendeur']) AND !isset($_GET['id_acheteur'])) OR (!isset($_GET['id_vendeur']) AND !isset($_GET['id_acheteur'])) OR isset($_GET['pseudo_admin']))
{

    $changemain = "main.php";
    $changecompteA = "connexion.php";
    $changecompteB= "connexionadmin.php";
    $changecompteC= "panier.php";

    $changecate = "categorie.php";
    $changecate2 = "categorie2.php";
    $changecate3 = "categorie3.php";
    $changeenchere = "enchere.php";
    $changevendre = "";
    $changecondition = "conditions.php";
    $changeenchere = "enchere.php";

    $changeachatbid = "achatbid.php";


    

    if((isset($_GET['id_acheteur']) AND $_GET['id_acheteur'] > 0))
    {
	    $getid = intval($_GET['id_acheteur']);
	    $requser = $bdd->prepare("SELECT * FROM acheteur WHERE id_acheteur = ?");
	    $requser->execute(array($getid));
	    $userinfosA = $requser->fetch();

	    if(isset($_SESSION['id_acheteur']) AND $userinfosA['id_acheteur'] == $_SESSION['id_acheteur'])
	    {
	    	$changemain = "main.php?id_acheteur=".$_SESSION['id_acheteur']."";
		    $changecompteA = "compteacheteur.php?id_acheteur=".$_SESSION['id_acheteur']."";
		    $changecompteB = "";
		    $changecate = "categorie.php?id_acheteur=".$_SESSION['id_acheteur']."";
		    $changecate2 = "categorie2.php?id_acheteur=".$_SESSION['id_acheteur']."";
            $changecate3 = "categorie3.php?id_acheteur=".$_SESSION['id_acheteur']."";
            $changeenchere = "enchere.php?id_acheteur=".$_SESSION['id_acheteur']."";
            $changevendre = "";
            $changecondition = "conditions.php?id_acheteur=".$_SESSION['id_acheteur']."";
            $changecompteC = "panier.php?id_acheteur=".$_SESSION['id_acheteur']."";
             $changeenchere = "enchere.php?id_acheteur=".$_SESSION['id_acheteur']."";

            $changeachatbid = "achatbid.php?id_acheteur=".$_SESSION['id_acheteur']."";
	    }
    }

    else if((isset($_GET['id_vendeur']) AND $_GET['id_vendeur'] > 0))
    {
	    $getid = intval($_GET['id_vendeur']);
	    $requser = $bdd->prepare("SELECT * FROM vendeur WHERE id_vendeur = ?");
	    $requser->execute(array($getid));
	    $userinfosA = $requser->fetch();

	    if(isset($_SESSION['id_vendeur']) AND $userinfosA['id_vendeur'] == $_SESSION['id_vendeur'])
	    {
		    $changemain = "main.php?id_vendeur=".$_SESSION['id_vendeur']."";
		    $changecompteA = "comptevendeur.php?id_vendeur=".$_SESSION['id_vendeur']."";
		    $changecompteB = "";
		    $changecate = "categorie.php?id_vendeur=".$_SESSION['id_vendeur']."";
		    $changecate2 = "categorie2.php?id_vendeur=".$_SESSION['id_vendeur']."";
            $changecate3 = "categorie3.php?id_vendeur=".$_SESSION['id_vendeur']."";
            $changeenchere = "enchere.php?id_vendeur=".$_SESSION['id_vendeur']."";
            $changevendre = "vendre.php?id_vendeur=".$_SESSION['id_vendeur']."";
            $changecondition = "conditions.php?id_vendeur=".$_SESSION['id_vendeur']."";
            $changecompteC = "";
            $changeenchere = "enchere.php?id_vendeur=".$_SESSION['id_vendeur']."";

            $changeachatbid = "achatbid.php?id_vendeur=".$_SESSION['id_vendeur']."";
	    }
    }

    else if(isset($_GET['pseudo_admin']))
    {
	    $getid = $_GET['pseudo_admin'];
	    $requser = $bdd->prepare("SELECT * FROM admin WHERE pseudo_admin = ?");
	    $requser->execute(array($getid));
	    $userinfosA = $requser->fetch();

	    if(isset($_SESSION['pseudo_admin']) AND $userinfosA['pseudo_admin'] == $_SESSION['pseudo_admin'])
	    {
		    $changecompteB = "admin.php?pseudo_admin=".$_SESSION['pseudo_admin']."";
		    $changecompteA = "";
		    $changemain = "main.php?pseudo_admin=".$_SESSION['pseudo_admin']."";
		    $changecate = "categorie.php?pseudo_admin=".$_SESSION['pseudo_admin']."";
		    $changecate2 = "categorie2.php?pseudo_admin=".$_SESSION['pseudo_admin']."";
            $changecate3 = "categorie3.php?pseudo_admin=".$_SESSION['pseudo_admin']."";
            $changeenchere = "enchere.php?pseudo_admin=".$_SESSION['pseudo_admin']."";
            $changevendre = "vendre.php?pseudo_admin=".$_SESSION['pseudo_admin']."";
            $changecondition = "conditions.php?pseudo_admin=".$_SESSION['pseudo_admin']."";
            $changecompteC = "panier.php?pseudo_admin=".$_SESSION['pseudo_admin']."";
             $changeenchere = "enchere.php?pseudo_admin=".$_SESSION['pseudo_admin']."";

            $changeachatbid = "achatbid.php?pseudo_admin=".$_SESSION['pseudo_admin']."";
	    }
    }
    
    $userinfosA = $bdd->query("SELECT * FROM produit WHERE categorie = 'bon pour le muse' AND statut = 'non vendu'");  

?>


<!DOCTYPE html>
<html>
<head>
	<title> Ebay ECE: La vente aux enchères en ligne pour la communauté ECE Paris </title>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/main.css">

    

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/main.js"></script>

    

</head>

<body>
    <!--HEADER ---------------------------------------------------------->
	<header class="colorbar"> 
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-sm-12">

					<a href="<?php echo $changemain  ?>"><img src="images/logo.png" width="170px" style="margin-top: 5px; margin-left: 10px"></a>
					
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

					<a href="<?php echo $changecompteC  ?>"><img class="petitlogo" src="images/panier.png" width="25px"></a>

					
		            <a href="<?php echo $changecompteA  ?>"><img class="petitlogo" src="images/compte.png" width="40px"></a>
					
					<a href="<?php echo $changecompteB  ?>"><img class="petitlogo"src="images/admin.png" width="25px"></a>

					<div>
					    <a  class="nav-link style" href="<?php echo $changevendre  ?>" style="margin-top: 12px; margin-left: 105px; width: 65px;">Sell</a>
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
                            
                           
                              <li class="align"><a href="<?php echo $changecate ?>" class="nav-link style" style="width: 155px; height: 40px;">Ferraille ou Trésor</a></li>
	                        
	                                                                           
                             <li class="align"><a class="nav-link style" style="width: 155px; height: 40px;" href="<?php echo $changecate2 ?>">Bon pour le Musée</a></li>



                             <li class="align"><a class="nav-link style" style="width: 155px; height: 40px;"href="<?php echo $changecate3 ?>">Accessoire VIP</a></li>



                             <li class="align"><a class="nav-link style" style="width: 155px; height: 40px;"href="<?php echo $changeenchere ?>">Enchères</a></li>

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
				<div class="col-lg-12 col-md-12 col-sm-12" style="height:45px; color: white; background-color: black">
					<h3> Bon pour le musé</h3>
				</div>

			</div>

			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12" style="">

					<div class="row">
				        <div class="col-lg-2 col-md-2 col-sm-12" style="border: 1px solid black; margin-left: 5px; margin-top: 10px;">

				        	<h6 class="style" style="margin-top: 10px;">Les mieux notés</h6>

                            
                            <ul style="list-style: none;">
							<?php for ($i=0; $i < 3 ; $i++) { 
								# code...
							  $info = $userinfosA->fetch()?>

							<li class = "style" style="margin-top: 25px; margin-left: -18px;"><?= $info['nom'] ?> <br> <?= $info['categorie'] ?> <br> <img src="<?php echo $info['photo']?>" width="125" height="125"><br><?= $info['prix'] ?>€ <br><a 
								<?php if(isset($_GET['id_acheteur']))
								{?>
								href="<?php echo "achatbid.php?id_acheteur=".$_GET['id_acheteur']."&item=".$info['id_produit']."" ?>" 
                                <?php
							    }?> 

							    <?php if(isset($_GET['id_vendeur']))
								{?>
								href="<?php echo "achatbid.php?id_vendeur=".$_GET['id_vendeur']."&item=".$info['id_produit']."" ?>"
                                <?php
							    }?> 

							    <?php if(isset($_GET['pseudo_admin']))
								{?>
								href="<?php echo "achatbid.php?pseudo_admin=".$_GET['pseudo_admin']."&item=".$info['id_produit']."" ?>" 
                                <?php
							    }?> 

							    <?php if(!isset($_GET['id_acheteur']) AND !isset($_GET['id_vendeur']) AND !isset($_GET['pseudo_admin']))
								{?>
								href="<?php echo "achatbid.php?item=".$info['id_produit']."" ?>"> 
                                <?php
							    }?> 
							    
							    
								<br>voir l'article</a> </li>
							<?php
						     }
							?>
					        </ul>
					     </div>

				        	  
				        <div class="col-lg-9 col-md-9 col-sm-12" style="border: 1px solid black;margin-left: 20px; margin-top: 10px;">

				        	<ul style="list-style: none;text-align: center; margin-left: -30px;">
							<?php for ($i=0; $i < $info = $userinfosA->fetch(); $i++) { 
								    
								# code...
							 ?>

							<li class = "style" style="margin-top: 25px; margin-left: 15px;"><?= $info['nom'] ?> <br> <?= $info['categorie'] ?> <br> <img src="<?php echo $info['photo']?>" width="200" height="200"><br><?= $info['prix'] ?>€<br> 
								<a <?php if(isset($_GET['id_acheteur']))
								{?>
								href="<?php echo "achatbid.php?id_acheteur=".$_GET['id_acheteur']."&item=".$info['id_produit']."" ?>" 
                                <?php
							    }?> 

							    <?php if(isset($_GET['id_vendeur']))
								{?>
								href="<?php echo "achatbid.php?id_vendeur=".$_GET['id_vendeur']."&item=".$info['id_produit']."" ?>"
                                <?php
							    }?> 

							    <?php if(isset($_GET['pseudo_admin']))
								{?>
								href="<?php echo "achatbid.php?pseudo_admin=".$_GET['pseudo_admin']."&item=".$info['id_produit']."" ?>" 
                                <?php
							    }?> 

							    <?php if(!isset($_GET['id_acheteur']) AND !isset($_GET['id_vendeur']) AND !isset($_GET['pseudo_admin']))
								{?>
								href="<?php echo "achatbid.php?item=".$info['id_produit']."" ?>"> 
                                <?php
							    }?>  <br> voir l'article</a> </li>

							<?php
							  
						     }
							?>
					        </ul>
				        	
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
							<li class="footer-link" style="font-size:15px; width: 200px;"><a href="<?php echo $changecondition?>">Conditions d'utilisation</li></a>
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
?>
