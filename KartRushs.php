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
			<label for="inputValue">라이더 명(식별자검색):</label>
			<input type="text" id="inputValue" name="inputValue" required>
			<button type="submit">확인</button>
		</form>

		<?php
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
			if ($response === FALSE) {
				echo '<script type="text/javascript">';
				echo 'alert("해당 라이더가 존재하지 않습니다!");';
				echo '</script>';
			} else {
				$data = json_decode($response, true);
				if (isset($data['ouid_info'][0]['ouid'])) {
					$ouid = $data['ouid_info'][0]['ouid'];
					$lv = $data['ouid_info'][0]['racer_level'];
					$date = $data['ouid_info'][0]["racer_date_create"];
					$user = 'https://open.api.nexon.com/kartrush/v1/user/basic';
					$url = "$user?ouid=" . urlencode($ouid);
					$response = file_get_contents($url, false, $context);
					$data = json_decode($response, true);
					$timeout = $data["racer_date_last_logout"] ?? "준비중";
					$nick = $data["racer_name"] ?? "준비중";
					echo '<div id="ouidResult">';
					echo '결과: <br>';
					echo '닉네임: ' . $nick . '<br>';
					echo '계정식별자 '. $ouid;
				} else {
					echo '<script type="text/javascript">';
					echo 'alert("개발자 또느 넥슨에게 문의하세요</br>");';
					echo '</script>';
				}
			}
		}
		?>
	</body>
</html>