<header class="header">
    <section class="header-head">
        <img src="/src/img/logo.png" alt="" class="header-head__logo">
        <span class="header-head__title">Нодья</span>
        <div class="header-head__entry">
            <?php if ( isset($_SESSION['logged_user'])) : ?>
                <div class="header-head__entry-user">
                    <span class="header-head__entry-user--name">Здравствуй, <?php echo $_SESSION['logged_user']->name; ?></span>
                    <a class="header-head__entry-user--publicate" href="#">Профиль</a>
                    <a class="header-head__entry-user--logout" href="/entry/logout.php"> Выйти</a>
                </div>
            <?php else: ?>
                <a href="/entry/login.php" class="header-head__entry-login">Вход автора</a>
                <a href="/entry/signup.php" class="header-head__entry-signup">Регистрация</a>
            <?php endif; ?>
        </div>
    </section>
    <section class="header-subtitle">
        <span class="header-subtitle-txt">Онлайн-клуб свободных авторов, читателей и почитателей</span>
    </section>
    <nav class="header-nav">
        <a href="/index.php" class="header-nav__item active">Главная</a>
        <a href="#" class="header-nav__item">Авторы</a>
        <a href="#" class="header-nav__item">Проза</a>
        <a href="#" class="header-nav__item">Поэзия</a>
        <a href="#" class="header-nav__item">Объявления</a>
    </nav>
</header>