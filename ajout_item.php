<?php
    
    $nowtime = time();
    // Décalaration des variables qui sont affectés aux valeurs saisies dans le formulaire par l'utilisateur 
    $id_vendeur = isset($_POST["id_vendeur"])? $_POST["id_vendeur"] : "";
    
    $intitule = isset($_POST["Intitule"])? $_POST["Intitule"] : "";
    $prix = isset($_POST["Prix"])? $_POST["Prix"] : "";
    $categorie = isset($_POST["Categorie"])? $_POST["Categorie"] : "";
    $description = isset($_POST["Description"])? $_POST["Description"] : "";
    $n_vente_1 = isset($_POST["NatureVente1"])? $_POST["NatureVente1"] : "";
    $n_vente_2 = isset($_POST["NatureVente2"])? $_POST["NatureVente2"] : "";
    $date = isset($_POST["Date"])? $_POST["Date"] : "";
    $heure = isset($_POST["Heure"])? $_POST["Heure"] : "";
    $prix_enchere = isset($_POST["PrixE"])? $_POST["PrixE"] : "";
    $photo = isset($_POST["Photo"])? $_POST["Photo"] : "";

    $tmp_name=$_FILES['Photo']['tmp_name'];
    $name = $_FILES['Photo']['name'];
    move_uploaded_file($tmp_name, $name);

    $video = isset($_POST["Video"])? $_POST["Video"] : "";
    
    // Identifier le nom de base de données
    $database = "ebayece";

    // Connecter à la base de données
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

    // Si la BDD existe, faire le traitement
    if ($db_found) 
    {
        $sql = "SELECT * FROM produit";
        if($intitule != "") 
        {
            //on cherche l'item avec les paramètres intitulé et catégorie
            $sql .= " WHERE nom LIKE '%$intitule%'";
            if ($categorie != "aucune") 
            {
                $sql .= " AND categorie LIKE '%$categorie%'";
            }
        }
        $result = mysqli_query($db_handle, $sql);
        
        //regarder s'il y a un résultat
        if (mysqli_num_rows($result) != 0) 
        {
            //l'item est déjà dans la BDD
            echo "Vous avez déjà crée une vente pour cet item. Veuillez réessayer avec un autre item<br>";?>
            <a href="<?php echo "vendre.php?id_vendeur=".$id_vendeur."" ?>">Revenir à la page précédente</a><?php
        } 
        else 
        {
            // Relever l'id de l'item
            $sql = "SELECT * FROM produit WHERE nom LIKE '%$intitule%' AND categorie LIKE '%$categorie%'";
            $result = mysqli_query($db_handle, $sql);
            while ($data = mysqli_fetch_assoc($result)) 
            {
            	echo $data;
                $id_item = $data['id_produit'];
            }
            
            //Mise en place de la vente
            if(($n_vente_1=="Encheres")&&($n_vente_2==""))
            {
                if(($date!="")&&($prix_enchere!=""))
                {
                    // Insertion d'un nouvel item
                     $sql = "INSERT INTO produit(nom, prix, categorie, description, photo, video, id_vendeur) VALUES ('$intitule', '$prix', '$categorie', '$description', '$name', '$video','$id_vendeur')";
                    
                    $result = mysqli_query($db_handle, $sql) or die(mysqli_error($db_handle));
               		$sql = "SELECT * FROM produit ";

            		$result = mysqli_query($db_handle, $sql) or die(mysqli_error($db_handle));

            	while ($data = mysqli_fetch_assoc($result)) 
           		{
                	$id_item = $data['id_produit'];
            	}
                    
                    // Insertion d'un nouvel enchère
                    $sql="INSERT INTO enchere(date_fin, heure_fin, prix_surencheri, statut_vente, id_produit) VALUES ('$date', '$heure', '$prix_enchere', 'non vendu','$id_item')";
                    $result = mysqli_query($db_handle, $sql);
                    
                    echo "Félicitations !<br>". ' ' ."La vente a commencé !";
                    ?><a href="<?php echo "main.php?id_vendeur=".$id_vendeur."" ?>">Revenir à la page d'accueil</a><?php
                }
                else
                {
                    echo "Vous avez choisi une enchère mais vous n'avez pas renseigné les élèments nécessaire pour une mise en vente de ce type.";
                }
            }
            elseif(($n_vente_1=="MeilleuresOffres")&&($n_vente_2==""))
            {
                // Insertion d'un nouvel item
                 $sql = "INSERT INTO produit(nom, prix, categorie, description, photo, video, id_vendeur) VALUES ('$intitule', '$prix', '$categorie', '$description', '$name', '$video','$id_vendeur')";

                $result = mysqli_query($db_handle, $sql) or die(mysqli_error($db_handle));
                $sql = "SELECT * FROM produit ";

            	$result = mysqli_query($db_handle, $sql) or die(mysqli_error($db_handle));

            	while ($data = mysqli_fetch_assoc($result)) 
           		{
                	$id_item = $data['id_produit'];
            	}
                
                // Insertion d'une nouvelle meilleure offre
                $sql="INSERT INTO offre(statut_vente, id_produit, id_vendeur) VALUES ('non vendu','$id_item', '$id_vendeur')";
                $result = mysqli_query($db_handle, $sql);
                
                echo "Félicitations !<br>". ' ' ."La vente a commencé !";
                ?><a href="<?php echo "main.php?id_vendeur=".$id_vendeur."" ?>">Revenir à la page d'accueil</a><?php
            }
            elseif(($n_vente_1=="AchatImmediat")&&($n_vente_2==""))
            {
                // Insertion d'un nouvel item
                $sql = "INSERT INTO produit(nom, prix, categorie, description, photo, video, id_vendeur) VALUES ('$intitule', '$prix', '$categorie', '$description', '$name', '$video','$id_vendeur')";

                $result = mysqli_query($db_handle, $sql) or die(mysqli_error($db_handle));
                $sql = "SELECT * FROM produit ";

            	$result = mysqli_query($db_handle, $sql) or die(mysqli_error($db_handle));

            	while ($data = mysqli_fetch_assoc($result)) 
           		{
                	$id_item = $data['id_produit'];
            	}
                // Insertion d'une nouvel achat immédiat
                $sql="INSERT INTO achat_direct(statut_vente, id_produit) VALUES ('non vendu','$id_item')";
                $result = mysqli_query($db_handle, $sql);
                
                echo "Félicitations !<br>". ' ' ."La vente a commencé !";
                ?><a href="<?php echo "main.php?id_vendeur=".$id_vendeur."" ?>">Revenir à la page d'accueil</a><?php
            }
            elseif((($n_vente_1=="MeilleuresOffres")&&($n_vente_2=="AchatImmediat"))||(($n_vente_2=="MeilleuresOffres")&&($n_vente_1=="AchatImmediat")))
            {
                // Insertion d'un nouvel item
                $sql = "INSERT INTO produit(nom, prix, categorie, description, photo, video, id_vendeur) VALUES ('$intitule', '$prix', '$categorie', '$description', '$name', '$video','$id_vendeur')";
                
                $result = mysqli_query($db_handle, $sql) or die(mysqli_error($db_handle));
                $sql = "SELECT * FROM produit ";

            	$result = mysqli_query($db_handle, $sql) or die(mysqli_error($db_handle));

            	while ($data = mysqli_fetch_assoc($result)) 
           		{
                	$id_item = $data['id_produit'];
            	}
                
                // Insertion d'une nouvelle meilleure offre
                $sql="INSERT INTO offre(statut_vente, id_produit, id_vendeur) VALUES ('non vendu','$id_item', '$id_vendeur')";
                $result = mysqli_query($db_handle, $sql);

                // Insertion d'une nouvel achat immédiat
                $sql="INSERT INTO achat_direct(statut_vente, id_produit) VALUES ('non vendu','$id_item')";
                $result = mysqli_query($db_handle, $sql);

                echo "Félicitations !<br>". ' ' ."La vente a commencé !";
                ?><a href="<?php echo "main.php?id_vendeur=".$id_vendeur."" ?>">Revenir à la page d'accueil</a><?php
            }
            elseif((($n_vente_1=="AchatImmediat")&&($n_vente_2=="Encheres"))||(($n_vente_2=="AchatImmediat")&&($n_vente_1=="Encheres")))
            {   
                if(($date!="")&&($prix_enchere!=""))
                {
                    // Insertion d'un nouvel item
                    $sql = "INSERT INTO produit(nom, prix, categorie, description, photo, video, id_vendeur) VALUES ('$intitule', '$prix', '$categorie', '$description', '$name', '$video','$id_vendeur')";

                     $result = mysqli_query($db_handle, $sql) or die(mysqli_error($db_handle));
	                $sql = "SELECT * FROM produit ";

	            	$result = mysqli_query($db_handle, $sql) or die(mysqli_error($db_handle));

	            	while ($data = mysqli_fetch_assoc($result)) 
	           		{
	                	$id_item = $data['id_produit'];
	            	}
                    
                    // Insertion d'un nouvel enchère
                    $sql="INSERT INTO enchere(date_fin, heure_fin, prix_surencheri, statut_vente, id_produit) VALUES ('$date', '$heure', '$prix_enchere', 'non vendu', '$id_item')";
                    $result = mysqli_query($db_handle, $sql);

                    // Insertion d'une nouvel achat immédiat
                    $sql="INSERT INTO achat_direct(statut_vente, id_produit) VALUES ('non vendu', '$id_item')";
                    $result = mysqli_query($db_handle, $sql);

                    echo "Félicitations !<br>". ' ' ."La vente a commencé !";
                    ?><a href="<?php echo "main.php?id_vendeur=".$id_vendeur."" ?>">Revenir à la page d'accueil</a><?php
                }
                else
                {
                    echo "Vous avez choisi une enchère mais vous n'avez pas renseigné les élèments nécessaire pour une mise en vente de ce type.";
                    ?><a href="<?php echo "vendre.php?id_vendeur=".$id_vendeur."" ?>">Revenir à la page précédente</a><?php
                }
            }
            else
            {
                echo "Erreur : la vente ne peut s'effectuer. Veuillez contacter le service client.";
                ?><a href="<?php echo "main.php?id_vendeur=".$id_vendeur."" ?>">Revenir à la page d'accueil</a><?php
            }
        }
    }
    else
    {
        echo "Erreur : accès à la base de donnée échouée !";
    }

    //fermer la connexion
    mysqli_close($db_handle);

?>