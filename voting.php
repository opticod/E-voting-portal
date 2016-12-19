<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
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
<?php
$roll = mysql_prep($_SESSION['roll']);
$degree = mysql_prep($_SESSION['degree']);
$gender = mysql_prep($_SESSION['gender']);
$year = mysql_prep($_SESSION['year']);
check_voted($roll);
if (isset($_POST['submit']) && ($_SERVER['REQUEST_METHOD'] == 'POST') && mysql_prep($_POST['submit']) == "SUBMIT VOTE!!!") {
    check_voted($roll);
    if (isset($_POST['auth']) && !empty($_POST['auth'])) {
        if (auth(mysql_prep($_POST['auth']), $roll)) {
            $flag = false;
            if (isset($_POST['GS'])) {
                $GS = mysql_prep($_POST['GS']);
                voting($GS);
            }
            if (isset($_POST['MES'])) {
                $MES = mysql_prep($_POST['MES']);
                voting($MES);
            }
            if (isset($_POST['SS'])) {
                $SS = mysql_prep($_POST['SS']);
                voting($SS);
            }
            if (isset($_POST['CS'])) {
                $CS = mysql_prep($_POST['CS']);
                voting($CS);
            }
            if (isset($_POST['MAS'])) {
                $MAS = mysql_prep($_POST['MAS']);
                voting($MAS);
            }
            if (isset($_POST['STA'])) {
                $STA = mysql_prep($_POST['STA']);
                voting($STA);
            }
            if (isset($_POST['EWS'])) {
                $EWS = mysql_prep($_POST['EWS']);
                voting($EWS);
            }
            if (isset($_POST['LS'])) {
                $LS = mysql_prep($_POST['LS']);
                voting($LS);
            }
            if ($flag == true) {
                $query = "UPDATE user SET voted=1 WHERE roll='{$roll}' ";
                if ($query_run = mysqli_query($link, $query)) {
                    redirect_to('votedone.php');
                }
            }
        } else {
            echo '<strong style=\'color:#D5973C;\'>Verification Code Entered is Wrong!</strong>';
        }
    } else {
        echo '<strong>Enter the Verification Code!</strong>';
    }
}
?>
<?php
$output = "<div class=\"vote\"><div id='content'>";
$output.="<div id=\"info1\"class=\"info\" style='padding-bottom:5%;'>";
$output.="<form action='voting.php' class='vt' method='POST'>";
$output.="<strong style='color:#916A31;'>Don't Forget to Enter the Verifiaction Code at the Bottom! </strong><br><br>";
$output.="<h3>General Secretary </h3>";
post_disp('GS');
$output.="<h3>Mess Secretary </h3>";
post_disp('MES');
$output.="<h3>Sports Secretary </h3>";
post_disp('SS');
$output.="<h3>Cultural Secretary </h3>";
post_disp('CS');
$output.="<h3>Maintenance Secretary </h3>";
post_disp('MAS');
$output.="<h3>Secretary-Technical affairs </h3>";
post_disp('STA');
$output.="<h3>Environmental and Welfare Secretary </h3>";
post_disp('EWS');
$output.="<h3>Literary Secretary</h3>";
post_disp('LS');

$output.="<br><label for='auth' style='color: #916A31;padding-right: 9px;'>Verification Code::</label><input type='text' maxlength='30' name='auth' tabindex='' id='verify' required placeholder='Enter the Verification Code.'>";
$output.="<br><input type='submit' name='submit' tabindex='' value='SUBMIT VOTE!!!'></form>";
$output.="</div></div></div>";
echo $output;
?>


<?php include ('includes/footer.php'); ?>


