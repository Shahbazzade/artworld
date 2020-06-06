<?php 

require_once('config.php'); 
try {
   $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
   die( $e->getMessage() );
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
   
    <title>ArtWorld</title>

    
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/semantic.css" rel="stylesheet"> 
    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/business-casual.min.css" rel="stylesheet">
    <link rel="icon" href="img/098010.jpg">
      
  </head>

  <body>

   <h1 class="site-heading text-center text-white d-none d-lg-block" style="margin-top:70px;">
      <span class="site-heading-upper text-primary mb-3" style="font-size:32px; padding-top: 10px; ">Masterpiece Artworks</span>
      <span class="site-heading-lower">ArtWorld</span>
    </h1>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav" >
      <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="index.html">Masterpiece ArtWorks</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive" >
          <ul class="navbar-nav mx-auto" align="center">
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="index.html">Home</a>
            </li>
            <li class="nav-item px-lg-4" >
              <a class="nav-link text-uppercase text-expanded text-primary" href="gallery.php">Gallery
                  <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="artists.php">Artists</a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="genres.php">Genres</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<br />
<main class="ui container">
   <div class="ui secondary segment" style="margin-top:20px; width:60%; margin-left:auto; margin-right:auto; border-radius: 25px;" align="center">
<!--      <h1>User Input</h1>-->
      <form method="get" action="gallery.php">
         Gallery: 
         <select name="gallery">
            <option value="0">Select a gallery</option>
            
            <?php
   
            $sql = 'select * from Galleries order by GalleryName';
            $result = $pdo->query($sql);
            while ($row = $result->fetch()) {         
               echo '<option value="' . $row['GalleryID'] . '"';
               if (isset($_GET['gallery']) && $row['GalleryID'] == $_GET['gallery']) 
                  echo ' selected ';
               echo '>';
               echo $row['GalleryName'];
               echo ' (' . $row['GalleryCity'] . ')';
               echo '</option>';
             }
   
            ?>
         </select>
         <input class="ui button" type="submit" value="Submit">
      </form>
   </div>

<div class="ui segment" style=" background: rgba(192,192,192,0.1);" >  
   <div class="ui six cards">
<?php
	// only display painting cards if one has been selected
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if (isset($_GET['gallery']) && $_GET['gallery'] > 0) {
		$sql = 'select * from Paintings where GalleryId=' .
	$_GET['gallery'];
	$result = $pdo->query($sql);
	while ($row = $result->fetch()) {
?>

              <div class="card" >
                  <div class="image">
                     <img src="img/<?php echo
$row['ImageFileName']; ?>.jpg" 
                        title="<?php echo $row['Title']; ?>" 
                        alt=" <?php echo $row['Title']; ?>">
                  </div> 
                  <div class="extra"><?php echo $row['Title']; ?>
  
                  </div>
               </div> <!-- end class=card-->
 <?php
} // end while
} // end if (isset
} // end if ($_SERVER
?>
      </div> <!-- end class=four cards-->
   </div>  <!-- end class=segment-->
</main>
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
