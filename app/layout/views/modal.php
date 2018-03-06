<?php
$size = "";

if( isset($options['size']) ) {
	$size = $options['size'];
}

$classes = $size;
?>

<div class="ui modal <?= $classes ?>" id="<?= $id ?>">
	<div class="header">
		<?= ( isset($title) ? $title : "" ) ?>
	</div>
	<div class="content">
		<?= ( isset($content) ? $content : "" ) ?>
	</div>
	<div class="actions">
	<?php if( isset($actions) && is_array($actions) ): ?>
	<?php foreach($actions AS $action): ?>
		<?= $action ?>
	<?php endforeach; ?>
	<?php endif; ?>
	</div>
</div>

<script>

$('#<?= $id ?>').modal();

</script>