<?php
require_once("includes/session.php");
require_once("includes/connection.php");
require_once("includes/functions.php");
if (logged_in_admin()) {
    redirect_to("admin_hand.php");
}
?>
<!--The MIT License (MIT)

Copyright (c) <2015> <ANUPAM DAS>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE
-->
<?php include ('includes/header.php'); ?>
<div class="login">
    <h2 class="bar">Please Sign In</h2>
    <?php
    if (isset($_POST['roll']) && isset($_POST['password']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
        $roll = sha1(mysql_prep($_POST['roll']));
        $pass = sha1(mysql_prep($_POST['password']));
        if (!empty($roll) && !empty($pass)) {

            $query = "SELECT * FROM data WHERE username='{$roll}' ";
            $query_run = mysqli_query($link, $query);
            if (mysqli_num_rows($query_run) >= 1) {

                while ($row = mysqli_fetch_assoc($query_run)) {
                    $pass_db = $row['password'];
                    $roll_db = $row['username'];
                    if ($pass == $pass_db && $roll == $roll_db) {

                        $_SESSION['admin'] = $roll_db;
                        redirect_to("admin_hand.php");
                    }
                }


                echo '<strong>Enter Correct Username and Password</strong>';
            } else
                echo '<strong>Enter Correct Username and Password</strong>';
        }
    } else
        echo '<strong>Please Fill Up all the details</strong>';
    ?>
    <form action="admin_gym.php" method="POST">
        <input type="text" tabindex="1" maxlength="20" autofocus placeholder="Username  *" name="roll" value="">
        <input type="password" placeholder="Password  * " tabindex="2" name="password">
        <input type="submit" tabindex="3" value="LOGIN">
    </form>
</div>
<?php include ('includes/footer.php'); ?>
