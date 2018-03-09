<?php $this->layout('layouts::main') ?>

<div class="ui segment">

	<div class="ui secondary menu">
		<div class="item">
			<button class="ui tiny primary button pop" data-content="Ny post" onclick="openNewPost()"><i class="fa fa-plus"></i></button>
		</div>
		<div class="item">
			<button id="unlockeditbtn" class="ui tiny orange button pop" data-content="Lås op for redigering" onclick="unlockEdit()"><i class="fa fa-lock"></i></button>
			<button id="lockeditbtn" style="display:none" class="ui tiny red button pop" data-content="Lås redigering" onclick="lockEdit()"><i class="fa fa-unlock"></i></button>
		</div>
		<div class="menu right">
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
				<select class="ui fluid dropdown" id="budgets">
				<?php foreach($years as $year): ?>
					<option value="<?=$year?>"><?=$year?></option>
				<?php endforeach; ?>
				</select>
			</div>
		</div>
	</div>
	
	<h3>Udgifter</h3>
	<table class="ui red compact celled table" id="expenses">
		<thead>
			<tr>
				<th>
					<!--<button class="ui tiny button pop" data-content="Ny udgift"><i class="fa fa-plus"></i></button>-->
				</th>
				<?php foreach($months as $month): ?>
				<th><?=$month?></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
		</tfoot>
	</table>
	
	<h3>Indtægter</h3>
	<table class="ui green compact celled table" id="income">
		<thead>
			<tr>
				<th>
					<!--<button class="ui tiny button pop" data-content="Ny indtægt"><i class="fa fa-plus"></i></button>-->
				</th>
				<?php foreach($months as $month): ?>
				<th><?=$month?></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
		</tfoot>
	</table>
	
	<h3>Rådigheder</h3>
	<table class="ui orange compact celled table" id="disposables">
		<thead>
			<tr>
				<th>
					<!--<button class="ui tiny button pop" data-content="Ny rådigheds visning"><i class="fa fa-plus"></i></button>-->
				</th>
				<?php foreach($months as $month): ?>
				<th><?=$month?></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
		</tfoot>
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
.ui.table tfoot th {
	text-align: right;
}
.ui.table tfoot th:first-child {
	text-align: left;
}
</style>

<script>
$("#budgets").change(function() {
	$.get("?module=overview&action=setbudget&id="+$(this).val(), function() {
		load();
	});
});

function unlockEdit() {
	$("#unlockeditbtn").hide();
	$("#lockeditbtn").show();
	$(".delbtn").show();
	$(".noneeditcell").hide();
	$(".editcell").show();
}

function lockEdit() {
	$("#unlockeditbtn").show();
	$("#lockeditbtn").hide();
	$(".delbtn").hide();
}

function load() {
	loadTable("expenses", "expense", true, function() {
		loadTable("income", "income", true, function() {
			loadTable("disposables", "disposable", true);
		});
	});
}

function loadTable(id, type, showTotal, callback) {
	$.get("?module=overview&action=getpostsjson&type="+type, function(data) {
		var html = '';
		data.posts.forEach(function(e) {
			html += '<tr>';
				html += '<td><button class="ui mini red button delbtn" style="display:none;margin-right:5px"><i class="fa fa-times"></i></button>'+e.name+'</td>';
				for(var i = 1; i <= 12; i++) {
					var value = ( typeof e.values[i] != 'undefined' ? e.values[i].value : "-" );
					html += '<td>';
						html += '<span class="">'+value+'</span>';
					html += '</td>';
				}
			html += '</tr>';
		});
		$("#"+id+" tbody").html(html);
		
		if(typeof showTotal != 'undefined' && showTotal == true) {
			var html = '';
			html += '<tr>';
				html += '<th><b>Total</b></th>';
				for(var i = 1; i <= 12; i++) {
					var value = ( typeof data.total[i]!= 'undefined' ? data.total[i] : "-" );
					html += '<th><b>'+value+'</b></th>';
				}
			html += '</tr>';
			$("#"+id+" tfoot").html(html);
		}
		
		if(typeof callback != 'undefined' && typeof callback == 'function') {
			callback();
		}
	});
}

load();
</script>

<?php $this->insert("views::new_post_modal", array('posttypes' => $posttypes)) ?>