<html lang="kr">

	<head>
		<meta name="google-site-verification" content="4ufC6fauJgPDo1C_Qpeu_fWHeKvNcklXMiFXB9RUGeY" />
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-height, initial-scale=1, maximum-scale=1, user-scalable=yes">
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
            .KartRushsss {
                background-color: black;
                color: white;
                position: absolute;
                top: 50px;
                left: 290px;
                padding: 10px 20px;
                border: none;
                cursor: pointer;
                font-size: 16px;
            }
            .test {
                background-color: red;
                color: white;
                position: absolute;
                top: 90px;
                left: 0px;
                padding: 10px 20px;
                border: none;
                cursor: pointer;
                font-size: 16px;
            }
            .UpdateButton {
                background-color: purple;
                color: white;
                position: absolute;
                top: 0;
                left: 0;
                padding: 15px 20px;
                border: none;
                cursor: pointer;
                font-size: 16px;
                z-index: 2;
            }
		</style>
		<title>카러플 정보 메뉴</title>
	</head>

	<body>
		<script>
            window.addEventListener("load", function() {
                if (window.screen.orientation) {
                    window.screen.orientation.lock('landscape').then(function(success) {
                    }).catch(function(error) {
                        console.error('Error? ', error);
                    });
                }
            });
		</script>
		<form action="info.php">
			<button class="UpdateButton">깔금한디자인으로 이동</button>
		</form>
		<form action="KartRush.php">
			<button class="KartRushs">카러플 정보검색 </button>
		</form>
		<form action="KartRushs.php">
			<button class="KartRushss">카러플식별자 검색</button>
		</form>
		<form action="KartRushs1.php">
			<button class="KartRushsss">카러플 점수별 군표!</button>
		</form>
	</body>
</html>