<?php
if(($returned['group'] != "1") && ($returned['permissions'] != "user = 1")) :
?>
<div class="container-fluid content_container p-5 ">
<div class="row">
    <div class="col-sm-6">
        <div class="card text-center">
            <div class="card-header">
                Zarządzaj użytkownikami
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-user-plus m-2 text-primary icon-admin-panel"></i>
                            <a href="index.php?admin_panel&panel=add_user" class="btn btn-primary btn-sm">Dodaj</a>
                        </div>
                        <div class="col-sm d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-user-minus m-2 text-primary icon-admin-panel"></i>
                            <a href="index.php?admin_panel&panel=delete_user" class="btn btn-primary btn-sm">Usuń</a>
                        </div>
                        <div class="col-sm d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-user-edit m-2 text-primary icon-admin-panel"></i>
                            <a href="index.php?admin_panel&panel=modify_user" class="btn btn-primary btn-sm">Modyfikuj</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted card_footer"></div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card text-center">
        <div class="card-header">
                Zarządzaj postami
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-plus m-2 text-primary icon-admin-panel"></i>
                            <a href="index.php?admin_panel&panel=add_post" class="btn btn-primary btn-sm" id="panelCollapse">Dodaj</a>
                        </div>
                        <div class="col-sm d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-minus m-2 text-primary icon-admin-panel"></i>
                            <a href="index.php?admin_panel&panel=delete_post" class="btn btn-primary btn-sm" id="panelCollapse">Usuń</a>
                        </div>
                        <div class="col-sm d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-edit m-2 text-primary icon-admin-panel"></i>
                            <a href="index.php?admin_panel&panel=modify_post" class="btn btn-primary btn-sm" id="panelCollapse">Modyfikuj</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted card_footer"></div>
        </div>
    </div>
</div>
<div class="row py-5">
    <div class="col-sm-6">
        <div class="card text-center">
            <div class="card-header">
                Zarządzaj logami
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-sign-in-alt m-2 text-primary icon-admin-panel"></i>
                            <a href="#" class="btn btn-primary btn-sm" id="panelCollapse">Historia logowania</a>
                        </div>
                        <div class="col-sm d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-history m-2 text-primary icon-admin-panel"></i>
                            <a href="#" class="btn btn-primary btn-sm" id="panelCollapse">Akcje użytkowników</a>
                        </div>
                        <div class="col-sm d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-clipboard-list m-2 text-primary icon-admin-panel"></i>
                            <a href="#" class="btn btn-primary btn-sm" id="panelCollapse">Historia wypoż/rezer</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted card_footer"></div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card text-center">
        <div class="card-header">
                Zarządzaj komunikatami
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-envelope m-2 text-primary icon-admin-panel"></i>
                            <a href="index.php?admin_panel&panel=create_notification" class="btn btn-primary btn-sm" id="panelCollapse">Wyślij</a>
                        </div>
                        <div class="col-sm d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-minus m-2 text-primary icon-admin-panel"></i>
                            <a href="index.php?admin_panel&panel=delete_notification" class="btn btn-primary btn-sm" id="panelCollapse">Usuń</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted card_footer"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="card text-center">
            <div class="card-header">
                Zarządzaj kontaktami do działów
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-plus m-2 text-primary icon-admin-panel"></i>
                            <a href="index.php?admin_panel&panel=add_contact" class="btn btn-primary btn-sm" id="panelCollapse">Dodaj</a>
                        </div>
                        <div class="col-sm d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-minus m-2 text-primary icon-admin-panel"></i>
                            <a href="index.php?admin_panel&panel=delete_contact" class="btn btn-primary btn-sm" id="panelCollapse">Usuń</a>
                        </div>
                        <div class="col-sm d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-edit m-2 text-primary icon-admin-panel"></i>
                            <a href="index.php?admin_panel&panel=modify_contact" class="btn btn-primary btn-sm" id="panelCollapse">Modyfikuj</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted card_footer"></div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card text-center">
        <div class="card-header">
                Zarządzaj zakładką "Pomoc"
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-plus m-2 text-primary icon-admin-panel"></i>
                            <a href="#" class="btn btn-primary btn-sm" id="panelCollapse">Dodaj artykuł</a>
                        </div>
                        <div class="col-sm d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-minus m-2 text-primary icon-admin-panel"></i>
                            <a href="#" class="btn btn-primary btn-sm" id="panelCollapse">Usuń artykuł</a>
                        </div>
                        <div class="col-sm d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-edit m-2 text-primary icon-admin-panel"></i>
                            <a href="#" class="btn btn-primary btn-sm" id="panelCollapse">Modyfikuj artykuł</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted card_footer"></div>
        </div>
    </div>
</div>
</div>
    <aside class="panel_container" id="panel">
        <div class="panel_outside_secion py-5" id="panelCollapse">
            <div class="col-lg h-25 d-flex justify-content-center align-items-start">
                <i class="fas fa-angle-double-left" id="arrow"></i>
            </div>
            <div class="col-lg h-50 d-flex justify-content-center align-items-center tu">
                <h4 class="rotated">
                    <?php
                        if (isset($_GET['panel'])) {
                            $panelName = $_GET['panel'];
                            $panelNameChanged = str_replace('_', ' ', $panelName);
                            echo $panelNameChanged;
                        } else {
                            echo "PANEL MODYFIKACYJNY";
                        }
                    ?>

                </h4>
            </div>
            <div class="col-lg h-25 d-flex justify-content-center align-items-end">
                <i class="fas fa-angle-double-left" id="arrow"></i>
            </div>
        </div>
        <div class="container panel_content">
        <?php
        if (isset($_GET['panel'])){
            if($_GET['panel']=='add_user') {
                include_once './src/services/add_user.php';
            }
            if($_GET['panel']=='delete_user') {
                include_once './src/services/delete_user.php';
            }
            if($_GET['panel']=='modify_user') {
                include_once './src/services/modify_user.php';
            }
            if($_GET['panel']=='add_post') {
                include_once './src/services/add_post.php';
            }
            if($_GET['panel']=='delete_post') {
                include_once './src/services/delete_post.php';
            }
            if($_GET['panel']=='modify_post') {
                include_once './src/services/modify_post.php';
            }
            if($_GET['panel']=='create_notification') {
                include_once './src/services/create_notification.php';
            }
            if($_GET['panel']=='delete_notification') {
                include_once './src/services/delete_notification.php';
            }
            if($_GET['panel']=='add_contact') {
                include_once './src/services/add_contact.php';
            }
            if($_GET['panel']=='delete_contact') {
                include_once './src/services/delete_contact.php';
            }
            if($_GET['panel']=='modify_contact') {
                include_once './src/services/modify_contact.php';
            }
        }
        ?>
        </div>
    </aside>
<?php endif ?>