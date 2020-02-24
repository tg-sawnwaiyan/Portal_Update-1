<template>
 <div id="login" class="loginwrapper">
    <div class="login_content">
      <div class="logo_wrap">
          <div class="brand_logo_container logo_bk">
            <img src="/images/login.png" class="brand_logo" alt="介護医療福祉の総合サイト[TIS ティーズ] ">
          </div>
        </div>
      <div class="user_card" id="altrole">
        <div class="login_link">
          <a href="/" class="home_link">ホーム</a>
          <router-link to="/register" class="reg_link  ml-auto">登録</router-link>      
        </div>
        <div class="form_content">
          <h3 class="user_name">{{name}}</h3>
          <form autocomplete="off" @submit.prevent="login" method="post">
              <div class="input-group">
                  <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                  </div>
                  <input type="text" id="email" class="form-control input_user" placeholder="メール" v-model="email"  autofocus @keyup="focusMail"> 
                  <span v-if="errors.email" class="error"><small>{{errors.email}}</small></span>
              </div>
              
              <div class="input-group">
                  <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                  </div>
                  <input type="password" class="form-control input_pass" name="password" value=""  id="password" v-model="password" placeholder="パスワード" @keyup="focusPassword" >
                <span v-if="errors.password" class="error"><small>{{errors.password}}</small></span>
              </div>
              <div class="d-flex justify-content-center mt-3">
                <button type="submit" name="button" id="getUser" :class="btn_color">ログイン</button>
              </div>
            
          </form>
          <router-link :to="{name: 'reset'}" class="login_txt">パスワードをお忘れですか？</router-link>
          <span class="alert alert-danger" v-if="has_error">パスワードが間違っています。</span>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="loginwrapper">
		<div class="d-flex justify-content-center h-100">
        <div class="user_card" id="altrole">
            <div class="links login_top">
             <router-link to="/register" class="ml-auto text login_1">登録</router-link>
              <a href="/" class="mr-auto text-white login_2">ホーム</a>
            </div>

            <div class="d-flex justify-content-center">
              <div class="brand_logo_container logo_bk">
                <img src="/images/login.png" class="brand_logo" alt="logo">
              </div>
            </div>
            <div class="d-flex justify-content-center">
              <div class="row width">
                <div class="col-12 m-t-80">
                  <div class="user_name">{{name}}</div>
                <form autocomplete="off" @submit.prevent="login" method="post">
                  <div class="m-b-20 loginposition">
                    <div class="input-group ">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                      <input type="text" id="email" class="form-control input_user" placeholder="ユーザー名" v-model="email"  autofocus @keyup="focusMail"> 
                    </div>
                     <span v-if="errors.email" class="error"><small>{{errors.email}}</small></span>
                  </div>
                   <div class="m-b-20 loginposition">
                      <div class="input-group ">
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
  </div> -->

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
        if((this.email != '' && this.mail_reg.test(this.email))){        
            this.errors.email='';
        }else{        
            this.errors.email ='※メールアドレスが必須です。';         
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