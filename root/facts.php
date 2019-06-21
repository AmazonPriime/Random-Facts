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
        <link rel="stylesheet" type="text/css" href="CSS/hover.css">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        
        <!-- Icons -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Custom CSS -->
        <link rel="stylesheet" type="text/css" href="CSS/style.css">
        
        <!-- Custom Font -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    
        <title>Random Facts - Facts</title>
    
        <script>
        
            function submitValidation() {
                var fact = document.submitFact.fact.value;
                var type = document.submitFact.type.value;

                if (fact.length <= 19 || fact.length >= 256) {
                    alert("Please make sure that your fact is 20 or more characters.");
                    return false;
                }
                
                if (type == "" || type == null){
                    alert("Please make sure you pick a category.");
                    return false;
                }
                
                return true;
            }

            function commentValidation() {
                var comment = document.submitComment.comment.value;

                if (comment.length < 19 || comment.length >= 256) {
                    alert("Please make sure that your comment is 20 or more characters.");
                    return false;
                }
                
                return true;
            }
            
        </script>
        
        
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
                        <a class="nav-item nav-link" href="#"><p class="selected"><span class="navaccent">F</span><span class="navrest">ACTS</span> <i class="fa fa-book"></i></p></a>
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
        
        <div class="textarea">
            <div class="containter-fluid">
                <h1 class="display-3"><span class="navaccent">F</span><span class="navrest">acts</span></h1>
            </div>
        </div>

        <br>

        <div class="textarea">
            <div class="containter-fluid">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm">
                        <?php
                            $link = connectdb();
                        
                            @$type = mysql_real_escape_string($_GET['type']);
                            @$factid = mysql_real_escape_string($_GET['id']);
                            
                        
                            if ($factid == ""){
                                if ($type == ""){
                                    $query = "SELECT factid, text, likes, dislikes, author FROM facts ORDER BY RAND() LIMIT 1";
                                }else{
                                    $query = "SELECT factid, text, likes, dislikes, author FROM facts WHERE category = '$type' ORDER BY RAND() LIMIT 1";
                                }
                            }else{
                                $query = "SELECT factid, text, likes, dislikes, author FROM facts WHERE factid = '$factid'";
                            }

                            $rows = mysql_query($query) or die(mysql_error());

                            $facts = mysql_fetch_array($rows);
                        
                            if (mysql_num_rows($rows)==0){
                                echo '<p class="lead para center">Error, :/ no facts found.</p>';
                            }else{
                                echo '<h3 class="display-4" style="color:#3498db;">'.getusername($facts['author']).'</h3>';
                                echo '<h4 class="container fact" style="color:#bdc3c7;">'.$facts['text'].'</h4>';
                                echo '<div class="center">';
                                
                                if ($loggedin == true and responded($_SESSION['uuid'], $facts['factid']) == false){
                                    echo '<span class="text"><a href="response.php?resp=like&id='.$facts['factid'].'" style="color:#3498db;"><i class="fa fa-thumbs-up"></i></a> <span style="color:#1abc9c;">'.$facts['likes'].'</span> &nbsp;&nbsp; <span style="color:#c0392b;">'.$facts['dislikes'].'</span> <a href="response.php?resp=dislike&id='.$facts['factid'].'" style="color:#3498db;"><i class="fa fa-thumbs-down"></i></a></span>';
                                    echo '</div>';
                                    echo '<br>';   
                                }else{
                                    echo '<span class="text" style="color:#bdc3c7;"><i class="fa fa-thumbs-up"></i> <span style="color:#1abc9c;">'.$facts['likes'].'</span> &nbsp;&nbsp; <span style="color:#c0392b;">'.$facts['dislikes'].'</span> <i class="fa fa-thumbs-down"></i></span>';
                                    echo '</div>';
                                    echo '<br>'; 
                                }
                            }
                        ?>
                        
                        <form name="randomfact" action="facts.php" method="get">
                            <div class="center">
                                <button type="button" class="btn btn-outline-primary btn-lg factbuttons" data-toggle="collapse" data-target="#categories">CATEGORIES</button>
                                <span>&nbsp;&nbsp;</span><button type="submit" class="btn btn-outline-primary btn-lg factbuttons">NEW FACT</button>
                                <br><br>
                                <div class="collapse" id="categories">
                                    <div style="background:none;border:1px solid #2980b9;border-radius:5px;padding-top:20px;">
                                        <div class="form-group para">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label"><input class="form-check-input" type="radio" name="type" id="General" value="General"> General</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label"><input class="form-check-input" type="radio" name="type" id="Science" value="Science"> Science</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label"><input class="form-check-input" type="radio" name="type" id="Animals" value="Animals"> Animals</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label"><input class="form-check-input" type="radio" name="type" id="Entertainment" value="Entertainment"> Entertainment</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label"><input class="form-check-input" type="radio" name="type" id="History" value="History"> History</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label"><input class="form-check-input" type="radio" name="type" id="Numbers" value="Numbers"> Numbers</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </div>
        </div>
        
        <br>
        
        <div class="textarea">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <?php
                        if ($loggedin == true){
                            echo '<div class="col-sm">';
                            echo '<form name="submitComment" onsubmit="return commentValidation()" action="comment.php" method="post">';
                            echo '<div class="input-group input-group-lg">';
                            echo '<input class="form-control" id="comment" placeholder="Comment..." name="comment" style="background:none;color:white;width:100%;">';
                            echo '<span class="input-group-btn"><button type="submit" class="btn btn-info">Comment</button></span>';
                            echo '</div>';
                            echo '<input type="hidden" name="factid" value="'.$facts['factid'].'">';
                            echo '</form>';
                            echo '</div>';
                        }else{
                            echo '<div class="col-sm center">';
                            echo '<p class="lead para">Login or register to leave a comment!</p>';
                            echo '<a class="btn btn-outline-primary" href="login.html">LOGIN</a>';
                            echo '&nbsp;&nbsp;<a class="btn btn-outline-primary" href="registration.html">REGISTER</a>';
                            echo '</div>';
                        }
                    ?>
                    <div class="col-sm-3"></div>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm commentarea">
                    <?php
                        $factid = mysql_real_escape_string($facts['factid']);

                        $query = "SELECT text, time, author FROM comments WHERE factid='$factid' ORDER BY time";

                        $rows = mysql_query($query) or die(mysql_error());

                        if (mysql_num_rows($rows)==0){
                                echo '<span class="lead">No comments have been left. Be the first!</span>';
                            }else{
                            while ($comments = mysql_fetch_array($rows)) {
                                echo '<div class="row">';
                                echo '<div class="col-sm">';
                                echo '<span class="lead" style="color:#bdc3c7;">'.$comments['text'].'</span>';
                                echo '</div>';
                                echo '<div class="col-sm-2">';
                                echo '<span class="lead" style="color:#95a5a6;">'.getusername($comments['author']).'</span>';
                                echo '</div>';
                                echo '</div>';   
                            }
                        }

                        mysql_close($link);
                    ?>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>

        <br>

        <div class="textarea">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <?php
                        if ($loggedin == true){
                            echo '<div class="col-sm center">';
                            echo '<form name="submitFact" onsubmit="return submitValidation()" action="submitfact.php" method="post">';
                            echo '<div class="input-group input-group-lg">';
                            echo '<input class="form-control" id="factbox" placeholder="Fact..." name="fact" style="background:none;color:white;width:100%;">';
                            echo '<span class="input-group-btn"><button data-toggle="collapse" data-target="#submitfactcat" class="btn btn-primary">Categories</button></span>';
                            echo '<span class="input-group-btn"><button type="submit" class="btn btn-info">Submit Fact</button></span>';
                            echo '</div>';
                            echo '<br>';
                            echo '<div class="collapse" id="submitfactcat">';
                            echo '<div style="background:none;border:1px solid #2980b9;border-radius:5px;padding-top:20px;">';
                            echo '<div class="form-group para">';
                            echo '<div class="form-check form-check-inline">';
                            echo '<label class="form-check-label"><input class="form-check-input" type="radio" name="type" id="General" value="General"> General</label>';
                            echo '</div>';
                            echo '<div class="form-check form-check-inline">';
                            echo '<label class="form-check-label"><input class="form-check-input" type="radio" name="type" id="Science" value="Science"> Science</label>';
                            echo '</div>';
                            echo '<div class="form-check form-check-inline">';
                            echo '<label class="form-check-label"><input class="form-check-input" type="radio" name="type" id="Animals" value="Animals"> Animals</label>';
                            echo '</div>';
                            echo '<div class="form-check form-check-inline">';
                            echo '<label class="form-check-label"><input class="form-check-input" type="radio" name="type" id="Entertainment" value="Entertainment"> Entertainment</label>';
                            echo '</div>';
                            echo '<div class="form-check form-check-inline">';
                            echo '<label class="form-check-label"><input class="form-check-input" type="radio" name="type" id="History" value="History"> History</label>';
                            echo '</div>';
                            echo '<div class="form-check form-check-inline">';
                            echo '<label class="form-check-label"><input class="form-check-input" type="radio" name="type" id="Numbers" value="Numbers"> Numbers</label>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</form>';
                            echo '</div>';
                        }else{
                            echo '<div class="col-sm center">';
                            echo '<p class="lead para">Login or register to submit your own fact!</p>';
                            echo '<a class="btn btn-outline-primary" href="login.html">LOGIN</a>';
                            echo '&nbsp;&nbsp;<a class="btn btn-outline-primary" href="registration.html">REGISTER</a>';
                            echo '</div>';
                        }
                    ?>
                    <div class="col-sm-3"></div>
                </div>
            </div>
        </div>
        
        <br>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>    
    
    </body>
    
</html>