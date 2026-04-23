 <div class="table-box">
        <h3 style="margin-bottom:10px;">Recent Bookings</h3>

        <table>
            <tr>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Gender</th>
                <th>Username</th>
                <th>Password</th>
            </tr><tbody id="tbbody">

               <script>
    $(document).ready(function(){
    $(".btn2").click(function(){
    $.ajax({
        url:"test1.php",
        type:"POST",
        
        success:function(data){
        $("#tbbody").html(data);

        }
    });

});
});
   </script>
        