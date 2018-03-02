<?php $this->layout('layouts::main') ?>

<style>
#users-wrap {
	
}
	#users-wrap .table tbody tr {
		cursor: pointer;
	}
</style>

<div id="users-wrap">
	<div class="ui segment">
		<h2>Brugere</h2>
		<button class="green ui button" onclick="openNew()">Ny</button>
		<table class="ui inverted selectable table">
			<thead>
				<tr>
					<th>Navn</th>
					<th>Brugernavn</th>
					<th>E-mail</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($users AS $user): ?>
				<tr onclick="openEdit(<?= $this->e($this->objPHPToJS($user)) ?>)">
					<td><?= $user->name ?></td>
					<td><?= $user->username ?></td>
					<td></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<!-- New user modal -->
<div class="ui tiny modal" id="newModal">
	<div class="header">
		Ny bruger
	</div>
	<div class="content">
		<form class="ui form" id="userform" method="post" action="<?= $this->e($this->action("users", "create")) ?>">
			<div class="field">
				<label>Navn</label>
				<input type="text" name="name" value="">
			</div>
			<div class="field">
				<label>Brugernavn</label>
				<input type="text" name="username" value="">
			</div>
			<div class="field">
				<label>Adgangskode</label>
				<input type="password" name="pass" value="">
			</div>
			<div class="field">
				<label>Gentag adgangskode</label>
				<input type="password" name="pass2" value="">
			</div>
		</form>
	</div>
	<div class="actions">
		<div class="ui left floated cancel button">Annuller</div>
		<div class="ui green button">Opret</div>
	</div>
</div>

<!-- Edit user modal -->
<div class="ui tiny modal" id="editModal">
	<div class="header">
		Rediger bruger
	</div>
	<div class="content">
		<form class="ui form" id="userform" method="post" action="<?= $this->e($this->action("users", "save")) ?>">
			<input type="hidden" name="id" value="">
			<div class="field">
				<label>Navn</label>
				<input type="text" name="name" value="">
			</div>
			<div class="field">
				<label>Brugernavn</label>
				<input type="text" disabled name="username" value="">
			</div>
		</form>
	</div>
	<div class="actions">
		<div class="ui left floated cancel button">Annuller</div>
		<div class="ui red button">Slet</div>
		<div class="ui orange button">Skift adgangskode</div>
		<div class="ui green button">Gem</div>
	</div>
</div>

<script>
function openNew() {
	$('#newModal').modal('show');
}
function openEdit( user ) {
	$('#editModal #userform input[name=id]').val(user.id);
	$('#editModal #userform input[name=name]').val(user.name);
	$('#editModal #userform input[name=username]').val(user.username);
	
	$('#editModal').modal('show');
}

$('#newModal').modal();
$('#editModal').modal();
</script>