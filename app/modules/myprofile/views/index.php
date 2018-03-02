<?php $this->layout('layouts::main') ?>

<style>
#myprofile-wrap {
	width: 400px;
	margin: 0 auto;
}
</style>

<div id="myprofile-wrap">
	<div class="ui segment">
		<h2>Min profil</h2>
		<form class="ui form" id="myprofileform" method="post" action="<?= $this->e($this->action("myprofile", "save")) ?>">
			<div class="field">
				<label>Navn</label>
				<input type="text" name="name" value="<?= $this->e($profile->name) ?>">
			</div>
			<div class="field">
				<label>Brugernavn</label>
				<input type="text" disabled name="username" value="<?= $this->e($profile->username) ?>">
			</div>
			<button type="submit" class="ui button primary" tabindex="0">Gem</button>
			<button type="button" id="setPassBTN" class="ui button" tabindex="0" onclick="openSetPassModal()">Set ny adgangskode</button>
		</form>
	</div>
</div>

<?php $this->insert("views::setnewpassmodal") ?>

<script>
$("#myprofileform").submit(function() {
    $("#myprofileform button.primary").addClass("loading");
});

$("#myprofileform").ajaxForm({
    success: function(e) {
        if(e.error) {
			$("#myprofileform button.primary").removeClass("loading");
			toast(e.error, {color: "danger"})
		} else {
			$("#myprofileform button.primary").removeClass("loading");
			toast("Din profil blev gemt", {color: "success"})
		}
    }
});
</script>