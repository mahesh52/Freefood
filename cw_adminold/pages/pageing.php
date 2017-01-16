<?php


function make_pages($page,$limit,$total,$filePath,$otherParams)

{

	@$divs=$total%$limit;

	if($divs==0)

	{

	@$tots=(int)($total/$limit);

	}else{

	@$tots=(int)($total/$limit) + 1;

	}

	echo "<li>
	<a href=\"$filePath?page=".(1)."&$otherParams\"  style='color:#000000;'><span aria-hidden='true'>&laquo;</span></a></li>";

	if($tots==1)

	{

	echo "<li><a href=\"$filePath?page=1&$otherParams\" style='color:#000000;'>[1]</a></li>";

	}

	if($tots>1)

	{

		
		

		
if(!empty($page))
{

if(($page-5)>=1)
{
echo "<li><a href=\"$filePath?page=".($page-5)."&$otherParams\" style='color:#000000;'>".($page-5)."</a></li>";
}

if(($page-4)>=1)
{
echo "<li><a href=\"$filePath?page=".($page-4)."&$otherParams\" style='color:#000000;'>".($page-4)."</a></li>";
}

if(($page-3)>=1)
{
echo "<li><a href=\"$filePath?page=".($page-3)."&$otherParams\" style='color:#000000;'>".($page-3)."</a></li>";
}


if(($page-2)>=1)
{
echo "<li><a href=\"$filePath?page=".($page-2)."&$otherParams\" style='color:#000000;'>".($page-2)."</a></li>";
}
if(($page-1)>=1)
{
echo "<li><a href=\"$filePath?page=".($page-1)."&$otherParams\" style='color:#000000;'>".($page-1)."</a></li>";
}
echo "<li><a href=\"$filePath?page=$page&$otherParams\" style='color:#000000;'>[$page]</a></li>";

if(($page+1)<=$tots)
{
echo "<li><a href=\"$filePath?page=".($page+1)."&$otherParams\" style='color:#000000;'>".($page+1)."</a></li>";
}
if(($page+2)<=$tots)
{
echo "<li><a href=\"$filePath?page=".($page+2)."&$otherParams\" style='color:#000000;'>".($page+2)."</a></li>";
}
if(($page+3)<=$tots)
{
echo "<li><a href=\"$filePath?page=".($page+3)."&$otherParams\" style='color:#000000;'>".($page+3)."</a></li>";
}
if(($page+4)<=$tots)
{
echo "<li><a href=\"$filePath?page=".($page+4)."&$otherParams\" style='color:#000000;'>".($page+4)."</a></li>";
}
if(($page+5)<=$tots)
{
echo "<li><a href=\"$filePath?page=".($page+5)."&$otherParams\" style='color:#000000;'>".($page+5)."</a></li>";
}
}
else
{
if($tots>3)
{
if(1<=$tots)
{
echo "<li><a href=\"$filePath?page=1&$otherParams\" style='color:#000000;'>1</a></li>";
}
if(2<=$tots)
{
echo "<li><a href=\"$filePath?page=2&$otherParams\" style='color:#000000;'>2</a></li>";
}
if(3<=$tots)
{
echo "<li><a href=\"$filePath?page=3&$otherParams\" style='color:#000000;'>3</a></li>";
}
if(4<=$tots)
{
echo "<li><a href=\"$filePath?page=4&$otherParams\" style='color:#000000;'>4</a></li>";
}
echo ".........";echo "&nbsp;&nbsp;";
if(($tots-3)>=1)
{
echo "<li><a href=\"$filePath?page=".($tots-3)."&$otherParams\" style='color:#000000;'>".($tots-3)."</a></li>";
}
if(($tots-2)>=1)
{
echo "<li><a href=\"$filePath?page=".($tots-2)."&$otherParams\" style='color:#000000;'>".($tots-2)."</a></li>";
}
if(($tots-1)>=1)
{
echo "<li><a href=\"$filePath?page=".($tots-1)."&$otherParams\" style='color:#000000;'>".($tots-1)."</a></li>";
}
echo "<li><a href=\"$filePath?page=".($tots)."&$otherParams\" style='color:#000000;'>".($tots)."</a></li>";
}
else
{
for(@$i=1;$i<=$tots;$i++)
		{
		if($page==$i)
		{
		echo "<li><a href=\"$filePath?page=$i&$otherParams\" style='color:#000000;'>[$i]</a></li>";
		}else{
		echo "<li><a href=\"$filePath?page=$i&$otherParams\" style='color:#000000;'>$i</a></li>";
		}
		}}
}
}

		
	echo "<li><a href=\"$filePath?page=".($tots)."&$otherParams\"style='color:#000000;'><span aria-hidden='true'>&raquo;</span></a></li>";




}

?>