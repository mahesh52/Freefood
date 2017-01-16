<?php
include("../../config.php");
$val=$_GET['val'];
//echo "select * from main where name='$id'";
if(!empty($val))
{$st=mysql_fetch_array(mysql_query("select * from zonal where guid='$val'"));
//echo "select * from city where zone='$st[zone]' order by name asc";?>
 

                <select class="form-control" name="city" required>
             <option value="">Select City</option>
              <?php $qry=mysql_query("select * from city where zone='$st[zone]' order by name asc");
			  while($row=mysql_fetch_assoc($qry))
			  {
				?><option value="<?php echo $row['guid'];?>" ><?php echo $row['name'];?></option><?php
			  }?>            	 	
			</select>
<?php 
}
else 
{
?><select name="city" class="form-control" required>

                <option value="">Select City</option>


                </select>
<?php 
}
 ?>