<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css?v=1.3">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container">
        <div class="left">
            <form action="login.php" method="post">
                <h1>Login</h1>
                <?php if (isset($_GET['error'])) { ?>
                    <p style="text-align:center;" class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <div class="login-box">
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input name="employee_id" placeholder="employee_id" type="text"/>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input name="password" placeholder="Password" type="password"/>
                    </div>
                    
                    <button class="btn">Login</button>
                </div>
            </form>
        </div>
        <div class="right">
            <img alt="Yageo Telemecanique Sensors Logo" width="300" src="img/tese-logo.jpg"/>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>