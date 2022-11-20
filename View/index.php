<?php


?>
<?php require 'inc/header.php' ?>

<?php if (empty($this->oPosts)): ?>
    <p class="bold">There is no Blog Post.</p>
    <p><button type="button" onclick="window.location='<?=ROOT_URL?>?p=blog&amp;a=add'" class="bold">Add Your First Blog Post!</button></p>
<?php else: ?>

    <?php foreach ($this->oPosts as $oPost): ?>
        <h1><a href="<?=ROOT_URL?>?p=blog&amp;a=post&amp;id=<?=$oPost->id?>"><?=htmlspecialchars($oPost->title)?></a></h1>

        <p><?=nl2br(htmlspecialchars(mb_strimwidth($oPost->content, 0, 100, '...')))?></p>
        <p><a href="<?=ROOT_URL?>?p=blog&amp;a=post&amp;id=<?=$oPost->id?>">Detail this post?</a></p>
        <p class="left small italic">Posted on <?=$oPost->created_at?></p>

        <?php require 'inc/buttons.php' ?>
        <hr class="clear" /><br />
    <?php endforeach ?>

<?php endif ?>

<?php require 'inc/footer.php' ?>