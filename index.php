<?php session_start();
include "php/db/connect.php";
    include 'php/actions/login.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/scripts/main.js"></script>
    <link href="/style/main.css" rel="stylesheet">
    <title>Task5</title>
</head>

<body>
    <header class="text-center">
        
        <?php
            if (isset($_SESSION['login']))
            {
                echo' <h1 class="display-4">Welcome, '. $_SESSION['login'].'!</h1>';
            }
            else 
            {
                echo '<h1 class="display-4">Welcome, Guest!</h1>';
            }
        ?>
        
        <p class="lead">
            This is my homework for Task 5-6.
        </p>
    </header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 ">
               
            <?php if (isset($_SESSION['login'])) 
                    {
                        
                    echo '<li class="nav-item">
                                <a class="nav-link" id="exitNav" data-uid="'.$_SESSION['uid'].'" href="#">Log out</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="showNav" href="#">Show users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="showMessage" href="#">Incoming messages</a>
                            </li>';
                        }
                        else 
                        {
                            echo '<li class="nav-item">
                            <a class="nav-link active" id="signNav" href="#">Sign in</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="regNav" href="#">Registration</a>
                        </li>';
                        }
                        ?> 
                    </ul>
            </div>
        </div>
    </nav>
    <div class="container">

    </div>
    
</body>
</html>