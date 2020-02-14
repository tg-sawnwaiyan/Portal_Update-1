<div style="width:800px;">
<!-- Hi, This is : {{ $getCustomer->email }} -->
<div style="text-align: left;">
        <div> 
        <span style="background: #fbaa84;">               
            <a href="#" style="background: #2980B9;font-weight: 900; letter-spacing: 2px; font-size: 16px; mso-height-rule: exactly; line-height: 40px; text-align: center; text-decoration: none; display: block; font-weight: 900; text-transform: uppercase;float:left;padding:7px;">
            <span style="color:#ffffff">T-IS</span>
            </a> 
            <br> 
            <br>           
        </span>           

            <p style="color:#3e4348;font-size: 12px;font-weight: bold;text-align: left;margin-top: 34px;">
            {{$getCustomer->name}} 様
            </p>
            <h5 style="color:#3e4348;font-size: 20px;font-weight: bold;text-align: left;margin-bottom:0px;">
            T-ISティーズへの登録が承認されました。
            </h5>
            <br/>
            <p style="color:#000;margin-top:0px;">
            こちらのメールアドレスがユーザ名となります。 {{ $getCustomer->email }}
            
            </p>
            <span style="background: #2980B9;">
          

             <a href="https://testikportal.management-partners.co.jp/login" style="color: #fff; -moz-border-radius: 4px;background: #2980B9; border: 1px solid #2980B9; font-weight: 900; letter-spacing: 2px; font-size: 16px; mso-height-rule: exactly; line-height: 35px; text-align: center; text-decoration: none; display: block; border-radius: 4px; font-weight: 900; text-transform: uppercase;width:218px;">
                ログイン
                </a>
            </span>
   
            <div style="font-size:12px;color:#807c7c;margin-top:10px;">心当たりがない場合はこのメッセージを無視してください。</div>
            <br>
            <br>
            
        </div>
    </div>
</div>


<style>

</style>