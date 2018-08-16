<?php 
   include("config.php");
   session_start();
    $_SESSION['login'] = time();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id FROM table_login WHERE id = '$myusername' and senha = '$mypassword'";
      $sql2 = "SELECT cargo from table_login where id = '$myusername'";

      $result = mysqli_query($db,$sql);
      $resultCargo = mysqli_query($db,$sql2);


      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $row2 = mysqli_fetch_array($resultCargo,MYSQLI_ASSOC);

      $active = $row['id'];
      $active2 = $row2['cargo'];

      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
    
      if($count == 1 and $active2 == 'coordenador') {
         //session_register("myusername");
         //$_SESSION['login_user'] = $myusername;
         
         header("location: index.html");
      }else if($count == 1 and $active2 == 'professor'){
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
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <div style = "margin:30px auto; width: 500px;" class="card">
      <h3 class="col-centered" style="margin-top: 15px">Teste de progresso</h3>
       <form action = "" method = "post" style="width: 65%;" class="col-centered card-body">
        <div class="form-group">
          <label for="username">Usuário: </label><input type = "text" name = "username" class = "form-control"/>
        </div>
        <div class="form-group">
          <label for="password">Senha  :</label><input type = "password" name = "password" class = "form-control" />
        </div>
          <button type="submit" class="btn btn-secondary">Login</button><br />
          <div class="erro" style = "font-size:11px; color:#cc0000; margin-top:10px;"><?php echo $error; ?></div>
       </form>
       
    </div>
</body>
</html>