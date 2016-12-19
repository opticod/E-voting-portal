<?php
require_once("includes/session.php");
require_once("includes/connection.php");
require_once("includes/functions.php");
if (not_declared())
    confirm_logged_in_admin();
?>
<link href="CSS/result_min.css" rel="stylesheet" type="text/css"/>
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
        echo "<h2>B.Tech 1st Year Boys</h2><br>";
        echo "<h3>General Secretary Post</h3>";
        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='1' AND gender='M' AND posts='GS'";
        res_vote($query);
        echo "<h3>Mess Secretary </h3>";
        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='1' AND gender='M' AND posts='MES'";
        res_vote($query);
        echo "<h3>Sports Secretary </h3>";

        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='1' AND gender='M' AND posts='SS'";
        res_vote($query);
        echo "<h3>Cultural Secretary </h3>";

        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='1' AND gender='M'AND posts='CS'";
        res_vote($query);
        echo "<h3>Maintenance Secretary </h3>";
        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='1' AND gender='M' AND posts='MAS'";
        res_vote($query);
        echo "<h3>Secretary-Technical affairs </h3>";
        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='1' AND gender='M' AND posts='STA'";
        res_vote($query);
        echo "<h3>Environmental and Welfare Secretary </h3>";
        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='1' AND gender='M' AND posts='EWS'";
        res_vote($query);
        echo "<h3>Literary Secretary</h3>";
        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='1' AND gender='M' AND posts='LS'";
        res_vote($query);

        echo '<br><br><hr>';

        echo "<h2>B.Tech 2st Year Boys</h2><br>";
        echo "<h3>General Secretary Post</h3>";
        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='2' AND gender='M' AND posts='GS'";
        res_vote($query);
        echo "<h3>Mess Secretary </h3>";
        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='2' AND gender='M' AND posts='MES'";
        res_vote($query);
        echo "<h3>Sports Secretary </h3>";

        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='2' AND gender='M' AND posts='SS'";
        res_vote($query);
        echo "<h3>Cultural Secretary </h3>";

        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='2' AND gender='M'AND posts='CS'";
        res_vote($query);
        echo "<h3>Maintenance Secretary </h3>";
        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='2' AND gender='M' AND posts='MAS'";
        res_vote($query);
        echo "<h3>Secretary-Technical affairs </h3>";
        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='2' AND gender='M' AND posts='STA'";
        res_vote($query);
        echo "<h3>Environmental and Welfare Secretary </h3>";
        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='2' AND gender='M' AND posts='EWS'";
        res_vote($query);
        echo "<h3>Literary Secretary</h3>";
        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='2' AND gender='M' AND posts='LS'";
        res_vote($query);
        echo '<br><br><hr>';

        echo "<h2>B.Tech 3st Year Boys</h2><br>";
        echo "<h3>General Secretary Post</h3>";
        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='3' AND gender='M' AND posts='GS'";
        res_vote($query);
        echo "<h3>Mess Secretary </h3>";
        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='3' AND gender='M' AND posts='MES'";
        res_vote($query);
        echo "<h3>Sports Secretary </h3>";

        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='3' AND gender='M' AND posts='SS'";
        res_vote($query);
        echo "<h3>Cultural Secretary </h3>";

        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='3' AND gender='M'AND posts='CS'";
        res_vote($query);
        echo "<h3>Maintenance Secretary </h3>";
        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='3' AND gender='M' AND posts='MAS'";
        res_vote($query);
        echo "<h3>Secretary-Technical affairs </h3>";
        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='3' AND gender='M' AND posts='STA'";
        res_vote($query);
        echo "<h3>Environmental and Welfare Secretary </h3>";
        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='3' AND gender='M' AND posts='EWS'";
        res_vote($query);
        echo "<h3>Literary Secretary</h3>";
        $query = "SELECT * FROM candidate WHERE degree='BT' AND year='3' AND gender='M' AND posts='LS'";
        res_vote($query);
        echo '<br><br><hr>';


        echo "<h2>P.G. & M.Tech Students</h2><br>";
        echo "<h3>General Secretary Post</h3>";
        $query = "SELECT * FROM candidate WHERE degree IN ('MT','PD') AND gender='M' AND posts='GS'";
        res_vote($query);
        echo "<h3>Mess Secretary </h3>";
        $query = "SELECT * FROM candidate WHERE degree IN ('MT','PD') AND gender='M' AND posts='MES'";
        res_vote($query);
        echo "<h3>Sports Secretary </h3>";

        $query = "SELECT * FROM candidate WHERE degree IN ('MT','PD') AND gender='M' AND posts='SS'";
        res_vote($query);
        echo "<h3>Cultural Secretary </h3>";

        $query = "SELECT * FROM candidate WHERE degree IN ('MT','PD') AND gender='M'AND posts='CS'";
        res_vote($query);
        echo "<h3>Maintenance Secretary </h3>";
        $query = "SELECT * FROM candidate WHERE degree IN ('MT','PD') AND gender='M' AND posts='MAS'";
        res_vote($query);
        echo "<h3>Secretary-Technical affairs </h3>";
        $query = "SELECT * FROM candidate WHERE degree IN ('MT','PD') AND gender='M' AND posts='STA'";
        res_vote($query);
        echo "<h3>Environmental and Welfare Secretary </h3>";
        $query = "SELECT * FROM candidate WHERE degree IN ('MT','PD') AND gender='M' AND posts='EWS'";
        res_vote($query);
        echo "<h3>Literary Secretary</h3>";
        $query = "SELECT * FROM candidate WHERE degree IN ('MT','PD') AND gender='M' AND posts='LS'";
        res_vote($query);
        echo '<br><br><hr>';

        echo "<h2>Girls Hostel</h2><br>";
        echo "<h3>General Secretary Post</h3>";
        $query = "SELECT * FROM candidate WHERE  gender='F' AND posts='GS'";
        res_vote($query);
        echo "<h3>Mess Secretary </h3>";
        $query = "SELECT * FROM candidate WHERE gender='F' AND posts='MES'";
        res_vote($query);
        echo "<h3>Sports Secretary </h3>";

        $query = "SELECT * FROM candidate WHERE gender='F'AND posts='SS'";
        res_vote($query);
        echo "<h3>Cultural Secretary </h3>";

        $query = "SELECT * FROM candidate WHERE gender='F' AND posts='CS'";
        res_vote($query);
        echo "<h3>Maintenance Secretary </h3>";
        $query = "SELECT * FROM candidate WHERE gender='F' AND posts='MAS'";
        res_vote($query);
        echo "<h3>Secretary-Technical affairs </h3>";
        $query = "SELECT * FROM candidate WHERE gender='F' AND posts='STA'";
        res_vote($query);
        echo "<h3>Environmental and Welfare Secretary </h3>";
        $query = "SELECT * FROM candidate WHERE gender='F' AND posts='EWS'";
        res_vote($query);
        echo "<h3>Literary Secretary</h3>";
        $query = "SELECT * FROM candidate WHERE gender='F' AND posts='LS'";
        res_vote($query);
        echo '<br><br><hr>';
        ?>
    </div>

</div>




<?php include ('includes/footer.php'); ?>
