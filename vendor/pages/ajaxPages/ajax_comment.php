<?php extract($_POST); 
include '../../../config.php';
 if($guid!= ''){ 
$detail=mysql_query("select * from `estimates` where car_id='$guid'");
?>
<table class="table table-responsive table-bordered"><tr><th>
                    <label>Sno</label></th><th>
                    <label>Amount</label></th><th>
                    <label>Dealer Details</label></th></tr>
                </div>
<?php $m=0;
while($det=mysql_fetch_assoc($detail))
{$m++;
 $est=mysql_fetch_array(mysql_query("select * from buyer where guid='$det[refid]'"));?>
 
                <tr><td>
                        <?php echo $m;?>
                   </td><td>
                        <?php echo $det[amount];?>
                    </td><td>
                        <?php echo $est[name];echo "&nbsp;";echo $est[lname];echo "<br>";
							   echo $est[email];echo "<br>";
							   echo $est[mobile]; ?>
                   </td></tr>
              <?php 
}?></table><?php }
 ?>
 	

