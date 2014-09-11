<?php
/**
 * Created by PhpStorm.
 * User: urf
 * Date: 9/10/14
 * Time: 11:16 AM
 */


?>
<div>    // authorization form
<form action="authorize.php" method="POST" >
    <input type="text" name="username">
    <input type="password" name="password">
    <input type="submit">
</form>
</div>


<div>    // registration form
    <form action="register.php" method="POST" >
        <input type="text" name="username">
        <input type="password" name="password">
        <input type="email" name="email">
        <input type="submit">
    </form>
</div>