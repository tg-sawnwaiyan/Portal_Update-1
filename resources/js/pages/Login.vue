<template>

  <div class="loginwrapper">
		<div class="d-flex justify-content-center h-100">
        <div class="user_card" id="altrole">
          <!-- <h4 style="position:relative; bottom: 60px; width:152px;">事業者ログイン</h4> -->
            <div class="links login_top">
              <!-- <router-link to="/" class="mr-auto text-white">ホーム</router-link> -->
             <router-link to="/register" class="ml-auto text login_1">登録</router-link>
              <a href="/" class="mr-auto text-white login_2">ホーム</a>
              <!-- <a href="/register" class="ml-auto text">登録</a> -->
            </div>

            <div class="d-flex justify-content-center">
              <div class="brand_logo_container logo_bk">
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
                  <div class="m-b-20">
                    <div class="input-group">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                      <input type="email" id="email" class="form-control input_user" placeholder="ユーザー名" v-model="email"  autofocus @keyup="focusMail">
                      
                    </div>
                     <span v-if="errors.email" class="error"><small>{{errors.email}}</small></span>
                  </div>
                   <div class="m-b-20">
                      <div class="input-group">
                          <div class="input-group-append">
                              <span class="input-group-text"><i class="fas fa-key"></i></span>
                          </div>
                          <input type="password" class="form-control input_pass" name="password" value=""  id="password" v-model="password" placeholder="パスワード" @keyup="focusPassword" >
                        
                      </div>
                      <span v-if="errors.password" class="error"><small>{{errors.password}}</small></span>
                   </div>
                    <span class="alert alert-danger" v-if="has_error">パスワードが間違っています。</span>

                    <div class="d-flex justify-content-center mt-3">
                      <button type="submit" name="button" id="getUser" :class="btn_color">ログイン</button>
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
        errors:{
          email:'',
          password:''
        },
        email: null,
        password: null,
        has_error: false,
        name:'',
        btn_color:'',
        mail_reg: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/
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
         this.btn_color='btn login_btn_admin'
        $('#altrole').addClass('admin_user_card');
         console.log('ADMIN LOGIN');
       }else {
         this.name ='事業者ログイン';
         this.btn_color='btn login_btn'
       }
    },
    methods: {
       focusMail: function(event) {
          if((this.email != '' && this.mail_reg.test(this.email))){        
              this.errors.email='';
          }else{        
              this.errors.email ='※メールアドレスが正しくありません。もう一度入力してください。';         
          }    
      },
       focusPassword: function(event) {
          if(this.password != '' || this.password != null){        
              this.errors.email='';
          }  
      },
      login() {

        if(this.email == '' || this.email == null)
        {
          this.errors.email = "メールアドレスが必須です。"
        }
        else{
          this.errors.email = '';
        }
        if(this.password == '' || this.password == null)
        {
          this.errors.password = "パスワードが必須です。";
        }
        else{
          this.errors.password = '';
        }
        
        // get the redirect object
    
        if(this.errors.email == '' && this.errors.password == '')
        {
            var redirect = this.$auth.redirect()
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
              const redirectTo = this.$auth.user().role === 1 ? (this.$auth.user().type_id == 2 ? '/accountlist/hospital/'+ this.$auth.user().customer_id : '/accountlist/nursing/'+ this.$auth.user().customer_id ) : '/news_list'
              this.$router.push({path: redirectTo})
            },
            error: function(e) {
              this.$loading(false);
           
              _this.has_error = true
            },
            rememberMe: true,
            fetchUser: true
          })
          }
        }
       
      }
    }
  }
</script>
<style>
.error{
  position: absolute;
}
.admin_user_card{
  background-color: #3791B9 !important;
  color: #fff;
}
.admin_user_card .user_name{
  color: #fff !important;
}
.admin_user_card .links a{
  color: #fff !important;
}
.admin_user_card .input-group-text{
  background: #044A77 !important;
  color: #F5F5F5 !important;
}
.admin_user_card .brand_logo_container{
  border: 10px solid #4399BF;
}
.customer_user_card{
  background-color: #FBFBFB !important;
}
@media only screen and (max-width: 380px){
  .admin_user_card{
    background-color: #fff !important;
  }
}
</style>