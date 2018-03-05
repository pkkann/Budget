<?php $this->layout('layouts::main') ?>

<div class="ui segment">
    
	<div class="ui secondary  menu">
		<div class="item">
			<select class="ui dropdown">
			<?php if(count($budgets)): ?>
			<?php foreach($budgets as $budget): ?>
				<option value="<?= $budget->id ?>"><?= $budget->name ?></option>
			<?php endforeach; ?>
			<?php else: ?>
				<option value="">Ingen budgetter</option>
			<?php endif; ?>
			</select>
		</div>
		<div class="item">
			<button class="ui button" onclick="window.location.href='?module=budgets&action=newbudget_view'">Nyt budget</button>
		</div>
		<div class="right menu">
			<div class="item">
				<button class="ui teal button"><i class="fa fa-cog"></i></button>
			</div>
		</div>
	</div>
	
</div>

<script>

</script>