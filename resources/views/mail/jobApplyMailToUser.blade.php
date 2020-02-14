<div style="width:800px;">
<div style="text-align: left;">
            <div style="padding: 10px;">

                <!-- <span style="font-size: 40px;font-weight: bold;color: #d2571c;text-shadow: 3px 4px #ccc;">LOGO <span style="font-size: 30px; color: #f57e46;">HERE</span></span> -->

                <div style="text-align:left;">    <span style="background: #fbaa84;">               
                <a href="#" style="background: #2980B9;font-weight: 900; letter-spacing: 2px; font-size: 16px; mso-height-rule: exactly; line-height: 40px; text-align: center; text-decoration: none; display: block; font-weight: 900; text-transform: uppercase;float:left;padding:7px;">
                <span style="color:#ffffff">T-IS</span>
                </a> 
                <br> 
                <br>           
                </span></div>

                <h5 style="color:#3e4348;font-size: 12px;margin-bottom: 30px;font-weight: bold;text-align: left;">
              {{$getComment->first_name}}&nbsp;&nbsp;様
                    <p style="margin-top:10px;">以下の求人へ応募が完了いたしました。</p>                    
              </h5>
              <p style="text-align:left;margin:2px;color:#3e4348;font-size: 16px;font-weight:bold;"><span style="color:#2980B9">◎&nbsp;</span>{{$getComment->job_title}}</p>
                    <p style="text-align:left;margin:2px;color:#3e4348;font-size: 12px;padding-left:10px;"> 【求人番号: {{$getComment->jobnum}}】</p>
                    <p style="text-align: left;margin: 0px;">
                    ****************************************</p>
                    <p style="text-align:left;margin:2px;font-size: 16px;"><span style="color:#2980B9">◎&nbsp;</span>【ご応募された方の情報】</p> 
                    <p style="text-align:left;margin:2px;color:#3e4348;font-size: 12px;">
                    <strong> 仕事内容 </strong> ：{{$getComment->job_description}}
                    <br>
                    <strong> 経験・スキル </strong> ：{{$getComment->skill}}
                    <br>
                    <strong> 勤務地 </strong> ：{{$getComment->job_location}}
                    <br>
                    <strong> 最寄り駅 </strong> ：{{$getComment->job_nearest_station}}
                    <br>
                    <strong> 雇用形態 </strong> ：{{$getComment->job_employment_status}}
                    <br>
                    <strong> 給料 </strong> ： {{$getComment->salary}}
                    <br>
                    <strong> 特別な条件 </strong> ：{{$getComment->allowances}}
                    <br>
                    <strong> 各種保険 </strong> ：{{$getComment->insurance}}
                    <br>
                    <strong> 就業時間 </strong> ：{{$getComment->job_working_hours}}
                    <br>
                    <strong> 休日休暇 </strong> ：{{$getComment->holidays}}
                    <br>
                    <strong> 事業者名 </strong> ：{{$getComment->cus_name}}
                    <br>
                    ご希望等：
                    </p> 
                    <br>
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