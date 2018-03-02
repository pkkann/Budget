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
        <a class="item <?=$this->e($this->menuActive("dashboard", "index"))?>" href="<?=$this->e($this->action("dashboard", "index"))?>">
			Dashboard
		</a>
		<a class="item <?=$this->e($this->menuActive("users", "index"))?>" href="<?=$this->e($this->action("users", "index"))?>">
			Brugere
		</a>
        <div class="right menu">
            <div class="ui dropdown item">
                <div class="text"><i class="user circle icon"></i> Min profil</div>
                <i class="dropdown icon"></i>
                <div class="menu">
					<a class="item <?=$this->e($this->menuActive("myprofile", "index"))?>" href="<?=$this->e($this->action("myprofile", "index"))?>">Rediger min profil</a>
					<div class="divider"></div>
                    <a class="item" href="<?=$this->e($this->action("login", "deauthenticate"))?>">Log ud</a>
                </div>
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