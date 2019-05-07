<?php
	session_start();
	include("bonus_sys.php");
//---------------------------------
	if(!$_SESSION["adm"]){exit('{"result":"身份未验证，无法操作"}');};
//获得页面信息后写入数据库
	$sub="../data/sub_data.txt";
	$fp=fopen($sub,"r+");
	while(!feof($fp)){
	$rst=fgets($fp);
	//echo ftell($fp);
	$rs=explode("||",$rst);
	if($rs[0]==$_SESSION["adm"]){exit('{"result":"已经操作过，无法重复提交"}');}
		}
	$sn=$_POST["sn"];
	
//--------记录成绩-------------------------------------
$fp=fopen("data/bonus.txt","r+") or die('{"result":"程序数据打开错误"}');
//============读取奖品数，随机抽奖，获得奖品数据$bonus=================================
$r=rand(1,$at+$bt+$ct+$dt+$et+$ft-$an-$bn-$cn-$dn-$en-$fn);//获取随机数
$award="谢谢";
if($r<=($at-$an)){$award=$a;$t=1;}
if($r>($at-$an)&&$r<=($at+$bt-$an-$bn)){$award=$b;} 
if($r>($at+$bt-$an-$bn)&&$r<=($at+$bt+$ct-$an-$bn-$cn)){$award=$c;}
if($r>($at+$bt-$an-$bn+$ct-$cn)&&$r<=($at+$bt+$ct+$dt-$an-$bn-$cn-$dn)){$award=$d;}
if($r>($at+$bt-$an-$bn+$ct-$cn+$dt-$dn)&&$r<=($at+$bt+$ct+$dt-$an-$bn-$cn-$dn+$et-$en)){$award=$e;}
if($r>($at+$bt-$an-$bn+$ct-$cn+$dt-$dn+$et-$en)&&$r<=($at+$bt+$ct+$dt-$an-$bn-$cn-$dn+$et-$en+$ft-$fn)){$award=$f;}
//------------------写入中奖信息----------------------
$fp=fopen("data/bonus.txt","a+");
fwrite($fp,$content);
$content=$_session['adm']."||".$_POST['sn']."||".$award
fclose($fp);

//---------------------信息反馈抽奖页面-----
echo '{';
//---------------输出中奖信息
echo '"name":"'.$_POST["user"].'","sn":"'.$sn.'","award":"'.$award.'",';
//----------输出奖品剩余信息
echo '"';
echo $a.'":';
echo $at-$an.',"';
echo $b.'":';
echo $bt-$bn.',"'.$c;
echo '":';
echo $ct-$cn.',"'.$d.'":';
echo $dt-$dn;
echo ',"'.$e.'":';
echo $et-$en;
echo '}'

?>