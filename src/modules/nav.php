<nav class="vertical-nav bg-white overflow-auto" id="sidebar">
        <div class="py-4 px-3 mb-2 bg-light">
            <div class="media d-flex align-items-center"><img src="https://icons-for-free.com/iconfiles/png/512/bookshelf+library+icon-1320087270870761354.png" alt="logo" width="65" class="mr-3 rounded-circle img-thumbnail shadow">
                <div class="media-body">
                    <h4 class="m-0">Biblioteka Główna Toruń</h4>
                </div>
            </div>
        </div>
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
        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Użytkownik: <span class="text-primary"><?php echo $returned['user_name']?></span></p>
<?php
switch ($returned['group']) {
    /* -------------------USER MENU-----------------------------*/
    case 1:
        if ($returned['permissions'] == "user = 1") {
?>
        <ul class="nav flex-column bg-white mb-3">
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fas fa-user mr-3 text-primary fa-fw"></i>
                    Informacje o użytkowniku
                </a>
            </li>
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
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fas fa-exclamation-circle mr-3 text-primary fa-fw"></i>
                    Komunikaty
                    <!-- Notification badge -->
                    <span class="badge badge-notify">1</span>
                    <!-- End Notification badge -->
                </a>
            </li>
            <li class="nav-item ">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-question-circle mr-3 text-primary fa-fw"></i>
                    Pomoc
                </a>
            </li>
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
        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Main</p>
        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item">
                <a href="index.php" class="nav-link text-dark font-italic bg-light">
                    <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                    Strona główna
                </a>
            </li>
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
        </ul>
<?php
        break;
        } else {
            array_push($errors, "Proszę skontaktować się z administracją, brak uprawnień");
            break;
        }
/* -------------------MOD MENU-----------------------------*/
    case 2:
        if ($returned['permissions'] == "mod = 1") {
?>
        <ul class="nav flex-column bg-white mb-3">
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fas fa-user mr-3 text-primary fa-fw"></i>
                    Informacje o użytkowniku
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fas fa-exclamation-circle mr-3 text-primary fa-fw"></i>
                    Komunikaty
                    <!-- Notification badge -->
                    <span class="badge badge-notify">1</span>
                    <!-- End Notification badge -->
                </a>
            </li>
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
        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Zarządzanie</p>
        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item">
                <a href="index.php" class="nav-link text-dark font-italic bg-light">
                    <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                    Strona główna
                </a>
            </li>
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
                <a href="index.php?book_add" class="nav-link text-dark font-italic">
                    <i class="fa fa-book  mr-3 text-primary fa-fw"></i>
                    Dodaj książkę do zbioru
                </a>
            </li>
            <li class="nav-item ">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-minus-circle mr-3 text-primary fa-fw"></i>
                    Usuń książkę do zbioru
                </a>
            </li>
            <li class="nav-item ">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-user-plus  mr-3 text-primary fa-fw"></i>
                    Dodaj użytkownika
                </a>
            </li>
            <li class="nav-item ">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fa fa-plus-circle mr-3 text-primary fa-fw"></i>
                    Dodaj post
                </a>
            </li>
        </ul>
<?php
        break;
        } else {
            array_push($errors, "Proszę skontaktować się z administracją, brak uprawnień");
            break;
        }
/* -------------------ADMIN MENU-----------------------------*/
    case 3:
    if ($returned['permissions'] == "admin = 1") {
?>
        <ul class="nav flex-column bg-white mb-3">
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fas fa-user mr-3 text-primary fa-fw"></i>
                    Informacje o użytkowniku
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark font-italic">
                    <i class="fas fa-exclamation-circle mr-3 text-primary fa-fw"></i>
                    Komunikaty
                    <!-- Notification badge -->
                    <span class="badge badge-notify">1</span>
                    <!-- End Notification badge -->
                </a>
            </li>
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

        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Zarządzanie</p>
        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item">
                <a href="index.php" class="nav-link text-dark font-italic bg-light">
                    <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                    Strona główna
                </a>
            </li>
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
                    <i class="fa fa-plus-circle mr-3 text-primary fa-fw"></i>
                    Dodaj post
                </a>
            </li>
            <li class="nav-item ">
                <a href="index.php?admin_panel" class="nav-link text-dark font-italic">
                    <i class="fa fa-tools mr-3 text-primary fa-fw"></i>
                    Otwórz Admin Panel
                </a>
            </li>
        </ul>
<?php
        break;
        } else {
            array_push($errors, "Proszę skontaktować się z administracją, brak uprawnień do funkcji apliakcji");
            break;
        }
    default:
    array_push($errors, "Proszę skontaktować się z administracją, brak uprawnień do funkcji apliakcji");
}
?>
</nav>
<button id="menu-toggle" class="btn">Toggle Menu <i class="fa fa-
filter"></i></button>