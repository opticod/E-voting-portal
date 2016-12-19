<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
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
<div id="register">
    <h2 class="bar">Please Register!</h2>
    <?php
    $email_id = NULL;
    $pass = NULL;
    $pass2 = NULL;
    $firstname = NULL;
    $lastname = NULL;
    $degree = NULL;
    $ph = NULL;
    $roll = NULL;
    $gender = NULL;
    if (($_SERVER['REQUEST_METHOD'] == 'POST')):
        if (isset($_POST['email_id']) || isset($_POST['pass']) || isset($_POST['pass2']) || isset($_POST['firstname']) || isset($_POST['lastname']) || isset($_POST['degree']) || isset($_POST['roll']) || isset($_POST['gender']) || isset($_POST['ph'])) {
            if (isset($_POST['email_id']) && isset($_POST['pass']) && isset($_POST['pass2']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['degree']) && isset($_POST['roll']) && isset($_POST['gender'])) {
                $email_id = mb_strtolower(mysql_prep($_POST['email_id']));
                $pass = mysql_prep($_POST['pass']);
                $pass2 = mysql_prep($_POST['pass2']);
                $firstname = ucfirst(mysql_prep($_POST['firstname']));
                $lastname = ucfirst(mysql_prep($_POST['lastname']));
                $degree = mysql_prep($_POST['degree']);
                $ph = mysql_prep($_POST['ph']);
                $roll = strtoupper(mysql_prep($_POST['roll']));
                $gender = mysql_prep($_POST['gender']);
                $year = (int) (date("y")) - (int) (substr($roll, 0, 2));
                if (!empty($pass) && !empty($pass2) && !empty($firstname) && !empty($lastname) && !empty($degree) && !empty($roll) && !empty($gender) && !empty($email_id) && !empty($year)) {
                    if ($pass == $pass2) {
                        $query = "SELECT roll,email_id FROM user WHERE roll='{$roll}' OR email_id='{$email_id}' ";
                        $query_run = mysqli_query($link, $query);
                        if (mysqli_num_rows($query_run) == 0) {
                            $enc_pass = sha1($pass);
                            $random_num = mt_rand(10000, 99999);
                            $email_name = strstr($email_id, '@', true); //vs.5.3.0
                            $res = sent_mail($random_num, $email_name);

                            $query = "INSERT INTO user 
                            (firstname,lastname,roll,degree,year,email_id,gender,ph,password,keyid,sent)
                            VALUES ('{$firstname}','{$lastname}','{$roll}','{$degree}','{$year}','{$email_id}','{$gender}','{$ph}','{$enc_pass}','{$random_num}','{$res}')";

                            if (mysqli_query($link, $query)) {
                                echo '<strong>Successfully Registerd To Gymkhanna Election Protocol....</strong>';
                                $email_id = NULL;
                                $pass = NULL;
                                $pass2 = NULL;
                                $firstname = NULL;
                                $lastname = NULL;
                                $degree = NULL;
                                $ph = NULL;
                                $roll = NULL;
                                $year = NULL;
                                $gender = NULL;
                            } else
                                echo '<strong>Try after some Time</strong>';
                        } else
                            echo '<strong>Roll Number or Email Id Already Exists.</strong>';
                    } else
                        echo '<strong>Password doesn\'t Match</strong>';
                }
            }
            else {
                echo '<strong>Please fill up all the boxes!</strong>';
            }
        }
    endif;
    ?>

    <form action="signs.php" method="POST">
        <br><input type="text" placeholder="First Name *" autofocus required tabindex="1"  maxlength="30"value="<?php echo htmlentities($firstname); ?>" name="firstname">
        <br><input type="text" placeholder="Last Name *" required tabindex="2" maxlength="30" value="<?php echo htmlentities($lastname); ?>"name="lastname">
        <br><select name="degree"  maxlength="2" required tabindex="3">
            <option></option>
            <option value="BT"<?php
            if ((isset($degree)) && ($degree === 'BT')) {
                echo "selected";
            }
            ?>>B.Tech</option>
            <option value="MT"<?php
            if ((isset($degree)) && ($degree === 'MT')) {
                echo "selected";
            }
            ?>>M.Tech</option>
            <option value="PD"<?php
            if ((isset($degree)) && ($degree === 'PD')) {
                echo "selected";
            }
            ?>>Ph.D</option>
        </select>
        <br><input name="roll" tabindex="4"  required placeholder="Roll No. *" maxlength="10" value="<?php echo htmlentities($roll); ?>">                    
        <br><input type="email"placeholder="Enter IITP Email id." required tabindex="5"maxlength="50" name="email_id" value="<?php echo htmlentities($email_id); ?>">
        <br><input type="radio" id="male"style="left:28%;"placeholder="Male" required tabindex="6"<?php
        if ((isset($gender)) && ($gender === 'M')) {
            echo "checked";
        }
        ?> name="gender"maxlength="1" value="M">
        <label for="male" style="left:17%;">Male</label>
        <br><input type="radio" id="female"style="left:54%;"tabindex="7" name="gender"<?php
        if ((isset($gender)) && ($gender === 'F')) {
            echo "checked";
        }
        ?> maxlength="1"value="F">
        <label for="female" style="left:38%;">Female</label>
        <br><input type="password" tabindex="8" required  placeholder="Enter Password *"name="pass">
        <br><input type="password" tabindex="9"required  placeholder="Re-Enter Password *"name="pass2">
        <br><input type="text" tabindex="10" name="ph"placeholder="Mobile Number" maxlength="10"value="<?php echo htmlentities($ph); ?>">
        <br><input type="submit" tabindex="11" value="Register">
    </form>
</div>


<?php include ('includes/footer.php'); ?>