<?php
$content = '';
$content .= '<form class="ui form" id="cu_form" method="post" action="">';
	$content .= '<input type="hidden" name="id">';
	$content .= '<div class="field">';
		$content .= '<label>Navn</label>';
		$content .= '<input type="text" name="name" value="">';
	$content .= '</div>';
$content .= '</form>';

$this->insert("layouts::modal", [
	'id' => "cu_modal", 
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
$('#cu_modal').modal({
	closable : false
});

$("#cu_modal #cu_form").ajaxForm({
    success: function(e) {
        if(e.error) {
			console.error(e);
		} else {
			$('#cu_modal').modal("hide");
			loadTable();
		}
		$("#cu_modal .ui.button").removeAttr("disabled");
    }
});

$("#cu_modal #closebtn").click(function() {
	$('#cu_modal').modal("hide");
});

$("#cu_modal #delbtn").click(function() {
	if(confirm("Er du sikker?")) {
		$("#cu_modal .ui.button").attr("disabled", "true");
		$("#cu_modal #delbtn").addClass("loading");
		$.get("?module=budgets&action=delete_budget&id="+$("#cu_modal #cu_form input[name=id]").val(), function(e) {
			if(e.error) {
				console.error(e);
			} else {
				$('#cu_modal').modal("hide");
				loadTable();
			}
		});
	}
});

function clean()
{
	$("#cu_modal input[name=id]").val("");
	$("#cu_modal input[name=name]").val("");
	$("#cu_modal .ui.button").removeAttr("disabled");
	$("#cu_modal #delbtn").removeClass("loading");
	$("#cu_modal #submitbtn").removeClass("loading");
}

function showCreateModal()
{
	clean();
	$("#cu_modal #modal_title").html("Nyt budget");
	$("#cu_modal #submitbtn").html("Opret");
	$("#cu_modal #delbtn").hide();
	$("#cu_modal #cu_form").attr("action", "?module=budgets&action=create_budget");
	$('#cu_modal').modal("show");
}

function showUpdateModal(id)
{
	$.get("?module=budgets&action=get_budget&id="+id, function(response) {
		clean();
		$("#cu_modal #modal_title").html("Rediger budget");
		$("#cu_modal #submitbtn").html("Gem");
		$("#cu_modal #delbtn").show();
		$("#cu_modal #cu_form").attr("action", "?module=budgets&action=update_budget");
		$("#cu_modal input[name=id]").val(id);
		$("#cu_modal input[name=name]").val(response.name);
		
		$('#cu_modal').modal("show");
	});
}

$("#cu_modal #submitbtn").click(function() {
	$("#cu_modal #cu_form").submit();
});

$("#cu_modal #cu_form").submit(function(event) {
	$("#cu_modal .ui.button").attr("disabled", "true");
	$("#cu_modal #submitbtn").addClass("loading");
});
</script>