<pre>
{{$getComment->name}} 様

TIS ティーズへの資料請求が完了しました。   

【資料請求先】                
@foreach($getComment->fav_name_copy as $name)
@if($name != null)
{{$name}}
@endif
@endforeach

************************************************
TIS ティーズ                  
運営会社　株式会社 TRUST-ESTATE               
〒164-0003　東京都中野区東中野1-59-9　リックビル2階                                         
TEL ：03-6279-1951   FAX ：03-6279-1952
************************************************
</pre>