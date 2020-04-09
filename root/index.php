<!DOCTYPE html>

<?php
    session_start();
    include 'functions.php';
    @ $loggedin = checkuuid($_SESSION['uuid']);
?>

<html lang='en'>
    
    <head>
        
        <!-- Required Meta Tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Animations -->
        <link rel="stylesheet" type="text/css" href="https://cdn.tutorialjinni.com/hover.css/2.3.1/css/hover-min.css" />
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        
        <!-- Icons -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Custom CSS -->
        <link rel="stylesheet" type="text/css" href="CSS/style.css">
        
        <!-- Custom Font -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    
        <title>Random Facts - Home</title>
    
    </head>
    
    <body class="background">
        
        <div class="logo"><img class="img-fluid hvr-grow" src="IMG/Logo.png"></div>

        <nav id="navbar" class="nav nav-fill navbar navbar-light navbar-expand-lg">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                 <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="navbar-nav container-fluid navtext">
                        <a class="nav-item nav-link" href="#"><p class="selected"><span class="navaccent">H</span><span class="navrest">OME</span> <i class="fa fa-home"></i></p></a>
                        <a class="nav-item nav-link" href="facts.php"><p><span class="navaccent">F</span><span class="navrest">ACTS</span> <i class="fa fa-book"></i></p></a>
                        <a class="nav-item nav-link" href="about.php"><p><span class="navaccent">A</span><span class="navrest">BOUT</span> <i class="fa fa-question"></i></p></a>
                        
                        <?php
                            if ($loggedin == true){
                                echo '<a class="nav-item nav-link" href="profile.php"><p><span class="navaccent">P</span><span class="navrest">ROFILE</span> <i class="fa fa-user"></i></p></a>';
                            } else {
                                echo '<a class="nav-item nav-link" href="login.html"><p><span class="navaccent hvr-backword">L</span><span class="navrest">OGIN</span> <i class="fa fa-unlock"></i></p></a> &nbsp;';
                                echo '<a class="nav-item nav-link" href="registration.html"><p><span class="navaccent" href="registration.html">R</span><span class="navrest">EGISTER</span> <i class="fa fa-pencil-square-o"></i></p></a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </nav>
        
        <div>
            <div class="textarea">
                <div class="containter-fluid">
                    <h1 class="display-3"><span class="navaccent">H</span><span class="navrest">ome</span></h1>
                </div>
            </div>
            
            <br>
            
            <div class="textarea">
                <div class="containter-fluid">
                    <span class="lead para">This website is for those individuals who want to create a quiz or test and/or would just like to learn some random pieces of information to tell your friends and family. <br>
                        The facts are sorted into several categories in which you can choose, or you could be really random not use the categories!</span>
                </div>
            </div>
            
            <br>
            <?php
				if ($loggedin == true){
					echo '<div class="textarea">';
					echo '<div class="containter-fluid">';
					echo '<div class="row">';
					echo '<div class="col-sm-3"></div>';
					echo '<div class="col-sm">';
					echo '<a class="btn btn-outline-primary btn-lg" style="width:100%;" href="profile.php">Profile</a>';
					echo '</div>';
					echo '<div class="col-sm">';
					echo '<a class="btn btn-outline-primary btn-lg" style="width:100%;" href="facts.php">Facts</a>';
					echo '</div>';
					echo '<div class="col-sm-3"></div>';
					echo '</div>';
					echo '</div>';
					echo '</div>';
				}else{
					echo '<div class="textarea">';
					echo '<div class="containter-fluid">';
					echo '<div class="row">';
					echo '<div class="col-sm-3"></div>';
					echo '<div class="col-sm">';
					echo '<a class="btn btn-outline-primary btn-lg" style="width:100%;" href="login.html">Login</a>';
					echo '</div>';
					echo '<div class="col-sm">';
					echo '<a class="btn btn-outline-primary btn-lg" style="width:100%;" href="registration.html">Register</a>';
					echo '</div>';
					echo '<div class="col-sm-3"></div>';
					echo '</div>';
					echo '</div>';
					echo '</div>';
				}
			?>
        </div>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>    
    </body>
    
</html>