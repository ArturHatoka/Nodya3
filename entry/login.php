<?php
    require "includes/db.php";

    $data= $_POST;
    if (isset($data['do_login'])){
        $errors = array();
        $user = R::findOne('users', 'email = ?', array($data['email']));
        if ($user){
            if (password_verify($data['password'], $user->password)){
                $_SESSION['logged_user'] = $user;
                header('Location: /index.php');
            }
            else{
                $errors[] = 'Неверно ввереден пароль';
            }
        }
        else{
            $errors[] = 'Пользователь с таким email не найден';
        }
        if (!empty($errors)){
            echo '<div id="errors">'.array_shift($errors).'</div><hr>';
        }
    }
?>
<?php
    include("../includes/_head.php");
?>
<body>
<?php
    include("../includes/header/_header.php");
    include("../includes/header/_profile.php");
?>
<main class="main">
<section>
    <form action="login.php" method="post">
        <p>Email<br/>
            <input type="email" name="email" placeholder="email" value="<?php echo @$data['email']; ?>">
        </p>
        <p>Пароль<br/>
            <input type="password" name="password" placeholder="password" value="<?php echo @$data['password']; ?>">
        </p>
        <p>
            <button type="submit" name="do_login">Войти</button>
        </p>
    </form>
</section>
</main>
</body>
</html>

