<?php
    require "includes/db.php";

    $data= $_POST;
    if( isset($data['do_signup']) )
    {
        //здесь регистрируем
        $errors = array();
        if (trim($data['name']) == '' )
        {
            $errors[] ='Введите имя';
        }
        if (trim($data['last_name']) == '' )
        {
            $errors[] ='Введите фамилию';
        }
        if (trim($data['email']) == '' )
        {
            $errors[] ='Введите email';
        }
        if ($data['password'] == '' )
        {
            $errors[] ='Введите пароль';
        }
        if ($data['password_2'] != $data['password'] )
        {
            $errors[] ='Повтор пароля не верен';
        }
//         if ( R::count('users', "login = ?", array($data['login'])) > 0 )
//         {
//             $errors[] ='Пользователь с таким логином уже существует';
//         }
        if ( R::count('users', "email = ?", array($data['email'])) > 0 )
        {
            $errors[] ='Пользователь с таким емейлом уже существует';
        }

        if (empty($errors))
        {
            //Все ок регаем
            $user = R::dispense('users');
            $user->name = $data['name'];
            $user->last_name = $data['last_name'];
            $user->email = $data['email'];
            $user->moderator = 'no_moder';
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
            R::store($user);
            header('Location: login.php');
        }
        else
            {
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
    include("../includes/header/_profile.php")
?>
<main class="main">
<section>
    <form action="signup.php" method="post">

        <p>Ввведите ваше имя<br/>
            <input type="text" name="name" placeholder="name" value="<?php echo @$data['name']; ?>">
        </p>
        <p>Ввведите вашу фамилию<br/>
            <input type="text" name="last_name" placeholder="last_name" value="<?php echo @$data['last_name']; ?>">
        </p>
        <p>Введите ваш email<br/>
            <input type="email" name="email" placeholder="email" value="<?php echo @$data['email']; ?>" >
        </p>
        <p>Введите ваш пароль<br/>
            <input type="password" name="password" placeholder="password" value="<?php echo @$data['password']; ?>">
        </p>
        <p>Повторите ваш пароль<br/>
            <input type="password" name="password_2" placeholder="password_2">
        </p>
        <p>
            <button type="submit" name="do_signup">Зарегистрироваться</button>
        </p>

    </form>
</section>
</main>
</body>
</html>
