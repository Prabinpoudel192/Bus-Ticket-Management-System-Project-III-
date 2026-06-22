<style>
#pra1{
    border:1px solid black;
    background:red;
    height:300px;
    width:500px;
    margin:50px;
    box-shadow:0px 20px;
    border-radius:30px;
}
#pra2{
    border-radius:30px;
    height:100%;
    width:100%;
    object-fit:cover;
}
</style>
<script>
let images = [
  "../images/background.jpg",
  "../images/bookticketlogo.png",
  "../images/logo.png",
  "../images/logouticon.webp"
];

let index = 0;

setInterval(() => {
    index = (index + 1) % images.length;
    document.getElementById("pra2").src = images[index];
}, 10000);

</script>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="pra1">
     <img id="pra2" src="../images/background.jpg">
    </div>
    
</body>
</html>