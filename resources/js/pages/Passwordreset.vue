<template>
    <div class="loginwrapper" id="psd_reset">
      <div class="user_card">
        <div class="logo_wrap">
          <div class="brand_logo_container logo_bk">
            <img src="/images/login.png" class="brand_logo" alt="介護医療福祉の総合サイト[T-IS ティーズ] ">
          </div>
        </div>
        <div class="login_link">
          <a href="/" class="home_link">ホーム</a>
          <router-link to="/register" class="reg_link  ml-auto">登録</router-link>      
        </div>
          <form class="reset_form" autocomplete="off" @submit.prevent="resetPass" method="post">
            <div class="mb-4  reset">
              <div class="input-group">
                  <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                  <input type="text" class="form-control input_user" id="email" name="email" value="" v-model="email" @keyup="focusMail" autofocus placeholder="メール">
                  <span class="invalid-feedback" role="alert">
                      <strong></strong>
                  </span>   
              </div>
              <span v-if="errors.email" class="error"><small>{{errors.email}}</small></span>
            </div>                   
              <div class="d-flex justify-content-center mt-3">
                <button type="submit" name="button" id="getUser" class="btn login_btn">送信</button>
              </div>
          </form>
          <p class="reset_txt">
            ※ ユーザ名(メールアドレス)を入力してください。<br/>
            ※ メールアドレス宛にパスワード再設定用のリンクをお送りします。
        </p>
      </div>
    </div>
</template>
<script>
  export default {
    data() {
      return {
        errors:{
          email:'',
        },
        email: null,
        has_error: false,
        mail_reg: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/
      }
    },
    mounted() {
      //
    },
    methods: {

      focusMail: function(event) {
        if((this.email != '' && this.mail_reg.test(this.email))){        
            this.errors.email='';
        }else{        
            this.errors.email ='※メールアドレスが正しくありません。もう一度入力してください。';         
        }    
      },
      resetPass() {
      
        if(this.email == '' || this.email == null)
        {
          this.errors.email = "メールアドレスが必須です。";
        }
        else{
          this.errors.email = '';
        }

        if((this.email != '' && this.mail_reg.test(this.email))){        
            this.errors.email='';
        }else{        
            this.errors.email ='※メールアドレスが正しくありません。もう一度入力してください。';         
        }    

        if(this.errors.email == '')
        {
            this.$loading(true);
            var fData = new FormData();
            fData.append('email', this.email);
            this.axios.post('/api/reset',fData) 
            .then(response => {
              
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
  }
</script>