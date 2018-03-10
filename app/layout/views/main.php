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
	.table.selectable {
		cursor: pointer;
	}
</style>
<div id="top" class="ui top fixed menu">
    <div class="ui container">
		<a class="item" href="?module=overview&action=show_index">
			Oversigt
		</a>
		<a class="item" href="?module=budgets&action=show_index">
			Budgetter
		</a>
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
$('.menu .item')
  .tab()
;
$('.pop')
  .popup()
;
</script>