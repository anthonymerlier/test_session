<?php
session_start();

if(!isset($_SESSION['email'])){
  // L'UTILISATEUR N'A PAS DE SESSION, ON LE REDIRIGE
  header("Location: login.php");
}

require("connect.php");
$reqInfoUser = $bdd->prepare("SELECT user_email,user_prenom,user_nom,user_created_date FROM tb_users WHERE user_email = ?");
$reqInfoUser->execute([ $_SESSION['email']]);
$dataInfoUser = $reqInfoUser->fetch(PDO::FETCH_ASSOC);

// var_dump($dataInfoUser);
// die();

?>
<!doctype html>
<html lang="fr">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col">
        <p>Bonjour Prénom</p>
        <hr>
        <form action="php/user_update.php" method="post">
          <div class="form-group">
            <label for="">Votre prénom</label>
            <input type="text" name="prenom" id="prenom" class="form-control" value="<?= $dataInfoUser['user_prenom'] ?>">
          </div>
          <div class="form-group">
            <label for="">Votre nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="<?= $dataInfoUser['user_nom'] ?>">
          </div>
          <div class="form-group">
            <button type="button" name="submitData" class="btn btn-outline-warning" id="submitData">Modifier mes données</button>
          </div>
        </form>
        <hr>
        <a href="disconnect.php" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
  <script>
    $(document).ready(function () {
      $("#submitData").click(function(){
        var prenom = $("#prenom").val();
        var nom = $("#nom").val();
        $.ajax({
          method: "post",
          url: "php/user_update.php",
          data: "submitData=send&nom=" + nom + "&prenom=" + prenom,
          success: function (response) {
            alert("Ok");
          }
        });
      })
    });
  </script>
</body>

</html>