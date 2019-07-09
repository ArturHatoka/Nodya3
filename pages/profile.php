<?php
    require "../entry/includes/db.php";
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
<?php
$data= $_POST;
if( isset($data['do_refact']) )
{
    //здесь изменяем
    $errors = array();
//    if (trim($data['name']) == '' )
//    {
//        $errors[] ='Введите имя';
//    }
//    if (trim($data['email']) == '' )
//    {
//        $errors[] ='Введите email';
//    }
    if (password_verify($data['password_2'], $_SESSION['logged_user']->password));
    else{

        if ($data['password_2'] != $data['password'] )
        {
            $errors[] ='Повтор пароля не верен';
        }
    }
//         if ( R::count('users', "login = ?", array($data['login'])) > 0 )
//         {
//             $errors[] ='Пользователь с таким логином уже существует';
//         }
//    if ( R::count('users', "email = ?", array($data['email'])) > 0 )
//    {
//        $errors[] ='Пользователь с таким емейлом уже существует';
//    }

    if (empty($errors))
    {
        //Все ок меняем
        $id = $_SESSION['logged_user']->id;
        $user_refact = R::load('users', $id);
        if ($data['name'] != ''){

            $user_refact->name = $data['name'];
        }
        if ($data['last_name'] != ''){

            $user_refact->last_name = $data['last_name'];
        }
        if ($data['email'] != ''){

            $user_refact->email = $data['email'];
        }
        if ($data['password'] != ''){

            $user_refact->password = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        R::store($user_refact);
//        header('Location: _profile.php');
    }
    else
    {
        echo '<div id="errors">'.array_shift($errors).'</div><hr>';
    }

} ?>


<?php

if ($_SESSION['logged_user']->id==1){
echo 'АДМИН и ты можешь:';

?>
    <form action="profile.php" method="post">
        <br>
        <p>ВЫ <?php echo $_SESSION['logged_user']->name; ?>
        </p>
        <p>Измените ваш пароль<br/>
            <input type="password" name="password" placeholder="password" value="<?php echo @$data['password']; ?>">
        </p>
        <p>Повторите ваш пароль<br/>
            <input type="password" name="password_2" placeholder="password_2">
        </p>
        <p>
            <button type="submit" name="do_refact">Сохранить</button>
        </p>
        <br>
    </form>


    <form action="profile.php" method="post">
    <?php
    $users = R::find('users', 'id > 1');
    foreach ($users as $user){
        $user_id = $user->id;
        $data = $_POST;
        if( isset($data['do_moder']) )
        {
            $user_mod = R::load('users', $user_id);
            if ($data['moderator'] != ''){
                $user_mod->moderator = $data['moderator'];
            }
            R::store($user_mod);
//        header('Location: _profile.php');

        } ?>
            <?php echo $user_mod->id; ?>
            <?php echo $user_mod->name; ?>
            <p>Модерка<br/>
                <input type="text" name="moderator" placeholder="<?php echo $user_mod->moderator; ?>" value="<?php echo @$data['moderator']; ?>">
            </p>
            <p>
                <button type="submit" name="do_moder">Сохранить</button>
            </p>

        <?php
    } ?>
    </form>
    <?php
}
    else {
        echo 'НЕ АДМИН ниче не можешь';
        ?>

        <form action="profile.php" method="post">
            <?php echo $_SESSION['logged_user']->id; ?>

            <p>Измените ваше имя<br/>
                <input type="text" name="name" placeholder="<?php echo $_SESSION['logged_user']->name; ?>" value="<?php echo @$data['name']; ?>">
            </p>
            <p>Измените вашу фамилию<br/>
                <input type="text" name="last_name" placeholder="<?php echo $_SESSION['logged_user']->last_name; ?>" value="<?php echo @$data['last_name']; ?>">
            </p>
            <p>Измените ваш email<br/>
                <input type="email" name="email" placeholder="<?php echo $_SESSION['logged_user']->email; ?>" value="<?php echo @$data['email']; ?>" >
            </p>
            <p>Измените ваш пароль<br/>
                <input type="password" name="password" placeholder="password" value="<?php echo @$data['password']; ?>">
            </p>
            <p>Подтвердите ваш пароль<br/>
                <input type="password" name="password_2" required placeholder="password_2">
            </p>
            <p>
                <button type="submit" name="do_refact">Сохранить</button>
            </p>

        </form>
    <?php
    }
?>

</main>
<footer>

</footer>
</body>
</html>
