<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type"
        content="text/html"; charset="utf-8">
        <link rel="stylesheet" href="bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/css/bootstrap.css">  
        <script>
            function logout() {
                var loguit = confirm('Are you sure you want to logout?');
                if (loguit) {
                    location.href='index.php?page=logout'
                }
            }
        </script>
        <style>
        .active {background-color: red;}
        </style>
    </head>
    <body>

    <!-- Header == nav bar -->

        <div class="header">
            <div class="icon_container">

            </div>
        </div>  
        <?php
        if(isset($_SESSION["ID"])&&
        $_SESSION["STATUS"]=="ACTIVE") {
            if($_SESSION["ROL"]==0) {
                ?>
                <!-- navbar shown when rol is 0 (user)-->
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                        <div class="container-fluid">

                            <a class="navbar-brand" href="#">StatTracker</a>

                            <!-- search bar which allows the user to find a video by title -->
                                <form name="search" action="index.php?page=homepage" method="POST" class="form">
                                    <input type="hidden" name="id" id="id"
                                    value="<?php echo $video['ID'];?>" />   
                                    <input type="text" name="title" id="title" value="<?php if(!empty($_POST['title'])) echo $_POST['title']; ?>">
                                    <input type="submit" class="icon" id="submit" name="submit" value="Search" />

                                </form>
                        </div>
                    <button type="button" class="btn btn-dark" onclick="logout()">logout</button>
                    </nav>


                <?php
            }elseif($_SESSION["ROL"]==1){
                ?>

                <!-- navbar shown when rol is 1 (admin) -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">StatTracker</a>
                    <a class="navbar-brand <?php if ($_GET["page"]=='homepage') {echo "active";}?>" onclick="location.href='index.php?page=homepage'">Homepage</a>
                    <a class="navbar-brand <?php if ($_GET["page"]=='videos_edit') {echo "active";}?>" onclick="location.href='index.php?page=videos_edit'">Edit</a>
                    <a class="navbar-brand <?php if ($_GET["page"]=='videos') {echo "active";}?>" onclick="location.href='index.php?page=videos'">Delete</a>
                    <a class="navbar-brand <?php if ($_GET["page"]=='videos_add') {echo "active";}?>" onclick="location.href='index.php?page=videos_add'">Add</a>
                        <form name="search" action="index.php?page=homepage" method="POST" class="form">
                            <input type="hidden" name="id" id="id"
                                value="<?php echo $video['ID'];?>" />   
                            <input type="text" name="title" id="title" value="<?php if(!empty($_POST['title'])) echo $_POST['title']; ?>">
                            <input type="submit" class="icon" id="submit" name="submit" value="Search" />

                        </form>
                </div>
            <button type="button" class="btn btn-dark" onclick="logout()">Logout</button>
        </nav>
            <?php
            }
        }
        ?>
    </div>
    </body>
</html>