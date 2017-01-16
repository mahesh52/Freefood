<?php
include("../config.php");
$val=$_GET['val'];
//echo "select * from main where name='$id'";
if(!empty($val))
{?>
 <select name="city" class="form-control" required onChange="return areaval(this.value);">

                <option value="">Select City</option>

                <?php $news1=mysql_query("select * from city where refid='$val' order by name asc ");

while ($state=mysql_fetch_assoc($news1)) {?>

				<option value="<?php echo $state['guid'];?>"><?php echo $state['name'];?></option>

                <?php } ?>

                </select>
<?php 
}
else 
{
?><select name="city" class="form-control" required onChange="return areaval(this.value);">

                <option value="">Select City</option>


                </select>
<?php 
}
 ?>