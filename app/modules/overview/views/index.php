<?php $this->layout('layouts::main') ?>

<div class="ui secondary  menu">
    <div class="item">
        <button class="ui primary button" onclick="showCreateModal()">Ny post</button>
    </div>
    <div class="right menu">
        <div class="item">
            <select class="ui dropdown">
            <?php foreach($budgets as $budget): ?>
                <option value="<?=$budget->id?>" <?=($budget->id == $_SESSION['budget_id'] ? "selected" : "")?>><?=$budget->name?></option>
            <?php endforeach; ?>
            </select>
        </div>
        <div class="item">
            <select class="ui dropdown">
            <?php foreach($months as $key => $month): ?>
                <option value="<?=$key?>" <?=($key == $_SESSION['month'] ? "selected" : "")?>><?=$month?></option>
            <?php endforeach; ?>
            </select>
        </div>
        <div class="item">
            <select class="ui fluid dropdown">
            <?php foreach($years as $year): ?>
                <option value="<?=$year?>" <?=($year == $_SESSION['year'] ? "selected" : "")?>><?=$year?></option>
            <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>

<h3>Udgifter</h3>
<table class="ui red celled selectable table" id="table">
    <thead>
        <tr>
            <th>Post</th>
            <th>Estimeret</th>
            <th>Faktisk</th>
        </tr>
    </thead>
    <tbody>
    
    </tbody>
    <tfoot>
    </tfoot>
</table>

<h3>Indtægter</h3>
<table class="ui green celled selectable table" id="table">
    <thead>
        <tr>
            <th>Post</th>
            <th>Estimeret</th>
            <th>Faktisk</th>
        </tr>
    </thead>
    <tbody>
    
    </tbody>
    <tfoot>
    </tfoot>
</table>

<h3>Rådigheder</h3>
<table class="ui orange celled selectable table" id="table">
    <thead>
        <tr>
            <th>Post</th>
            <th>Estimeret</th>
            <th>Faktisk</th>
        </tr>
    </thead>
    <tbody>
    
    </tbody>
    <tfoot>
    </tfoot>
</table>

<?php $this->insert("views::cu_post_modal", ['types' => $posttypes]) ?>