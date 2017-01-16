<?php
include("../../config.php");
$val=$_GET['val'];
//echo "select * from main where name='$id'";
if(!empty($val))
{?>
 <select name="refid" class="form-control" required>

                <option value="" <?php if($sql[cat_id]==''){?>selected<?php } ?>>Select City</option>

                <?php $news1=mysql_query("select * from city where zone='$val' order by name asc ");

while ($state=mysql_fetch_assoc($news1)) {?>

				<option value="<?php echo $state['guid'];?>"><?php echo $state['name'];?></option>

                <?php } ?>

                </select>
<?php 
}
else 
{
?><select name="refid" class="form-control" required>

                <option value="">Select City</option>


                </select>
<?php 
}
 ?>