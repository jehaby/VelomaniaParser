<?php
/**
 * Created by PhpStorm.
 * User: urf
 * Date: 9/10/14
 * Time: 11:16 AM
 */


?>
<div>
    <h3>Authorization</h3>
    <form action="authorize.php" method="POST" >
        <table>
            <tr><td>Username</td><td><input type="text" name="username"> </td></tr>
            <tr><td>Password: </td><td><input type="password" name="password"></td></tr>
            <tr><td></td><td><input type="submit"></td></tr>
        </table>
    </form>
</div>


<div>
    <h3>Registration</h3>
    <form action="register.php" method="POST" >
        <table>
            <tr> <td>Username: </td> <td> <input type="text" name="username"> </td></tr>
            <tr> <td>Password:</td> <td><input type="password" name="password"> </td></tr>
            <tr> <td>Email: </td> <td><input type="email" name="email"> </td></tr>
            <tr> <td>Invitation code: </td> <td><input type="text" name="invitation_code"> </td></tr>
            <tr> <td></td><td><input type="submit"> </td></tr>
        </table>
    </form>
</div>