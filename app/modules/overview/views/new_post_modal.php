<?php 
$content = '';
$content .= '<form class="ui form" id="newpostform" method="post" action="?module=overview&action=createpost">';
	$content .= '<div class="field">';
		$content .= '<label>Navn</label>';
		$content .= '<input type="text" name="name" value="">';
	$content .= '</div>';
	$content .= '<div class="field">';
		$content .= '<label>Type</label>';
		$content .= '<select class="ui dropdown" name="type">';
		foreach($posttypes as $key => $type) {
			$content .= '<option value="'.$key.'">'.$type.'</option>';
		}
		$content .= '</select>';
	$content .= '</div>';
$content .= '</form>';

$actions = array(
	'<div class="ui left floated cancel button">Annuller</div>',
	'<div class="ui green button" id="createBTN">Tilføj</div>'
);

$options = array(
	'size' => "tiny"
);

$this->insert("layouts::modal", [
	'id' => "newpostmodal", 
	'title' => "Ny post", 
	'content' => $content, 
	'actions' => $actions, 
	'options' => $options
]); 
?>

<script>
$('#newpostmodal').modal();

function openNewPost() {
	$('#newpostmodal').modal('show');
	$("#newpostmodal #newpostform input[name=name]").val("");
	$('#newpostmodal #newpostform .dropdown').dropdown('restore defaults');
	$("#newpostmodal #createBTN").removeClass("loading");
}

$("#newpostmodal #createBTN").click(function() {
	$("#newpostmodal #newpostform").submit();
});

$("#newpostmodal #newpostform").submit(function() {
    $("#newpostmodal #createBTN").addClass("loading");
});

$("#newpostmodal #newpostform").ajaxForm({
    success: function(e) {
        if(e.error) {
			console.error(e);
		} else {
			$('#newpostmodal').modal('hide');
			load();
		}
    }
});
</script>