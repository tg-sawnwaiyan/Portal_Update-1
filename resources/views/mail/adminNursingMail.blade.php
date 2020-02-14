<div>
<div style="text-align: left;">
	        <div style="padding: 10px;">              
                <span style="background: #fbaa84;">               
                    <a href="#" style="background: #2980B9;font-weight: 900; letter-spacing: 2px; font-size: 16px; mso-height-rule: exactly; line-height: 40px; text-align: center; text-decoration: none; display: block; font-weight: 900; text-transform: uppercase;float:left;padding:7px;">
                    <span style="color:#ffffff">T-IS</span>
                    </a> 
                    <br> 
                    <br>           
                </span>
	            
                <h5 style="color:#3e4348;font-size: 12px;margin-bottom: 30px;font-weight: bold;text-align: left;">
                    <p style="margin-top:10px;">T-IS ティーズより資料請求がございました。</p>                    
	            </h5>
                <p style="text-align: left;margin: 0px;">****************************************
                </p>
                <p style="text-align:left;margin:2px;color:#3e4348;font-size: 16px;"><span style="color:#2980B9">◎</span>【資料請求先】</p>
                @foreach($getComment->fav_name_copy as $name)
              
                    @if($name != null)
                      <label> {{$name}}</label><br/>
                    @endif

                @endforeach
                
                <p style="text-align: left;margin: 0px;">
                ****************************************
                </p>
                <p style="text-align:left;margin:2px;color:#3e4348;font-size: 16px;"><span style="color:#2980B9">◎</span>【資料請求された方について】</p>
                <p style="text-align:left;margin:2px;color:#3e4348;font-size: 12px;">
                <span style="color: #000;font-weight:bold">お名前：</span>{{$getComment->name}}
                <br>
                <span style="color: #000;font-weight:bold">ふりがな：</span>{{$getComment->furigana}}
                <br>
                <span style="color: #000;font-weight:bold">生年月日：</span>{{$getComment->bdate}}
                <br>
                <span style="color: #000;font-weight:bold">性別：</span>{{$getComment->sex1}}
                <br>
                <span style="color: #000;font-weight:bold">郵便番号：</span>{{$getComment->postal}}
                <br>
                <span style="color: #000;font-weight:bold">都道府県、市区町村、番地（建物名)：</span>{{$getComment->division}}{{$getComment->townshipname}}{{$getComment->city}}
                <br>
                <span style="color: #000;font-weight:bold">電話番号：</span>{{$getComment->phone}}
                <br>
                <span style="color: #000;font-weight:bold">メールアドレス：</span>{{$getComment->mail}}
                </p> 
                <br>
                <p style="text-align:left;margin:2px;color:#3e4348;font-size: 16px;"><span style="color:#2980B9">◎</span>【入居対象者様について】</p>
                <p style="text-align:left;margin:2px;color:#3e4348;font-size: 12px;">
                <span style="color: #000;font-weight:bold">入居対象者様とのご関係：</span>{{$getComment->relation}}
                <br>
                <span style="color: #000;font-weight:bold">お名前：</span>{{$getComment->ttname}}
                <br>
                <span style="color: #000;font-weight:bold">性別：</span>{{$getComment->sex}}
                <br>
                <span style="color: #000;font-weight:bold">年齢：</span>{{$getComment->years}}
                <br>
                <span style="color: #000;font-weight:bold">介護度：</span>{{$getComment->nursing}}
                <br>
                <span style="color: #000;font-weight:bold">認知症：</span>{{$getComment->fect}}
                <br>
                <span style="color: #000;font-weight:bold"> ご要望や、お困りごと、その他お問い合わせ：</span>{{$getComment->hope}}                    
                </p>
                <p style="text-align: left;margin: 0px;">
                 ****************************************</p>   
                <p style="font-size:12px;color:#807c7c;text-align:left;"> 
                    <span style="color:#000">[T-IS ティーズ] </span>
                    <br/>
                    〒163-0713
                    <br/>                        
                    東京都新宿区西新宿2-7-1小田急第一生命ビル13階 
                    <br/>                       
                    TEL：03-6911-???? FAX：03-6911-????
                </p>	       
	        </div>
	    </div>
</div>
  


  



