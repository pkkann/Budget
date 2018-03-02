<?php $this->layout('layouts::index') ?>

<style>
.login-wrap {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: #EEEEEE;
}
    .login-wrap .login {
        width: 400px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>

<div class="login-wrap">
    <div class="ui negative message errormsg hidden">
        <div class="header">
            Der skete en fejl
        </div>
        <p></p>
    </div>
    <div class="ui segment login">
        <h2>Budget</h2>
        <form class="ui form" method="post" id="loginform" action="?module=login&action=authenticate">
            <div class="field">
                <div class="ui left icon input">
                    <input placeholder="Brugernavn" type="text" name="username">
                    <i class="users icon"></i>
                </div>
            </div>
            <div class="field">
                <div class="ui left icon input">
                    <input placeholder="Adgangskode" type="password" name="password">
                    <i class="lock icon"></i>
                </div>
            </div>

            <div class="field">
                <button class="ui button primary" style="width:100%" type="submit">Log ind</button>
            </div>
        </form>

    </div>
    <div class="login">
        <a href="mailto:hoenen@aub.dk">hoenen@aub.dk</a>
    </div>
</div>

<script>
$("#loginform input[name=username]").focus();

$("#loginform").submit(function(e) {
    $("#loginform button.primary").addClass("loading");
});

$("#loginform").ajaxForm({
    success: function(e) {
        if(e.error) {
            $("#loginform button.primary").removeClass("loading");
            $(".errormsg p").html(e.error).parent().removeClass("hidden");
			$("#loginform input[name=password]").val("").focus();
        } else {
            window.location.href = "";
        }
    }
});
</script>