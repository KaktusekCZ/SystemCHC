<div class="admin__bar">
    <div class="admin__bar__status">
        <?php echo '<div class="admin__bar__item admin__bar__item--type"><span class="header"><i class="fas fa-user"></i> Typ účtu</span>'.getAccountType($accRow["type"]).'</div>'?>
        <?php if($accRow["type"] == 1) : ?>
            <?php echo'<div class="admin__bar__item admin__bar__item--grade"><span class="header"><i class="fas fa-users"></i> Třída</span>'.getAccountGrade($groupRow).'</div>'?>
        <?php endif; ?>
        <?php echo'<div class="admin__bar__item admin__bar__item--name"><span class="header"><i class="fas fa-user"></i> Přihlášen</span><span class="name">'.$accRow["name"].'</span></div>'?>
        <div class="admin__bar__item admin__bar__item--logout js-admin-logout">Odhlásit se <i class="fas fa-sign-out-alt"></i></div>
    </div>
</div>
