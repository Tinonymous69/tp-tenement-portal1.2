<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
        <div class="container">
           <?php
           if  (isset($_POST["submit"])){
              $firstname = $_POST["firstname"];
              $lastname = $_POST["lastname"];
              $email = $_POST["email"];
              $password = $_POST["password"];
              $confirmPassword = $_POST["confirm_password"];
              $phone = $_POST["phone"];
              $address = $_POST["address"];
              $passwordHash =password_hash($password, PASSWORD_DEFAULT);   


              $errors =array();
                 
             if  (empty($firstname) OR empty($lastname) OR empty($email) OR empty ($password) OR empty ($confirmPassword) OR empty ($phone) OR empty ($address)) {
              array_push($errors,"All fields are required");

             }
              if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors, "Email is not valid");
              }
                 if  (strlen($password)<8) {                                      
                  array_push($errors,"Password must be at least 8 characters long");
                 }
              if  ($password!==$confirmPassword){
                 array_push($errors, "Password does not match");
              }
                 require_once "database.php"; 
                  $sql = "SELECT * FROM user WHERE email = '$email'";    
                  $result = mysqli_query($conn, $sql);       
                  $rowCount = mysqli_num_rows($result);
                  if ($rowCount>0) {
                  array_push($errors, "Email already exist!");

                  }   
                  if  (count($errors)>0) {
                   foreach ($errors as $error) {
                       echo "<div class='alert alert-danger'>$error</div>";
                   }
                  
                  }else{

                      $sql = "INSERT INTO user (first_name, lastname, email, password, phone, address) VALUES (?, ?, ?, ?, ?, ?)";
                      $stmt = mysqli_stmt_init($conn);
                      $prepareStmt = mysqli_stmt_prepare($stmt,$sql);   
                      if ($prepareStmt ) {
                       mysqli_stmt_bind_param($stmt,"ssssss", $firstname, $lastname, $email, $passwordHash, $phone, $address);
                       mysqli_stmt_execute($stmt);
                       echo "<div class='alert alert-success'>Register Successfully.</div>";
                      }else{
                        die("Something went wrong");
                      }  

                     }
                  }
                     
           ?> 
            <form action="register.php" method="post">
           <div class="form-group">
            

           
          <label for="firstname">Firstname</label>
          <input type="text"  class="form-control" name="firstname"  placeholder="Enter Your Firstname" required>

          <label for="lastname">Lastname</label>
          <input type="text"  class="form-control" name="lastname"  placeholder="Enter Your Lastname" required>

          <label for="email">Email</label>
          <input type="text"  class="form-control" name="email"  placeholder="Enter Your Email" required>
            
          <label for="password">Password</label>
          <input type="password"  class="form-control" name="password"  placeholder="Enter Your Password" required>
          
          <label for="confirmpassword">Confirm Password</label>
          <input type="password"  class="form-control" name="confirm_password"  placeholder="Confirm Your Password" required>
          
           <label for="phone">Phone Number</label>
          <input type="tel" id="phone"  class="form-control" name="phone"  placeholder="Enter Your Phone Number" required>
              
          <label for="address">Address</label>
          <input type="text"  class="form-control" name="address"  placeholder="Enter Your Complete Address" >

          </div class="form-btn">
           <input type="submit" class="btn btn-primary" value="Register" name="submit">
       
          </form>
          
</body>
</html>