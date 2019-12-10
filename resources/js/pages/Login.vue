<template>
    <div class="loginwrapper">
		<div class="d-flex justify-content-center h-100">
        <div class="user_card">
            <div class="links" style="top:-80px;">
              <!-- <router-link to="/" class="mr-auto text-white">ホーム</router-link> -->
              <router-link to="/register" class="ml-auto text">登録</router-link>
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
                <form autocomplete="off" @submit.prevent="login" method="post">
                    <div class="input-group m-b-20">
											<div class="input-group-append">
												<span class="input-group-text"><i class="fas fa-user"></i></span>
											</div>                      
                      <input type="email" id="email" class="form-control input_user" placeholder="ユーザー名" v-model="email" required autofocus>                                            
                    </div>
                    <div class="input-group m-b-20">
											<div class="input-group-append">
												<span class="input-group-text"><i class="fas fa-key"></i></span>
											</div>
											<input type="password" class="form-control input_pass" name="password" value=""  id="password" v-model="password" placeholder="パスワード" required >
                        
                    </div>
                    <span class="alert alert-danger" v-if="has_error">パスワードが間違っています。</span>
                    
                    <div class="d-flex justify-content-center mt-3">
                      <button type="submit" name="button" id="getUser" class="btn login_btn">ログイン</button>
                    </div>
                </form>
                <div class="mt-4">
                  <div class="d-flex justify-content-center links">
                    <span><a href="">パスワードをお忘れですか？</a></span>

                  </div>
                </div>                 
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
        password: null,
        has_error: false
      }
    },
    mounted() {
      //
    },
    methods: {
      login() {
        // get the redirect object
        var redirect = this.$auth.redirect()
        var _this = this
        this.$auth.login({
          params: {
            email: _this.email,
            password: _this.password
          },
          success: function() {
            // handle redirection
            const redirectTo = redirect ? redirect.from.name : 'News'
            this.$router.push({name: redirectTo})
            console.log(this.$auth)
          },
          error: function(e) {
            console.log(e);
            _this.has_error = true
          },
          rememberMe: true,
          fetchUser: true
        })
      }
    }
  }
</script>