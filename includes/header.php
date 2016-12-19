<!DOCTYPE html>
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
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>GymkhannaElections</title>     
        <link href="CSS/welcome_min.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>       
        <div id="iitph">
            <img  src="images/header.png"/>
        </div>
        <nav class="navbar">
            <nav class="navbar" >                    
                <ul class="topmenu"> 
                    <?php
                    $keywords = preg_split("[\/]", $_SERVER['SCRIPT_NAME']);
                    $key = $keywords[count($keywords) - 1];
                    ?>                    
                    <li>ashasa</li>
                    <li><a href="index.php" title="Home" class="<?php echo ($key == "index.php") ? "current" : "diff"; ?>">Home</a></li>
                    <li><a>|</a></li>
                    <li><a href="//www.iitp.ac.in" title="IITP Home"class="diff">IITP Home</a></li>
                    <li><a>|</a></li>
                    <li><a href="//www.iitp.ac.in/gymkhana/index.html" title="IITP Gymkhana"class="diff">IITP Gymkhana</a></li>
                    <li><a>|</a></li>
                    <li><a href="contact.php" title="contact us"class="<?php echo ($key == "contact.php") ? "current" : "diff"; ?>">Contact Us</a></li>
                    <li><a>|</a></li>
                    <li><a  title="Login"class="<?php echo ($key == "logs.php") ? "current" : "diff"; ?>">Login</a>
                        <ul class="submenu">
                            <li><a href="logs.php" title="Voters">Voters</a></li>
                        </ul>
                    </li>
                    <li><a>|</a></li>
                    <li><a title="Sign Up"class="<?php echo ($key == "signs.php") ? "current" : "diff"; ?>">Sign Up</a>
                        <ul class="submenu">
                            <li><a href="signs.php" title="Voters">Voters</a></li>
                        </ul>
                    </li> 
                    <li><a title="<?php echo (logged_in()) ? "Log Out" : ""; ?>" class="logout" href="logout.php"><?php
                            echo (logged_in()) ? "Log Out" : "";
                            echo (logged_in_admin()) ? "Log Out" : "";
                            ?></a></li>
                </ul>
            </nav>
        </nav>            
    </div> 