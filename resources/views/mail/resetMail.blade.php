<!DOCTYPE html>
<html lang="en">

<head>
    <title>Healthcare Portal | パスワードの再設定</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
</head>

<body style="margin: 0; padding: 0;">
    <div style="max-width:800px;background-color: #fff9ec;">
        <div style="max-width:550px;margin: 0 auto;text-align: center;">           
                <br>
                <p style="font-size: 40px;font-weight: bold;color: #d2571c;text-shadow: 3px 4px #ccc;">LOGO <span style="font-size: 30px; color: #f57e46;">HERE</span></span>
                <br/>
                <br/>
                <span style="padding: 5px 100px;color:#3e4348;font-size: 33px;font-weight: bold;text-align: center;border-bottom: 1px solid #ccc;">
                    パスワードの再設定
                </span>
                <p style="color:#000;text-align: left">
                    パスワードの再設定がリクエストされました。<br> 以下のボタンをクリックし、パスワードの再設定手続きにお進みください。
                </p>
                <span style="background: #fbaa84;">
               
                <a href="http://testikportal.management-partners.co.jp/resetpassword?code={{$checkmail[0]['role']}}" style="background: #fbaa84; border: 1px solid #ff9563; font-weight: 900; letter-spacing: 2px; font-size: 16px; mso-height-rule: exactly; line-height: 60px; text-align: center; text-decoration: none; display: block; border-radius: 4px; font-weight: 900; text-transform: uppercase">
                &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#ffffff">パスワードを再設定する</span>&nbsp;&nbsp;&nbsp;&nbsp;
                </a>
           
			<!-- <a href="http://testikportal.management-partners.co.jp/resetpassword?code={{$checkmail[0]['role']}}" style="background: #fbaa84;color: #000;box-shadow: 0 2px 4px 0 rgba(27,160,5,0.2);border-radius: 4px;border: 1px solid #ff9563;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.12);
						background-size: 100%;display: inline-block;background-position: 50% 50%;font-weight: bold;line-height: 46px;font-size: 15px;
						padding: 0px 28.3px;text-align: center;text-decoration: none;min-width: 280px;-webkit-text-size-adjust: none; mso-hide: all;">
			<span style="font-size:13.5pt;color:#fff;border:solid #fbaa84 6.0pt;">パスワードを再設定する</span> -->
                </a>
                </span>
                <br>
                <div style="font-size: 12px;color: #807c7c;line-height: 1.5;max-width: 385px;text-align: left;">
                ※再設定しない場合は、不要このメッセージを無視してください。<br> 
                ※パスワードは、上記から変更操作をしない限り変更されません。<br> 
                ※再設定用URLは24時間有効です。
                </div>
                <br>
            
            <footer>
                <p style="padding: 10px 0 50px 0;border-top: 1px solid #ccc;text-align: left;">
                    〒163-0713<br> 東京都新宿区西新宿2-7-1小田急第一生命ビル13階
                    <br> TEL：03-6911-???? <br> FAX：03-6911-????
                </p>

            </footer>
        </div>
    </div>
</body>

</html>