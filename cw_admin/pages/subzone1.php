<?php
include("../../config.php");
$val=$_GET['val'];
//echo "select * from main where name='$id'";
if(!empty($val))
{//$st=mysql_fetch_array(mysql_query("select * from zonal where guid='$val'"));?>
 

                <select class="form-control" name="zonal" required onChange="return subcity(this.value);">
             <option value="">Select Zonal Partner</option>
              <?php $qry=mysql_query("select * from zonal where state='$val' order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><option value="<?php echo $row['guid'];?>" ><?php echo $row['name'];?></option><?php
			  }?>            	 	
			</select>
<?php 
}
else 
{
?><select name="zonal" class="form-control" required>

                <option value="">Select Zonal Partner</option>


                </select>
<?php 
}
 ?>