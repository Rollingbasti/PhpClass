<?php
require_once('../includes/config.php');

if(!$user->isLoggedIn()){
    header('Location: login.php');
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin - Add Post</title>
    <link rel="stylesheet" href="../style/normalize.css">
    <link rel="stylesheet" href="../style/main.css">
    <script src="https://cdn.tinymce.com/4/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
            theme: "modern",
            plugins: [
                "advlist autolink lists link image charmap print anchor",
                "searchreplace visualblocks code fullscreen",
                "media table contextmenu paste"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
    </script>
</head>
<body>

<div id="wrapper">

    <?php
        include('menu.php');
    ?>
    <p><a href="./">Blog Admin Index</a></p>

    <h2>Add Post</h2>
    <?php

        if(isset($_POST['submit'])){
            $_POST = array_map('stripslashes', $_POST);
            extract($_POST);

            if($postTitle == ''){
                $error[] = 'Please enter the title.';
            }

            if($postDesc == ''){
                $error[] = 'Please enter the description.';
            }

            if($postCont == ''){
                $error[] = 'Please enter the content.';
            }

            if(!isset($error)){

                try{
                    $stmt = $db->prepare('INSERT INTO blog_posts (postTitle,postDesc,postCont,postDate) VALUES (:postTitle, :postDesc, :postCont, :postDate)');
                    $stmt->execute(array(
                        ':postTitle' => $postTitle,
                        ':postDesc' => $postDesc,
                        ':postCont' => $postCont,
                        ':postDate' => date('Y-m-d H:i:s')
                    ));

                    header('Location: index.php?action=added');
                    exit;
                } catch(PDOException $e){
                    echo $e->getMessage();
                }
            }
        }

        if(isset($error)){
            foreach($error as $error){
                echo '<p class="error">'.$error.'</p>';
            }
        }
    ?>

    <form action='' method='post'>
        <p><label>Title</label><br />
        <input type='text' name='postTitle' value='<?php if(isset($error)){echo $_POST['postTitle'];}?>'></p>
        <p><label>Beschreibung</label><br />
        <textarea name='postDesc' cols='60' rows='10'><?php if(isset($error)){echo $_POST['postDesc'];} ?></textarea></p>
        <p><label>Content</label><br />
        <textarea name='postCont' cols='60' rows='10'><?php if(isset($error)){echo $_POST['postCont'];} ?></textarea></p>
        <p><input type='submit' name='submit' value='Submit'></p>
    </form>
</div>
</body>
</html>