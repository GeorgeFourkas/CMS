<?php  require_once("Includes/db.php"); ?>
<?php  require_once("Includes/Functions.php"); ?>
<?php  require_once("Includes/Sessions.php"); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/c2019668c3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>Blog Page</title>
  </head>
  <body>
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <div class="container">

            <a href="blog.php" class ="navbar-brand mr-5">Fourko-Blog</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
                <span class = "navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id=navbarcollapseCMS>

            <ul class = "navbar-nav mr-auto">

                <li class = "nav-item">
                     <a href="blog.php" class ="nav-link">Home</a></li>

                <li class = "nav-item">
                      <a href="#" class ="nav-link">About Us</a></li>

                <li class = "nav-item">
                      <a href="blog.php" class ="nav-link">Blog</a></li>

                <li class = "nav-item">
                      <a href="#" class ="nav-link">Contact Us</a></li>

                <li class = "nav-item">
                      <a href="#" class ="nav-link">Features</a></li>
            </ul>
              <form class="form-inline d-none d-sm-block" action="blog.php">
                <div class="form-group">
                  <input class = "form-control" type="text" name="Search" placeholder="Search Something Here" value="">
                  <button class = "btn btn-primary ml-1" name="SearchButton">Go!</button>
                </div>
              </form>
            </ul>
          </div>
        </div>

      </nav>
      <div style="height:3.5px;background:#FF4500;"></div>

          <!-- End of the Navbar Section -->

      <div class="container mt-3 mb-3">
        <div class="row mt-4">
          <div class="col-sm-8">
            <!-- main Area starts here -->
            <?php
              echo ErrorMessage();
              echo SuccessMessage();

              $Connectingdb;
              if (isset($_GET["SearchButton"])){
                $Search  = $_GET["Search"];
                $sql  = "SELECT * FROM posts WHERE
                datetime LIKE :search
                OR title LIKE :search
                OR category LIKE :search
                OR post LIKE :search";

                $stmt = $Connectingdb ->prepare($sql);
                $stmt -> bindValue(':search','%'.$Search.'%');
                $stmt->execute();
              }
            else {
              $PostidFromURL = $_GET["id"];
              if (!isset($PostidFromURL)) {

                $_SESSION["ErrorMessage"] = "Υπήρξε Κάποιο Πρόβλημα.Παρακαλούμε Προσπαθήστε Αργότερα";
                redirect_to("Blog.php");
              }
                $sql = "SELECT * FROM posts WHERE id='$PostidFromURL'";
                $stmt = $Connectingdb -> query($sql);
                }
              while ($DataRows = $stmt ->fetch()) {
                $PostId           = $DataRows["id"];
                $DateTime         = $DataRows["datetime"];
                $PostTitle        = $DataRows["title"];
                $Category         = $DataRows["category"];
                $Admin            = $DataRows["author"];
                $Image            = $DataRows["image"];
                $PostDescription  = $DataRows["post"];
            ?>
              <div class="card mt-3">
                <img src="Upload/<?php echo htmlentities($Image);?>" alt="Posts Image" class = "imt-fluid card-img-top" style = "max-height:450px;">
                <div class="card-body">
                  <h4 class = "card-title"><?php echo htmlentities($PostTitle); ?></h4>
                  <small class = "text-muted">Written by: <?php echo htmlentities($Admin)?> on <?php echo htmlentities($DateTime)  ?></small>
                  <span style = "float:right;" class = "badge badge-dark text-light">Comments 20</span>
                  <hr>


                  <p class = "card-text"><?php echo htmlentities($PostDescription) ?></p>
                  <a href="FullPost.php?id=<?php echo $PostId;?>" style = "float:right;">

                  </a>
                </div>
              </div>
              <?php   } ?>
            <!-- main Area Ends  here -->

          </div>
        <div class="col-sm-4 " style="min-height:40px; background-color:green;">


       </div>
    </div>



      </div>

      <footer class="bg-dark text-white">
        <div class="container">
          <div class="row">
            <div class="col">


            <p class="lead text-center">Theme by | George Fourkas |<span id="year"></span> &copy All rights reserved</p>
            <p class = "text-center small">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel suscipit ex. Nam hendrerit urna quis orci auctor,
               quis fermentum dolor semper. Mauris convallis fermentum porta. Sed in venenatis nibh.  </p>


            </div>
          </div>
        </div>
      </footer>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <script>
  $('#year').text(new Date().getFullYear());
  </script>
  </body>
</html>
