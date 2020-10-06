<?php  require_once("Includes/db.php"); ?>
<?php  require_once("Includes/Functions.php"); ?>
<?php  require_once("Includes/Sessions.php"); ?>
<?php
  if (isset($_POST['Submit'])) {
    $category = $_POST['CategoryTitle'];
    $Admin = ['Fourkas'];

    date_default_timezone_set("Europe/Athens");
    $CurrentTime= time();
    $DateTime = strftime("%d-%B-%Y %H:%M:%S",$CurrentTime);


    if(empty($category)){
      $_SESSION["ErrorMessage"] = "All Fields must be filled out";
      Redirect_to("categories.php");

    }elseif (strlen($category)<2) {
      $_SESSION["ErrorMessage"] = "Category must contain less than 2 letters";
      Redirect_to("categories.php");

    }elseif (strlen($category)>49) {
      $_SESSION["ErrorMessage"] = "Category must not contain more than 49 letters";
      Redirect_to("categories.php");

  }else{
    $sql = "INSERT INTO category(title,author,datetime)";
    $sql .= "VALUES(:categoryName , :adminName , :dateTime )";

    $stmt = $Connectingdb -> prepare($sql);

    $stmt -> bindValue(':categoryName' , $category);
    $stmt -> bindValue(':adminName'    , $Admin );
    $stmt -> bindValue(':dateTime' , $DateTime);

    $Execute = $stmt->execute();

    if ($Execute) {
        $_SESSION["SuccessMessage"] = "Category With the id of ".$Connectingdb->lastInsertId()." Was Added Successfully";
        Redirect_to("categories.php");
    }else{
      $_SESSION["ErrorMessage"] = "Something Went Wrong Please Try Again";
      Redirect_to("categories.php");
    }


}

  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/c2019668c3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css?version=1">
    <title>Categories</title>
  </head>
  <body>


        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <div class="container">



            <a href="#" class ="navbar-brand">George Fourkas</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
                <span class = "navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id=navbarcollapseCMS>


            <ul class = "navbar-nav mr-auto">

                <li class = "nav-item">
                  <a href="MyProfile.php" class ="nav-link"><i class="fas fa-user"></i> My Profile</a></li>

                <li class = "nav-item">
                     <a href="Dashboard.php" class ="nav-link">Dashboard</a></li>

                <li class = "nav-item">
                      <a href="Posts.php" class ="nav-link">Posts</a></li>

                <li class = "nav-item">
                      <a href="Categories.php" class ="nav-link">Categories</a></li>

                <li class = "nav-item">
                      <a href="Admins.php" class ="nav-link">Manage Admins</a></li>

                <li class = "nav-item">
                      <a href="Comments.php" class ="nav-link">Comments</a></li>

                <li class = "nav-item">
                      <a href="Blog.php?page=1" class ="nav-link">Live Blog</a></li>

            </ul>

            <ul class ="navbar-nav ml-auto">
              <li class = "nav-item"><a href="#" class="nav-link"> <i class="fas fa-user-times"></i> Logout</a></li>

            </ul>
          </div>
        </div>

      </nav>
        <div style="height:3.5px;background:#FF4500;"></div>


          <!-- End of the Navbar Section -->

      <header>
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h1><i class = "fas fa-edit" style="color:#FF4500;"></i> Manage Categories</h1>
            </div>
          </div>
        </div>
    </header>

    <!-- Main Area -->


    <section class="container py-2 mb-4">
      <div class="row" >
        <div class="offset-lg-1 col-lg-10" style="min-height:720px;">
          <?php echo ErrorMessage(); ?>
          <?php echo SuccessMessage(); ?>
          <form class="" action="categories.php" method="post">
            <div class="card mb-3 bg-dark">
              <div class="card-header">
                <h1 style="color:#FF4500">Add New Category</h1>
                <div class="card-body">
                  <div class="form-group">
                    <label for="title"><span class = "justaclass">Category Title:</span></label>
                    <input class ="form-control" type="text" name="CategoryTitle" id="title" placeholder = "Type Title Here" value="">

                  </div>
                  <div class="row">
                    <div class="col-lg-6 mb-2">
                      <a href="Dashboard.php" class = "btn btn-warning btn-block" ><i class = "fas fa-arrow-left"></i> Back to Dashboard</a>
                    </div>
                    <div class="col-lg-6 mb-2">
                      <button type="submit" name="Submit" class="btn btn-success btn-block">
                        <i class = "fas fa-check"></i> Publish </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
  </section>

    <!-- END OF MAIN AREA -->
      <div style="height:3.5px;background:#FF4500;"></div>
      <footer class="bg-dark text-white">
        <div class="container">
          <div class="row">
            <div class="col">

            <p class="lead text-center">Theme by | George Fourkas |<span id="year"></span> &copy All rights reserved</p>
            <p class = "text-center small">orem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel suscipit ex. Nam hendrerit urna quis orci auctor,
               quis fermentum dolor semper. Mauris convallis fermentum porta. Sed in venenatis nibh. </p>

            </div>
          </div>
        </div>
      </footer>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script> $('#year').text(new Date().getFullYear()); </script>


  </body>
</html>
