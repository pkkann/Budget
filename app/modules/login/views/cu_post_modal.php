<?php
$content = '';
$content .= '<form class="ui form" id="cu_post_form" method="post" action="">';
	$content .= '<input type="hidden" name="id">';
	$content .= '<div class="field">';
		$content .= '<label>Navn</label>';
		$content .= '<input type="text" name="name" value="">';
	$content .= '</div>';
	$content .= '<div class="field">';
		$content .= '<label>Type</label>';
		$content .= '<select class="ui dropdown" name="type">';
		foreach($types as $key => $type) {
			$content .= '<option value="'.$key.'">'.$type.'</option>';
		}
		$content .= '</select>';
	$content .= '</div>';
$content .= '</form>';

$this->insert("layouts::modal", [
	'id' => "cu_post_modal", 
	'title' => '<span id="modal_title"></span>', 
	'content' => $content, 
	'actions' => array(
		'<button class="ui red right button" id="delbtn">Slet</button>',
		'<button class="ui button" type="button" id="closebtn">Annuller</button>',
		'<button class="ui green button" type="button" id="submitbtn"></button>'
    ),
	'options' => array(
		'size'	=> "tiny"
    )
]);
?>

<script>
$('#cu_post_modal').modal({
	closable : false
});

$("#cu_post_modal #cu_post_form").ajaxForm({
    success: function(e) {
		console.log(e);
        if(e.error) {
			console.error(e);
		} else {
			$('#cu_post_modal').modal("hide");
		}
		$("#cu_post_modal .ui.button").removeAttr("disabled");
    }
});

$("#cu_post_modal #closebtn").click(function() {
	$('#cu_post_modal').modal("hide");
});

$("#cu_post_modal #submitbtn").click(function() {
	$("#cu_post_modal #cu_post_form").submit();
});

$("#cu_post_modal #cu_post_form").submit(function(event) {
	$("#cu_post_modal .ui.button").attr("disabled", "true");
	$("#cu_post_modal #submitbtn").addClass("loading");
});

function showCreateModal()
{
	clean();
	$("#cu_post_modal #modal_title").html("Ny post");
	$("#cu_post_modal #submitbtn").html("Opret");
	$("#cu_post_modal #delbtn").hide();
	$("#cu_post_modal #cu_post_form").attr("action", "?module=overview&action=create_post");
	$('#cu_post_modal').modal("show");
}

function clean()
{
	$("#cu_post_modal input[name=id]").val("");
	$("#cu_post_modal input[name=name]").val("");
	$("#cu_post_modal .ui.button").removeAttr("disabled");
	$("#cu_post_modal #delbtn").removeClass("loading");
	$("#cu_post_modal #submitbtn").removeClass("loading");
}
</script>