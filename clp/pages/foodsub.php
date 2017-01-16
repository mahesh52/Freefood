<?php
include("../../config.php");
$val=$_GET['val'];
//echo "select * from main where name='$id'";
if(!empty($val))
{?>
 <select name="subcategory" class="form-control" required>

                <option value="" <?php if($sql[cat_id]==''){?>selected<?php } ?>>Select Sub Category</option>

                <?php $news1=mysql_query("select * from foodcategory where refid='$val' order by name desc ");

while ($state=mysql_fetch_assoc($news1)) {?>

				<option value="<?php echo $state[guid];?>"><?php echo $state[name];?></option>

                <?php } ?>

                </select>
<?php 
}
else 
{
?><select name="subcategory" class="form-control" required>

                <option value="">Select Sub Category</option>


                </select>
<?php 
}
 ?>