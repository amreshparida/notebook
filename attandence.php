<?php
session_start();

include 'conn.php';

if(!isset($_SESSION['email']))
{
    header("Location: index.php");
    exit();
}

if(isset($_POST['attandence']))
{
    $date = $_POST['attn_date'];
    foreach($_POST['tk_attandence'] as $att)
    {
        $sql = "INSERT INTO attendence SET stud_id = '$att', att_date = '$date' ";
        $conn->query($sql);
    }
}






?>


<html>
    <body>

    <a href="view_attandence.php">View Attandence</a>

    <h3>Student Attandence</h3>

    <form action="" method="post">

<table>
    <tr>
        <th style="border:1px solid black; padding:10px;">#</th>
        <th style="border:1px solid black; padding:10px;">Roll No.</th>
        <th style="border:1px solid black; padding:10px;">Student Name</th>
        <th style="border:1px solid black; padding:10px;">
        Date
            <input required type="date" name="attn_date" />
        </th>
    </tr>


    <?php


$sql = "SELECT * FROM students ";
$result = $conn->query($sql);


if($result->num_rows > 0)
{

    while($row = $result->fetch_assoc()) {

?>


    <tr>
        <td style="border:1px solid black; padding:10px;">
            <input type="checkbox" name="tk_attandence[]" value="<?php echo $row['id'] ?>" />
        </td>
        <td style="border:1px solid black; padding:10px;"><?php echo $row['id'] ?></td>
        <td colspan="2" style="border:1px solid black; padding:10px;"><?php echo $row['student_name'] ?></td>
        
    </tr>

<?php } } ?>



</table>

<br/>
<input type="submit" value="Take Attandence" name="attandence" />

</form>

    </body>
</html>