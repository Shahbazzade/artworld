<?php 

require_once('config.php'); 

/*
 Displays a list of genres
*/

try {
   $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
   $sql = 'select GenreId, GenreName, Description, Link from Genres where GenreId=:id';
   $id =  $_GET['id'];
   $statement = $pdo->prepare($sql);
   $statement->bindValue(':id', $id);
   $statement->execute();   
   
   $row = $statement->fetch(PDO::FETCH_ASSOC);
   $pdo = null;
}
catch (PDOException $e) {
   die( $e->getMessage() );
}


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" name="author" content="">
    <title>ArtWorld</title>
    <link href="css/semantic.css" rel="stylesheet"> 
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/business-casual.min.css" rel="stylesheet">
    <link rel="icon" href="img/098010.jpg">
  </head>
<body>
    <h1 class="site-heading text-center text-white d-none d-lg-block" style="margin-top:70px;">
      <span class="site-heading-upper text-primary mb-3" style="font-size:32px; padding-top: 10px;">Masterpiece Artworks</span>
      <span class="site-heading-lower" >ArtWorld</span>
    </h1>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav" >
      <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="index.html">Masterpiece ArtWorks</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav mx-auto" align="center">
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="index.html">Home</a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="gallery.php">Gallery
                  <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="artists.php">Artists</a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded  text-primary" href="genres.php">Genres
                  <span class="sr-only">(current)</span>
                </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <br />
<main class="ui container">
    <div class="ui secondary segment" style="width:50%; margin-left:auto; margin-right:auto; border-radius: 25px;" align="center">
         <h1><?php echo $row['GenreName']; ?></h1>
    </div>    
    <div class="ui segment" style=" margin-left:auto; margin-right:auto;">
        <div class="ui grid" >
           <div class="three wide column">
                <img src="img/<?php echo $row['GenreId']; ?>.jpg" >
           </div>
           <div class="thirteen wide column">
                <p><?php echo $row['Description']; ?></p>
                <p>
                <a class="ui labeled icon primary button" href="<?php echo $row['Link']; ?>">
                  <i class="external icon"></i>
                  Read more on Wikipedia about <?php echo $row['GenreName']; ?>
                </a>
                    <a href="genres.php" style="float:right">Go to the List of Genres</a>
                </p>
           </div> 
       </div>
    </div>
</main>
    <br />
<footer class="footer text-faded text-center py-5">
      <div class="container">
        <p class="m-0 small">Copyright &copy; Your Website 2018</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="jquery/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>


</body>
</html>