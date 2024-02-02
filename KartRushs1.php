<html lang="kr">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes">
		<style>
            body {
                background-color: orange;
            }

            body::before {
                content: "카러플 정보";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 50px;
                background-color: red;
                color: white;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 24px;
                z-index: 1;
            }

            .KartRushs {
                background-color: pink;
                color: white;
                position: absolute;
                top: 50px;
                left: 0;
                padding: 10px 20px;
                border: none;
                cursor: pointer;
                font-size: 16px;
            }

            .KartRushss {
                background-color: blue;
                color: white;
                position: absolute;
                top: 50px;
                left: 140px;
                padding: 10px 20px;
                border: none;
                cursor: pointer;
                font-size: 16px;
            }
		</style>
		<title>카러플점수표</title>
		<?php
		echo "<br><br>3000점 이하: 일반군<br>5500점 이상: 4군<br>7000점 이상: 3군<br>9900점 이상: 2군<br>15000점 이상 1군<br>18000점 이상: 주력<br>20000점 이상 강주력<br>21000점 이상 선수활동<br>준비중에 있습니다.<br>";
		echo "해당 맵에 대한 최대점수가 있습니다.<br>";
		echo "최대점수는 3000점이며 또한 맵 길이에 따라 주어진 포인트가 다릅니다.<br>";
		echo "총 맵은 아이템맵에 나오는걸 제외한 기록입니다.<br>3000점을 넘을 수 있나요?<br>";
		echo "예 넘을 수 있습니다. 저는 그것을 알려줄 수 없지만 넘을 수 있습니다.<br>";
		echo "83개에 스피드트랙에서 총 2만점을 넘기세요!";
		echo "또한 길이에 따라 해당맵의 최대점수 또한 변경됩니다.<br>";
		?>
	</head>
	<body>