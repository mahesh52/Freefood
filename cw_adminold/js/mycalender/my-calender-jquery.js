// A Jquery developed by Viswanadha Kushal Abhishek
// Version 1.0.0
// Release Date 19-12-2014
$('.my-date').change(function(){});
var months = [ "January", "February", "March", "April", "May", "June", 
               "July", "August", "September", "October", "November", "December" ];
var days = ["Su", "M", "T", "W", "T", "F", "S"];
var d = new Date();
var year = d.getFullYear();
var month = months[d.getMonth()];
var monthNumeric = d.getMonth()+1;
var monthDirect = d.getMonth();
var day = days[d.getDay()];
var date = d.getDate();
var monthYear = ((''+month).length<2 ? '0' : '') + month + ' - ' + d.getFullYear();
var dateNumber = ((''+date).length<2 ? '0' : '') + date;
$('.monthYear').text(monthYear);
var fd = Date.today().clearTime().moveToFirstDayOfMonth();
var firstday = fd.getDay();
var prevCounter = 1;
var nextCounter = 1;
var currentDay = Date.today();
var firstday = fd.getDay();
var firstDate = fd.getDate();
var currentMonth = fd.getMonth();
var currentYear = fd.getFullYear();
$('body').on('click','.fuel_prev',function(fd){
	var newMonth = (months[monthDirect-prevCounter]);
	fd = currentDay.add({months: -prevCounter}).clearTime().moveToFirstDayOfMonth();
	currentMonth = fd.getMonth();
	currentYear = fd.getFullYear();
	var monthYear =  months[currentMonth] + '-' + currentYear;
	$('.monthYear').text(monthYear);
	 $.ajax({
	 type:"post",
	 dataType:"text", 
	 url:"ajaxPages/ajax_fuel_exp.php",
	 data:  'cm='+currentMonth+'&cy='+currentYear,
	 success: function(response){
		 $('.client-paid tbody').html(response);
	 }});
	return fd;
});
$('body').on('click','.fuel_next',function(fd){
	var newMonth = (months[monthDirect+nextCounter]);
	var newMonthNumeric = (monthNumeric+nextCounter);
	newYear = d.getFullYear();
	fd = currentDay.add({months: nextCounter}).clearTime().moveToFirstDayOfMonth();
	currentMonth = fd.getMonth();
	currentYear = fd.getFullYear();
	var monthYear =  months[currentMonth] + '-' + currentYear;
	$('.monthYear').text(monthYear);
	 $.ajax({
	 type:"post",
	 dataType:"text", 
	 url:"ajaxPages/ajax_fuel_exp.php",
	 data:  'cm='+currentMonth+'&cy='+currentYear,
	 success: function(response){
		 $('.client-paid tbody').html(response);
	 }});
	$('.monthYear').text(monthYear);
	return fd;
});
$('body').on('click','.trans_prev',function(fd){
	var newMonth = (months[monthDirect-prevCounter]);
	fd = currentDay.add({months: -prevCounter}).clearTime().moveToFirstDayOfMonth();
	currentMonth = fd.getMonth();
	currentYear = fd.getFullYear();
	var monthYear =  months[currentMonth] + '-' + currentYear;
	$('.monthYear').text(monthYear);
	var bid=$('#bid').val();
	 $.ajax({
	 type:"post",
	 dataType:"text", 
	 url:"ajaxPages/ajax_trans_exp.php",
	 data:  'cm='+currentMonth+'&cy='+currentYear+'&bid='+bid,
	 success: function(response){
		 $('.transaction').html(response);
	 }});
	return fd;
});
$('body').on('click','.trans_next',function(fd){
	var newMonth = (months[monthDirect+nextCounter]);
	var newMonthNumeric = (monthNumeric+nextCounter);
	newYear = d.getFullYear();
	fd = currentDay.add({months: nextCounter}).clearTime().moveToFirstDayOfMonth();
	currentMonth = fd.getMonth();
	currentYear = fd.getFullYear();
	var monthYear =  months[currentMonth] + '-' + currentYear;
	$('.monthYear').text(monthYear);
	var bid=$('#bid').val();
	 $.ajax({
	 type:"post",
	 dataType:"text", 
	 url:"ajaxPages/ajax_trans_exp.php",
	 data:  'cm='+currentMonth+'&cy='+currentYear+'&bid='+bid,
	 success: function(response){
		 $('.transaction').html(response);
	 }});
	$('.monthYear').text(monthYear);
	return fd;
});
