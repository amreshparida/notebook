<?php
session_start();

include 'conn.php';

if(!isset($_SESSION['email']))
{
    header("Location: index.php");
    exit();
}

?>


<html>
    <body>
    <a href="attandence.php">Take Attandence</a>
        <br/>
<h3>View Attandence</h3>
    <table>
    <tr>
        <th style="border:1px solid black; padding:10px;">#</th>
        <th style="border:1px solid black; padding:10px;">Roll No.</th>
        <th style="border:1px solid black; padding:10px;">Student Name</th>
        <th style="border:1px solid black; padding:10px;">
        Date
            <form action="" id="show" method="post">
                <input onchange="show();"  required type="date" name="attn_date" />
            </form>
        </th>
    </tr>


<?php 

if(isset($_POST['attn_date']))
{

    $date = $_POST['attn_date'];
   
    $sql = "SELECT a.*, s.student_name FROM attendence as a LEFT JOIN students as s on a.stud_id = s.id WHERE a.att_date = '$date' ";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {

        while($row = $result->fetch_assoc()) {

?>

    <tr>
        <td style="border:1px solid black; padding:10px;">
            <input type="checkbox" name="tk_attandence[]" checked disabled value="<?php echo $row['stud_id'] ?>" />
        </td>
        <td style="border:1px solid black; padding:10px;"><?php echo $row['stud_id'] ?></td>
        <td colspan="2" style="border:1px solid black; padding:10px;"><?php echo $row['student_name'] ?></td>
        
    </tr>

<?php } } }  ?>


    </table>


<script>
    function show()
    {
        document.getElementById("show").submit();
    }
</script>

    </body>
</html>