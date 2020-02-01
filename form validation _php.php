<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
img{
  max-width:180px;
}
input[type=file]{
padding:10px;
}
 body {
 background-color: #f2f2f2;}

 .container {
  
  
  padding-left:30px;
  
  background-color: #f2f2f2;
  
}
.submit{

  
  width:80px;
  height:40px;
}




</style>

</head>
<body>  

<?php
// define variables and set to empty values
$firstnameErr =$lastnameErr= $emailErr  =$phoneErr= $passwordErr ="";
$firstname = $lastname= $email  = $phone = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["firstname"])) {
    $firstnameErr = "FirstName is required";
  } else {
    $firstname = test_input($_POST["firstname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {
      $firstnameErr = "Only letters and white space allowed";
    }
  }
  if (empty($_POST["lastname"])) {
    $lastnameErr = "lastName is required";
  } else {
    $lastname = test_input($_POST["lastname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$lastname)) {
      $lastnameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
  if (empty($_POST["phone"])) {
    $phoneErr = "phone is required";
  } else {
    $phone = test_input($_POST["phone"]);
    // check if phone is well-formed
    if(!preg_match('/^[0-9]{11}+$/',$phone)){
      $phoneErr = "Invalid phone format";
    }
  }
  if (empty($_POST["password"])) {
    $passwordErr = "password is required";
  } else {
    $password = test_input($_POST["password"]);
    // check if password is well-formed
    if (strlen($_POST["password"]) < 8) {
      $passwordErr = "Your Password Must Contain At Least 8 Characters!";
  }
  }
  

  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
    <div class="container">
         
          
          <form  class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
          <h2>backendform validation</h2>
          <p><span class="error">* required field</span></p>
          firstname: <input type="text" name="firstname">
            <span class="error">* <?php echo $firstnameErr;?></span>
            <br><br>
            lastname: <input type="text" name="lastname">
            <span class="error">* <?php echo $lastnameErr;?></span>
            <br><br>
            E-mail: <input type="text" name="email">
            <span class="error">* <?php echo $emailErr;?></span>
            <br><br>
            password: <input type="password" name="password">
            <span class="error">* <?php echo $passwordErr;?></span>
            <br><br>

            phone: <input type="text" name="phone">
            <span class="error">* <?php echo $phoneErr;?></span>
            <br><br>
          
            <p><input type="file"  accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;"></p>
          <p><label for="file" style="cursor: pointer;">Upload Image</label></p>
          <p><img id="output" width="200" /></p>
          <input class="submit" type="submit" name="submit" value="Submit"> 
     </div>    

<script>
var loadFile = function(event) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
};
</script>

  

</form>



</body>
</html>