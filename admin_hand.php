<?php
require_once("includes/session.php");
require_once("includes/connection.php");
require_once("includes/functions.php");
confirm_logged_in_admin();
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
<div id="content">
    <div id="info1"class="info">
        <?php
        global $link;
        $email_id = NULL;
        $firstname = NULL;
        $lastname = NULL;
        $degree = NULL;
        $ph = NULL;
        $roll = NULL;
        $gender = NULL;
        $year = NULL;
        $post = NULL;
        if (($_SERVER['REQUEST_METHOD'] == 'POST')):
            if (isset($_POST['submit_d']) && $_POST['submit_d'] == 'DELETE User!') {

                if (isset($_POST['roll']) && isset($_POST['password'])) {
                    $roll = strtoupper(mysql_prep($_POST['roll']));
                    $pass = sha1(mysql_prep($_POST['password']));
                    if (!empty($roll) && !empty($pass)) {
                        $query = "SELECT * FROM data WHERE username='{$_SESSION['admin']}' ";
                        $query_run = mysqli_query($link, $query);
                        if (mysqli_num_rows($query_run) == 1) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                $pass_db = $row['password'];
                            }
                            if ($pass == $pass_db && !empty($_SESSION['admin'])) {

                                $query = "DELETE FROM user WHERE roll='$roll' LIMIT 1";
                                if ($query_run = mysqli_query($link, $query)) {
                                    echo '<strong>Successfully User Deleted!</strong>';
                                } else {
                                    echo '<strong>Try after some Time</strong>';
                                }
                            } else
                                echo '<strong>Enter Correct Username and Password</strong>';
                        } else
                            echo '<strong>Enter Correct Username and Password</strong>';
                    }
                }
            }else if (isset($_POST['submit_c_u']) && $_POST['submit_c_u'] == 'CHECK DETAILS User!') {

                if (isset($_POST['roll']) && isset($_POST['password'])) {
                    $roll = strtoupper(mysql_prep($_POST['roll']));
                    $pass = sha1(mysql_prep($_POST['password']));
                    if (!empty($roll) && !empty($pass)) {
                        $query = "SELECT * FROM data WHERE username='{$_SESSION['admin']}' ";
                        $query_run = mysqli_query($link, $query);
                        if (mysqli_num_rows($query_run) == 1) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                $pass_db = $row['password'];
                            }
                            if ($pass == $pass_db && !empty($_SESSION['admin'])) {

                                $query = "SELECT * FROM user WHERE roll='$roll' LIMIT 1";
                                if ($query_run = mysqli_query($link, $query)) {
                                    $output = '<strong>User Details are as Follows!</strong><br><br>';
                                    if (mysqli_num_rows($query_run) == 1) {
                                        while ($row = mysqli_fetch_assoc($query_run)) {
                                            $u_id = $row['id'];
                                            $u_firstname = $row['firstname'];
                                            $u_lastname = $row['lastname'];
                                            $u_roll = $row['roll'];
                                            $u_degree = $row['degree'];
                                            $u_year = $row['year'];
                                            $u_email_id = $row['email_id'];
                                            $u_gender = $row['gender'];
                                            $u_ph = $row['ph'];
                                            $u_voted = $row['voted'];
                                            $u_keyid = $row['keyid'];
                                            $u_sent = $row['sent'];
                                        }
                                        $output.="<strong>id</strong> " . $u_id . '<br>';
                                        $output.="<strong>firstname</strong> " . $u_firstname . '<br>';
                                        $output.="<strong>lastname</strong> " . $u_lastname . '<br>';
                                        $output.="<strong>roll</strong> " . $u_roll . '<br>';
                                        $output.="<strong>degree</strong> " . $u_degree . '<br>';
                                        $output.="<strong>year</strong> " . $u_year . '<br>';
                                        $output.="<strong>email_id</strong> " . $u_email_id . '<br>';
                                        $output.="<strong>gender</strong> " . $u_gender . '<br>';
                                        $output.="<strong>ph</strong> " . $u_ph . '<br>';
                                        $output.="<strong>voted</strong> " . $u_voted . '<br>';
                                        $output.="<strong>keyid</strong> " . $u_keyid . '<br>';
                                        $output.="<strong>sent</strong> " . $u_sent . '<br>';
                                        echo $output;
                                    }
                                } else {
                                    echo '<strong>Try after some Time</strong>';
                                }
                            } else
                                echo '<strong>Enter Correct Username and Password</strong>';
                        } else
                            echo '<strong>Enter Correct Username and Password</strong>';
                    }
                }
            }else if (isset($_POST['submit_c_c']) && $_POST['submit_c_c'] == 'UPDATE DETAILS User!') {

                if (isset($_POST['roll']) && isset($_POST['password'])) {
                    $roll = strtoupper(mysql_prep($_POST['roll']));
                    $pass = sha1(mysql_prep($_POST['password']));
                    if (!empty($roll) && !empty($pass)) {
                        $query = "SELECT * FROM data WHERE username='{$_SESSION['admin']}' ";
                        $query_run = mysqli_query($link, $query);
                        if (mysqli_num_rows($query_run) == 1) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                $pass_db = $row['password'];
                            }
                            if ($pass == $pass_db && !empty($_SESSION['admin'])) {
                                $category = mysql_prep($_POST['update_u_c']);
                                $new_value = mysql_prep($_POST['update_u_v']);
                                $query = "UPDATE user SET {$category}='{$new_value}' WHERE roll='{$roll}'";
                                if (mysqli_query($link, $query)) {
                                    echo '<strong>Successfully Updated User Details</strong>';
                                } else {
                                    echo '<strong>Try after some Time</strong>';
                                }
                            } else
                                echo '<strong>Enter Correct Username and Password</strong>';
                        } else
                            echo '<strong>Enter Correct Username and Password</strong>';
                    }
                }
            }else if (isset($_POST['submit_c_c']) && $_POST['submit_c_c'] == 'CHECK DETAILS Candidate!') {

                if (isset($_POST['roll']) && isset($_POST['password'])) {
                    $roll = strtoupper(mysql_prep($_POST['roll']));
                    $pass = sha1(mysql_prep($_POST['password']));
                    if (!empty($roll) && !empty($pass)) {
                        $query = "SELECT * FROM data WHERE username='{$_SESSION['admin']}' ";
                        $query_run = mysqli_query($link, $query);
                        if (mysqli_num_rows($query_run) == 1) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                $pass_db = $row['password'];
                            }
                            if ($pass == $pass_db && !empty($_SESSION['admin'])) {

                                $query = "SELECT * FROM candidate WHERE roll='$roll' LIMIT 1";
                                if ($query_run = mysqli_query($link, $query)) {
                                    $output = '<strong>Candidate Details are as Follows!</strong><br><br>';
                                    if (mysqli_num_rows($query_run) == 1) {
                                        while ($row = mysqli_fetch_assoc($query_run)) {
                                            $c_id = $row['id'];
                                            $c_firstname = $row['firstname'];
                                            $c_lastname = $row['lastname'];
                                            $c_roll = $row['roll'];
                                            $c_degree = $row['degree'];
                                            $c_year = $row['year'];
                                            $c_email_id = $row['email'];
                                            $c_gender = $row['gender'];
                                            $c_ph = $row['mobile'];
                                            $c_votes = $row['votes'];
                                            $c_posts = $row['posts'];
                                        }
                                        $output.="<strong>id</strong> " . $c_id . '<br>';
                                        $output.="<strong>firstname</strong> " . $c_firstname . '<br>';
                                        $output.="<strong>lastname</strong> " . $c_lastname . '<br>';
                                        $output.="<strong>roll</strong> " . $c_roll . '<br>';
                                        $output.="<strong>degree</strong> " . $c_degree . '<br>';
                                        $output.="<strong>year</strong> " . $c_year . '<br>';
                                        $output.="<strong>email</strong> " . $c_email_id . '<br>';
                                        $output.="<strong>gender</strong> " . $c_gender . '<br>';
                                        $output.="<strong>mobile</strong> " . $c_ph . '<br>';
                                        $output.="<strong>votes</strong> " . $c_votes . '<br>';
                                        $output.="<strong>posts</strong> " . $c_posts . '<br>';
                                        echo $output;
                                    }
                                } else {
                                    echo '<strong>Try after some Time</strong>';
                                }
                            } else
                                echo '<strong>Enter Correct Username and Password</strong>';
                        } else
                            echo '<strong>Enter Correct Username and Password</strong>';
                    }
                }
            }else if (isset($_POST['submit_c_cc']) && $_POST['submit_c_cc'] == 'UPDATE DETAILS Candidate!') {

                if (isset($_POST['roll']) && isset($_POST['password'])) {
                    $roll = strtoupper(mysql_prep($_POST['roll']));
                    $pass = sha1(mysql_prep($_POST['password']));
                    if (!empty($roll) && !empty($pass)) {
                        $query = "SELECT * FROM data WHERE username='{$_SESSION['admin']}' ";
                        $query_run = mysqli_query($link, $query);
                        if (mysqli_num_rows($query_run) == 1) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                $pass_db = $row['password'];
                            }
                            if ($pass == $pass_db && !empty($_SESSION['admin'])) {
                                $category = mysql_prep($_POST['update_c_c']);
                                $new_value = mysql_prep($_POST['update_c_v']);
                                $query = "UPDATE candidate SET {$category}='{$new_value}'WHERE roll='{$roll}'";
                                if (mysqli_query($link, $query)) {
                                    echo '<strong>Successfully Updated Candidate Details</strong>';
                                } else {
                                    echo '<strong>Try after some Time</strong>';
                                }
                            } else
                                echo '<strong>Enter Correct Username and Password</strong>';
                        } else
                            echo '<strong>Enter Correct Username and Password</strong>';
                    }
                }
            }
            elseif (isset($_POST['submit_d_c']) && $_POST['submit_d_c'] == 'DELETE Candidate!') {
                if (isset($_POST['roll']) && isset($_POST['password'])) {
                    $roll = strtoupper(mysql_prep($_POST['roll']));
                    $pass = sha1(mysql_prep($_POST['password']));
                    if (!empty($roll) && !empty($pass)) {
                        $query = "SELECT * FROM data WHERE username='{$_SESSION['admin']}' ";
                        $query_run = mysqli_query($link, $query);
                        if (mysqli_num_rows($query_run) == 1) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                $pass_db = $row['password'];
                            }
                            if ($pass == $pass_db && !empty($_SESSION['admin'])) {

                                $query = "DELETE FROM candidate WHERE roll='$roll' LIMIT 1";
                                if ($query_run = mysqli_query($link, $query)) {
                                    echo '<strong>Successfully Candidate Deleted!</strong>';
                                } else {
                                    echo '<strong>Try after some Time</strong>';
                                }
                            } else
                                echo '<strong>Enter Correct Username and Password</strong>';
                        } else
                            echo '<strong>Enter Correct Username and Password</strong>';
                    }
                }
            }elseif (isset($_POST['submit_c_a']) && $_POST['submit_c_a'] == 'UPDATE Admin!') {

                if (isset($_POST['c_user']) && isset($_POST['n_user']) && isset($_POST['n_password']) && isset($_POST['nn_password']) && isset($_POST['c_password'])) {
                    $c_user = sha1(mysql_prep($_POST['c_user']));
                    $n_user = sha1(mysql_prep($_POST['n_user']));
                    $n_pass = sha1(mysql_prep($_POST['n_password']));
                    $c_pass = sha1(mysql_prep($_POST['c_password']));
                    $nn_pass = sha1(mysql_prep($_POST['nn_password']));
                    if (!empty($c_user) && !empty($n_user) && !empty($n_pass) && !empty($nn_pass) && !empty($c_pass) && $n_pass == $nn_pass) {


                        if (mysqli_query($link, "BEGIN;")) {
                            $query = "SELECT * FROM data WHERE username='{$c_user}' FOR UPDATE; ";
                            if ($query_run = mysqli_query($link, $query)) {
                                if (mysqli_num_rows($query_run) == 1) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        $id = $row['id'];
                                        $pass_db = $row['password'];
                                    }
                                    if ($c_pass == $pass_db && !empty($_SESSION['admin'])) {

                                        $query1 = "UPDATE data SET username='{$n_user}'   WHERE id={$id}";
                                        $query2 = "UPDATE data SET password='{$n_pass}'  WHERE id={$id}";

                                        if (mysqli_query($link, $query1) && mysqli_query($link, $query2)) {
                                            if (mysqli_query($link, 'COMMIT;'))
                                                echo '<strong>Successfully Admin Details Updated!</strong>';
                                        } else {
                                            if (mysqli_query($link, 'ROLLBACK;'))
                                                echo '<strong>Try after some Time</strong>';
                                        }
                                        mysqli_query($link, 'END;');
                                    } else
                                        echo '<strong>Enter Correct Username and Password</strong>';
                                }
                            } else
                                echo '<strong>Enter Correct Username and Password</strong>';
                        }
                    }else {
                        echo '<strong>Please fill up Correctly all the boxes!</strong>';
                    }
                }
            } elseif (isset($_POST['submit_r']) && $_POST['submit_r'] == 'REGISTER Candidate!') {

                if (isset($_POST['roll']) && isset($_POST['password'])) {
                    $roll = strtoupper(mysql_prep($_POST['roll']));
                    $pass = sha1(mysql_prep($_POST['password']));
                    if (!empty($roll) && !empty($pass)) {
                        $query = "SELECT * FROM data WHERE username='{$_SESSION['admin']}' ";
                        $query_run = mysqli_query($link, $query);
                        if (mysqli_num_rows($query_run) == 1) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                $pass_db = $row['password'];
                            }
                            if ($pass == $pass_db && !empty($_SESSION['admin'])) {

                                if (isset($_POST['email_id']) || isset($_POST['firstname']) || isset($_POST['lastname']) || isset($_POST['degree']) || isset($_POST['roll']) || isset($_POST['gender']) || isset($_POST['year']) || isset($_POST['ph'])) {
                                    if (isset($_POST['email_id']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['degree']) && isset($_POST['roll']) && isset($_POST['gender']) && isset($_POST['email_id']) && isset($_POST['year']) && isset($_POST['post'])) {
                                        $email_id = mb_strtolower(mysql_prep($_POST['email_id']));
                                        $firstname = ucfirst(mysql_prep($_POST['firstname']));
                                        $lastname = ucfirst(mysql_prep($_POST['lastname']));
                                        $degree = mysql_prep($_POST['degree']);
                                        $ph = mysql_prep($_POST['ph']);
                                        $roll = strtoupper(mysql_prep($_POST['roll']));
                                        $gender = mysql_prep($_POST['gender']);
                                        $year = mysql_prep($_POST['year']);
                                        $post = mysql_prep($_POST['post']);

                                        if (!empty($firstname) && !empty($lastname) && !empty($degree) && !empty($roll) && !empty($gender) && !empty($email_id) && !empty($year) && !empty($post)) {
                                            $query = "SELECT roll FROM user WHERE roll='{$roll}' ";
                                            $query_run = mysqli_query($link, $query);
                                            if (mysqli_num_rows($query_run) == 0) {

                                                $query = "INSERT INTO candidate 
                            (firstname,lastname,roll,year,gender,degree,posts,email,mobile)
   VALUES ('{$firstname}','{$lastname}','{$roll}','{$year}','{$gender}','{$degree}','{$post}','{$email_id}','{$ph}')";

                                                if (mysqli_query($link, $query)) {
                                                    echo '<strong>Candidate Successfully Registerd To Gymkhanna Election Protocol....</strong>';
                                                    $email_id = NULL;
                                                    $firstname = NULL;
                                                    $lastname = NULL;
                                                    $degree = NULL;
                                                    $ph = NULL;
                                                    $roll = NULL;
                                                    $year = NULL;
                                                    $gender = NULL;
                                                    $post = NULL;
                                                } else
                                                    echo '<strong>Try after some Time</strong>';
                                            } else
                                                echo '<strong>Roll Number Already Exists.</strong>';
                                        }
                                    }
                                    else {
                                        echo '<strong>Please fill up all the boxes!</strong>';
                                    }
                                }
                            } else
                                echo '<strong>Enter Correct Username and Password</strong>';
                        } else
                            echo '<strong>Enter Correct Username and Password</strong>';
                    }
                }
            }elseif ((isset($_POST['declare']) && $_POST['declare'] == 'DECLARE Results!') || (isset($_POST['undeclare']) && $_POST['undeclare'] == 'UNDECLARE Results!')) {
                if (isset($_POST['user']) && isset($_POST['password'])) {
                    $user = sha1(mysql_prep($_POST['user']));
                    $password = sha1(mysql_prep($_POST['password']));
                    if (!empty($user) && !empty($password)) {
                        $query = "SELECT * FROM data WHERE username='{$user}' ";
                        if ($query_run = mysqli_query($link, $query)) {
                            if (mysqli_num_rows($query_run) == 1) {
                                while ($row = mysqli_fetch_assoc($query_run)) {
                                    $pass_db = $row['password'];
                                }

                                if ($password == $pass_db && !empty($_SESSION['admin'])) {
                                    if ((isset($_POST['declare']) && $_POST['declare'] == 'DECLARE Results!'))
                                        $query1 = "UPDATE data SET declared=1 ";
                                    if ((isset($_POST['undeclare']) && $_POST['undeclare'] == 'UNDECLARE Results!'))
                                        $query1 = "UPDATE data SET declared=0";
                                    if (mysqli_query($link, $query1)) {
                                        echo ((isset($_POST['declare']) && $_POST['declare'] == 'DECLARE Results!')) ? '<strong>Successfully Result Declared!</strong>' : '<strong>Successfully Result Undeclared!</strong>';
                                    } else {
                                        echo '<strong>Try after some Time</strong>';
                                    }
                                } else
                                    echo '<strong>Enter Correct Username and Password</strong>';
                            }
                        } else
                            echo '<strong>Enter Correct Username and Password</strong>';
                    }
                }
            }else {
                echo '<strong>Please fill up Correctly all the boxes!</strong>';
            }
        endif;
        ?>





        <form action="admin_hand.php" method="POST">
            <br><input type="text" tabindex="" required maxlength="10" placeholder="User Roll No. *" name="roll" value="">
            <br><input type="password"required maxlength="40" placeholder="Password  * " tabindex="" name="password">
            <br><br><input type="submit" tabindex="" name="submit_d" value="DELETE User!">
        </form><br><hr>
        <form action="admin_hand.php" method="POST">
            <br><input type="text" tabindex="" required maxlength="10" placeholder="Candidate Roll No. *" name="roll" value="">
            <br><input type="password"required maxlength="40" placeholder="Password  * " tabindex="" name="password">
            <br><br><input type="submit" tabindex="" name="submit_d_c" value="DELETE Candidate!">
        </form><br><hr>
        <form action="admin_hand.php" method="POST">
            <br><input type="text" placeholder="First Name *" required tabindex=""  maxlength="30"value="<?php echo htmlentities($firstname); ?>" name="firstname">
            <br><input type="text" placeholder="Last Name *" required tabindex="" maxlength="30" value="<?php echo htmlentities($lastname); ?>"name="lastname">
            <br><select name="degree"  maxlength="2"  required tabindex="">
                <option></option>
                <option value="BT">B.Tech</option>
                <option value="MT">M.Tech</option>
                <option value="PD">Ph.D</option>
            </select>
            <br><select name="post"  maxlength="3"  required tabindex="">
                <option></option>
                <option value="GS">General Secretary</option>
                <option value="MES">Mess Secretary </option>
                <option value="SS">Sports Secretary</option>
                <option value="CS">Cultural Secretary </option>
                <option value="MAS">Maintenance Secretary </option>
                <option value="STA">Secretary-Technical affairs </option>
                <option value="EWS">Environmental and Welfare Secretary </option>
                <option value="LS">Literary Secretary</option>
            </select>
            <br><input name="roll" tabindex=""  required placeholder="Roll No. *" maxlength="10" value="">                    
            <br><input type="email"placeholder="Email" tabindex=""maxlength="50" required name="email_id" value="<?php echo htmlentities($email_id); ?>">
            <br><input type="text"placeholder="Year  *"required tabindex=""maxlength="1" name="year" value="<?php echo htmlentities($year); ?>">
            <br><input type="radio" id="male"style="left:28%;"placeholder="Male" required tabindex="" name="gender"maxlength="1" value="M">
            <label for="male" style="left:17%;">Male</label>
            <br><input type="radio" id="female"style="left:54%;"tabindex="" name="gender" maxlength="1"value="F">
            <label for="female" style="left:38%;">Female</label>
            <br><input type="password" tabindex="" required  placeholder="Enter Password *"name="password">
            <br><input type="text" tabindex="" name="ph"placeholder="Mobile Number" maxlength="10"value="<?php echo htmlentities($ph); ?>">
            <br><br><input type="submit" tabindex="" name="submit_r" value="REGISTER Candidate!">
            <br><hr> 
        </form>
        <form action="admin_hand.php" method="POST">
            <br><input type="text" tabindex="" required maxlength="30" placeholder="Current Admin User Name *" name="c_user" value="">
            <br><input type="text" tabindex="" required maxlength="30" placeholder="New Admin User Name *" name="n_user" value="">
            <br><input type="password"required maxlength="40" placeholder="Current Password  * " tabindex="" name="c_password">
            <br><input type="password"required maxlength="40" placeholder="New Password  * " tabindex="" name="n_password">
            <br><input type="password"required maxlength="40" placeholder="Re-Type New Password  * " tabindex="" name="nn_password">
            <br><br><input type="submit" tabindex="" name="submit_c_a" value="UPDATE Admin!">
        </form><br><hr>
        <a href="result.php"><strong>Check Results Here!</strong></a>
        <br><hr>

        <form action="admin_hand.php" method="POST">
            <br><input type="text" tabindex="" required maxlength="30" placeholder="Admin User Name *" name="user" value="">
            <br><input type="password"required maxlength="40" placeholder="Password  * " tabindex="" name="password">
            <br><br><input type="submit" tabindex="" name="declare" value="DECLARE Results!">
            <br><br><input type="submit" tabindex="" name="undeclare" value="UNDECLARE Results!">
        </form><br><hr>
        <form action="admin_hand.php" method="POST">
            <br><input type="text" tabindex="" required maxlength="10" placeholder="User Roll No. *" name="roll" value="">
            <br><input type="password"required maxlength="40" placeholder="Password  * " tabindex="" name="password">
            <br><br><input type="submit" tabindex="" name="submit_c_u" value="CHECK DETAILS User!">
        </form><br><hr>
        <form action="admin_hand.php" method="POST">
            <br><input type="text" tabindex="" required maxlength="10" placeholder="Candidate Roll No. *" name="roll" value="">
            <br><input type="password"required maxlength="40" placeholder="Password  * " tabindex="" name="password">
            <br><br><input type="submit" tabindex="" name="submit_c_c" value="CHECK DETAILS Candidate!">
        </form><br><hr>
        <form action="admin_hand.php" method="POST">
            <br><input type="text" tabindex="" required maxlength="10" placeholder="Update User Roll No. *" name="roll" value="">
            <br><input type="text" tabindex="" required maxlength="40" placeholder="To Update *" name="update_u_c" value="">
            <br><input type="text" tabindex="" required maxlength="40" placeholder="Updated value *" name="update_u_v" value="">
            <br><input type="password"required maxlength="40" placeholder="Password  * " tabindex="" name="password">
            <br><br><input type="submit" tabindex="" name="submit_c_c" value="UPDATE DETAILS User!">
        </form><br><hr>
        <form action="admin_hand.php" method="POST">
            <br><input type="text" tabindex="" required maxlength="10" placeholder="Update Candidate Roll No. *" name="roll" value="">
            <br><input type="text" tabindex="" required maxlength="40" placeholder="To Update *" name="update_c_c" value="">
            <br><input type="text" tabindex="" required maxlength="40" placeholder="Updated value *" name="update_c_v" value="">
            <br><input type="password"required maxlength="40" placeholder="Password  * " tabindex="" name="password">
            <br><br><input type="submit" tabindex="" name="submit_c_cc" value="UPDATE DETAILS Candidate!">
        </form><br><hr>
    </div>

</div>




<?php include ('includes/footer.php'); ?>
