<template>
    <div class="loginwrapper">
		<div class="d-flex justify-content-center h-100">
        <div class="user_card">
            <div class="links" style="top:-65px;">
              <!-- <router-link to="/" class="mr-auto text-white">ホーム</router-link> -->
              <router-link to="/login" class="ml-auto text" style="color: #a93f0c!important;font-weight:bold;">ログイン</router-link>
              <a href="/" class="mr-auto text-white">ホーム</a>
              <!-- <a href="/register" class="ml-auto text">登録</a> -->
            </div>

            <div class="d-flex justify-content-center">
              <div class="brand_logo_container">
                <img src="/images/login.png" class="brand_logo" alt="logo">
              </div>
            </div>            
            <div class="d-flex justify-content-center">
              <div class="row width">
                <div class="col-12 m-t-50">   
                  <!-- <div class="user_name">パスワードのリセット</div>                       -->
                <form autocomplete="off" @submit.prevent="resetPass" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control input_user" id="email" name="email" value="" v-model="email" required autofocus placeholder="ユーザー名">
                        <span class="invalid-feedback" role="alert">
                            <strong></strong>
                        </span>
                    </div>
                    
                    <div class="d-flex justify-content-center mt-3">
                      <button type="submit" name="button" id="getUser" class="btn login_btn">送信</button>
                    </div>
                </form>
                </div>
              </div>
            </div>
            <div style="text-align: justify;" class="m-t-20 d-flex">
                ※ ユーザ名(メールアドレス)を入力してください。<br/>
                ※ メールアドレス宛にパスワード再設定用のリンクをお送りします。
            </div>
        </div>
    </div>
    </div>
</template>
<script>
  export default {
    data() {
      return {
        email: null,
        has_error: false
      }
    },
    mounted() {
      //
    },
    methods: {
      resetPass() {
       this.$loading(true);
        // get the redirect object
        var fData = new FormData();
        fData.append('email', this.email);
        this.axios.post('/api/reset',fData) 
        .then(response => {
            console.log(response)
           this.$loading(false);
            this.$swal({       
                      text: "ご登録のメールアドレスにパスワード変更用のURLを送付しました。",
                      type: "success",
                      width: 390,
                      height: 200,                        
                      confirmButtonColor: "#6cb2eb",                         
                      confirmButtonText: "閉じる",
                      confirmButtonClass: "all-btn",
                  
                  }).then(response => { 
                      this.$router.push({name: 'login'});
                   });
              }).catch(error=>{
                  console.log(error)
                  this.$loading(false);  
            if(error.response.status == 404){
                
                this.$swal({
                            title: "このメールアドレスは存在しません。",
                            text: "ご確認の上、もう一度お試しください。",
                            type: "warning",
                            width: 390,
                            height: 200,                        
                            confirmButtonColor: "#6cb2eb",                         
                            confirmButtonText: "閉じる",
                            confirmButtonClass: "all-btn",
                        
                        })
            }});
          }
      }
  }
</script>