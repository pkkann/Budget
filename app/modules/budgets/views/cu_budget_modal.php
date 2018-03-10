<?php
$content = '';
$content .= '<form class="ui form" id="cu_budget_form" method="post" action="">';
	$content .= '<input type="hidden" name="id">';
	$content .= '<div class="field">';
		$content .= '<label>Navn</label>';
		$content .= '<input type="text" name="name" value="">';
	$content .= '</div>';
$content .= '</form>';

$this->insert("layouts::modal", [
	'id' => "cu_budget_modal", 
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
$('#cu_budget_modal').modal({
	closable : false
});

$("#cu_budget_modal #cu_budget_form").ajaxForm({
    success: function(e) {
        if(e.error) {
			console.error(e);
		} else {
			$('#cu_budget_modal').modal("hide");
			loadTable();
		}
		$("#cu_budget_modal .ui.button").removeAttr("disabled");
    }
});

$("#cu_budget_modal #closebtn").click(function() {
	$('#cu_budget_modal').modal("hide");
});

$("#cu_budget_modal #delbtn").click(function() {
	if(confirm("Er du sikker?")) {
		$("#cu_budget_modal .ui.button").attr("disabled", "true");
		$("#cu_budget_modal #delbtn").addClass("loading");
		$.get("?module=budgets&action=delete_budget&id="+$("#cu_budget_modal #cu_budget_form input[name=id]").val(), function(e) {
			if(e.error) {
				console.error(e);
			} else {
				$('#cu_budget_modal').modal("hide");
				loadTable();
			}
		});
	}
});

$("#cu_budget_modal #submitbtn").click(function() {
	$("#cu_budget_modal #cu_budget_form").submit();
});

$("#cu_budget_modal #cu_budget_form").submit(function(event) {
	$("#cu_budget_modal .ui.button").attr("disabled", "true");
	$("#cu_budget_modal #submitbtn").addClass("loading");
});

function clean()
{
	$("#cu_budget_modal input[name=id]").val("");
	$("#cu_budget_modal input[name=name]").val("");
	$("#cu_budget_modal .ui.button").removeAttr("disabled");
	$("#cu_budget_modal #delbtn").removeClass("loading");
	$("#cu_budget_modal #submitbtn").removeClass("loading");
}

function showCreateModal()
{
	clean();
	$("#cu_budget_modal #modal_title").html("Nyt budget");
	$("#cu_budget_modal #submitbtn").html("Opret");
	$("#cu_budget_modal #delbtn").hide();
	$("#cu_budget_modal #cu_budget_form").attr("action", "?module=budgets&action=create_budget");
	$('#cu_budget_modal').modal("show");
}

function showUpdateModal(id)
{
	$.get("?module=budgets&action=get_budget&id="+id, function(response) {
		clean();
		$("#cu_budget_modal #modal_title").html("Rediger budget");
		$("#cu_budget_modal #submitbtn").html("Gem");
		$("#cu_budget_modal #delbtn").show();
		$("#cu_budget_modal #cu_budget_form").attr("action", "?module=budgets&action=update_budget");
		$("#cu_budget_modal input[name=id]").val(id);
		$("#cu_budget_modal input[name=name]").val(response.name);
		
		$('#cu_budget_modal').modal("show");
	});
}
</script>