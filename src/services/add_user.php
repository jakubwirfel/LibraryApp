<div id="add_user">
    <form action="index.php?admin_panel=1" method="POST">
    <div class="form-group row">
        <label for="inputUsername" class="col-sm-3 col-form-label">Nazwa użytkownika</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" id="inputUsername" placeholder="Nazwa użytkownika">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword" class="col-sm-3 col-form-label">Hasło</label>
        <div class="col-sm-9">
        <input type="password" class="form-control" id="inputPassword" placeholder="Hasło">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword2" class="col-sm-3 col-form-label"></label>
        <div class="col-sm-9">
        <input type="password" class="form-control" id="inputPassword2" placeholder="Powtórz hasło">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-9">
        <input type="email" class="form-control" id="inputEmail" placeholder="Email">
        </div>
    </div>
    <div class="form-group form-check">
    <input type="checkbox" class="form-check-input " id="PwdChange">
    <label class="form-check-label checkbox" for="PwdChange">Użytkownik musi zmienić hasło przy logowaniu</label>
  </div>
    <fieldset class="form-group">
        <div class="row">
        <legend class="col-form-label col-sm-3 pt-0">Grupa </legend>
        <div class="col-sm-9">
            <div class="form-check">
            <input class="form-check-input" type="radio" name="gridRadios" id="standard" value="1" checked>
            <label class="form-check-label" for="standard">
                Użytkownik standardowy
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="gridRadios" id="moderator" value="2">
            <label class="form-check-label" for="moderator">
                Moderator
            </label>
            </div>
            <div class="form-check disabled">
            <input class="form-check-input" type="radio" name="gridRadios" id="admin" value="3">
            <label class="form-check-label" for="admin">
                Administrator
            </label>
            </div>
        </div>
        </div>
    </fieldset>
    <div class="form-group row">
        <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">Utwórz</button>
        </div>
    </div>
    </form>
</div>