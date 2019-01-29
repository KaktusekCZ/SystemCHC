<div class="admin__edit">
    <?php echo '<h1 class="admin__votes__title">Editace žákovských účtů</h1>';
    require(__DIR__ . '/../actions/connectDB.php');
    $res = $mysqli->query("SELECT * FROM chc_users where type = 1");
    $class = array("1. VMA", "1. GD", "1. MT", "2. VMA", "2. GD", "2. MT", "3. VMA", "3. GD", "3. MT", "4. VMA", "4. GD", "4. MT");
    ?>
    <div class="accordion" id="users">
        <?php while ($item = $res->fetch_assoc()): ?>
            <div class="card">
                <div class="card-header" id="heading-<?php echo $item['id'] ?>">
                    <div class="row">
                        <div class="col-md-4">
                            <h2>
                                <?php echo $item["name"]; ?>
                            </h2>
                        </div>
                        <div class="col-md-4">
                            <span class="trida"><?php echo $class[$item["groupID"] - 1] ?></span>
                        </div>
                        <div class="col-md-4">
                            <button class="card-header__btn" type="button" data-toggle="collapse"
                                    data-target="#user-<?php echo $item['id'] ?>"
                                    aria-expanded="true" aria-controls="user-<?php echo $item['id'] ?>">
                                Upravit
                            </button>
                        </div>
                    </div>
                </div>

                <div id="user-<?php echo $item['id'] ?>" class="collapse"
                     aria-labelledby="heading-<?php echo $item['id'] ?>" data-parent="#user-<?php echo $item['id'] ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="input-group mb-3 col-lg-4 col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="username" autocomplete="username"
                                       class="form-control login__username" placeholder="Uživatelské jméno"
                                       aria-label="Uživatelské jméno" aria-describedby="login_username"
                                       value="<?php echo $item['name'] ?>"
                                       required="required">
                            </div>
                            <div class="input-group mb-3 col-lg-4 col-md-12">
                                <div class="input-group mb-3 groupidcontainer">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                    class="fas fa-bars"></i></span>
                                    </div>
                                    <select name="groupid" class="form-control register__select">
                                        <option value="1" <?php if($item["groupID"] == 1) echo "selected='selected'"?>>1. VMA</option>
                                        <option value="2" <?php if($item["groupID"] == 2) echo "selected='selected'"?>>1. GD</option>
                                        <option value="3" <?php if($item["groupID"] == 3) echo "selected='selected'"?>>1. MT</option>
                                        <option value="4" <?php if($item["groupID"] == 4) echo "selected='selected'"?>>2. VMA</option>
                                        <option value="5" <?php if($item["groupID"] == 5) echo "selected='selected'"?>>2. GD</option>
                                        <option value="6" <?php if($item["groupID"] == 6) echo "selected='selected'"?>>2. MT</option>
                                        <option value="7" <?php if($item["groupID"] == 7) echo "selected='selected'"?>>3. VMA</option>
                                        <option value="8" <?php if($item["groupID"] == 8) echo "selected='selected'"?>>3. GD</option>
                                        <option value="9" <?php if($item["groupID"] == 9) echo "selected='selected'"?>>3. MT</option>
                                        <option value="10" <?php if($item["groupID"] == 10) echo "selected='selected'"?>>4. VMA</option>
                                        <option value="11" <?php if($item["groupID"] == 11) echo "selected='selected'"?>>4. GD</option>
                                        <option value="12" <?php if($item["groupID"] == 12) echo "selected='selected'"?>>4. MT</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group mb-3 col-lg-4 col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" name="password" autocomplete="current-password"
                                       class="form-control login__password" placeholder="Nové heslo"
                                       aria-label="Nové heslo"
                                       aria-describedby="login_password" required="required">
                            </div>
                            <div class="input-group mb-3 col-md-12 send">
                                <button class="card-header__btn" type="button">
                                    Odeslat
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>

    </div>
</div>