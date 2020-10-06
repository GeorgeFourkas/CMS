  <?php  require_once("Includes/db.php"); ?>
  <?php  require_once("Includes/Functions.php"); ?>
  <?php  require_once("Includes/Sessions.php"); ?>
  <?php


    if (isset($_POST['Submit'])) {
      $PostTitle = $_POST["PostTitle"];
      $PostCategory = $_POST["Category"];
      $Image = $_FILES["Image"]["name"];
      $Target = "Upload/".basename($_FILES["Image"]["name"]);
      $PostText = $_POST["PostDescription"];
      $Admin = 'Fourkas';
      $Author = "Fourkas";

      date_default_timezone_set("Europe/Athens");
      $CurrentTime= time();
      $DateTime = strftime("%d-%B-%Y %H:%M:%S",$CurrentTime);

      if(empty($PostTitle)){
        $_SESSION["ErrorMessage"] = "Title can't be empty";
        Redirect_to("AddNewPost.php");

      }elseif (strlen($PostTitle)<5) {
        $_SESSION["ErrorMessage"] = "Post title must be greater than 5 characters";
        Redirect_to("AddNewPost.php");

      }elseif (strlen($PostText)>9999) {
        $_SESSION["ErrorMessage"] = "Post Description should be less than 10000 characters";
        Redirect_to("AddNewPost.php");

    }else{
      $sql  = "INSERT INTO posts(datetime,title,category,author,image,post)";
      $sql .= "VALUES(:dateTime ,:postTitle, :categoryName, :adminName, :imageName ,:postDescription )";

      $stmt = $Connectingdb -> prepare($sql);

      $stmt -> bindValue(':dateTime'        , $DateTime);
      $stmt -> bindValue(':postTitle'       , $PostTitle);
      $stmt -> bindValue(':categoryName'    , $PostCategory);
      $stmt -> bindValue(':adminName'       , $Admin );
      $stmt -> bindValue(':imageName'       , $Image);
      $stmt -> bindValue(':postDescription' , $PostText);


      $Execute = $stmt->execute();

      // php for moving the file to the destination get_included_files

      move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);

      if ($Execute) {
          $_SESSION["SuccessMessage"] = "Post With the id of ".$Connectingdb->lastInsertId()." Was Added Successfully";
          Redirect_to("AddNewPost.php");
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
                <h1><i class = "fas fa-edit" style="color:#FF4500;"></i> Add New Post</h1>
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


            <form class="" action="AddNewPost.php" method="post" enctype="multipart/form-data">
              <div class="card mb-3 bg-dark">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="title"><span class = "justaclass">Post Title:</span></label>
                      <input class ="form-control" type="text" name="PostTitle" id="title" placeholder = "Type Title Here" value="">

                    </div>

                    <div class="form-group">
                      <label for="title"><span class = "justaclass">Choose Category:</span></label>

                      <select class="form-control" id = "CategoryTitle" name="Category">
                        // sindesi me bash gia categories
                          <?php
                          $Connectingdb;
                            $sql = "SELECT id,title FROM category";
                            $stmt = $Connectingdb -> query($sql);
                            while ($DataRows = $stmt->fetch()) {
                              $Id = $DataRows["id"];
                              $CategoryName = $DataRows["title"];
                          ?>
                          <option><?php echo $CategoryName ?></option>
                          <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="image"><span class = "justaclass">Select Images</span></label>
                      <div class="custom-file">
                        <input class ="custom-file-input" type="file" name="Image" id="imageSelect" value="" placeholder="Press to Upload Image">
                        <label for="imageSelect" class = "custom-file-label"></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="Post"><span class = "justaclass">Post:</span></label>
                      <textarea class = "form-control" id =""  name="PostDescription" rows="5" cols="80"></textarea>
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
            </form>
          </div>
        </div>
    </section>
      <!-- END OF MAIN AREA -->
        <div style="height:3.5px;background:#FF4500;" ></div>
        <footer class="bg-dark text-white">
          <div class="container">
            <div class="row">
              <div class="col">

              <p class="lead text-center">Theme by | George Fourkas |<span id="year"></span> &copy All rights reserved</p>
              <p class = "text-center small">orem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel suscipit ex. Nam hendrerit urna quis orci auctor,
                quis fermentum dolor semper. Mauris convallis fermentum porta. Sed in venenatis nibh.  </p>

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
