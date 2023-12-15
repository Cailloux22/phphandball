<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
 include 'pdo.php';
 include 'mymeToExt.php';
?>

<body>
<?php


if (isset($_POST)) {
    $sql = "INSERT INTO `joueur` ( `firstname`, `lastname`, `birth`, `email`, `license`, `categorie_club_id`) 
    VALUES ( :param1,:param2, :param3,:param4,:param5,:param6);'";
    if($prep=$pdo->prepare($sql)){
        $prep->bindParam(':param1', $_POST['firstname'], PDO::PARAM_STR);
        $prep->bindParam(':param2', $_POST['lastname'], PDO::PARAM_STR);
        $prep->bindParam(':param3', $_POST['birth'], PDO::PARAM_STR);
        $prep->bindParam(':param4', $_POST['email'], PDO::PARAM_STR);
        $prep->bindParam(':param5', $_POST['license'], PDO::PARAM_STR);
        $prep->bindParam(':param6', $_POST['categorie_club_id'], PDO::PARAM_STR);

        $prep->execute();
    }else {
        $error = $pdo->errno . ' ' . $pdo->error;
        echo $error; // 1054 Unknown column 'foo' in 'field list'
    }
    if(isset($_FILES['photo'])){
        move_uploaded_file($_FILES['photo']['tmp_name'],'./photos/'.$pdo->lastInsertId().'.'.mime2ext($_FILES['photo']['type']));   
    }
    
}?>
    <header>
        <nav><a href="/">accueil</a>
            <a href="creer_joueur.php">creer joueur</a>
        </nav>
    </header>
    <?php  
    $res = array();
    $sql="SELECT club.name as club,
    categorie.name as cat,
    categorie_club.id as id
    FROM `club` 
    INNER JOIN categorie_club on club.id=categorie_club.club_id 
    INNER JOIN categorie on categorie.id=categorie_club.categorie_id;  ";
            if($prep=$pdo->prepare($sql)){
                // $prep->bindParam(':param1',$_GET['id'], PDO::PARAM_INT);
                $prep->execute(array($_GET['id']));
                while($row=$prep->fetch()){
                    // var_dump($row);
            array_push($res, array('club'=>$row['club'],'cat'=>$row['cat'],'id'=> $row['id'])
        );
                }
            }else {
                $error = $pdo->errno . ' ' . $pdo->error;
                echo $error; // 1054 Unknown column 'foo' in 'field list'
            }
    // var_dump($res);
    ?>

    <?php  ?>

    <form action="/creer_joueur.php" method="post" enctype="multipart/form-data">
        <label for='firstname'>nom<label>
        <input type="text" name="firstname" value='testUser' required>

        <label for='lastname'>prenom<label>
        <input type="text" name="lastname" value='testUser'required>

        <label for='birth'>date de naissance<label>
        <input type="date" name="birth" value='2017-06-01' required>

        <label for='email'>email<label>
        <input type="mail" name="email" value='testUser@gmail.com' required>

        <label for='license'>license<label>
        <input type="mail" name="license" value='<?php echo random_int(0,9).random_int(0,9).random_int(0,9).random_int(0,9).random_int(0,9).random_int(0,9).random_int(0,9) ?>'required>

        <label for='categorie_club'>categorie club<label>
        <select required name="categorie_club_id">
            <option value="">--Please choose a catégorie club--</option>
            <?php  foreach ($res as $key => $value) {?>
                
                <option value="<?php echo $value['id']?>"><?php echo $value['club'].' -- '.$value['cat']?></option>
            <?php }?>
        </select>
        <label for='photo'>selectionner une photo<label>
        <input type="file" name="photo">
        <input type="submit" value="creer joueur">
    </form>
</body>

</html>