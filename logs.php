<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php
if (logged_in()) {
    redirect_to("voting.php");
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
    if (($_SERVER['REQUEST_METHOD'] == 'POST')):
        if (isset($_POST['roll']) && isset($_POST['password'])) {
            $roll = mysql_prep($_POST['roll']);
            $pass = sha1(mysql_prep($_POST['password']));
            if (!empty($roll) && !empty($pass)) {
                $query = "SELECT roll,password,degree,gender,year FROM user WHERE roll='$roll' LIMIT 1";
                if ($query_run = mysqli_query($link, $query)) {
                    if ((mysqli_num_rows($query_run) == 1)) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            $pass_db = $row['password'];
                            if ($pass == $pass_db) {
                                $_SESSION['roll'] = $row['roll'];
                                $_SESSION['degree'] = $row['degree'];
                                $_SESSION['gender'] = $row['gender'];
                                $_SESSION['year'] = $row['year'];

                                redirect_to("voting.php");
                            } else
                                echo '<strong>Enter Correct Username and Password</strong>';
                        }
                    } else
                        echo '<strong>Enter Correct Username and Password</strong>';
                }
            } else
                echo '<strong>Please Fill Up all the details</strong>';
        }

    endif;
    ?>
    <form action="logs.php" method="POST">
        <input type="text" tabindex="1" maxlength="10" autofocus placeholder="Roll No. *" required name="roll" value="<?php
        if (isset($roll) && !empty($roll)) {
            echo $roll;
        }
        ?>">
        <input type="password" placeholder="Password  * " maxlength="40"required tabindex="2" name="password">
        <input type="submit" tabindex="3" value="LOGIN">
    </form>
    <p>Not Yet Registered?<br><a tabindex="4" href="signs.php">Register Here</a></p>
</div>
<?php include ('includes/footer.php'); ?>