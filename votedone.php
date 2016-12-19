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
<div id="content">
    <div id="info1"class="info">
        <strong>Thanks For Voting.......Please Log Out..........<br><br><br>You will be automatically Logged Out in <span id="timer"style="color: red; font-size:2em;padding: 5px;">5</span> seconds.</strong>
    </div>
</div>
<script>
    var seconds = document.getElementById('timer').firstChild.nodeValue;
    setInterval(function () {
        if (seconds == 0) {
            window.location = 'logout.php';
        } else {
            document.getElementById('timer').innerHTML = --seconds;
        }
    }, 1000);
</script>
<?php include ('includes/footer.php'); ?>