<?php include_once "api/db.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0039) -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>健康促進網</title>
<link href="./css/css.css" rel="stylesheet" type="text/css">
<script src="./css/jquery-1.9.1.min.js"></script>
<script src="./css/js.js"></script>
</head>
<body>
<div id="alerr" style="background:rgba(51,51,51,0.8); color:#FFF; min-height:100px; width:300px; position:fixed; display:none; z-index:9999; overflow:auto;">
	<pre id="ssaa"></pre>
</div>
<!-- <iframe name="back" style="display:none;"></iframe> -->
	<div id="all">
    	<div id="title">
		
		<!-- 增加日期更新功能 -->
		<!-- 加上 今日瀏覽 變數$Visit -> find() -->
		<!-- < ?=$Visit->find(['date'=>date("Y-m-d")])['visit'];?> -->
		<!-- 加上 累積瀏覽 變數$Visit -> sum() -->
		<!-- < ?=$Visit->sum('visit');?> -->

        <?=date('m 月 d 日 1');?> | 今日瀏覽: <?=$Visit->find(['date'=>date("Y-m-d")])['visit'];?> | 累積瀏覽:<?=$Visit->sum('visit');?>        
        <!-- 09 月 08 號 Monday | 今日瀏覽: 1 | 累積瀏覽: 36 -->
		
		<!-- 新增 回首頁 右上角 加上style='float:right' -->
		<a href="./index.php" style='float:right'>回首頁</a>
		</div>
        
		<!-- banner -->		
		<div id="title2">
			
			<!-- img移到a tag裡面 -->
			<a href="./index.php">
				<img src="./icon/banner-png.png" title="健康促進網－回首頁"  alt="健康促進網－回首頁">

			</a>
        </div>
        <div id="mm">
        	<div class="hal" id="lef">
            	<a class="blo" href="?do=po">回首頁</a>
               	<a class="blo" href="?do=news">最新文章</a>
               	<!-- <a class="blo" href="?do=pop"></a> -->
               	<!-- <a class="blo" href="?do=know"></a> -->
               	<a class="blo" href="?do=que">問卷調查</a>
            </div>

            <div class="hal" id="main">
            	<div>
            		<!-- 跑馬燈 移除屬性 設定寬度比例 80/20 -->
                	<!-- 跑馬燈跟會員登入並置 都加上display:inline-block -->
					<!-- <span>標籤接著寫 不要斷行 往上移接到</marquee>後面 -->
					<marquee style="width:78% ; display:inline-block">請民眾踴躍投稿電子報，讓電子報成為大家相互交流、分享的園地！詳見最新文章」之動態廣告文字</marquee><span style="width:20%; display:inline-block">
                    	<a href="?do=login">會員登入</a>
                    </span>
                    
					<!-- 右下方區域 左方選單內容區 -->
					<!-- include 對應檔案 -->
					<div class="">
					<?php
					$do=$_GET['do'] ?? 'main';
					$file="./front/" .$do. ".php";
					if(file_exists($file)){
						include $file;
					}else{
						include "./front/main.php";

					}
					?>


                	</div>
                </div>

            </div>

        </div>
        <div id="bottom">
    	    本網站建議使用：IE9.0以上版本，1024 x 768 pixels 以上觀賞瀏覽 ， Copyright © 2012健康促進網社群平台 All Right Reserved 
    		 <br>
    		 服務信箱：health@test.labor.gov.tw<img src="./icon/02B02.jpg" width="45">
        </div>
    </div>

</body></html>