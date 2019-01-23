<?php 
include("config.php");

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

 $myusername = mysqli_real_escape_string($db,$_POST['username']);
 $mypassword = mysqli_real_escape_string($db,$_POST['password']); 

 $sql = "SELECT * FROM table_login WHERE id = '$myusername' and senha = '$mypassword'";
 $sql2 = "SELECT cargo from table_login where id = '$myusername'";

 $result = mysqli_query($db,$sql);
 $resultCargo = mysqli_query($db,$sql2);


 $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
 $row2 = mysqli_fetch_array($resultCargo,MYSQLI_ASSOC);

 $active = $row['id'];
 $active2 = $row2['cargo'];
 $active3 = $row['senha'];


 $count = mysqli_num_rows($result);
 $_SESSION['username'] = $active;
 $_SESSION['curso'] = $row['curso'];
 $_SESSION['cargo'] = $active2;
 $_SESSION['senha'] = $active3;


 if($count == 1 and $active2 == 'coordenador') {

  $_SESSION['login'] = time();
  header("location: consulta_questoes.php");

}else if($count == 1 and $active2 == 'professor'){

 $_SESSION['login'] = time();
 header("location: consulta_questoes.php"); 

}
else {
 $error = "Your Login Name or Password is invalid";
}
}
?>

<!DOCTYPE html>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/form-control.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body style="background-color: #333;box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);">
  <div style = "margin:30px auto; width: 500px;" class="card">
    <img src="img/logo_prova.png" style="width: 74%;align-self: center;">
    <form action = "" method = "post" style="width: 65%;" class="col-centered  form-signin">
      <div class="form-label-grup">

        <input type = "text" name = "username" placeholder="Login" required autofocus class = "form-control"/>

      </div>
      <div class="form-label-grup" style="margin-top:10px;">

        <input type = "password" name = "password" placeholder="Senha" class = "form-control" required />

      </div><br>
      <button type="submit" class="btn btn-lg btn-primary btn-block">Login</button><br />
      <?php if (!isset($error)) {
        echo '<div class="erro" style = "font-size:11px; color:#cc0000; margin-top:10px;"></div>';
      } else{
        echo '<div class="erro" style = "font-size:11px; color:#cc0000; margin-top:10px;">'.$error.'</div>';
        
      }

      ?>
    </form>

  </div>
</body>
</html>