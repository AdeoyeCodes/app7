<?php 

include 'head.php';


?>

<html>
<body class= "body2">

<div class= "container2"> 
 <div class= "col-md-12">
  <h3 style= "margin-bottom: 20px; padding-top: 13px; text-align: left;"> Sign in </h3>
 <form action= "db2.php" method= "post">

 <div class= "form-group">
  
  <input type= "email" name= "email" class= "form-control" placeholder= "Email" required />
 
 </div>
 
 <div class= "form-group">
  
  <input type= "password" name= "password" class= "form-control" placeholder= "Password" required />
 
</div>
 
 <div class= "form-group">
  <button class= "btn btn-info" name= "submit"> <i class="fas fa-sign-in-alt"></i> Sign In </button>
 </div>

 <p style= "font-size: 15px; text-align: right; margin-top: -38px;" class= "forgot"> <a href= "#"> Forgot Password? </a> </p>

</form>
 

</div>
</div></br></br>

 <p style= "text-align: center;"> New to Bolux Panel? <a href= "signup.php"> Create an account </a> </p>
</body>
</html>