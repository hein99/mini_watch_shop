<?php displayPageHeader('Home') ?>

<h1>Hello!</h1>

<ul>
<?php foreach( $data as $d ) : ?>
    <li><?php echo $d ?></li>
<?php endforeach; ?>
</ul>


<?php displayPageFooter() ?>