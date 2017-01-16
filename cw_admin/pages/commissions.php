<?php ob_start();
session_start();extract($_POST);extract($_GET);
include 'secure.php';include '../../config.php'; $date=date('Y-m-d');


if(isset($_POST) && $_POST['state']!='' && $_POST['Submit']=='Addstate')
{
mysql_query("INSERT INTO `commissions` (`company` ,`state`,`zonal`,`city`,`clp`,`misc`,`date`,`burnbudget`,`amount`,erfv) VALUES ('$company','$state','$zonal','$city','$clp','$misc','$date','$burnbudget','$amount','$erfv')");
header('location:commissions.php');	
}




?><!DOCTYPE html>
<html>
         <?php include "styles-files.php";
		 ?>
         <script type="text/javascript">
		 function delete1()
{
  if(window.confirm("Confirm delete"))
  {
  return true;
   }
 else
   return false;
}
		 </script>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
       	 <?php include "header.php"; ?>
		 <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
         	<?php include "side-nav.php"; ?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Commission Structure
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
                <?php if(isset($_GET) && $_GET[action]=='add'){?>
				
				<form action="commissions.php" method="post" name="form1" onSubmit="return valid()" enctype="multipart/form-data">
               <table class="table table-responsive table-bordered">
  <tr><td>Company %</td><td>
                        <input type="text" name="company" class="form-control" placeholder="Company %" required/>
                    </td></tr>
                    <tr><td>State %</td><td>
                        <input type="text" name="state" class="form-control" placeholder="State %" required/>
                    </td></tr>
                    <tr><td>Zonal %</td><td>
                        <input type="text" name="zonal" class="form-control" placeholder="Zonal %" required/>
                    </td></tr>
                    <tr><td>City %</td><td>
                        <input type="text" name="city" class="form-control" placeholder="City %" required/>
                    </td></tr>
                    <tr><td>CLP %</td><td>
                        <input type="text" name="clp" class="form-control" placeholder="CLP %" required/>
                    </td></tr>
					<tr><td>ERFV %</td><td>
                        <input type="text" name="erfv" class="form-control" placeholder="ERFV %" required/>
                    </td></tr>
                    <tr><td>Misc %</td><td>
                        <input type="text" name="misc" class="form-control" placeholder="Misc %" required/>
                    </td></tr>
                     <tr><td>Burn Budget %</td><td>
                        <input type="text" name="burnbudget" class="form-control" placeholder="Burn Budget %" required/>
                    </td></tr>
                    <tr><td>Min Virtual Amount /-</td><td>
                        <input type="text" name="amount" class="form-control" placeholder="Min Virtual Amount /-" required/>
                    </td></tr>
               <tr><td colspan="2">                                                            
                    <button type="submit" name="Submit" value="Addstate" class="btn bg-yellow btn-block">Add Commissions</button>  
                </td></tr></table>
            </form>
				<?php }else{?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="commissions.php?action=add"><button type="button" class="btn btn-success">Add Commissions</button></a>
                <section class="content">

				 <!-- top row -->
                   <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>Company</th>
                            <th>State</th>
                            <th>Zonal</th>
                            <th>City</th>
                            <th>CLP</th>
							<th>ERFV</th>
                            <th>Misc</th>
                            <th>Burn Budget</th>
                            <th>Min Virtual Amount</th>
                            <th>Updated On</th>
                           </tr>

                        </thead>

                        <tbody>

                         <?php 
include 'pageing.php';
						    $gridId = $_GET[guid];
							$limit = 90; 								

$filePath="commissions.php";

if($page) 
{
$start = ($page - 1) * $limit; 			
}
else
{
$start = 0;						
$page=1;
}
$query_clients="SELECT * FROM `commissions`  order by guid desc  Limit $start, $limit ";

$query_clients=mysql_query($query_clients);

$select1="SELECT * FROM `commissions`";

$total=mysql_num_rows(mysql_query($select1));

$otherParams="";

@$divs=$total%$limit;

	if($divs==0)

	{

	@$totals=(int)($total/$limit);

	}else{

	@$totals=(int)($total/$limit) + 1;

	}$m=1;
						    while($client_count = mysql_fetch_assoc($query_clients)){
								?>

                        	<tr>

                            	<td><?php echo $m; ?></td>
                                 <td><?php echo $client_count['company'];?>%</td>
                                 <td><?php echo $client_count['state'];?>%</td>
                               <td><?php echo $client_count['zonal'];?>%</td>
                               <td><?php echo $client_count['city'];?>%</td>
                               <td><?php echo $client_count['clp'];?>%</td>
							    <td><?php echo $client_count['erfv'];?>%</td>
                               <td><?php echo $client_count['misc'];?>%</td>
                               <td><?php echo $client_count['burnbudget'];?>%</td>
                               <td><?php echo $client_count['amount'];?>/-</td>
                               <td><?php echo date('d M Y',strtotime($client_count['date']));?></td>
                              </tr>

                          <?php $m++;} ?>

                        </tbody>

                        <tfoot>

                        	<tr>

                            	<th colspan="10"> Showing <?php echo $page;?> of <?php echo $totals;?> Pages </th>

                            </tr>

                        </tfoot>

                    </table>
                     <ul class="pagination">

                       <?php make_pages($page,$limit,$total,$filePath,$otherParams); ?>
                       

                    </ul></section><?php } ?>
            </aside><!-- /.right-side -->
        </div>
        <!-- ./wrapper -->
        <!-- add new calendar event modal -->
        <script>
function subcategories(s)
{//alert(s);
 $.ajax({
  type:"get",
  dataType:"text",
  url:"subcat.php",
  data:  "val="+s,
  success: function(response){
	  $('#subcagtegory').html(response);
  }
 });
}
function subcity(s)
{//alert(s);
 $.ajax({
  type:"get",
  dataType:"text",
  url:"subcity.php",
  data:  "val="+s,
  success: function(response){
	  $('#subcity').html(response);
  }
 });
}
</script>
       <?php include "footer-scripts.php" ?>
    </body>
</html>