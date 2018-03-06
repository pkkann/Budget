<?php 
$content = '
<form class="ui form" id="newpostform" method="post" action="">
	<div class="field">
		<label>Navn</label>
		<input type="text" name="name" value="">
	</div>
	<div class="field">
		<label>Type</label>
		<select class="ui dropdown" name="type">
			<option value="expense">Udgift</option>
			<option value="income">Indtægt</option>
		</select>
	</div>
</form>
';

$actions = array(
	'<div class="ui left floated cancel button">Annuller</div>',
	'<div class="ui green button" id="createBTN">Tilføj</div>'
);

$options = array(
	'size' => "tiny"
);

$this->insert("layouts::modal", [
	'id' => "newpostform", 
	'title' => "Ny post", 
	'content' => $content, 
	'actions' => $actions, 
	'options' => $options
]); 
?>

<script>
$('#newpostform').modal();

function openNewPost() {
	$('#newpostform').modal('show');
	$("#newpostform input[name=name]").val("");
	$('#newpostform .dropdown').dropdown('restore defaults');
}
</script>