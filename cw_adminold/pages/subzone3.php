<?php
include("../../config.php");
$val=$_GET['val'];
//echo "select * from main where name='$id'";
if(!empty($val))
{//$st=mysql_fetch_array(mysql_query("select * from zonal where guid='$val'"));?>
 

                <select class="form-control" name="town" required onChange="return subtown(this.value);">
             <option value="">Select Town</option>
              <?php $qry=mysql_query("select * from town where zonal='$val' order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><option value="<?php echo $row['guid'];?>" ><?php echo $row['name'];?></option><?php
			  }?>            	 	
			</select>
<?php 
}
else 
{
?><select name="city" class="form-control" required onChange="return subtown(this.value);">

                <option value="">Select Town</option>


                </select>
<?php 
}
 ?>