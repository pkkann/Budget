<?php $this->layout('layouts::index') ?>

<style>
	body {
		background: #EEEEEE;
	}
	#content {
		
		overflow: auto;
		padding-top: 65px;
		padding-bottom: 25px;
	}
</style>
<div id="top" class="ui top fixed menu">
    <div class="ui container">
		<a class="item" href="?module=budgets&action=index_view">
			Budgetter
		</a>
		<div class="menu right">
			<div class="item">
				<select class="ui dropdown">
				</select>
			</div>
			<div class="item">
				<button class="ui button">Budgetter</button>
			</div>
		</div>
    </div>
</div>
<div id="content">
    <div class="ui container">
    <?=$this->section('content')?>
    </div>
</div>

<script>
$('.ui.dropdown')
  .dropdown()
;
</script>