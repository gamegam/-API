<html lang="kr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes">
		<style>
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
            form {
                text-align: center;
                width: 180px;
                padding: 20px;
                background-color: #ffffff;
                border: 1px solid #ddd;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            label {
                display: block;
                margin-bottom: 5px;
                font-size: 16px;
            }

            input {
                width: 100%;
                padding: 10px;
                margin-bottom: 20px;
                box-sizing: border-box;
                font-size: 16px;
            }

            button {
                background-color: #ffc107;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
            }

            #ouidResult {
                font-size: 15px;
                text-align: left;
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 5px;
                background-color: #ffffff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0);
            }

            #moreLink {
                display: none;
                color: #007bff;
                text-decoration: underline;
                cursor: pointer;
                margin-top: 10px;
            }
		</style>
		퀼리티를 개선하겠습니다. 감사합니다.
		<title>카러플API기반</title>
	</head>
	<body>

		<form method="post">
			<label for="inputValue">라이더 명:</label>
			<input type="text" id="inputValue" name="inputValue" required>
			<button type="submit">확인</button>
		</form>

		<?php
		include 'map.php';
		$s = getscore();
		$m = getMilitary();
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$racerName = $_POST["inputValue"];
			if ($racerName == null){
				return;
			}
			$apiEndpoint = 'https://open.api.nexon.com/kartrush/v1/id';
			$apiKey = '토큰키';//토큰키
			$url = "$apiEndpoint?racer_name=" . urlencode($racerName);
			$options = [
				'http' => [
					'header' => "accept: application/json\r\n" . "x-nxopen-api-key: $apiKey",
				],
			];
			$context = stream_context_create($options);
			$response = file_get_contents($url, false, $context);
			$data = json_decode($response, true);
			if (isset($data['ouid_info'][0]['ouid'])) {
				$ouid = $data['ouid_info'][0]['ouid'] ?? "error(Owner)";
				$lv = $data['ouid_info'][0]['racer_level'];
				$date = $data['ouid_info'][0]["racer_date_create"];//처음에 접속할떄 표시
				$user = 'https://open.api.nexon.com/kartrush/v1/user/basic';
				$url = "$user?ouid=" . urlencode($ouid);
				$response = file_get_contents($url, false, $context);
				$data = json_decode($response, true);
				$nick = $data["racer_name"] ?? "준비중";
				$date1 = $data["racer_date_create"];//첫 가입 날짜을 불러옴
				$join = new DateTime($date1);
				$A1 = ($join->format("A") == "PM") ? '오후' : '오전';
				$date1 = $join->format("Y년 m월 d일 $A1 h시 i분 s초");
				$date2 = $data["racer_date_last_login"] ?? null;//로그인
				$login = new DateTime($date2);
				$A2 = ($login->format("A") == "PM") ? '오후' : '오전';
				$date2 = $login->format("Y년 m월 d일 $A2 h시 i분 s초");
				$date3 = $data["racer_date_last_logout"] ?? "오류코드: ". var_dump($data);
				$loginout = new DateTime($date3);
				$A3 = ($loginout->format("A") == "PM") ? '오후' : '오전';
				$date3 = $loginout->format("Y년 m월 d일 $A3 h시 i분 s초");
				//타이틀 불러옴
				$titlelink = 'https://open.api.nexon.com/kartrush/v1/user/title-equipment';
				$urls = "$titlelink?ouid=" . urlencode($ouid);
				$response = file_get_contents($urls, false, $context);
				$titlea = json_decode($response, true);
				$titlebool = true;
				$title = $titlea["title_equipment"][0]["title_name"] ?? "없음";
				if ($title == "(Unknown)"){
					$titlebool = false;
					$text = "타이틀API에서 발견됨!<br>오류원인: (Unknown)이가 감지됨 혹은 알 수 없음!";
				}
				include 'Title.php';
				$title = getTitle($title);
				echo '<div id="ouidResult">';
				echo '결과: <br>';
				echo '닉네임: ' . $nick . '<br>';
				echo '계정 레벨: '. $lv,'Lv<br>';
				echo '첫가입: '. $date1.'<br>';
				echo '최근 로그인: '. $date2."<br>";
				echo "로그아웃날짜: ". $date3."<br>";
				echo "장착중인 타이틀: ". $title."<br>";
				echo '점수: '. $s .'점: 군: '. $m;
			} else {
				echo '<script type="text/javascript">';
				echo 'alert("해당 라이더는 존재하지 않습니다.");';
				echo '</script>';
			}
		}
		?>
	</body>
</html>
