<?php 

require_once('config.php'); 

/*
 Displays a list of genres
*/
function outputGenres() {
   try {
      $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = 'select GenreId, GenreName, Description from Genres
Order By GenreId';
        $result = $pdo->query($sql);
        while ($row = $result->fetch()) {
        outputSingleGenre($row);
        }
      $pdo = null;
   }
   catch (PDOException $e) {
      die( $e->getMessage() );
   }
}

/*
 Displays a single genre
*/
function outputSingleGenre($row) {
echo '<div class="ui container-fluid card">';  
echo '<div class="ui fluid image">';
$img = '<img  src="img/' . $row['GenreId'] .'.jpg">';
echo constructGenreLink($row['GenreId'], $img);    
echo '</div>'; // end class=image 
echo '<div class="extra">';
echo '<h4>';
echo constructGenreLink($row['GenreId'], $row['GenreName']);
echo '</h4>';
echo '</div>'; // end class = extra
echo '</div>'; // end class = card   
}

/* 
  Constructs a link given the genre id and a label (which could
  be a name or even an image tag
*/
function constructGenreLink($id, $label) {
$link = '<a href="genre.php?id=' . $id . '">';
$link .= $label;
$link .= '</a>';
return $link;
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
    <link rel="stylesheet" href="css/semantic.css" />

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/business-casual.min.css" rel="stylesheet">
    <link rel="icon" href="img/098010.jpg">
  </head>

  <body>

   <h1 class="site-heading text-center text-white d-none d-lg-block">
      <span class="site-heading-upper text-primary mb-3" style="font-size:32px; padding-top: 5.6%;">Masterpiece Artworks</span>
      <span class="site-heading-lower" >ArtWorld</span>
    </h1>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
      <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="index.html">Masterpiece ArtWorks</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive" align="center">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="index.html">Home</a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="gallery.php">Gallery</a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="artists.php">Artists</a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded text-primary" href="genres.php">Genres
                 <span class="sr-only">(current)</span>
                </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<br />
  <section class="page-section about-heading">
      <div class="container">
        <div class="about-heading-content">
          <div class="row">
            <div class="col-xl-9 col-xl-12 mx-auto">
              <div class="bg-faded rounded p-5">
                <h2 class="section-heading mb-4">
                <span class="section-heading-lower">List of Genres</span> <br />
                <span class="section-heading-upper">Please select a Genre.</span>
                </h2>
                <div class="ui grid">
                  <div class="ui segment">  
                     <div class="ui six doubling cards">
                        <?php outputGenres(); ?>  
                     </div>
                 </div>      
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer class="footer text-faded text-center py-5">
      <div class="container">
        <p class="m-0 small">Copyright &copy; Your Website 2018</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="jquery/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

  </body>

  <!-- Script to highlight the active date in the hours list -->
<!--
  <script>
    $('.list-hours li').eq(new Date().getDay()).addClass('today');
  </script>
-->

</html>
