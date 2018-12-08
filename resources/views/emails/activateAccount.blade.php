<style>
    .header{
        font-size: 40px;
        text-transform: uppercase;
        color: #fff;
        margin-bottom: 50px;
    }
    .main-wrapper{
        text-align: center;
        border: 2px solid #fff;
        background: #ccc7c7;
        box-shadow: 0px 16px 35px -6px #000;
        padding: 22px;
    }
    .heading{
        padding: 20px;
        min-height: 52px;
    }

</style>

<div style="width: 700px; height: 400px; text-align: center">
    <div class="heading">
        <div style="width: 50%;text-align: left; float: left;">
            <img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/img/logo.png" width="70"/>
        </div>
        <div style="width:50%; text-align: right; float: left;">
            <?php echo date('Y-m-d H:i:s'); ?>
        </div>
    </div>
    <div class="main-wrapper">
        <div class="header">
            Witaj <?php echo $user->getUsername(); ?>
        </div>
        <div >
            <h2>Aby uzyskać pełny dostęp do konta oraz je aktywowac kliknij w link poniżej</h2>
            <a href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/users/activateAccount?email=<?php echo $user->getEmail(); ?>&_token=<?php echo $user->getToken(); ?>&activate=1">Aktuwuj konto</a>
        </div>
    </div>
</div>