<?php 

require_once('config.php'); 

/*
 Displays the list of artist links on the left-side of page
*/
function outputArtists() {
   try {
         $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = "select * from Artists order by LastName limit 0,30";
         $result = $pdo->query($sql);
         while ($row = $result->fetch()) {
            echo '<a href="' . $_SERVER["SCRIPT_NAME"] . '?id=' . $row['ArtistID'] . '" class="';
            if (isset($_GET['id']) && $_GET['id'] == $row['ArtistID']) echo 'active ';
            echo 'item">';
            echo $row['LastName'] . '</a>';
         }
         $pdo = null;
   }
   catch (PDOException $e) {
      die( $e->getMessage() );
   }
}

/*
 Displays the list of paintings for the artist id specified in the id query string
*/
function outputPaintings() {
		try {
			if (isset($_GET['id']) && $_GET['id'] > 0) {
			$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = 'select * from Paintings where ArtistId=' . $_GET['id'];
			$result = $pdo->query($sql);
			while ($row = $result->fetch()) {
				outputSinglePainting($row);
			}
			$pdo = null;
			}
		}
catch (PDOException $e) {
die( $e->getMessage() );
}
}

/*
 Displays a single painting
*/
function outputSinglePainting($row) {
	echo '<div class="item">';
echo '<div class="image">';
echo '<img src="img/' .
$row['ImageFileName'] .'.jpg">';
echo '</div>';
echo '<div class="content">';
echo '<h4 class="header">';
echo $row['Title'];
echo '</h4>';
echo '<p class="description">';
echo $row['Excerpt'];
echo '</p>';
echo '</div>'; // end class=content
echo '</div>'; // end class=item

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
      <span class="site-heading-upper text-primary mb-3" style="font-size:32px; padding-top: 10px;">Masterpiece Artworks</span>
      <span class="site-heading-lower" >ArtWorld</span>
    </h1>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
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
              <a class="nav-link text-uppercase text-expanded" href="gallery.php">Gallery</a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded text-primary" href="artists.php">Artists
                <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="genres.php">Genres</a>
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
                  <span class="section-heading-lower">List of Artists</span> <br />
                <span class="section-heading-upper">Please select an Arrist's name.</span>
                </h2>
                <div class="ui grid">
                    <div class="four wide column">
                        <div class="ui link list">
                            <?php outputArtists(); ?>
                        </div>
                    </div>
                <div class="twelve wide column">
                    <div class="ui items">
                        <?php outputPaintings(); ?>
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

</html>
