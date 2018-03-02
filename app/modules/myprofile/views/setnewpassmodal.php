<div class="ui mini modal" id="setPassModal">
	<div class="header">
		Set ny adgangskode
	</div>
	<div class="content">
		<form class="ui form" id="resetpassform" method="post" action="<?= $this->e($this->action("myprofile", "savenewpass")) ?>">
			<div class="field">
				<label>Adgangskode</label>
				<input type="password" name="pass">
			</div>
			<div class="field">
				<label>Gentag adgangskode</label>
				<input type="password" name="pass2">
			</div>
		</form>
	</div>
	<div class="actions">
		<button class="ui button" id="cancelBTN">Annuller</button>
		<button class="ui button primary" onclick="$('#resetpassform').submit()">Gem</button>
	</div>
</div>

<script>
$('#setPassModal').modal();

function openSetPassModal() {
	$("#resetpassform input[name=pass]").val("");
	$("#resetpassform input[name=pass2]").val("");
	$("#setPassModal").modal('show');
}

$("#setPassModal #cancelBTN").click(function() {
	$("#setPassModal").modal('hide');
});

$("#resetpassform").submit(function() {
    $("#setPassModal button.primary").addClass("loading");
});

$("#resetpassform").ajaxForm({
    success: function(e) {
        if(e.error) {
			$("#setPassModal button.primary").removeClass("loading");
			toast(e.error, {color: "danger"})
		} else {
			$("#setPassModal button.primary").removeClass("loading");
			$("#setPassModal").modal('hide');
			toast("Din nye adgangskode blev gemt", {color: "success"})
		}
    }
});
</script>