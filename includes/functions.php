<?php

/* The MIT License (MIT)

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
 */

function mysql_prep($value) {
    global $link;
    $m_q_act = get_magic_quotes_gpc();
    $new_php = function_exists("mysqli_real_escape_string");
    if ($new_php) {//to support PHP v4.3.0 or higher
        if ($m_q_act) {//undo any magic quotes effects so that mysqli_real... can do its work
            $value = stripcslashes($value);
        }
        $value = mysqli_real_escape_string($link, $value);
    } else {//before PHP v4.3.0
        if (!$m_q_act) {
            $value = addslashes($value);
        }
    }
    return $value;
}

function redirect_to($location = NULL) {
    if ($location != NULL) {
        header("Location:{$location}");
        exit;
    }
}

function logged_in() {
    return isset($_SESSION['roll']);
}

function logged_in_admin() {
    return isset($_SESSION['admin']);
}

function confirm_logged_in() {
    if (!logged_in()) {
        redirect_to("logs.php");
    }
}

function confirm_logged_in_admin() {
    if (!logged_in_admin()) {
        redirect_to("admin_gym.php");
    }
}

function not_declared() {
    global $link;
    $query = "SELECT declared FROM data WHERE 1 ";
    if ($query_run = mysqli_query($link, $query)) {
        if ((mysqli_num_rows($query_run) == 1)) {
            while ($row = mysqli_fetch_assoc($query_run)) {
                $dec = $row['declared'];
            }
            if ($dec != 1) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    } else
        return TRUE;
}

function post_disp($posts) {
    global $gender, $year, $degree, $link, $output;
    if ($gender == 'F') {
        $query = "SELECT * FROM candidate WHERE gender='{$gender}' AND posts='{$posts}' ORDER BY firstname ";
    } else if ($degree != 'BT') {
        $query = "SELECT * FROM candidate WHERE gender='{$gender}' AND degree IN ('MT','PD') AND posts='{$posts}' ORDER BY firstname ";
    } else {
        $query = "SELECT * FROM candidate WHERE gender='{$gender}' AND degree='{$degree}' AND year='{$year}' AND posts='{$posts}' ORDER BY firstname ";
    }
    if ($query_run = mysqli_query($link, $query)) {
        if ((mysqli_num_rows($query_run) >= 1)) {
            while ($row = mysqli_fetch_assoc($query_run)) {
                $roll_can = $row['roll'];
                $label = ucfirst(strtolower($row['firstname']) . " " . ucfirst($row['lastname'])) . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $roll_can;
                $output.="<br><input type='radio' id='{$roll_can}'style='left:25%;position:absolute;'placeholder='{$posts}' required tabindex='' name='{$posts}' maxlength='10' value='{$roll_can}'>";
                $output.="<label for='{$roll_can}' style='left:29%;position:absolute;'>{$label}</label>";
            }
            $output.="<br><hr>";
        } else {
            $output.='<p style=\'left:25%;position:relative;\'>No Registered Candidate for this Post</p><hr>';
        }
    } else {
        $output.='<p>Try After Sometime.</p><hr>';
    }
}

function voting($roll_c) {
    global $link, $flag;
    $query = "SELECT votes FROM candidate WHERE roll='$roll_c' FOR UPDATE ";
    if (mysqli_query($link, "START TRANSACTION;") && $query_run = mysqli_query($link, $query)) {
        if ((mysqli_num_rows($query_run) == 1)) {
            while ($row = mysqli_fetch_assoc($query_run)) {
                $votes_now = $row['votes'];
            }
            $votes_pres = $votes_now + 1;
            $query = "UPDATE candidate SET votes='{$votes_pres}' WHERE roll='$roll_c'";
            if ($query_run = mysqli_query($link, $query)) {
                if (mysqli_query($link, 'COMMIT;'))
                    $flag = true;
            } else {
                if (mysqli_query($link, 'ROLLBACK;'))
                    echo '<strong>Try After Sometime.</strong>';
            }
        }
    } else {
        echo '<strong>Try After Sometime.</strong>';
    }
}

function res_vote($query) {
    global $link;
    $output = "";
    if ($query_run = mysqli_query($link, $query)) {
        if (mysqli_num_rows($query_run) >= 1) {
            while ($row = mysqli_fetch_assoc($query_run)) {

                $label = "<strong>" . ucfirst(strtolower($row['firstname']) . " " . ucfirst($row['lastname'])) . "</strong>" . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . strtoupper($row['roll']);
                $output.="<p style=\'left:25%;position:relative;\'>" . $label . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . '<br>' . "Votes Recieved    =    " . "&nbsp&nbsp&nbsp" . "<strong>" . $row['votes'] . "</strong>"
                        . "</p><br>";
            }
            echo $output;
        } else {
            echo '<p class="non">No Registered Candidate for this Post</p>';
        }
    }
}

function sent_mail($random_num, $email_name) {
    $to = $email_name . "@172.16.1.11";
    $message = "Hi! Here is your Verification Code:" . $random_num . " .Use it during Voting to prove your Identity. Thank You.";
    $message = wordwrap($message, 70);
    $headers = "From: gymkhanna@iitp.ac.in \n";
    $headers.="Reply-To: anupam.ee14@172.16.1.11 \n";
    $headers.="X-Mailer: PHP/" . phpversion() . "\n";
    $headers.="MIME-Version:1.0 \n";
    $headers.="Content-Type:text/plain;charset=iso-8859-1";

    $res = mail($to, $headers, $message);
    return $res ? 1 : 0;
}

function check_voted($roll) {
    global $link;
    $query = "SELECT voted FROM user WHERE roll='{$roll}' ";
    if ($query_run = mysqli_query($link, $query)) {
        if ((mysqli_num_rows($query_run) == 1)) {
            while ($row = mysqli_fetch_assoc($query_run)) {
                $voted = $row['voted'];
            }
        } else {
            $voted = 1;
        }
    } else {
        $voted = 1;
    }
    if ($voted == 1) {
        redirect_to('votedone.php');
    }
}

function auth($auth_key, $roll) {
    global $link;
    $query = "SELECT keyid FROM user WHERE roll='{$roll}'";
    if ($query_run = mysqli_query($link, $query)) {
        if ((mysqli_num_rows($query_run) == 1)) {
            while ($row = mysqli_fetch_assoc($query_run)) {
                $key = $row['keyid'];
            }
            if ($auth_key == $key) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
    return FALSE;
}

?>