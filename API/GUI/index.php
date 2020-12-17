<?php
    session_start();
    include_once 'serverside/variables.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $websiteName; ?> - Home</title>
    <link rel="icon" href="images/<?php echo $websiteLogo; ?>">
    <!-- Styles -->
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/footer.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet">
</head>
<body>
 
    <?php
        include_once "layouts/header.php";
    ?>

    <main>
        <div class="container">
        
            <div class="image-slider" id="image-slider">
                <img src="images/gawas.jpg" class='image-slides' alt="Second Image">            </div>

            <div class="social-media">
                <h3>Like us on facebook</h3>
                <div class="fb-page" data-href="https://www.facebook.com/stac.sogod/" data-height="127" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/stac.sogod/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/stac.sogod">Saint Thomas Aquinas College</a></blockquote></div>
                <h3>Our Location</h3>
                <div class="mapouter"><div class="gmap_canvas"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9334.02615255435!2d124.97735729436005!3d10.383831362421024!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33070f4001d0733f%3A0xb55e3c6c4d275382!2sSaint%20Thomas%20Aquinas%20College!5e0!3m2!1sen!2sph!4v1591190801038!5m2!1sen!2sph" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe><a href="https://www.embedgooglemap.net"></a></div><style>.mapouter{text-align:right;height:300px;width:300px;}.gmap_canvas {overflow:hidden;background:none!important;height:300px;width:300px;}</style>Google Maps by <a href="https://www.embedgooglemap.net" rel="nofollow" target="_blank">Embedgooglemap.net</a></div>
            </div>
        </div>
    </main>

    <div id="events">
        <div class="container">
            <h2>Events <?php 
            if(isset($_SESSION['admin_logged_in'])){
                echo "  <form method='GET' action='compose_content.php'>
                            <button name='news' type='submit'>Compose Events</button>
                        </form>";
            }
            ?> </h2>

            <?php
                $newsQuery = "SELECT * FROM news ORDER BY news_id DESC LIMIT 3;";
                if($result = mysqli_query($conn, $newsQuery)){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){

                            $newsTitle = $row['news_title'];
                            $newsContent = $row['news_content'];
                            $newsDate = $row['news_date'];
                            $newsTime = $row['news_time'];
                            $newsAuthor = $row['news_author'];
                            $id = $row['news_id'];

                            $cuttedContent = substr($newsContent, 0, 70)."...";

                            echo "
                            <div class='news'>
                                <h3><a href='school_news.php?id=$id&type=news'>$newsTitle</a></h3>
                                <span class='news-date'>$newsDate | $newsTime</span>
                                <p>$cuttedContent</p> 
                            ";    

                            if(isset($_SESSION['admin_logged_in'])){
                                echo "<form method='POST' action='serverside/delete_post.inc.php' class='crud'>
                                <input type='text' name='ID' value='$id' style='display:none'>
                                <input type='submit' class='delete-button' name='delete_news' value='Delete Post'>
                                </form>
                                <form method='GET' action='compose_content.php' class='crud'>
                                <input type='text' name='ID' value='$id' style='display:none'>
                                <input type='submit' class='delete-button' name='edit_news' value='Edit Post'>
                                </form>";   
                            }
                            
                            echo "
                            </div>";
                        }

                        echo "  <div class='view_all'>
                                    <h3><a href='news.php?type=events'>View All Events</a></h3>
                                </div>";
                    }
                    else{
                        echo "
                        <div class='news'>
                            <h3>No Available Events</h3>
                        </div>
                        ";  
                    }
                }
            ?> 
            <h2>Announcements 
            <?php 
                if(isset($_SESSION['admin_logged_in'])){
                    echo "  <form method='GET' action='compose_content.php'>
                                <button class='delete-button' name='announcements' type='submit'>Compose Announcements</button>
                            </form>";
                }
            ?> </h2>

            <?php
                $newsQuery = "SELECT * FROM announcements ORDER BY announcement_id DESC LIMIT 3;";
                if($result = mysqli_query($conn, $newsQuery)){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){

                            $announcementTitle = $row['announcement_title'];
                            $announcementContent = $row['announcement_content'];
                            $announcementDate = $row['announcement_date'];
                            $announcementTime = $row['announcement_time'];
                            $announcementAuthor = $row['announcement_author'];
                            $id = $row['announcement_id'];

                            $cuttedContent = substr($announcementContent, 0, 70)."...";

                            echo "
                            <div class='news'>
                            <h3><a href='school_news.php?id=$id&type=announcements'>$announcementTitle</a></h3>
                                <span class='news-date'>$announcementDate | $announcementTime</span>
                                <p>$cuttedContent</p> 
                            ";    

                            if(isset($_SESSION['admin_logged_in'])){
                                echo "<form method='POST' action='serverside/delete_post.inc.php' class='crud'>
                                <input type='text' name='ID' value='$id' style='display:none'>
                                <input class='delete-button' type='submit' name='delete_announcement' value='Delete Post'>
                                </form>
                                <form method='GET' action='compose_content.php' class='crud'>
                                <input type='text' name='ID' value='$id' style='display:none'>
                                <input class='delete-button' type='submit' name='edit_announcement' value='Edit Post'>
                                </form>
                                ";   
                            }
                            
                            echo "
                            </div>";
                        }

                        echo "  <div class='view_all'>
                                    <h3><a href='news.php?type=announcements'>View All Announcements</a></h3>
                                </div>";
                    }
                    else{
                        echo "
                        <div class='news'>
                            <h3>No Available Announcements</h3>
                        </div>
                        ";  
                    }
                }
            ?> 

        </div>
        
    </div>

    <?php
        include_once "layouts/footer.php";
    ?>

</body>
</html>

