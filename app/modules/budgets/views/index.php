<?php $this->layout('layouts::main') ?>

<div class="ui segment">
    
	<div class="ui secondary menu">
		<div class="item">
			<select class="ui dropdown" id="budgets">
			<?php if(count($budgets) > 0): ?>
				<?php foreach($budgets as $budget): ?>
				<option value="<?=$budget->id?>" <?= ($_SESSION['budget_id'] == $budget->id ? "selected" : "") ?>><?=$budget->name?></option>
				<?php endforeach; ?>
			<?php else: ?>
				<option value="">Ingen budgetter</option>
			<?php endif; ?>
			</select>
		</div>
		<div class="item">
			<button class="ui teal button"><i class="fa fa-cog"></i></button>
		</div>
	</div>
	
	<h3>Udgifter</h3>
	<table class="ui red celled table" id="expenses">
		<thead>
			<tr>
				<th>
					<button class="ui tiny red button"><i class="fa fa-plus"></i></button>
				</th>
				<?php foreach($months as $month): ?>
				<th><?=$month?></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
	
	<h3>Indtægter</h3>
	<table class="ui green celled table" id="income">
		<thead>
			<tr>
				<th>
					<button class="ui tiny green button"><i class="fa fa-plus"></i></button>
				</th>
				<?php foreach($months as $month): ?>
				<th><?=$month?></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
	
	<h3>Rådigheder</h3>
	<table class="ui orange celled table" id="availability">
		<thead>
			<tr>
				<th>
					<button class="ui tiny orange button"><i class="fa fa-plus"></i></button>
				</th>
				<?php foreach($months as $month): ?>
				<th><?=$month?></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
	
</div>

<style>
.ui.table tr td, .ui.table tr th {
	width: 6.666%;
}
.ui.table tr td {
	text-align: right;
}
.ui.table tr th {
	text-align: center;
}
.ui.table tr td:first-child, .ui.table tr th:first-child {
	width: 20%;
	text-align: left;
}
</style>

<script>
$("#budgets").change(function() {
	$.get("?module=budgets&action=setbudget&id="+$(this).val(), function() {
		load();
	});
});

function load() {
	// Expenses
	$.get("?module=budgets&action=getpostsjson&type=expense", function(data) {
		var html = '';
		data.forEach(function(e) {
			html += '<tr>';
				html += '<td>'+e.name+'</td>';
				for(var i = 0; i < 12; i++) {
					html += '<td></td>';
				}
			html += '</tr>';
		});
		$("#expenses tbody").html(html);
	});
	
	// Incomes
	$.get("?module=budgets&action=getpostsjson&type=income", function(data) {
		var html = '';
		data.forEach(function(e) {
			html += '<tr>';
				html += '<td>'+e.name+'</td>';
				for(var i = 0; i < 12; i++) {
					html += '<td></td>';
				}
			html += '</tr>';
		});
		$("#income tbody").html(html);
	});
}
load();
</script>