<template>
    <div class="loginwrapper">
		<div class="d-flex justify-content-center h-100">
        <div class="user_card">
            <div class="links" style="top:-134px;">
              <!-- <router-link to="/" class="mr-auto text-white">ホーム</router-link> -->
              <router-link to="/login" class="ml-auto text" style="color: #a93f0c!important;font-weight:bold;">ログイン</router-link>
              <a href="/" class="mr-auto text-white">ホーム</a>
              <!-- <a href="/register" class="ml-auto text">登録</a> -->
            </div>

            <div class="d-flex justify-content-center">
              <div class="brand_logo_container">
                <img src="/images/sample_1.png" class="brand_logo" alt="logo">
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="row width">
                <div class="col-12 m-t-80">               
                <form autocomplete="off" @submit.prevent="resetPass" method="post">
                    <div class="input-group mb-3">
                      <span>ユーザ名(メールアドレス)を入力してください。メールアドレス宛にパスワード再設定用のリンクをお送りします。</span>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control input_user" id="email" name="email" value="" v-model="email" required autofocus placeholder="ユーザー名">
                        <span class="invalid-feedback" role="alert">
                            <strong></strong>
                        </span>
                    </div>
                    
                    <div class="d-flex justify-content-center mt-3">
                      <button type="submit" name="button" id="getUser" class="btn login_btn">Submit</button>
                    </div>
                </form>
                <!-- <div class="mt-4">
					<div class="d-flex justify-content-center links d-margin">
						<span class="text-center">
                            <a href="/">家に帰る</a>
                        </span>                        
					</div>                   
				</div>                  -->
                </div>
              </div>
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
                    
                      text: "Check your email to change new password",
                      type: "info",
                      width: 390,
                      height: 200,                        
                      confirmButtonColor: "#6cb2eb",                         
                      confirmButtonText: "OK",
                      confirmButtonClass: "all-btn",
                  
                  }).then(response => { 
                      this.$router.push({name: 'login'});
                   });
              }).catch(error=>{
                  console.log(error)
                  this.$loading(false);  
            if(error.response.status == 404){
                
                this.$swal({
                            title: "Your email does not exist",
                            text: "Check your email back",
                            type: "warning",
                            width: 390,
                            height: 200,                        
                            confirmButtonColor: "#6cb2eb",                         
                            confirmButtonText: "OK",
                            confirmButtonClass: "all-btn",
                        
                        })
            }});
          }
      }
  }
</script>