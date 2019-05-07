<?
//------抽奖测试配置数据-----
	$a="金纺护理液、洗衣液套装";$at=5;$an=0;
	$b="洗衣液";$bt=15;$bn=0;
	$c="洗洁精";$ct=60;$cn=0;
	$d="燕麦片";$dt=5;$dn=0;
	$e="肥皂8块套装";$et=5;$en=0;
	$f="谢谢参与";$ft=12;$fn=0;
?>
<!--------------------------抽奖------------------------>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="format-detection" content="telephone=no">
		<title>WFLD幸运刮刮卡</title>
		<link href="./css/activity-style.css" rel="stylesheet" type="text/css">
	</head>
	<script type="text/javascript">
//--------禁止刷新页面---------
		function loading(canvas, options) {
			this.canvas = canvas;
			if (options) {
				this.radius = options.radius || 12;
				this.circleLineWidth = options.circleLineWidth || 4;
				this.circleColor = options.circleColor || 'lightgray';
				this.moveArcColor = options.moveArcColor || 'gray';
			} else {
				this.radius = 12;
				this.circelLineWidth = 4;
				this.circleColor = 'lightgray';
				this.moveArcColor = 'gray';
			}
		}
		loading.prototype = {
			show: function() {
				var canvas = this.canvas;
				if (!canvas.getContext) return;
				if (canvas.__loading) return;
				canvas.__loading = this;
				var ctx = canvas.getContext('2d');
				var radius = this.radius;
				var me = this;
				var rotatorAngle = Math.PI * 1.5;
				var step = Math.PI / 6;
				canvas.loadingInterval = setInterval(function() {
					ctx.clearRect(0, 0, canvas.width, canvas.height);
					var lineWidth = me.circleLineWidth;
					var center = {
						x: canvas.width / 2,
						y: canvas.height / 2
					};

					ctx.beginPath();
					ctx.lineWidth = lineWidth;
					ctx.strokeStyle = me.circleColor;
					ctx.arc(center.x, center.y + 20, radius, 0, Math.PI * 2);
					ctx.closePath();
					ctx.stroke();
					//在圆圈上面画小圆   
					ctx.beginPath();
					ctx.strokeStyle = me.moveArcColor;
					ctx.arc(center.x, center.y + 20, radius, rotatorAngle, rotatorAngle + Math.PI * .45);
					ctx.stroke();
					rotatorAngle += step;

				},
				100);
			},
			hide: function() {
				var canvas = this.canvas;
				canvas.__loading = false;
				if (canvas.loadingInterval) {
					window.clearInterval(canvas.loadingInterval);
				}
				var ctx = canvas.getContext('2d');
				if (ctx) ctx.clearRect(0, 0, canvas.width, canvas.height);
			}
		};
	</script>
	</head>
	<body data-role="page" class="activity-scratch-card-winning">
		<script src="./js/jquery.js" type="text/javascript"></script>
		<script src="./js/wScratchPad.js" type="text/javascript"></script>
		<div class="main">
			<div class="cover">
				<img src="./images/activity-scratch-card-bannerbg.png">
				<div id="prize">
				</div>
				<div id="scratchpad">
				</div>
			</div>
			<div class="content">
				<div id="zjl" style="display:none" class="boxcontent boxwhite">
					<div class="box">
						<div class="title-red" style="color: #444444;">
							<span class="red" id="username"></span>
							<span>
								谢谢你参加本活动，抽奖结果如下：
							</span>
						</div>
						<div class="Detail">
							<p>
								你中了：
								<span class="red" id ="theAward"></span>
							</p>
							<p>
								兑奖SN码：
								<span class="red" id="sncode">
<?php
$sn=rand(0,99999);
if($sn<10){$sn="0000".$sn;}
if(9<$sn&&$sn<100){$sn="000".$sn;}
if(99<$sn&&$sn<1000){$sn="00".$sn;}
if(999<$sn&&$sn<10000){$sn="0".$sn;}
?>
								</span>
							</p>
							<p class="red"></p>
							<p><form name="cj" id="cj" action="cj_do.php" method="post"></form>
							<input name="sn" class="px" id="sn" value=" " type="hidden" readonly form="cj">
							</p>
							<p>
								<p>
									<input class="pxbtn" name="提 交" id="save-btn1" type="button" value="确定" onClick="alert("退出程序");window.close(this)";> 
								</p>
							</div>
					</div>
				</div>
	 	 			<div class="boxcontent boxwhite">
					<div class="box">
						<div class="Detail">
							<p id="a"></p>
							<p id="b"></p>
							<p id="c"></p>
							<p id="d"></p>
							<p id="e"></p>
						</div>
					</div>
				</div>			
			</div>
			<div style="clear:both;">
			</div>
		</div>
		<script src="./js/alert.js" type="text/javascript"></script>
		<script type="text/javascript">
			window.sncode = "null";
			window.prize = "谢谢参与";

			var zjl = false;
			var num = 0;
			var goon = true;
			$(function() {
				$("#scratchpad").wScratchPad({
					width: 150,
					height: 40,
					color: "#a9a9a7",
					scratchMove: function() {
						num++;
						if (num == 2) {
						//各类奖项几率设置			ajax
				
 			 	$.post("test.php",
  					{
  					  name:"<?='WSC'.rand(0,10)?>",
  					  sn:"<?=$sn?>"
 					 },
  				function(data,status){
				obj = eval ("(" + data + ")")
				document.getElementById('prize').innerHTML = obj.award;
							$("#theAward").html(obj.award);
							$("#sncode").html(obj.sn);
							$("#sn").val(obj.sn);
							$("#username").html(obj.name);

							//显示奖品清单
				$("#a").html("<?=$a?>&nbsp;&nbsp;剩余数:<font color=red>"+obj.<?=$a?>+"</font>");
				$("#b").html("<?=$b?>&nbsp;&nbsp;剩余数:<font color=red>"+obj.<?=$b?>+"</font>");
				$("#c").html("<?=$c?>&nbsp;&nbsp;剩余数:<font color=red>"+obj.<?=$c?>+"</font>");
				$("#d").html("<?=$d?>&nbsp;&nbsp;剩余数:<font color=red>"+obj.<?=$d?>+"</font>");
				$("#e").html("<?=$e?>&nbsp;&nbsp;剩余数:<font color=red>"+obj.<?=$e?>+"</font>");
							zjl=true;
						});
						}

						if (zjl && num > 10 && goon) {
						
							//$("#zjl").fadeIn();
							goon = false;
							
							$("#zjl").slideToggle(500);
							//$("#outercont").slideUp(500)
						}
					}
				});
				
			});
			 
			</script>
	</body>
</html>
