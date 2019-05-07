
<?
//------抽奖测试配置数据-----
	$a="金纺护理液、洗衣液套装";$at=5;$an=0;
	$b="洗衣液";$bt=15;$bn=0;
	$c="洗洁精";$ct=60;$cn=0;
	$d="燕麦片";$dt=5;$dn=0;
	$e="肥皂8块套装";$et=5;$en=0;
	$f="谢谢参与";$ft=12;$fn=0;
//---------------获取奖品数量--------------
$fp=file("dt.txt");
$total=count($fp);
for($l=0;$l<$total;$l++){
	$rs=explode("||",$fp[$l]);
	$temp=$rs[2];
	//echo $temp;
	if($temp=="XXXXXXXX"){$fn++;}
	if($temp==1){$an++;}
	if($temp==2){$bn++;}
	if($temp==3){$cn++;}
	if($temp==4){$dn++;}
	if($temp==5){$en++;}
	}
//fclose($fp);
?>