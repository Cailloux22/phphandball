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
    <?php  
    include 'pdo.php';
    $res = array();
    $sql="SELECT joueur.firstname as nom,joueur.lastname as prenom,joueur.birth as birth,joueur.email as email,joueur.license as license,categorie.name as catname,club.name as clubname FROM `club` INNER JOIN categorie_club on club.id=categorie_club.club_id INNER JOIN categorie on categorie.id=categorie_club.categorie_id INNER JOIN joueur on joueur.categorie_club_id=categorie_club.id where joueur.id=? ;  ";
            if($prep=$pdo->prepare($sql)){
                // $prep->bindParam(':param1',$_GET['id'], PDO::PARAM_INT);
                $prep->execute(array($_GET['id']));
                while($row=$prep->fetch()){
                    // var_dump($row);
            array_push($res, array('Nom'=>$row['nom'],'Prenom'=>$row['prenom'],'Date naissance '=> $row['birth'],'Email'=> $row['email'],'License'=> $row['license'],'catname'=>$row['catname'],'clubname'=>$row['clubname'])
        );
                }
            }else {
                $error = $pdo->errno . ' ' . $pdo->error;
                echo $error; // 1054 Unknown column 'foo' in 'field list'
            }
    // var_dump($res);
    ?>

    <?php  ?>
    <table>


        <tr>
            <td class="caption">
                <?php
                if(!empty( glob('./photos/'.$_GET['id'].'*'))){?>

                    <img src="<?php echo glob('./photos/'.$_GET['id'].'*')[0]?>" alt="profile" width="150">

                <?php  }else{?>

                    <img src="./photos/AvatarMaker.png" alt="profile" width="150">
                    
                <?php  }?>
            </td>
            <td class="caption">
                Club de Handball de <?php echo $res[0]['clubname']?></br>
                Catégorie
                <?php echo $res[0]['catname']?></td>
        </tr>


        <?php foreach ($res[0] as $cle => $valeur) {
                if ($cle !== 'clubname'&& $cle !=='catname' ) { ?>


        <tr>
            <th>
                <?php echo $cle ?>
            </th>
            <td>
                <?php echo $valeur ?>
            </td>
        </tr>
        
        <?php }
            }?>
    </table>
</body>

</html>