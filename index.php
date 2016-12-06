<?php
require('includes/config.php');
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Taste.It.Love.It</title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>

    <div id="wrapper">
        <h1>Taste.It.Love.It</h1>
        <hr />
        <div class="beitraege">
        <?php
            try {

                $stmt = $db->query('SELECT postID, postTitle, postDesc, postDate FROM blog_posts ORDER BY postID DESC');
                while($row = $stmt->fetch()){

                    echo '<div class="beitrag">';
                        echo '<h1>'.$row['postTitle'].'</h1>';
                        echo '<p>'.$row['postDesc'].'</p>';
                        echo '<p><a href="viewpost.php?id='.$row['postID'].'">Mehr lesen</a></p>';
                    echo '</div>';
                        
                }
            
            } catch(PDOExcepetion $e) {
                echo $e->getMessage();
            }
        ?>
        </div>
    </div>
</body>
</html>