<div class="admin__edit">
    <?php echo '<h1 class="admin__votes__title">Editace žákovských účtů</h1>';
    require(__DIR__ . '/../actions/connectDB.php');
    $res = $mysqli->query("SELECT * FROM chc_users where type = 1 OR type = 2");
    $class = array(1 => "1. VMA", 2 => "1. GD", 3 => "1. MT", 4 => "2. VMA", 5 => "2. GD", 6 => "2. MT", 7 => "3. VMA", 8 => "3. GD", 9 => "3. MT", 10 => "4. VMA", 11 => "4. GD", 12 => "4. MT");
    include(__DIR__ . '/../actions/loginStatus.php');
    ?>
    <div class="accordion" id="users">
        <?php while ($item = $res->fetch_assoc()):
                $group = (isset($class[$item["groupID"]]) ? $class[$item["groupID"]] : "Učitel");
            ?>
        <div class="card">
            <div class="card-header" id="heading-<?php echo $item['id'] ?>">
                <div class="row">
                    <div class="col-md-4">
                        <h2>
                            <?php echo $item["name"]; ?>
                        </h2>
                    </div>
                    <div class="col-md-4">
                        <span class="trida">
                            <?php echo $group ?></span>
                    </div>
                    <div class="col-md-4">
                        <button class="card-header__btn" type="button" data-toggle="collapse" data-target="#user-<?php echo $item['id'] ?>" aria-expanded="true" aria-controls="user-<?php echo $item['id'] ?>">
                            Upravit
                        </button>
                    </div>
                </div>
            </div>

            <div id="user-<?php echo $item['id'] ?>" class="collapse" aria-labelledby="heading-<?php echo $item['id'] ?>" data-parent="#user-<?php echo $item['id'] ?>">
                <div class="card-body">
                    <form class="edit__form">
                        <div class="row">
                            <div class="input-group mb-3 col-lg-4 col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="username" autocomplete="username" class="form-control login__username" placeholder="Uživatelské jméno" aria-label="Uživatelské jméno" aria-describedby="login_username" value="<?php echo $item['name'] ?>" required="required">
                            </div>
                            <?php if(isset($class[$item["groupID"]])): ?>
                            <div class="input-group mb-3 col-lg-4 col-md-12">
                                <div class="input-group mb-3 groupidcontainer">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-bars"></i></span>
                                    </div>
                                    <select name="groupid" class="form-control register__select">
                                        <?php foreach ($class as $label):
                                                $key = array_search($label, $class);
                                                ?>
                                        <option value="<?php echo $key ?>" <?php if ($item["groupID"]==$key) echo "selected='selected'" ?>>
                                            <?php echo $label ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="input-group mb-3 col-lg-4 col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" name="password" autocomplete="current-password" class="form-control login__password" placeholder="Nové heslo" aria-label="Nové heslo" aria-describedby="login_password">
                            </div>
                            <input type="hidden" value="<?php echo $item['id'] ?>" name="userId">
                            <div class="input-group col-md-12 send">
                                <span class="card-header__btn card-header__btn__delete" data-user-id="<?php echo $item['id'] ?>">
                                    Smazat
                                </span>
                                <button class="card-header__btn" type="submit" name="submitButton">
                                    Odeslat
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>
<script type="text/javascript">
    window.onload = function()
    {
        let request;
        $(".edit__form").submit(function(event)
        {
            event.preventDefault();
            if (request)
            {
                request.abort();
            }
            let $form = $(this);
            let $inputs = $form.find("input, button");
            let serializedData = $form.serialize();
            $inputs.prop("disabled", true);
            request = $.ajax(
            {
                url: "../actions/setEditUser.php",
                type: "post",
                data: serializedData
            });
            request.done(function(response, textStatus, jqXHR)
            {
                switch (response)
                {
                    case "1":
                        window.location.reload();
                        break;
                    default:
                        showMessage("Vyskytla se neznámá chyba", "red");
                        break;
                }
            });
            request.fail(function()
            {
                showMessage("Vyskytla se neznámá chyba. Prosím, kontaktujte správce", "red");
            });
            request.always(function()
            {
                $inputs.prop("disabled", false);
            });
        });
        $(".card-header__btn__delete").click(function()
        {
            if (request)
            {
                request.abort();
            }
            let id = $(this).attr("data-user-id");
            console.log(id);
            request = $.ajax(
            {
                url: "../actions/deleteUser.php",
                type: "post",
                data:
                {
                    'delete': id,
                }
            });
            request.done(function(response, textStatus, jqXHR)
            {
                console.log(response);
                switch (response)
                {
                    case "1":
                        window.location.reload();
                        break;
                    default:
                        showMessage("Vyskytla se neznámá chyba", "red");
                        break;
                }
            });
            request.fail(function()
            {
                showMessage("Vyskytla se neznámá chyba. Prosím, kontaktujte správce", "red");
            });
        });
    }
</script>