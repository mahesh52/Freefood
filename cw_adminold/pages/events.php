<?php ob_start();
session_start();extract($_POST);
include 'secure.php';include '../../config.php'; 
if(isset($_GET) && $_GET[delid]!='')
{
mysql_query("delete from tickets where guid='$_GET[delid]'");
header('location:events.php?action=view&gid='.$_GET[gid]);	
	
}
if(isset($_GET) && $_GET[deleteid]!='')
{
mysql_query("delete from events where guid='$_GET[deleteid]'");
header('location:events.php');	
}
if(isset($_POST) && $_POST[event_title]!='')
{//print_r($_POST);exit;
	$from=strtotime($fromdate);$from_date=date('Y-m-d',$from);$to=strtotime($todate);$to_date=date('Y-m-d',$to);
	 $logo=$_FILES[image][name];
		 if(!empty($logo)){
			 $lgo=time().$logo;
			 move_uploaded_file($_FILES[image][tmp_name],"../../uploads/$lgo");
			 mysql_query("update events set image='$lgo' where guid='$guid'");
		 }
	$query="update `events` set `event_title`='$event_title' ,`location`='$location' ,`fromdate`='$from_date' ,`fromtime`='$fromtime' ,`todate`='$to_date' ,`totime`='$totime' ,`event_desc`='$event_desc' ,`organiser`='$organiser' ,`list_privacy`='$list_privacy' ,`event_type`='$event_type' ,`event_topic`='$event_topic' ,`tickets`='$tickets',`publish`='$publish' where guid='$guid'";
	mysql_query($query);
	$free=count($free_ticket);
	for($i=0;$i<$free;$i++)
	{
		if($refid1[$i]=='')
		{
	mysql_query("INSERT INTO `tickets` (`ticket_type` , `ticket_name`,`ticket_qty` ,`ticket_price` ,`refid`) VALUES ('Free','$free_ticket[$i]', '$free_ticket_quantity[$i]', '0', '$guid')");
		}
		else
		{
		mysql_query("update `tickets` set  `ticket_name`='$free_ticket[$i]',`ticket_qty`='$free_ticket_quantity[$i]' where guid='$refid1[$i]'");	
		}
	}
	$paid=count($paid_ticket);
	for($i=0;$i<$paid;$i++)
	{
		if($refid2[$i]=='')
		{
	mysql_query("INSERT INTO `tickets` (`ticket_type` , `ticket_name`,`ticket_qty` ,`ticket_price` ,`refid`) VALUES ('Paid','$paid_ticket[$i]', '$paid_ticket_quantity[$i]', '$paid_ticket_price[$i]', '$guid')");
	}
		else
		{
		mysql_query("update `tickets` set  `ticket_name`='$paid_ticket[$i]',`ticket_qty`='$paid_ticket_quantity[$i]',`ticket_price`='$paid_ticket_price[$i]' where guid='$refid2[$i]'");	
		}
	}
	$donation=count($donation_ticket);
	for($i=0;$i<$donation;$i++)
	{
		if($refid3[$i]=='')
		{
	mysql_query("INSERT INTO `tickets` (`ticket_type` , `ticket_name`,`ticket_qty` ,`ticket_price` ,`refid`) VALUES ('Donation','$donation_ticket[$i]', '$donation_ticket_quantity[$i]', '$donation_ticket_price[$i]', '$guid')");
	}
		else
		{
		mysql_query("update `tickets` set  `ticket_name`='$donation_ticket[$i]',`ticket_qty`='$donation_ticket_quantity[$i]',`ticket_price`='$donation_ticket_price[$i]' where guid='$refid3[$i]'");	
		}
	}
header('location:events.php');
}?><!DOCTYPE html>
<html>
         <?php include "styles-files.php";
		 ?>
         <link href="../css/agency.css" rel="stylesheet">
          <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script>

$(function() {

$( ".my-date" ).datepicker();


});
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
<script type="text/javascript">
	function valid()
	{
	
	if(document.form1.event_title.value=='')
	{
	alert("Please Enter Event Title");
	document.form1.event_title.focus();
	return false;	
	}
	if(document.form1.location.value=='')
	{
	alert("Please Enter Location");
	document.form1.location.focus();
	return false;	
	}
	if(document.form1.fromdate.value=='')
	{
	alert("Please Enter Start Date");
	document.form1.fromdate.focus();
	return false;	
	}
	if(document.form1.todate.value=='')
	{
	alert("Please Enter Ending Date");
	document.form1.todate.focus();
	return false;	
	}
	
	return true;
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
                        <?php if(isset($_GET) && $_GET[action]=='viewdet'){
		$det=mysql_fetch_array(mysql_query("SELECT * FROM `events` where guid='$_GET[gid]'"));
		echo $det[event_title]; echo "&nbsp;";echo "Event Registrations";
		}else{echo "Events";}?> 
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Admin</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
<?php if(isset($_GET) && $_GET[action]=='view'){
	$details=mysql_fetch_array(mysql_query("select * from events where guid='$_GET[gid]'"));?>
	<form name="form1" method="post" action="events.php" enctype="multipart/form-data" onSubmit="return valid();">
	<div class="col-md-12 no-padd">
				   <div class="col-sm-12">
							<div class="col-sm-12 eventbg">
									<div class="panel-body" id="step1">
										<div class="col-xs-12 no-padd text-center eventtitle">
											<span class="glyphicon glyphicon-star" aria-hidden="true"></span> Event Details - Step-1 <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
										</div>
										<div class="panel-body"><br>
											<div class="col-sm-12 no-padd">
												<div class="col-sm-6">
												  <label>Event Title</label>
												  <span><input type="text" class="form-control" name="event_title" value="<?php echo $details[event_title];?>" required placeholder="Give it a short distinct name" /></span>
												</div>
												<div class="col-sm-6">
												  <label>Location</label>
												  <span><input type="text" class="form-control" id="geocomplete" name="location" value="<?php echo $details[location];?>" required placeholder="Specify where it is held" /></span>
												</div>
												<div class="col-sm-6">
												  <label>Starts</label><div class="clearfix"></div>
												  <div class="col-sm-6 no-padd">
													  <span><input type="text" class="form-control col-sm-6 my-date" name="fromdate" value="<?php echo $details[fromdate];?>"  required/></span>
												  </div>
												  <div class="col-sm-6 no-padd">
													  <span><select class="form-control col-sm-6" name="fromtime">
                                                      <option <?php if($details[fromtime]=='00:00:00'){?>selected<?php } ?>>00:00</option>
                                                      <option <?php if($details[fromtime]=='00:30:00'){?>selected<?php } ?>>00:30</option>
                                                      <option <?php if($details[fromtime]=='01:00:00'){?>selected<?php } ?>>01:00</option>
                                                      <option <?php if($details[fromtime]=='00:30:00'){?>selected<?php } ?>>01:30</option>
                                                      <option <?php if($details[fromtime]=='02:00:00'){?>selected<?php } ?>>02:00</option>
                                                      <option <?php if($details[fromtime]=='02:30:00'){?>selected<?php } ?>>02:30</option>
                                                      <option <?php if($details[fromtime]=='03:00:00'){?>selected<?php } ?>>03:00</option>
                                                      <option <?php if($details[fromtime]=='03:30:00'){?>selected<?php } ?>>03:30</option>
                                                      <option <?php if($details[fromtime]=='04:00:00'){?>selected<?php } ?>>04:00</option>
                                                      <option <?php if($details[fromtime]=='04:30:00'){?>selected<?php } ?>>04:30</option>
                                                      <option <?php if($details[fromtime]=='05:00:00'){?>selected<?php } ?>>05:00</option>
                                                      <option <?php if($details[fromtime]=='05:30:00'){?>selected<?php } ?>>05:30</option>
                                                      <option <?php if($details[fromtime]=='06:00:00'){?>selected<?php } ?>>06:00</option>
                                                      <option <?php if($details[fromtime]=='06:30:00'){?>selected<?php } ?>>06:30</option>
                                                      <option <?php if($details[fromtime]=='07:00:00'){?>selected<?php } ?>>07:00</option>
                                                      <option <?php if($details[fromtime]=='07:30:00'){?>selected<?php } ?>>07:30</option>
                                                      <option <?php if($details[fromtime]=='08:00:00'){?>selected<?php } ?>>08:00</option>
                                                      <option <?php if($details[fromtime]=='08:30:00'){?>selected<?php } ?>>08:30</option>
                                                      <option <?php if($details[fromtime]=='09:00:00'){?>selected<?php } ?>>09:00</option>
                                                      <option <?php if($details[fromtime]=='09:30:00'){?>selected<?php } ?>>09:30</option>
                                                      <option <?php if($details[fromtime]=='10:00:00'){?>selected<?php } ?>>10:00</option>
                                                      <option <?php if($details[fromtime]=='10:30:00'){?>selected<?php } ?>>10:30</option>
                                                      <option <?php if($details[fromtime]=='11:00:00'){?>selected<?php } ?>>11:00</option>
                                                      <option <?php if($details[fromtime]=='11:30:00'){?>selected<?php } ?>>11:30</option>
                                                      <option <?php if($details[fromtime]=='12:00:00'){?>selected<?php } ?>>12:00</option>
                                                      <option <?php if($details[fromtime]=='12:30:00'){?>selected<?php } ?>>12:30</option>
                                                      <option <?php if($details[fromtime]=='13:00:00'){?>selected<?php } ?>>13:00</option>
                                                      <option <?php if($details[fromtime]=='13:30:00'){?>selected<?php } ?>>13:30</option>
                                                      <option <?php if($details[fromtime]=='14:00:00'){?>selected<?php } ?>>14:00</option>
                                                      <option <?php if($details[fromtime]=='14:30:00'){?>selected<?php } ?>>14:30</option>
                                                      <option <?php if($details[fromtime]=='15:00:00'){?>selected<?php } ?>>15:00</option>
                                                      <option <?php if($details[fromtime]=='15:30:00'){?>selected<?php } ?>>15:30</option>
                                                      <option <?php if($details[fromtime]=='16:00:00'){?>selected<?php } ?>>16:00</option>
                                                      <option <?php if($details[fromtime]=='16:30:00'){?>selected<?php } ?>>16:30</option>
                                                      <option <?php if($details[fromtime]=='17:00:00'){?>selected<?php } ?>>17:00</option>
                                                      <option <?php if($details[fromtime]=='17:30:00'){?>selected<?php } ?>>17:30</option>
                                                      <option <?php if($details[fromtime]=='18:00:00'){?>selected<?php } ?>>18:00</option>
                                                      <option <?php if($details[fromtime]=='18:30:00'){?>selected<?php } ?>>18:30</option>
                                                      <option <?php if($details[fromtime]=='19:00:00'){?>selected<?php } ?>>19:00</option>
                                                      <option <?php if($details[fromtime]=='19:30:00'){?>selected<?php } ?>>19:30</option>
                                                      <option <?php if($details[fromtime]=='20:00:00'){?>selected<?php } ?>>20:00</option>
                                                      <option <?php if($details[fromtime]=='20:30:00'){?>selected<?php } ?>>20:30</option>
                                                      <option <?php if($details[fromtime]=='21:00:00'){?>selected<?php } ?>>21:00</option>
                                                      <option <?php if($details[fromtime]=='21:30:00'){?>selected<?php } ?>>21:30</option>
                                                      <option <?php if($details[fromtime]=='22:00:00'){?>selected<?php } ?>>22:00</option>
                                                      <option <?php if($details[fromtime]=='22:30:00'){?>selected<?php } ?>>22:30</option>
                                                      <option <?php if($details[fromtime]=='23:00:00'){?>selected<?php } ?>>23:00</option>
                                                      <option <?php if($details[fromtime]=='23:30:00'){?>selected<?php } ?>>23:30</option>
                                                      </select></span>
												  </div>
												</div>
												<div class="col-sm-6">
												  <label>Ends</label><div class="clearfix"></div>
												  <div class="col-sm-6 no-padd">
													  <span><input type="text" class="form-control col-sm-6 my-date" value="<?php echo $details[todate];?>" name="todate" placeholder="" required/></span>
												  </div>
												  <div class="col-sm-6 no-padd">
													  <span><select class="form-control col-sm-6" name="totime">
                                                     <option <?php if($details[totime]=='00:00:00'){?>selected<?php } ?>>00:00</option>
                                                      <option <?php if($details[totime]=='00:30:00'){?>selected<?php } ?>>00:30</option>
                                                      <option <?php if($details[totime]=='01:00:00'){?>selected<?php } ?>>01:00</option>
                                                      <option <?php if($details[totime]=='00:30:00'){?>selected<?php } ?>>01:30</option>
                                                      <option <?php if($details[totime]=='02:00:00'){?>selected<?php } ?>>02:00</option>
                                                      <option <?php if($details[totime]=='02:30:00'){?>selected<?php } ?>>02:30</option>
                                                      <option <?php if($details[totime]=='03:00:00'){?>selected<?php } ?>>03:00</option>
                                                      <option <?php if($details[totime]=='03:30:00'){?>selected<?php } ?>>03:30</option>
                                                      <option <?php if($details[totime]=='04:00:00'){?>selected<?php } ?>>04:00</option>
                                                      <option <?php if($details[totime]=='04:30:00'){?>selected<?php } ?>>04:30</option>
                                                      <option <?php if($details[totime]=='05:00:00'){?>selected<?php } ?>>05:00</option>
                                                      <option <?php if($details[totime]=='05:30:00'){?>selected<?php } ?>>05:30</option>
                                                      <option <?php if($details[totime]=='06:00:00'){?>selected<?php } ?>>06:00</option>
                                                      <option <?php if($details[totime]=='06:30:00'){?>selected<?php } ?>>06:30</option>
                                                      <option <?php if($details[totime]=='07:00:00'){?>selected<?php } ?>>07:00</option>
                                                      <option <?php if($details[totime]=='07:30:00'){?>selected<?php } ?>>07:30</option>
                                                      <option <?php if($details[totime]=='08:00:00'){?>selected<?php } ?>>08:00</option>
                                                      <option <?php if($details[totime]=='08:30:00'){?>selected<?php } ?>>08:30</option>
                                                      <option <?php if($details[totime]=='09:00:00'){?>selected<?php } ?>>09:00</option>
                                                      <option <?php if($details[totime]=='09:30:00'){?>selected<?php } ?>>09:30</option>
                                                      <option <?php if($details[totime]=='10:00:00'){?>selected<?php } ?>>10:00</option>
                                                      <option <?php if($details[totime]=='10:30:00'){?>selected<?php } ?>>10:30</option>
                                                      <option <?php if($details[totime]=='11:00:00'){?>selected<?php } ?>>11:00</option>
                                                      <option <?php if($details[totime]=='11:30:00'){?>selected<?php } ?>>11:30</option>
                                                      <option <?php if($details[totime]=='12:00:00'){?>selected<?php } ?>>12:00</option>
                                                      <option <?php if($details[totime]=='12:30:00'){?>selected<?php } ?>>12:30</option>
                                                      <option <?php if($details[totime]=='13:00:00'){?>selected<?php } ?>>13:00</option>
                                                      <option <?php if($details[totime]=='13:30:00'){?>selected<?php } ?>>13:30</option>
                                                      <option <?php if($details[totime]=='14:00:00'){?>selected<?php } ?>>14:00</option>
                                                      <option <?php if($details[totime]=='14:30:00'){?>selected<?php } ?>>14:30</option>
                                                      <option <?php if($details[totime]=='15:00:00'){?>selected<?php } ?>>15:00</option>
                                                      <option <?php if($details[totime]=='15:30:00'){?>selected<?php } ?>>15:30</option>
                                                      <option <?php if($details[totime]=='16:00:00'){?>selected<?php } ?>>16:00</option>
                                                      <option <?php if($details[totime]=='16:30:00'){?>selected<?php } ?>>16:30</option>
                                                      <option <?php if($details[totime]=='17:00:00'){?>selected<?php } ?>>17:00</option>
                                                      <option <?php if($details[totime]=='17:30:00'){?>selected<?php } ?>>17:30</option>
                                                      <option <?php if($details[totime]=='18:00:00'){?>selected<?php } ?>>18:00</option>
                                                      <option <?php if($details[totime]=='18:30:00'){?>selected<?php } ?>>18:30</option>
                                                      <option <?php if($details[totime]=='19:00:00'){?>selected<?php } ?>>19:00</option>
                                                      <option <?php if($details[totime]=='19:30:00'){?>selected<?php } ?>>19:30</option>
                                                      <option <?php if($details[totime]=='20:00:00'){?>selected<?php } ?>>20:00</option>
                                                      <option <?php if($details[totime]=='20:30:00'){?>selected<?php } ?>>20:30</option>
                                                      <option <?php if($details[totime]=='21:00:00'){?>selected<?php } ?>>21:00</option>
                                                      <option <?php if($details[totime]=='21:30:00'){?>selected<?php } ?>>21:30</option>
                                                      <option <?php if($details[totime]=='22:00:00'){?>selected<?php } ?>>22:00</option>
                                                      <option <?php if($details[totime]=='22:30:00'){?>selected<?php } ?>>22:30</option>
                                                      <option <?php if($details[totime]=='23:00:00'){?>selected<?php } ?>>23:00</option>
                                                      <option <?php if($details[totime]=='23:30:00'){?>selected<?php } ?>>23:30</option>
                                                      </select></span>
												  </div>
												</div>
												<div class="col-sm-4">
												  <label>Event Image</label><div class="clearfix"></div>
												  <img src="<?php if($details[image]==''){?>../../img/upload-img.png<?php } else{?>../../uploads/<?php echo $details[image];?><?php } ?>" id="blah" alt="" class="" width="200" height="152"/>
												  
                                                  <div class="fileupload fileupload-new" data-provides="fileupload">

                                  <span class="btn btn-white btn-file" style="border:0">

                                  <img src="../../img/upload_black.png" alt="" class="center-block"/>

                                  <span class="fileupload-new"><i class="icon-paper-clip"></i> Upload Logo</span>

                                  <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>

                                  <input type="file" class="default" name="image" id="imgInp">

                                  </span>

                                </div>
												</div>
												<div class="col-sm-8">
												  <label>Event Description</label>
												  <span><textarea type="text" class="form-control" name="event_desc" placeholder="Enter event description" rows="5"/><?php echo $details[event_desc];?></textarea></span>
												</div>
												<div class="col-sm-8">
												  <label>Organiser Name</label>
												  <span><input type="text" class="form-control" name="organiser" placeholder="Organiser" value="<?php echo $details[organiser];?>"/>
                                                  <input type="hidden" id="delid" value="1"></span>
												</div>
											</div>
										</div>
										
									</div>
									
									
									
									
									<div class="panel-body" id="step2">
										<div class="col-xs-12 no-padd text-center eventtitle">
											<span class="glyphicon glyphicon-star" aria-hidden="true"></span> Create Tickets - Step-2 <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
										</div>
										<div class="col-sm-12">
											<br><span align="center" class="greentext">What type of ticket would you like to start with?</span><br><br>
										</div>
										<div class="col-sm-12 no-padd" id="add-ticket">
											<?php $qry=mysql_query("select * from tickets where refid='$details[guid]' and ticket_type='Free'");
											while($row=mysql_fetch_assoc($qry)){?>
											<div class="border-bottm no-padd">
                                            <div class="col-sm-4"><span><input type="text" class="form-control" name="free_ticket[]" placeholder="Ticket Name"  value="<?php echo $row[ticket_name];?>"/></span></div>
                                            <div class="col-sm-3"><span><input type="text" class="form-control" name="free_ticket_quantity[]" value="<?php echo $row[ticket_qty];?>" placeholder="Quantity Available" />
                                            <input type="hidden" name="refid1[]" value="<?php echo $row[guid];?>"></span></div>
                                            <div class="col-sm-3 col-xs-6"><span class="form-control1">Free Ticket</span></div>
                                            <div class="col-sm-2 col-xs-6"><a href="events.php?delid=<?php echo $row[guid];?>&gid=<?php echo $row[refid];?>" onClick="return delete1();"><span class="form-control1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></span></a></div></div><div class="clearfix"></div>
											<?php } ?>
                                            <?php $qry=mysql_query("select * from tickets where refid='$details[guid]' and ticket_type='Paid'");
											while($row=mysql_fetch_assoc($qry)){?>
											<div class="border-bottm no-padd">
                                            <div class="col-sm-4" id="delete-id"><span><input type="text" class="form-control" name="paid_ticket[]" placeholder="Ticket Name" value="<?php echo $row[ticket_name];?>"/></span></div>
                                            <div class="col-sm-3"><span><input type="text" class="form-control" name="paid_ticket_quantity[]" placeholder="Quantity Available" value="<?php echo $row[ticket_qty];?>"/></span></div>
                                            <div class="col-sm-3"><span><input type="text" class="form-control" name="paid_ticket_price[]" value="<?php echo $row[ticket_price];?>" placeholder="Price" /><input type="hidden" name="refid2[]" value="<?php echo $row[guid];?>"></span></div><div class="col-sm-2">
                                            <a href="events.php?delid=<?php echo $row[guid];?>&gid=<?php echo $row[refid];?>" onClick="return delete1();"><span class="form-control1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></span></a></div></div><div class="clearfix"></div>
											<?php } ?>
                                            <?php $qry=mysql_query("select * from tickets where refid='$details[guid]' and ticket_type='Donation'");
											while($row=mysql_fetch_assoc($qry)){?>
											<div class="border-bottm no-padd">
                                            <div class="col-sm-4"><span><input type="text" class="form-control" name="donation_ticket[]" placeholder="Ticket Name" value="<?php echo $row[ticket_name];?>"/></span></div>
                                            <div class="col-sm-3"><span><input type="text" class="form-control" name="donation_ticket_quantity[]" placeholder="Quantity Available" value="<?php echo $row[ticket_qty];?>"/><input type="hidden" name="refid3[]" value="<?php echo $row[guid];?>"></span></div>
                                            <div class="col-sm-3"><span><input type="text" class="form-control" name="donation_ticket_price[]" placeholder="Quantity Available" value="<?php echo $row[ticket_price];?>"/></span></div>
                                            <div class="col-sm-2"><a href="events.php?delid=<?php echo $row[guid];?>&gid=<?php echo $row[refid];?>" onClick="return delete1();">
                                            <span class="form-control1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></span></a></div></div>
                                            <div class="clearfix"></div>
											<?php } ?>
										</div>
										<div class="col-sm-12">
											<a href="javascript:void(0);" class="textwhite btn1 btn-default add-ticket-free"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Free Ticket</a>
											<a href="javascript:void(0);" class="textwhite btn1 btn-default add-ticket-paid"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Paid Ticket</a>
											<a href="javascript:void(0);" class="textwhite btn1 btn-default add-ticket-donation"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Donations</a><br><br>
										</div>
										
									</div>
									
									
									
									<div class="panel-body" id="step3" >
										<div class="col-xs-12 no-padd text-center eventtitle">
											<span class="glyphicon glyphicon-star" aria-hidden="true"></span> Additional Settings - Step-3 <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
										</div>
										<div class="col-sm-12">
											<br><label><strong>Listing privacy</strong></label><br><br>
											<div class="col-sm-12">
											<label>
											  <input type="radio" name="list_privacy" value="public" <?php if($details[list_privacy]=='public'){?> checked<?php } ?>>
											  Public page: list this event on AMAR Event and search engines
											</label><br><br>
											</div>
											
											<div class="col-sm-12">
											<label>
											  <input type="radio" name="list_privacy" value="private" <?php if($details[list_privacy]=='private'){?> checked<?php } ?>>
											  Private page: do not list this event publicly
											</label><br><br>
											</div>
											
											<div class="col-sm-12">
											<label>Event Type</label>
											<select name="event_type" class="form-control">
												<option value="" selected="selected">Select the Type of event</option>
												<?php $query=mysql_query("select * from category order by name asc");
					   while($row=mysql_fetch_assoc($query))
					   {?>
                        <option  value="<?php echo $row[guid]?>" <?php if($details[event_type]==$row[guid]){?>selected<?php } ?>><?php echo $row[name];?></option>
                        <?php } ?>
                        </select><br>
											</div>
											
											<div class="col-sm-12">
											<label>Event Topic</label>
											<select name="event_topic" class="form-control">
												<option value="" selected="selected">Select the Topic of event</option>
												<?php $query=mysql_query("select * from subcategory order by name asc");
					   while($row=mysql_fetch_assoc($query))
					   {?>
                        <option  value="<?php echo $row[guid]?>" <?php if($details[event_topic]==$row[guid]){?>selected<?php } ?>><?php echo $row[name];?></option>
                        <?php } ?>
                        </select><br>
											</div>
											
											<div class="col-sm-12">
											<label>REMAINING TICKETS<br>
											  <input type="checkbox" name="tickets" value="yes" <?php if($details[tickets]=='yes'){?>checked<?php } ?>>
											  Show the number of tickets remaining on the registration page
											</label>
											</div>
											
										</div>
										
										<div class="col-sm-12">
                                        <input type="hidden" name="guid" value="<?php echo $details[guid];?>">
                                        <a href="javascript:void(0);" class="textwhite btn1 btn-default make"><input type="checkbox" <?php if($details[publish]=='yes'){?>checked<?php } ?> name="publish" value="yes"> Make Your Event Live</a>
											<button type="submit" class="textwhite btn1 btn-default choose"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Save</button>
											
										</div>
										
									</div>
									
									
							</div>
							
						<div class="clearfix"></div>
							
							
				   </div>
					<div class="clearfix"></div>
                </div></form>
	<?php }elseif(isset($_GET) && $_GET[action]=='viewdet'){
		$det=mysql_fetch_array(mysql_query("SELECT * FROM `events` where guid='$_GET[gid]'"));
		?>
		<table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>Name</th>

                           <th>Email</th>
                           <th>Quantity</th>
                           
                           
                           </tr>

                        </thead>

                        <tbody>

                         <?php 


$query_clients="SELECT * FROM `book_tickets` where eventid='$_GET[gid]' order by guid desc";

$query_clients=mysql_query($query_clients);$m=0;
		    while($client_count = mysql_fetch_assoc($query_clients)){
								$m++;?>

                        	<tr>

                            	<td><?php echo $m; ?></td>

                                <td><?php echo $client_count[name]; ?></td>

                               <td><?php echo $client_count[email]; ?></td>
                               <td><?php echo $client_count[ticket_qty]; ?></td>

                            </tr>

                          <?php $m++;} ?>

                        </tbody>

                       

                    </table>
		<?php
	}else{?>
				 <!-- top row -->
                   <table class="table table-responsive table-bordered">

                    	<thead>

                          <tr>

                        	

                            <th>Sno</th>
                            <th>Event Title</th>

                           <th>Location</th>
                           <th>Starts</th>
                           <th>Ends</th>
                           <th>View / Edit Full Details</th>
                           <th>Event Registrations</th>
                           <th>Delete</th>
                           
                           </tr>

                        </thead>

                        <tbody>

                         <?php 
extract($_GET);include 'pageing.php';
						    $gridId = $_GET[guid];
							$limit = 90; 								

if($page) 

$start = ($page - 1) * $limit; 			

else

$start = 0;						

$filePath="events.php";
$page=1;
//echo "select * from cat  Limit $start, $limit";

$query_clients="SELECT * FROM `events`  order by guid desc  Limit $start, $limit ";

$query_clients=mysql_query($query_clients);

$select1="SELECT * FROM `events`";

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
								$check=mysql_num_rows(mysql_query("select * from book_tickets where eventid='$client_count[guid]'"));
								?>

                        	<tr>

                            	<td><?php echo $m; ?></td>

                                <td><?php echo $client_count[event_title]; ?></td>

                               <td><?php echo $client_count[location]; ?></td>
                               <td><?php $from=strtotime($client_count[fromdate]);$from_date=date('d M Y',$from);
									echo $from_date;echo "&nbsp;"; echo $client_count[fromtime];?></td>
                                     <td><?php $to=strtotime($client_count[todate]);$to_date=date('d M Y',$to);
									echo $to_date;echo "&nbsp;"; echo $client_count[totime];?></td>
                               <td><a href="events.php?action=view&gid=<?php echo $client_count[guid]; ?>"><button type="button" class="btn btn-success">View Details</button></a></td>
                               <td>
                               <?php if($check>0){?><a href="events.php?action=viewdet&gid=<?php echo $client_count[guid]; ?>"><button type="button" class="btn btn-success"><?php echo $check;?></button></a><?php } else{?><button type="button" class="btn btn-success"><?php echo $check;?></button><?php }?></td>
                               <td><a href="events.php?action=delete&deleteid=<?php echo $client_count[guid]; ?>" onClick="return delete1();"><button type="button" class="btn btn-danger">Delete</button></a></td>

                            </tr>

                          <?php $m++;} ?>

                        </tbody>

                        <tfoot>

                        	<tr>

                            	<th colspan="6"> Showing <?php echo $page;?> of <?php echo $totals;?> Pages </th>

                            </tr>

                        </tfoot>

                    </table>
                     <ul class="pagination">

                       <?php make_pages($page,$limit,$total,$filePath,$otherParams); ?>
                       

                    </ul><?php } ?></section>
            </aside><!-- /.right-side -->
        </div>
        <script>
	
	$('body').on('click', '.add-ticket-free', function(){
		var s=document.getElementById('delid').value;
		$('#add-ticket').append('<div class="border-bottm no-padd" id="del'+s+'"><div class="col-sm-4" id="delete-id"><span><input type="text" class="form-control" name="free_ticket[]" placeholder="Ticket Name" /></span></div><div class="col-sm-3"><span><input type="text" class="form-control" name="free_ticket_quantity[]" placeholder="Quantity Available" /></span></div><div class="col-sm-3 col-xs-6"><span class="form-control1">Free Ticket</span></div><div class="col-sm-2 col-xs-6"><span class="form-control1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-trash" aria-hidden="true" onclick="deleteid('+s+')"></span></span></div></div><div class="clearfix"></div>');
		document.getElementById('delid').value=parseInt(s)+1;
		});
		
		
	$('body').on('click', '.add-ticket-paid', function(){
		var s=document.getElementById('delid').value;
		$('#add-ticket').append('<div class="border-bottm no-padd" id="del'+s+'"><div class="col-sm-4" id="delete-id"><span><input type="text" class="form-control" name="paid_ticket[]" placeholder="Ticket Name" /></span></div><div class="col-sm-3"><span><input type="text" class="form-control" name="paid_ticket_quantity[]" placeholder="Quantity Available" /></span></div><div class="col-sm-3"><span><input type="text" class="form-control" name="paid_ticket_price[]" placeholder="Ticket Price" /></span></div><div class="col-sm-2"><span class="form-control1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-trash" aria-hidden="true" onclick="deleteid('+s+')"></span></span></div></div><div class="clearfix"></div>');
		document.getElementById('delid').value=parseInt(s)+1;
		});
		
		
	$('body').on('click', '.add-ticket-donation', function(){
		var s=document.getElementById('delid').value;
		$('#add-ticket').append('<div class="border-bottm no-padd" id="del'+s+'"><div class="col-sm-4" id="delete-id"><span><input type="text" class="form-control" name="donation_ticket[]" placeholder="Ticket Name" /></span></div><div class="col-sm-3"><span><input type="text" class="form-control" name="donation_ticket_quantity[]" placeholder="Quantity Available" /></span></div><div class="col-sm-3"><span><input type="text" class="form-control" name="donation_ticket_price[]" placeholder="Donation Amount" /></span></div><div class="col-sm-2"><span class="form-control1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-trash" aria-hidden="true" onclick="deleteid('+s+')"></span></span></div></div><div class="clearfix"></div>');
		document.getElementById('delid').value=parseInt(s)+1;
		});
function deleteid(s)
{
	var sd='del'+s;
	$('#'+sd).remove();
}
		function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function(){
    readURL(this);
});	
		
	</script>
    <script src="../../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../css/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
    <script src="../../jquery.geocomplete.js"></script>
    <script src="../../logger.js"></script>
     
    <script>
      $(function(){
        
        var options = {
         
        };
        
        $("#geocomplete").geocomplete(options);
        
      });
    </script> 
        <!-- ./wrapper -->
        <!-- add new calendar event modal -->
    </body>
</html>