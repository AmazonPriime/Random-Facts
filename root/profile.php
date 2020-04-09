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
                        <a class="nav-item nav-link" href="index.php"><p><span class="navaccent">H</span><span class="navrest">OME</span> <i class="fa fa-home"></i></p></a>
                        <a class="nav-item nav-link" href="facts.php"><p><span class="navaccent">F</span><span class="navrest">ACTS</span> <i class="fa fa-book"></i></p></a>
                        <a class="nav-item nav-link" href="about.php"><p><span class="navaccent">A</span><span class="navrest">BOUT</span> <i class="fa fa-question"></i></p></a>
                        <a class="nav-item nav-link" href="profile.php"><p class="selected"><span class="navaccent">P</span><span class="navrest">ROFILE</span> <i class="fa fa-user"></i></p></a>
                    </div>
                </div>
            </div>
        </nav>
        
        <div>
            <div class="textarea">
                <div class="containter-fluid">
                    <h1 class="display-3"><span class="navaccent">P</span><span class="navrest">rofile</span></h1>
                </div>
            </div>
            
            <br>
            
			<?php
                if ($loggedin == true){
                    $link = connectdb();
                    $uuid = $_SESSION['uuid'];
                    $query = "SELECT username, forename, surname, age, sex, type, country FROM users WHERE uuid = '$uuid'";	
                    $rows = mysql_query($query) or die(mysql_error());
                    $user = mysql_fetch_array($rows);

                    echo '<div class="center">';
                    echo '<div class="textarea">';
                    echo '<div class="containter-fluid">';
                    echo '<span class="display-4 para">'.$user['username'].'</span>';
                    echo '</div>';
                    echo '</div>';

                    echo '<br>';

                    echo '<div class="textarea">';
                    echo '<div class="containter-fluid">';
                    echo '<span class="lead profile">Forename</span><br>';
                    echo '<span class="lead para" id="fore">'.$user['forename'].'</span><br><br>';

                    echo '<span class="lead profile">Surname</span><br>';
                    echo '<span class="lead para" id="sur">'.$user['surname'].'</span><br><br>';

                    echo '<span class="lead profile">Age</span><br>';
                    if ($user['age'] == 0){
                        echo '<span class="lead para" id="age">Secret ;)</span><br><br>';   
                    }else{
                        echo '<span class="lead para" id="age">'.$user['age'].'</span><br><br>';   
                    }

                    echo '<span class="lead profile">Type</span><br>';
                    echo '<span class="lead para" id="type">'.$user['type'].'</span><br><br>';

                    echo '<span class="lead profile">Country</span><br>';
                    echo '<span class="lead para" id="coun">'.$user['country'].'</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    echo '<br>';

                    $query = "SELECT text, category FROM facts WHERE author = '$uuid'";
                    $rows = mysql_query($query) or die(mysql_error());

                    echo '<div class="textarea center">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-3"></div>';    
                    echo '<div class="col-sm">';    

                    echo '<span class="lead profile">Facts by this user</span>';
                    if (mysql_num_rows($rows)==0){
                        echo '<br><span class="lead para">'.$user['username'].' has not submited any facts just yet.</span>';
                    }else{
                        while ($facts = mysql_fetch_array($rows)){
                            echo '<div class="row">';
                            echo '<div class="col-sm-8 left">';
                            echo '<span class="para left">'.$facts['text'].'</span>';
                            echo '</div>';
                            echo '<div class="col-sm right">';
                            echo '<span class="para">'.$facts['category'].'</span>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }

                    echo '</div>';
                    echo '<div class="col-sm-3"></div>';  
                    echo '</div>';
                    echo '</div>';  
                    
                    if ($user['type'] == 'Admin'){
                        $query = "SELECT factid, text, category, author FROM factqueue";
                        $rows = mysql_query($query) or die(mysql_error());
                        
                        echo '<br>'; 
                        echo '<div class="textarea center">';
                        echo '<div class="row">';
                        echo '<div class="col-sm-3"></div>';    
                        echo '<div class="col-sm">';    

                        echo '<span class="lead profile">Facts Queue</span><br>';
                        if (mysql_num_rows($rows)==0){
                            echo '<span class="lead para">No facts to be checked!</span>';
                        }else{
                            while ($facts = mysql_fetch_array($rows)){
                                echo '<hr>';
                                echo '<div class="row">';
                                echo '<div class="col-sm-8 left">';
                                echo '<span class="para left">'.$facts['text'].'</span>';
                                echo '</div>';
                                echo '<div class="col-sm right">';
                                echo '<span class="para">'.$facts['category'].'</span>';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="row">';
                                echo '<div class="col-sm right">';
                                echo '<a class="btn btn-outline-primary" href="profile.php?accept=true">ACCEPT</a>';
                                echo '</div>';
                                echo '<div class="col-sm left">';
                                echo '<a class="btn btn-outline-primary" href="profile.php?accept=false">REJECT</a>';
                                echo '</div>';
                                echo '</div>';
                                echo '<hr>';
                            }
                        }

                        echo '</div>';
                        echo '<div class="col-sm-3"></div>';  
                        echo '</div>';
                        echo '</div>';

                        if (@$_GET['accept'] == 'true'){
                            $link = connectdb();

                            $query = "SELECT factid, text, category, author FROM factqueue";

                            $rows = mysql_query($query) or die(mysql_error());
                            $facts = mysql_fetch_array($rows);

                            $factid = $facts['factid'];
                            $text = $facts['text'];
                            $category = $facts['category'];
                            $author = $facts['author'];

                            $query = "INSERT INTO facts (factid, text, category, author) VALUES ('$factid', '$text', '$category', '$author')";

                            $rows = mysql_query($query) or die(mysql_error());

                            $query = "DELETE FROM factqueue WHERE factid = '$factid'";

                            $rows = mysql_query($query) or die(mysql_error());
                            
                            echo '<script>window.location.href = "profile.php"</script>';

                        }elseif (@$_GET['accept'] == 'false'){
                            $link = connectdb();

                            $query = "SELECT factid, text, category, author FROM factqueue";

                            $rows = mysql_query($query) or die(mysql_error());
                            $facts = mysql_fetch_array($rows);

                            $factid = $facts['factid'];
                            
                            $query = "DELETE FROM factqueue WHERE factid = '$factid'";

                            $rows = mysql_query($query) or die(mysql_error());
                            
                            echo '<script>window.location.href = "profile.php"</script>';
                        }   
                    }
                    
                }else{
                    echo '<script>window.location.href = "login.html"</script>';
                }
            
                mysql_close($link);
			?>
            
            <br>
            
            <div class="textarea center">
                <a class="btn btn-outline-primary" href="profile.php?signout=true">SIGNOUT</a>
            </div>
            
            <?php
                if (@$_GET['signout'] == true){
                    @$_SESSION['uuid'] = '0';
                    echo '<script>window.location.href = "index.php"</script>';
                }
            ?>
            
            <br>
            
        </div>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>    
    </body>
    
</html>