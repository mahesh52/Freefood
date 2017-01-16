<?php
include("../../config.php");
$val=$_GET['val'];
//echo "select * from main where name='$id'";
if(!empty($val))
{$st=mysql_fetch_array(mysql_query("select * from town where guid='$val'"));?>
 <?php $m=0;$news1=mysql_query("select * from area where refid='$st[city]' order by name asc ");

while ($state=mysql_fetch_assoc($news1)) {$m++;
if($m%8==0){echo "<br>";}?><label>
<input type="checkbox" name="areas[]" value="<?php echo $state['guid'];?>"><?php echo $state['name'];?></label>&nbsp;
                <?php } ?>
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