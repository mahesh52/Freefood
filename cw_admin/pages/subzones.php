<?php
include("../../config.php");
$val=$_GET['val'];
//echo "select * from main where name='$id'";
if(!empty($val))
{?>
 
<select class="form-control" name="zone" required onChange="return subcategories(this.value);">
             <option value="">Select Zone</option>
              <?php $qry=mysql_query("select * from zone where refid='$val' order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><option value='<?php echo $row["guid"];?>'><?php echo $row['name'];?></option><?php
			  }?>            	 	
			</select>
<?php 
}
else 
{
?><select name="zone" class="form-control" required>

                <option value="">Select Zone</option>


                </select>
<?php 
}
 ?>