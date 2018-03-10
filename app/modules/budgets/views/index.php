<?php $this->layout('layouts::main') ?>

<div class="ui icon message">
    <i class="edit icon"></i>
    <div class="content">
        <div class="header">
            Rediger?
        </div>
        <p>Klik på et budget for at redigere</p>
    </div>
</div>
<div class="ui secondary  menu">
    <div class="item">
    <button class="ui primary button" onclick="showCreateModal()">Nyt budget</button>
    </div>
</div>
<table class="ui celled selectable table" id="table">
    <thead>
        <tr>
            <th>Navn</th>
            <th style="width:30%">Oprettet</th>
        </tr>
    </thead>
    <tbody>
    
    </tbody>
</table>

<script>
loadTable();
function loadTable()
{
    $.get("?module=budgets&action=get_budgets", function(response) {
        var html = '';
        response.forEach(function(el) {
            html += '<tr onclick="showUpdateModal('+el.id+')">';
                html += '<td>'+el.name+'</td>';
                html += '<td>'+el.created+'</td>';
            html += '</tr>';
        });
        $("#table tbody").html(html);
    });
}
</script>

<?php $this->insert("views::cu_budget_modal") ?>