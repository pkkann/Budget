<?php $this->layout('layouts::main') ?>

<div class="ui segment">
    
	<div class="ui form">
		<div class="field" style="width: 200px;">
			<label>Budget</label>
			<select class="ui dropdown" id="yearselect">
			<?php foreach($budgets as $budget): ?>
				<option value="<?= $budget->id ?>"><?= $budget->year ?></option>
			<?php endforeach; ?>
			</select>
		</div>
	</div>
	
	<h3>Udgifter</h3>
	<table class="ui red celled table budgettable">
		<thead>
			<tr>
				<th></th>
				<?php foreach($months as $month): ?>
				<th><?= $month ?></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
	
</div>



<style>
.budgettable tr th, .budgettable tr td {
	width: 100px;
}
</style>

<script>
$("#yearselect").change(function() {
	showLoading();
	loadPosts();
});
function loadPosts()
{
	$budget_id = $("#yearselect").val();
	
	
}
loadPosts();
</script>