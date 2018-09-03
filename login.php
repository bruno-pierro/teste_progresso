<?php 
include("config.php");

  session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 

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


 $count = mysqli_num_rows($result);
 $_SESSION['username'] = $active;
 $_SESSION['curso'] = $row['curso'];
 $_SESSION['cargo'] = $active2;

      // If result matched $myusername and $mypassword, table row must be 1 row

 if($count == 1 and $active2 == 'coordenador') {
         //session_register("myusername");
         //$_SESSION['login_user'] = $myusername;

  $_SESSION['login'] = time();
  header("location: index.html");
}else if($count == 1 and $active2 == 'professor'){
 $_SESSION['login'] = time();
 header("location: professor.php"); 
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body style="background-color: #333;box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);">
  <div style = "margin:30px auto; width: 500px;" class="card">
    <h3 class="text-center mb-4 h3 mb-3 font-weight-normal" style="margin-top: 1.5em;font-family: 'Titillium Web', sans-serif;color:#00B233">Prova Certa <i class="fas fa-check-double" style="color:#c13434;"></i></i></h3>
    <form action = "" method = "post" style="width: 65%;" class="col-centered  form-signin">
      <div class="form-label-group">
        
        <input type = "text" name = "username" placeholder="Login" required autofocus class = "form-control"/>
        <label for="username">Usuário: </label>

      </div>
      <div class="form-label-group">
        
        <input type = "password" name = "password" placeholder="Senha" class = "form-control" required />
        <label for="password">Senha  :</label>

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