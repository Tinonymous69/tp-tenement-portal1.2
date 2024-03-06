<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
  
    <title>Login System</title>
</head>
<body>

    <div class="container">
    <img src="image/CVSU.png" alt="logo" class="logo">
    <h1>
		CVSU ENROLLMENT SYSTEM
        
</h1>
        <div class="box form-box">
        <header>
        </header>


        <form action="" method="post">
         <div class="field input">
            <label for="email">Username</label>
             <input type="text" name="email" id="username"  placeholder="username or email" required >


         </div>   

         <div class="field input">
            <label for="password">Password</label>
             <input type="password" name="password" id="password" placeholder="password" required >
         </div>   

              <div class="form-btn">
                <input type="submit" class="btn" name="submit" value="Login" required>
             </div>
        
               <div class="links">
                 Not Member yet? <a href="register.php">Register Now</a>                                                             
               </div>



    </form>
    
</body>
</html>