<?php
include("../../config.php");
$val=$_GET['val'];
//echo "select * from main where name='$id'";
if(!empty($val))
{?>
 <select name="area" class="form-control" required>

                <option value="" selected>Select Area</option>

                <?php $news1=mysql_query("select * from area where refid='$val' order by name desc ");

while ($state=mysql_fetch_assoc($news1)) {?>

				<option value="<?php echo $state['guid'];?>"><?php echo $state['name'];?></option>

                <?php } ?>

                </select>
<?php 
}
else 
{
?><select name="area" class="form-control" required>

                <option value="">Select Area</option>


                </select>
<?php 
}
 ?>