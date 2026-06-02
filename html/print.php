


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
    function printed(){
        document.body.style.display="none";
        document.getElementById("printable").style.display="block";
        window.print();
        document.body.style.display="block";
    }

    </script>
   

</head>
<body>
    <div >
        <div id="printable" style="height:500px;width:500px; padding:10px; background:url('../images/background.jpg');background-size:cover; repeat-x:no-repeat; repeat-y:no-repeat;">

        </div>
       <button onclick="printed()">Print</button>
    
    
</div>
</body>
</html>