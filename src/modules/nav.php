<nav class="vertical-nav bg-white" id="sidebar">
        <div class="py-4 px-3 mb-4 bg-light">
            <div class="media d-flex align-items-center"><img src="https://icons-for-free.com/iconfiles/png/512/bookshelf+library+icon-1320087270870761354.png" alt="logo" width="65" class="mr-3 rounded-circle img-thumbnail shadow">
                <div class="media-body">
                    <h4 class="m-0">Biblioteka Główna Toruń</h4>
                </div>
            </div>
        </div>
        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Użytkownik: <span class="text-primary"><?php echo $returned['user_name']?></span></p>
        <ul class="nav flex-column bg-white mb-3">
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fas fa-user mr-3 text-primary fa-fw"></i>
                    Informacje o użytkowniku
                </a>
            </li>
<?php if (($returned['group'] == 1) && ($returned['permissions'] == "user = 1")) :?>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fas fa-book-open mr-3 text-primary fa-fw"></i>
                    Wypożyczenia
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fas fa-bookmark mr-3 text-primary fa-fw"></i>
                    Rezerwacje
                </a>
            </li>
<?php endif ?>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fas fa-exclamation-circle mr-3 text-primary fa-fw"></i>
                    Komunikaty
                    <!-- Notification badge -->
                    <span class="badge badge-notify">1</span>
                    <!-- End Notification badge -->
                </a>
            </li>
<?php if (($returned['group'] == 1) && ($returned['permissions'] == "user = 1")) :?>
            <li class="nav-item ">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-question-circle mr-3 text-primary fa-fw"></i>
                    Pomoc
                </a>
            </li>
<?php endif ?>
            <li class="nav-item ">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-phone-alt mr-3 text-primary fa-fw"></i>
                    Kontakt
                </a>
            </li>
            <li class="nav-item">
                <a href="?logout=true" class="nav-link text-dark font-italic">
                    <i class="fa fa-sign-out-alt mr-3 text-primary fa-fw"></i>
                    Wyloguj
                </a>
            </li>
        </ul>
        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Język</p>
        <div class="container lang_container">
            <div class="row">
                <div class="col-xs-6 px-3 mb-3">
                    <a href="#"/><img src="./public/assets/poland_flag.svg" alt="Polish language"  width="50" /></a>
                </div>
                <div class="col-sc-6 px-3 mb-3">
                    <a href="#"/><img src="./public/assets/uk_flag.svg" alt="English language"  width="50" /></a>
                </div>
            </div>
        </div>
<?php if (($returned['group'] == 1) && ($returned['permissions'] == "user = 1")) :?>
        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Main</p>
<?php endif ?>
        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Zarządzanie</p>
        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic bg-light">
                    <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                    Strona główna
                </a>
            </li>
<?php if (($returned['group'] == 1) && ($returned['permissions'] == "user = 1")) :?>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-search mr-3 text-primary fa-fw"></i>
                    Wyszukiwanie książek
                </a>
            </li>
            <li class="nav-item top-line">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-newspaper mr-3 text-primary fa-fw"></i>
                    Co nowego?
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-book mr-3 text-primary fa-fw"></i>
                    Wybrane dla Ciebie
                </a>
            </li>
<?php endif ?>
<?php if (($returned['group'] == 2) && ($returned['permissions'] == "mod = 1")) :?>
            <li class="nav-item ">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-book-open mr-3 text-primary fa-fw"></i>
                    Zarządzaj wypożyczonymi
                </a>
            </li>
            <li class="nav-item ">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-bookmark mr-3 text-primary fa-fw"></i>
                    Zarządzaj rezerwacjami
                </a>
            </li>
            <li class="nav-item ">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-paper-plane mr-3 text-primary fa-fw"></i>
                    Wyślij komunikat
                </a>
            </li>
            <li class="nav-item ">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-book  mr-3 text-primary fa-fw"></i>
                    Dodaj książkę do zbioru
                </a>
            </li>
            <li class="nav-item ">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-plus-circle mr-3 text-primary fa-fw"></i>
                    Dodaj post
                </a>
            </li>
<?php endif ?>
        </ul>
<?php if (($returned['group'] == 3) && ($returned['permissions'] == "admin = 1")) :?>
        <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">Charts</p>

        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-chart-area mr-3 text-primary fa-fw"></i>
                    Area charts
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-chart-bar mr-3 text-primary fa-fw"></i>
                    Bar charts
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-chart-pie mr-3 text-primary fa-fw"></i>
                    Pie charts
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-chart-line mr-3 text-primary fa-fw"></i>
                    Line charts
                </a>
            </li>
        </ul>
<?php endif ?>
    </nav>