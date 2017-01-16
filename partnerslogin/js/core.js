/*!
 * Catchway Transactions
 * Copyright 2015 Catchway.
 * Author - Viswanadha Kushal Abhishek
 */
var my_months = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", 
               "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];
function client_refresh(s)
{
	if(s==0){
var split_date = $('.my-date').val().split("/");
	}
	else
	{
	var split_date = s;	
	}
var my_day = split_date[1];
var my_month = my_months[(parseFloat(split_date[0])-1)];
var my_date=my_day+' '+my_month;
  $.ajax({
	 type:"post",
	 dataType:"text", 
	 url:"ajaxPages/ajax_client_paid.php?sid="+s,
	 data:  $("#add-paid").serializeArray(),
	 success: function(response){
		 $('.client-paid tbody').html(response);
		 
  var sum = 0;var totsum = 0;
		 var dc_sum = 0;
		 $("."+my_day).each(function() {
			var dc_current_element = parseFloat($(this).text());
			dc_sum = parseFloat(dc_sum+dc_current_element);
		 });
		 $(".money").each(function() {
			var current_element = parseFloat($(this).text());
			sum = parseFloat(sum+current_element);
		 });
		 $(".cashmoney").each(function() {
			var currt_element = parseFloat($(this).text());
			totsum = parseFloat(totsum+currt_element);
		 });
		 function trimString(x){
			  var n = x.toString().replace(',','');
			  return n;   
		 }
		 var a = trimString($('.opening-balance').text());
		 //var b = trimString($('.trans-amount').text());
		 var c = trimString($('.expn-amount').text());
		 var opening_balance = parseFloat(a);
		// var trans_amount = parseFloat(b);
		 var expn_amount = parseFloat(c);
		 var cash_in_hand = opening_balance+(totsum-(expn_amount));
		 function commaSeparateNumber(val){
			while (/(\d+)(\d{3})/.test(val.toString())){
			  val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
			}
			return val;
		 }
		 var my_value = commaSeparateNumber(cash_in_hand);
		 var my_client_paid = commaSeparateNumber(totsum);
		  var tot_client_paid = commaSeparateNumber(sum);
		 var dc_my_collection = commaSeparateNumber(dc_sum);
		 $('.cash-in-hand').text(my_value);
		  $('.my_date').text(my_date);
		 $('.paid-amount').text(my_client_paid);
		 $('.day-collection').text(dc_my_collection);
		 $('.big-paid-amount').text(tot_client_paid);
		
	}
  });
  $('.add-row-clientpaid').closest('form').find("input[type='text'], textarea").val("");
  $('.add-row-transactions').closest('form').find("input[type='text'], textarea").val("");
  $('.addoption').prop('selectedIndex',0);	
   $('.my-date').datepicker('setDate', null);
  
	
}			   
			   
			   
$('body').on('click','.add-row-clientpaid',function(){
	var s=0;
client_refresh(s);
});

$('body').on('click','.add-row-transactions',function(){
	var split_date = $('.t_my-date').val().split("/");
  var my_day = split_date[1];//alert(my_day);
  var my_month = my_months[(parseFloat(split_date[0])-1)];
  //$('.t_my-date').val(my_day+' '+my_month);
  var bank_date=$('#bank_date').val();
   var current_time=$('#current_time').val();
    var bank_website=$('#bank_website').val();
	 var bank_amount=$('#bank_amount').val();
	 var bank_cheque=$('#bank_cheque').val();
	 var bank_bank=$('#bank_bank').val();
  $.ajax({
	 type:"post",
	 url:"ajaxPages/ajax_client.php",
	 dataType:"text", 
	 data:  $("#add-catchway-trans").serializeArray()+"&date="+bank_date+"&current_time="+current_time+"&website="+bank_website+"&amount="+bank_amount+"&cheque="+bank_cheque+"&bank="+bank_bank,
	 success: function(response){
		 $('.catchway-trans tbody').html(response);
		  var t_sum = 0;
		 $(".trans-money").each(function() {
			var t_current_element = parseFloat($(this).text());
			t_sum = parseFloat(t_sum+t_current_element);
		 });
		 function commaSeparateNumber(val){
			while (/(\d+)(\d{3})/.test(val.toString())){
			  val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
			}
			return val;
		 }
		 var a = commaSeparateNumber(t_sum);
		 $('.trans-amount').text(a);
		$('#bank_date').val(null);
        $('#current_time').val(null);
        $('#bank_website').val(null);
	    $('#bank_amount').val(null);
	    $('#bank_cheque').val(null);
	    $('#bank_bank').val(null);
		 client_refresh(split_date);
	 }
  }); 
  //$(this).closest('form').find("input[type='text'], textarea").val("");
  //$('.addoption').prop('selectedIndex',0);
 
});

$('body').on('click','.add-row-expensives',function(){
	var split_date = $('.e_my-date').val().split("/");
  var my_day = split_date[1];
  var my_month = my_months[(parseFloat(split_date[0])-1)];
  //$('.e_my-date').val(my_day+' '+my_month);
  $.ajax({
	 type:"post",
	 dataType:"text",
	 url:"ajaxPages/ajax_exp.php",
	 data:  $("#add-expenses").serialize(),
	 success: function(response){
		 $('.mnth-expenses tbody').html(response);
		  var e_sum = 0;
		 $(".expn-money").each(function() {
			var e_current_element = parseFloat($(this).text());
			e_sum = parseFloat(e_sum+e_current_element);
		 });
		 function e_trimString(e_x){
			  var e_n = e_x.toString().replace(',','');
			  return e_n;   
		 }
		 var e_a = e_trimString($('.opening-balance').text());
		 var e_b = e_trimString($('.paid-amount').text());
		 var e_c = e_trimString($('.trans-amount').text());
		 var e_opening_balance = parseFloat(e_a);
		 var e_paid_amount = parseFloat(e_b);
		 var e_trans_amount = parseFloat(e_c);
		 var e_cash_in_hand = e_opening_balance+(e_paid_amount-(e_sum));
		 function e_commaSeparateNumber(e_val){
			while (/(\d+)(\d{3})/.test(e_val.toString())){
			  e_val = e_val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
			}
			return e_val;
		 }
		 var e_my_value = e_commaSeparateNumber(e_cash_in_hand);
		 var e_my_client_paid = e_commaSeparateNumber(e_sum);
		 $('.cash-in-hand').text(e_my_value);
		 $('.expn-amount').text(e_my_client_paid);
	 }
  });
  $(this).closest('form').find("input[type='text'], textarea").val("");
});



	
			$('body').on('click','.add-row-client',function(){
				var mySwitch = 'branch';
				var ddul=$(this).data('delete');
				if(ddul=='yes')
				{
				var gid=$('#delete-id').val();
				}
				else
				{
				var gid='';	
				}
					var dtype=$(this).data('type');
				$.ajax({
					   type:"post",
					   dataType:"text",
					   url:"ajaxPages/ajax_admin.php",
					   data:  $('#add-client-paid').serialize()+"&addid=branch&gid="+gid+"&dtype="+dtype,
					   success: function(response){
						$('.client-paid tbody').html(response);
						var count=0;
						$('.bid').each(function(){
						count++;
						});
						 $('.paid-amount').text(count);
								  
							   }
						 });
    $('.addoption').append('<option value="'+m+'"> '+n+' </option>');
			});
			
			
			$('body').on('click','.add-row-trans',function(){
				var mySwitch = 'bank';
				var ddul=$(this).data('delete');
				if(ddul=='yes')
				{
				var gid=$('#delete-id').val();
				}
				else
				{
				var gid='';	
				}
					var dtype=$(this).data('type');
				$.ajax({
					   type:"post",
					   dataType:"text",
					   url:"ajaxPages/ajax_admin.php",
					   data:  $('#add-catchway-trans').serialize()+"&addid=bank&gid="+gid+"&dtype="+dtype,
					   success: function(response){
						   $('.trans-catchway tbody').html(response);
						   var count=0;
						$('.acid').each(function(){
						count++;
						});
						 $('.trans-amount').text(count);
					   }
				 });
				
			});
			
			
			$('body').on('click','.add-row-exp',function(){
				var mySwitch = 'admin';
				var ddul=$(this).data('delete');
				if(ddul=='yes')
				{
				var gid=$('#delete-id').val();
				}
				else
				{
				var gid='';	
				}
					var dtype=$(this).data('type');
				$.ajax({
					   type:"post",
					   dataType:"text",
					   url:"ajaxPages/ajax_admin.php",
					   data:  $('#add-expenses').serialize()+"&addid=admin&gid="+gid+"&dtype="+dtype,
					   success: function(response){
						   $('.mnth-expenses tbody').html(response);
						   var count=0;
						$('.usid').each(function(){
						count++;
						});
						 $('.expn-amount').text(count);
					   }
				 });
				 
			});
			
			//data verification
			$('body').on('keyup','.data-verify',function(){
				var id='#'+$(this).attr('id');
				var chk=$(id).val();
				var ci_id='.'+$(this).data('check-id');
				var btn_id='.'+$(this).data('button-id');//alert(id+','+ci_id);
				 var count=0;
	$(ci_id).each(function(){
		count++;
		});
		if(count>0)
		{
				$(ci_id).each(function() {
					var current=$(this).text();
                   		if(chk == current)
						{
							
								$(btn_id).addClass('disabled');
								return false;
							
						}
						else
						{
							var findclass=$(btn_id).closest('.modal-footer').find('.disabled');
							$(findclass).removeClass('disabled');
						}
                });
		}
		else
		{
		var findclass=$(btn_id).closest('.modal-footer').find('.disabled');
							$(findclass).removeClass('disabled');	
		}
				});
				
				// editing / view details
				$('body').on('click','.edit-record',function(){
				 $('.modal-title').text('Add');
				 $('.update-row').addClass('disabled');
				 $('.update-row').text('Add');
				  $('#add-client-paid').find("input[type='text'], textarea").val("");
				  $('#catchway-trans').find("input[type='text'], textarea").val("");
				  $('#mnth-expenses').find("input[type='text'],input[type='password'], textarea").val("");
				  $('.addoption').prop('selectedIndex',0);
				  $('#branch_mode1').iCheck('uncheck');
				  $('#branch_mode2').iCheck('uncheck');
				  $('#br_currency1').iCheck('uncheck');
				  $('#br_currency2').iCheck('uncheck');
				  $('#bank_mode1').iCheck('uncheck');
				  $('#bank_mode2').iCheck('uncheck');
				  $('#bank_currency1').iCheck('uncheck');
				  $('#bank_currency2').iCheck('uncheck');
				  
				});
				
				$('body').on('click','.addbranches',function(){
					var row_id=$(this).data('row-id');
					$.ajax({
					   type:"post",
					   dataType:"text",
					   url:"ajaxPages/ajax_branch.php?guid="+row_id,
					   success: function(response){
						   $('.addoptions').html(response);
					   }
					});
				});
				
				$('body').on('click','.label',function(){
					var mySwitch = $(this).data('switch-id');
					var row_id=$(this).data('row-id');
					$.ajax({
					   type:"post",
					   dataType:"text",
					   url:"ajaxPages/ajax_edit.php",
					   data:  "switchid="+mySwitch+"&guid="+row_id,
					   success: function(response){
						   if(mySwitch=='branch')
						   {var spt=response.split('-*!');
							 $('.branch_id').val(spt[0]);
							 $('.branch_name').val(spt[1]);
							 $('#branch_id_name').val(spt[3]);
							 $('#update_id').val(spt[4]);
							 var ft=$('#branch_id_name').val(); 
							 if(spt[2]=='IND'){$('#branch_mode1').iCheck('check');}
							 if(spt[2]=='INT'){$('#branch_mode2').iCheck('check');}
							 if(ft=='Rupee'){$('#br_currency1').iCheck('check');}
							 if(ft=='Dollar'){$('#br_currency2').iCheck('check');}
						   }
						   if(mySwitch=='bank')
						   {var spt=response.split('-*!');
							 $('#bank_name').val(spt[0]);
							 $('#acc_id').val(spt[1]);
							 $('#update_bank_id').val(spt[4]);
							 $('#mibile').val(spt[5]);
							 var ft=spt[3]; 
							 if(spt[2]=='IND'){$('#bank_mode1').iCheck('check');}
							 if(spt[2]=='INT'){$('#bank_mode2').iCheck('check');}
							 if(ft=='Rupee'){$('#bank_currency1').iCheck('check');}
							 if(ft=='Dollar'){$('#bank_currency2').iCheck('check');}
							 
						   }
						    if(mySwitch=='admin')
						   {var spt=response.split('-*!');
							 $('#admin_name').val(spt[1]);
							 $('#admin_mobile').val(spt[2]);
							 $('#user_id').val(spt[3]);
							 $('#admin_password').val(spt[4]);
							 $('#update_admin_id').val(spt[5]);var compare_string=spt[0];
							 var cnt=0;
							 $('#branch_details option').each(function() {
							 var current_string=$(this).val();
							 if(compare_string==current_string){
								 $('#branch_details').prop('selectedIndex',cnt);
								 }cnt++;
                            });
							 
						   }
							$('.update-row').removeClass('disabled');
							$('.update-row').removeClass('edit-record');
							$('.update-row').text('Update');
							
						 $('.modal-title').text('Edit');
						  
						   
					   }
				 });
					
				});
				
				
				
				//delete
				
				$('body').on('click','.label-delete',function(){
					var gid=$(this).data('guid');
					var dtype=$(this).data('type');
					$('#delete-id').val(gid);
					$('#delete-record').attr('data-type',dtype);
					if(dtype=='delete-bank'){
						var findclass=$('#delete-record').closest('.modal-footer').find('.add-row-client');
							$(findclass).removeClass('add-row-client');
							var finclass=$('#delete-record').closest('.modal-footer').find('.add-row-exp');
							$(finclass).removeClass('add-row-exp');
							 $('#delete-record').addClass('add-row-trans');
							 return true;
						}
						if(dtype=='delete-branch'){
							var findclass=$('#delete-record').closest('.modal-footer').find('.add-row-trans');
							$(findclass).removeClass('add-row-trans');
							var finclass=$('#delete-record').closest('.modal-footer').find('.add-row-exp');
							$(finclass).removeClass('add-row-exp');
						$('#delete-record').addClass('add-row-client');
						return true;
						}
						if(dtype=='delete-admin'){
							var findclass=$('#delete-record').closest('.modal-footer').find('.add-row-trans');
							$(findclass).removeClass('add-row-trans');
							var finclass=$('#delete-record').closest('.modal-footer').find('.add-row-client');
							$(finclass).removeClass('add-row-client');
						$('#delete-record').addClass('add-row-exp');
						return true;
						}
					});
					
//petrol expensives

$('.add-row-petrol').click(function(){
var split_date = $('.my-date').val().split("/");
var my_day = split_date[1];
var my_month = my_months[(Number(split_date[0])-1)];
if(my_day == 1){
 var new_date = my_day+'st';
}
else if(my_day == 2){
 var new_date = my_day+'nd'; 
}
else if(my_day == 3){
 var new_date = my_day+'rd'; 
}
else{
 var new_date = my_day+'th'; 
}
  $.ajax({
  type:"post",
  dataType:"text",
  url:"ajaxPages/ajax_petrol_expenses.php",
  data:  $("#add-petrol-expenses").serialize()+"&nDate="+new_date,
  success: function(response){
   $('.client-paid tbody tr').last().after(response);
   var sum = 0;
   $(".money").each(function() {
   var current_element = Number($(this).text());
   sum = Number(sum+current_element);
   });
   function commaSeparateNumber(val){
   while (/(\d+)(\d{3})/.test(val.toString())){
     val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
   }
   return val;
   }
   var total_expense = commaSeparateNumber(sum);
   var my_client_paid = commaSeparateNumber(sum);
   $('.petrol-expenses-mobile').text(total_expense);
   $('.petrol-expenses').text(total_expense);
  }
  });
  $(this).closest('form').find("input[type='text'], textarea").val("");
});

$('.distance').keyup(function(){
 var distance = $(this).val();
 var amount = parseFloat(distance*1.5);
 $('.disp-amount').val(amount);
});				
				
  