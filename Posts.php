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
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="style.css">


    <title>Posts</title>
  </head>
  <body>

        <!-- Navigation Bar -->
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <div class="container">



            <a href="basic.html" class ="navbar-brand">George Fourkas</a>
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
                   <h1><i class = "fas fa-blog" style="color:#FF4500;"></i> Blog Posts </h1>
               </div>

                <div class="col-lg-3 mb-2">
                    <a href="AddNewPost.php" class="btn btn-primary btn-block" id="adminbutton"><i class = "fas fa-edit">  Add New Post</i></a>
                </div>

                <div class="col-lg-3 mb-2">
                  <a href="Categories.php" class="btn btn-info btn-block"id="adminbutton"><i class = "fas fa-folder-plus">  Add New Category</i></a>
                </div>



                <div class="col-lg-3 mb-2">
                  <a href="Admins.php" class="btn btn-warning btn-block"id="adminbutton"><i class = "fas fa-user-plus">  Add New Admins</i></a>
                </div>

                <div class="col-lg-3 mb-2">
                  <a href="Comments.php" class="btn btn-success btn-block"id="adminbutton"><i class = "fas fa-check">  Approove New Comments</i></a>
                </div>
              </div>
            </div>
        </header>

        <!--  Header End-->


        <!-- Main Area Start-->
        <section class = "container py-2 mb-4">
          <div class="row">
            <div class="col-lg-12">
              <div style="overflow-x:auto;">
              <table class = "table table-hover">
                <thead class = "thead-dark">


                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date&Time</th>
                    <th>Author</th>
                    <th>Banner</th>
                    <th>Comments</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Preview</th>
                 </tr>
                </thead>
                <?php

                $Connectingdb;
                $sql = "SELECT * FROM posts ";
                $stmt = $Connectingdb -> query($sql);
                $Sr = 0;

                while ($DataRows = $stmt -> fetch()) {
                  $Id         = $DataRows["id"];
                  $DateTime   = $DataRows["datetime"];
                  $PostTitle  = $DataRows["title"];
                  $Category   = $DataRows["category"];
                  $Admin      = $DataRows["author"];
                  $Image      = $DataRows["image"];
                  $PostText   = $DataRows["post"];
                  $Sr++;
                 ?>
                 <tbody>


                 <tr>
                   <td><?php echo $Sr ?></td>

                   <?php if (strlen($PostTitle)>20){$PostTitle = substr($PostTitle, 0 ,15); $PostTitle.="..."; }?>

                   <td><?php echo $PostTitle ?></td>
                   <?php if (strlen($Category)>20){$Category = substr($Category, 0 ,15); $Category.="..."; }?>

                   <td><?php echo $Category; ?></td>
                   <td><?php echo $DateTime; ?></td>

                   <?php if (strlen($Admin)>20){$Admin = substr($Admin, 0 ,15); $Admin.="..."; }?>
                   <td><?php echo $Admin;    ?></td>

                   <td><img src="Upload/<?php echo $Image;?>" width ="120px" height="50px;"</td>
                   <td>Comments</td>
                   <td><a href="EditPost.php?id=<?php echo $Id;?>"><span class = "btn btn-warning">Edit</span></a></td>
                   <td><a href="DeletePost.php?id=<?php echo $Id ?>"><span class = "btn btn-danger">Delete</span></a></td>
                  <td><a href="FullPost.php?id=<?php echo $Id; ?>"><span class = "btn btn-primary">Preview</span></td>

                 </tr>
                </tbody>
               <?php } ?>
              </table>
            </div>
          </div>
        </div>
        </section>

      <div style="height:3.5px;background:#FF4500;"></div>

      <footer class="bg-dark text-white ">
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

          <script>
            $('#year').text(new Date().getFullYear());
          </script>


  </body>
</html>
