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
    $sql='SELECT joueur.license  as jnum,joueur.id as jid,joueur.firstname,joueur.lastname,club.num,categorie.id,categorie.name as catname,club.name as clubname FROM `club` INNER JOIN categorie_club on club.id=categorie_club.club_id INNER JOIN categorie on categorie.id=categorie_club.categorie_id INNER JOIN joueur on joueur.categorie_club_id=categorie_club.id where club.num= :param1 AND categorie.id= :param2 ;';
            if($prep=$pdo->prepare($sql)){
                $prep->bindParam(':param1',$_GET['id'], PDO::PARAM_INT);
                $prep->bindParam(':param2',$_GET['categ'], PDO::PARAM_INT);
                $prep->execute();
                while($row=$prep->fetch()){
                    // var_dump($row);
            array_push($res, array('jid'=>$row['jid'],'id'=>$row['id'],'firstname'=> $row['firstname'],'lastname'=> $row['lastname'],'num'=> $row['num'],'catname'=>$row['catname'],'clubname'=>$row['clubname'],'jnum'=>$row['jnum'])
        );
                }
            }else {
                $error = $pdo->errno . ' ' . $pdo->error;
                echo $error; // 1054 Unknown column 'foo' in 'field list'
            }
    ?>


    <table>
        <caption>
        Club de Handball de <?php echo $res[0]['clubname'].' - '.$res[0]['catname']?>
        </caption>
        <thead>
            <tr>
               
                <th>
                ID

                </th>
                <th>
                    Joueur

                </th>


                

            </tr>

        </thead>
        <tbody>
            <?php foreach ($res as $key => $value) {?>
                <!-- joueur.php?id=F1718-220132 -->
            <tr class="click" onclick="window.location.href='http://localhost:8090/joueur.php?id=<?php echo $value['jid']?>'">
                
                <td>
                    <?php echo $value['jnum'] ?>
                </td>
                <td>
                    <?php echo $value['firstname'].' '.$value['lastname'] ?>
                </td>
                <?php ?>
                </td>
            </tr>
            <?php  }?>

        </tbody>

    </table>
</body>

</html>