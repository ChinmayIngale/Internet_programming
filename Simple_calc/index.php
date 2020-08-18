<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            box-sizing: border-box;
        }
        #calc{
            border: 2px solid black;
            border-spacing: 10px;
        }
        th{
            height: 80px;
            border: 1px solid black;
            border-radius: 5px;
            padding: 0;
        }
        #equal{
            background-color:#2a39e5 ;
            color:#fff;
        }
        .exp{
            background-color: #dfe1e5;
        }
        td{
            text-align: center;
        }
        input{
            height: 50px;
            width: 70px;
            background-color: #f1f3f4;
            color: #000000;
            border: none;
            border-radius: 5px;
            text-align: center;  
            font-size: 30px;    
        }
        input:hover, .exp:hover{
            background-color: #c1c3c6;
            box-shadow: 5px 5px 10px black 50%;
        }
        #output{
            width: 95%;
            margin: 5px;
            text-align: right;
            padding: 0;
        }
    </style>
    <?php
        $f=0;
        if(isset($_POST['exp'])){
            $exp = $_POST['exp'];
            $screen = $_POST['out'];
            $screen .= $exp;
            $f=1;
        }
        if(isset($_POST['equal'])){
            $ma = $_POST['out'];
            $screen= eval('return '.$ma.';');
            $f=1;
        }
        if(isset($_POST['clear'])){
            header("Refresh:0");
        }
    
    ?>
</head>
<body>
    <h1>Simple php Calculator</h1>
    <div>
    <table id="calc">
    <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
        <thead>
        <tr>
            <th colspan="4">
                <input id="output" type="text" name="out" placeholder="0" value="<?php if($f==1) {echo $screen;} ?>">
            </th>
        </tr>
        </thead>
        <tbody>
        <from id="eval" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <tr>
            <td><input class="exp" type="submit" name="exp" value="("></td>
            <td><input class="exp" type="submit" name="exp" value=")"></td>
            <td><input class="exp" type="submit" name="exp" value="%"></td>
            <td><input class="exp" type="submit" name="clear" value="AC"></td>
        </tr>
        <tr>
            <td><input type="submit" name="exp" value="7"></td>
            <td><input type="submit" name="exp" value="8"></td>
            <td><input type="submit" name="exp" value="9"></td>
            <td><input class="exp" type="submit" name="exp" value="/"></td>
        </tr>
        <tr>
            <td><input type="submit" name="exp" value="4"></td>
            <td><input type="submit" name="exp" value="5"></td>
            <td><input type="submit" name="exp" value="6"></td>
            <td><input class="exp" type="submit" name="exp" value="*"></td>
        </tr>
        <tr>
            <td><input type="submit" name="exp" value="1"></td>
            <td><input type="submit" name="exp" value="2"></td>
            <td><input type="submit" name="exp"value="3"></td>
            <td><input class="exp" type="submit" name="exp" value="-"></td>
        </tr>
        <tr>
            <td><input type="submit" name="exp" value="0"></td>
            <td><input type="submit" name="exp"value="."></td>
            <td><input class="exp" id="equal" name ="equal" type="submit" value="="></td>
            <td><input class="exp" type="submit" name="exp" value="+"></td>
        </tr>
        
        </tbody>
        </form>
    </table>
    </div>
    
</body>
</html>