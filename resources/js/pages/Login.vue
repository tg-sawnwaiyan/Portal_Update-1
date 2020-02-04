<template>

  <div class="loginwrapper">
		<div class="d-flex justify-content-center h-100">
        <div class="user_card" id="altrole">
          <!-- <h4 style="position:relative; bottom: 60px; width:152px;">事業者ログイン</h4> -->
            <div class="links" style="top:-50px;">
              <!-- <router-link to="/" class="mr-auto text-white">ホーム</router-link> -->
              <router-link to="/register" class="ml-auto text">登録</router-link>
              <a href="/" class="mr-auto text-white">ホーム</a>
              <!-- <a href="/register" class="ml-auto text">登録</a> -->
            </div>

            <div class="d-flex justify-content-center">
              <div class="brand_logo_container">
                <img src="/images/login.png" class="brand_logo" alt="logo">
              </div>
            </div>
            <!-- <div class="col-md-12">
                <div class="row">
                </div>
            </div>
             -->
            <div class="d-flex justify-content-center">
              <div class="row width">
                <div class="col-12 m-t-80">
                  <div class="user_name">{{name}}</div>
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
                    <span>
                        <router-link :to="{name: 'reset'}" class="nav-link pad-free">パスワードをお忘れですか？</router-link>
                    </span>
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
        has_error: false,
        name:''
      }
    },
    mounted() {
     if(this.$route.path == "/admin_login"){
        $('#altrole').addClass('admin_user_card');

       }
      else {
         $('#altrole').addClass('customer_user_card');
       }
    },
    created(){
       if(this.$route.path == "/admin_login"){
         this.name="管理者ログイン";
        $('#altrole').addClass('admin_user_card');
         console.log('ADMIN LOGIN');

       }else {
         this.name ='事業者ログイン';
       }
    },

    methods: {
      login() {
        // get the redirect object

        var redirect = this.$auth.redirect()
        console.log(this)
        var _this = this
        this.$loading(true);

        if(this.$route.path == "/admin_login"){

          this.$auth.loginAdmin({
          params: {
            email: _this.email,
            password: _this.password,
          },
          success: function() {
            this.$loading(false);
            this.visit = 'false';
            localStorage.setItem('visit', this.visit);
            // handle redirection
            const redirectTo = this.$auth.user().role === 2 ? 'news_list' : '/'
            this.$router.push({name: redirectTo})
          },
          error: function(e) {
            this.$loading(false);
            console.log(e);
            _this.has_error = true
          },
          rememberMe: true,
          fetchUser: true
        })
        }else{
          this.$auth.login({
          params: {
            email: _this.email,
            password: _this.password
          },
          success: function() {
            this.$loading(false);
            this.visit = 'false';
            localStorage.setItem('visit', this.visit);
            // handle redirection
            const redirectTo = this.$auth.user().role === 1 ? 'profile' : '/'
            this.$router.push({name: redirectTo})
          },
          error: function(e) {
            this.$loading(false);
            console.log(e);
            _this.has_error = true
          },
          rememberMe: true,
          fetchUser: true
        })
        }

      }
    }
  }
</script>
<style>
.admin_user_card{
  background-color: #222d32 !important;
  color: #fff;
}
.admin_user_card .user_name{
  color: #fff !important;
}
.admin_user_card .links a{
  color: #fff !important;
}
.admin_user_card .input-group-text{
  background: #787a7b !important;
  color: #f5f5f5 !important;
}
.admin_user_card .brand_logo_container{
  border:10px solid #787a7b;
}
.customer_user_card{
  background-color: #fbfbfb !important;
}
</style>
