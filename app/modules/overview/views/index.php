<?php $this->layout('layouts::main') ?>

<div class="ui secondary  menu">
    <div class="item">
        <button class="ui primary button">Ny post</button>
    </div>
    <div class="right menu">
        <div class="item">
            <select class="ui fluid dropdown">
            <?php foreach($budgets as $budget): ?>
                <option value="<?=$budget->id?>"><?=$budget->name?></option>
            <?php endforeach; ?>
            </select>
        </div>
        <div class="item">
            <select class="ui fluid dropdown">
            <?php foreach($years as $year): ?>
                <option value="<?=$year?>"><?=$year?></option>
            <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>