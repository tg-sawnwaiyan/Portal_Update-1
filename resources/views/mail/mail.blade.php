<div style="width:800px;margin-left:auto;margin-right:auto">
<!-- Hi, This is : {{ $getCustomer->email }} -->
<div style="background-color: #fff9ec;text-align: center; margin-top: 45px;">
		<div>
			<br>
			<!-- <span style="font-size: 40px;font-weight: bold;color: #d2571c;text-shadow: 3px 4px #ccc;">LOGO <span style="font-size: 30px; color: #f57e46;">HERE</span></span> -->

			<div style="text-align:center;"><span style="background: #fbaa84;">               
                    <a href="#" style="background: #2980B9;font-weight: 900; letter-spacing: 2px; font-size: 16px; mso-height-rule: exactly; line-height: 40px; text-align: center; text-decoration: none; display: block; font-weight: 900; text-transform: uppercase;float:right;padding:7px;">
                    <span style="color:#ffffff">T-IS</span>
                    </a> 
                    <br>          
                </span></div>
			<br>

			<h5 style="color:#3e4348;font-size: 12px;margin-bottom: 30px;font-weight: bold;text-align: left;">
			{{$getCustomer->name}} 様
			</h5>
			<h5 style="color:#3e4348;font-size: 29px;margin-bottom: 30px;margin-top: 30px;font-weight: bold;text-align: center;">
			T-ISティーズへの登録が承認されました。
			</h5>
			<p style="color:#000;">
			こちらのメールアドレスがユーザ名となります。 {{ $getCustomer->email }}
			
			</p>
			<span style="background: #fbaa84;">
			<a href="https://testikportal.management-partners.co.jp/login" style="background: #fbaa84;color: #000;box-shadow: 0 2px 4px 0 rgba(27,160,5,0.2);border-radius: 4px;border: 1px solid #ff9563;box-shadow: 0 2px 4px 0 rgba(0,0,0,0.12);
						background-size: 100%;display: inline-block;background-position: 50% 50%;font-weight: bold;line-height: 46px;font-size: 15px;
						padding: 0px 28.3px;text-align: center;text-decoration: none;min-width: 280px;-webkit-text-size-adjust: none; mso-hide: all;">
			<span style="font-size:12pt;color:#fff;border:solid #fbaa84 6.0pt;">LOGIN</span>
			</a>
			</span>
			<br> <br/>
			<div style="font-size:12px;color:#807c7c;margin-top:10px;">心当たりがない場合はこのメッセージを無視してください。</div>
			<br>
			<br>
			
		</div>
	</div>
</div>


<style>

</style>