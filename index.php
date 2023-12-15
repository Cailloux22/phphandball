<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <nav><a href="/">accueil</a>
            <a href="creer_joueur.php">creer joueur</a>
        </nav>
    </header>
    <?php  ?>

    <?php
    include 'pdo.php';
  
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si la base de données existe
    $stmt = $pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$database'");
    $databaseExists = $stmt->fetchColumn();

    if (!$databaseExists) {
        // Importer le fichier SQL
        $sqlFile = './db.sql';
        $sql = file_get_contents($sqlFile);

        // Exécuter les requêtes SQL
        $pdo->exec($sql);

        echo "La base de données a été importée avec succès.\n";
    }
    
        // $tab=str_getcsv($line[0]);
        $res = array();
    
            $sql='SELECT categorie.id as catid,num,categorie.name,club.name as club_name,COUNT(`categorie_club_id`) FROM `club` INNER JOIN categorie_club on club.id=categorie_club.club_id INNER JOIN categorie on categorie.id=categorie_club.categorie_id INNER JOIN joueur on joueur.categorie_club_id=categorie_club.id GROUP BY joueur.categorie_club_id;';
            if($prep=$pdo->prepare($sql)){
                $prep->execute();
                while($row=$prep->fetch()){
                    // var_dump($row);
            array_push($res, array('Num'=>$row['num'],'Club'=> $row['club_name'],'Licenciés'=> $row['COUNT(`categorie_club_id`)'],'Catégorie'=> $row['name'],'catid'=>$row['catid'])
        );
                }
            }else {
                $error = $pdo->errno . ' ' . $pdo->error;
                echo $error; // 1054 Unknown column 'foo' in 'field list'
            }
    ?>

    <table>
        <caption>
            Ligue de Bretagne de Handball - Comité 22
        </caption>
        <thead>
            <tr>
                <?php
                $show = $res;
                unset($show[0]['catid']);
                // var_dump($show);
                foreach ($show[0] as $key=> $value) { ?>

                <th>
                    <?php echo $key?>

                </th>


                <?php }?>

            </tr>

        </thead>
        <tbody>
            <?php foreach ($res as $key => $value) {?>
            <tr class="click"
                onclick="window.location.href='http://localhost:8090/club.php?id=<?php echo  $value['Num']  ?>&categ=<?php echo  $value['catid']  ?>'">


                <?php foreach ($value as $cle => $valeur) {
                if ($cle !== 'catid') { ?>

                <td>
                    <?php echo $valeur ?>
                </td>

                <?php } }?>


                <!-- <td><a href="/club.php?id=<?php echo  $value['Num']  ?>&categ=<?php echo  $value['catid']  ?>"> voir</a></td> -->
            </tr>
            <?php  }?>

        </tbody>

    </table>
</body>

</html>