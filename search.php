<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form method="GET">
    <input type= "search" name="q">
    <button type="submit">Search</button>

    <?php

    $q=$_GET["q"]??""; //اذا كانت قيمة  q موجوده خزنها في $q
    //اذا مش موجوده خزنها فراغ
    

   if($q !=""){
        echo "Search result for: " .$q;
    } 

  



    ?>
</form>
    
</body>
</html>