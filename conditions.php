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

					<form>
						<table>
							<tr>
								<td> <input type="search" placeholder="Search for products..."style="width: 750px; height: 35px; margin-left: 18px; margin-top: 12px; border-color:#DCDCDC #696969 #696969 #DCDCDC; -webkit-border-radius:5px;">
								</td>
								<td><input  class="bouton" type="submit" name="" value="OK" style="cursor: pointer; -webkit-border-radius:5px;"></td>
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



                             <li class="align"><a class="nav-link style" style="width: 155px; height: 40px;"href="<?php echo  $changeenchere ?>">Enchères</a></li>

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
		<div class="container-fluid" style="padding-bottom: 75px;">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12" style="height:45px; color: white; background-color: black">
					<h3>Conditions générales</h3>
				</div>
			</div>	
		</div>	
		<div class="container" style="background-color: white;border: 1px solid silver;margin-bottom: 30px">
			<h2 style="margin-top: 30px; text-align: center; color: #2B777F"> Conditions d'utilisation des services d'eBayECE</h2>
			
			<p style="margin-left: 70px; margin-right: 70px;margin-top: 50px">Les présentes conditions d'utilisation (les « Conditions d'utilisation ») s'appliquent aux utilisateurs à compter de leur date d’inscription sur eBay. Pour les utilisateurs inscrits avant le 1er avril 2018, ces Conditions d'utilisation leur seront applicables à partir du 1er mai 2018. Ces conditions remplacent toutes les versions antérieures des Conditions d'utilisation d'eBay. La précédente modification de ces Conditions d'utilisation a eu lieu le 12 mai 2016.<br><br>
			Si vous êtes un consommateur, aucune stipulation des Conditions d'utilisation ne saurait exclure ou limiter de quelque manière que ce soit la responsabilité d'eBay à votre égard. Cette responsabilité d'eBay ne pourra être limitée ou exclue que dans les cas prévus par la loi, à savoir en cas de force majeure, de faits irrésistibles, de faute d'un tiers ou de votre propre faute.
			<br><br>
			Les présentes conditions d'utilisation (les « Conditions d'utilisation ») décrivent les conditions dans lesquelles la société eBay propose l'accès à ses sites, services, applications (notamment via des appareils mobiles/tablettes ou tout autre support à venir) et outils (ci-après désignés par les « Applications »).</p>

			<h3 style="margin-left: 50px; margin-right: 50px;margin-top: 30px;"> 1. Objet </h3>
			<p style="margin-left: 70px; margin-right: 70px;margin-top: 30px"> eBayECE est une place de marché qui permet à ses utilisateurs d'offrir, de vendre ou d'acheter pratiquement tout ce qu'il ou elle souhaite, dans une diversité de formats tarifaires et de lieux d'échange, tels que, entre autres, les boutiques, les mises en vente à prix fixe ("Achat immédiat") ou au format "Enchères" provenant de lieux différents.<br><br>
			eBayECE ne détient aucun objet mis en vente ou vendu sur son site, et n’intervient en aucune façon dans la transaction entre les vendeurs et les acheteurs. Le contrat de vente est conclu exclusivement et directement entre le vendeur et l’acheteur. eBay n’est pas une société de vente aux enchères publiques.<br><br>
			Nous n'intervenons pas dans les transactions entre acheteurs et vendeurs. A ce titre, nous ne transférons pas la propriété des objets du vendeur à l'acheteur. Les accords de vente/achat sont conclus directement entre l'acheteur et le vendeur. En conséquence, nous n'exerçons aucun contrôle sur la qualité, la sûreté ou la légalité des objets mis en vente, la véracité ou l'exactitude du contenu ou des annonces des utilisateurs, la capacité des vendeurs à vendre lesdits objets ni la capacité des acheteurs à payer lesdits objets. Toute indication sur les tarifs et la livraison, ou tout autre conseil proposés par eBayECE sur ses sites, services, applications ou outils, sont fournis uniquement à titre informatif.<br> <br>Par ailleurs, nous ne pouvons pas assurer que le vendeur ou l'acheteur concluront ou exécuteront la transaction, ou qu’un acheteur retournera correctement un objet. Le vendeur est libre de choisir l'enchérisseur avec lequel il souhaite conclure la vente. Toutefois, dès que le vendeur notifie l'enchérisseur qu'il accepte son offre, les dispositions de la loi française s'appliquent à la vente.<br><br>
			Les vendeurs doivent disposer d'un moyen de paiement valide enregistré auprès d'eBay, et ce de manière permanente. Lors de la configuration ou modification de votre méthode de paiement pour le règlement des frais de Services eBayECE, vous avez accepté en exécution du contrat de facturation d’être prélevé automatiquement de tout frais ici dû par eBayECE en application des présentes Conditions. Cela comprend notamment les montants dus pour les frais eBay et les bordereaux d'affranchissement.<br><br> eBay vous informera de ces frais sur vos factures, le cas échéant. Si les sommes dont vous êtes redevable à eBayECE ne peuvent recouvrées par la méthode de paiement renseignée pour quelque raison que ce soit, vous restez tenu de régler à eBayECE tous les montants impayés.<br><br> eBayECE se réserve le droit de demander tant le remboursement de ces sommes par tout autre moyen que ceux de tous frais supplémentaires engagés par eBay pour obtenir ce remboursement, si la loi l’autorise. Vous pouvez modifier votre méthode de paiement dans Mon eBay à tout moment.</p>

			<h3 style="margin-left: 50px; margin-right: 50px;margin-top: 30px;"> 2. Frais </h3>
			<p style="margin-left: 70px; margin-right: 70px;margin-top: 30px"> L'inscription et l'action d'enchérir sur des objets proposés sur nos Services sont gratuites. L'utilisation d'autres services tels que la mise en vent d'objets est payante. eBayECE peut être amenée à modifier les frais en publiant ces changements sur son site ou dans la section Messages de Mon eBayECE, 14 jours à l'avance. Vous pouvez clôturer votre compte sans aucune pénalité dans les 14 jours suivant la notification desdits changements.
			Sauf mention contraire, tous les tarifs sont indiqués en euros (EUR).<br><br> Il est de votre responsabilité de payer tous les frais et taxes applicables résultant de l'utilisation de nos Services dans les délais et par l'intermédiaire d'un mode de paiement valable. En cas de problème lié à votre mode de paiement ou si votre compte présente un arriéré, nous tenterons de percevoir les montants dus par d'autres moyens de recouvrement, nous débiterons les autres modes de paiement figurant dans votre compte, nous pourrons faire appel à une agence de recouvrement ou à un conseil juridique habilité à cette fin. Des intérêts de retard au taux légal s'appliqueront le cas échéant.<br><br> Vous acceptez que nous vous envoyions des factures au format électronique par e-mail. Enfin, nous pouvons aussi suspendre ou limiter votre capacité à utiliser nos Services jusqu'à ce que le paiement ait été intégralement reçu.
			<br><br>
			Si des sommes sont disponibles sur votre compte eBay depuis plus de 5 ans, vous acceptez qu’eBay puisse conserver ces sommes après vous en avoir informé et laisser la possibilité de vous y opposer.</p>

			<h3 style="margin-left: 50px; margin-right: 50px;margin-top: 30px;"> 3. Conditions d'achats </h3>
			<p style="margin-left: 70px; margin-right: 70px;margin-top: 30px"> Lorsque vous achetez un objet, vous acceptez de vous conformer au règlement pour les acheteurs et de :
				<ul style="margin-left: 90px">
					<li>lire l’annonce dans son intégralité avant de faire une offre ou d’acheter un objet ;</li> <br>
					<li>conclure un contrat juridiquement contraignant d’acheter un objet lorsque vous vous engagez à acheter ledit objet auprès du vendeur ou lorsque vous êtes le meilleur enchérisseur (ou si votre enchère est le cas échéant acceptée).</li>
				</ul>
			</p>

			<h3 style="margin-left: 50px; margin-right: 50px;margin-top: 30px;"> 4. Clause additionelle </h3>
			<p style="margin-left: 70px; margin-right: 70px;margin-top: 30px"> Les vendeurs peuvent créer des règles pour automatiser les retours et les remboursements dans certaines circonstances. Pour tous les nouveaux vendeurs, eBay peut définir une règle par défaut qui automatise la procédure de retour pour tout ou partie de leurs annonces pour lesquelles les retours sont acceptés. Les vendeurs peuvent supprimer ou personnaliser leurs préférences de retour dans les paramètres de leur compte dans Mon eBay. Vous acceptez ici vous conformer à la procédure de retour eBay.<br><br>
			Lorsqu’un objet est retourné ou si une transaction est annulée (voir notre Règlement en matière d’annulation de transactions), afin de rembourser l'acheteur, vous acceptez qu’eBay puisse demander à PayPal d’annuler le paiement de l’acheteur (dans la même devise ou dans une devise différente) de votre compte PayPal.
			</p>


		</div>
		<div class="container" style="background-color: white; margin-bottom: 50px">
			<div class="row">
			<a class="nav-link style" style="width: 155px; height: 40px;" onclick="history.go(-1)">Retour</a>
    		
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
