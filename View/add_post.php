<?php

?>
<?php require 'inc/header.php' ?>
<?php require 'inc/msg.php' ?>

    <form action="" method="post">

        <p><label for="title">Title:</label><br />
            <input type="text" name="title" id="title" required="required" />
        </p>

        <p><label for="body">Content:</label><br />
            <textarea name="content" id="content" rows="5" cols="35" required="required"></textarea>
        </p>

        <p><input type="submit" name="add_submit" value="Add" /></p>
    </form>

<?php require 'inc/footer.php' ?>