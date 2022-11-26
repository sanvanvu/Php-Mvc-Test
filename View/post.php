<?php

?>
<?php require 'inc/header.php' ?>

<?php if (empty($this->oPost)): ?>
    <p class="error">The post can't be be found!</p>
<?php else: ?>

    <article>
        <time datetime="<?=$this->oPost->created_at?>" ></time>

        <h1><?=htmlspecialchars($this->oPost->title)?></h1>
        <p><?=nl2br(htmlspecialchars($this->oPost->content))?></p>
        <p class="left small italic">Posted on <?=$this->oPost->created_at?></p>

        <?php
        $oPost = $this->oPost;
        require 'inc/buttons.php';
        ?>
    </article>

<?php endif ?>

<?php require 'inc/footer.php' ?>