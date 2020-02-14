<template>
   <div class="loginwrapper">
    <div class="user_card" id="altrole">
        <div class="logo_wrap">
            <div class="brand_logo_container logo_bk">
            <img src="/images/login.png" class="brand_logo" alt="介護医療福祉の総合サイト[T-IS ティーズ] ">
            </div>
        </div>
        <div class="login_link">
            <a href="/" class="home_link">ホーム</a>
            <router-link to="/register" class="reg_link  ml-auto">登録</router-link>      
        </div>
    </div>
   </div>
</template>
<script>
  export default {
    data() {
      return {
        password: null,
        confirm_pass: null,
        has_error: false,
        has_success: false,
        is_disabled: false,
        errors:{
            password:'',
            confirmPassword:''
        }
      }
    },
    mounted() {
      //
    },
    created() {
        console.log(this.$route.query.code)
    },
    methods: {
        resetPass() {
            if(this.password == '' || this.password == null)
            {
                this.errors.password = "パスワードが必須です。";
            }
            else{
                this.errors.password = '';
            }
             if(this.confirm_pass == '' || this.confirm_pass == null)
            {
                this.errors.confirmPassword = "パスワードが必須です。";
            }
            else{
                this.errors.confirmPassword = '';
            }
            if(this.password.length < 6 || this.confirm_pass.length < 6)
            {
                this.has_error = true;
                this.error_text = "Password must be greater than 6 ";
            }
            else{
                this.error_text = '';
            }

            if(this.errors.password == '' && this.errors.confirmPassword == '' && this.error_text == '')
            {
                      // get the redirect object
                    var fData = new FormData();
                    fData.append('password', this.password);
                    fData.append('token', this.$route.query.code);
                    this.axios.post('/api/resetpassword',fData) 
                    .then(response => {
                        console.log(response)
                        if(response.data == "success"){
                            this.has_success = true;
                        }
                        else{
                            this.has_error = true;
                            this.error_text = "Token Expired. Send Mail again.";
                            this.is_disabled = true;
                            $("#changePass").css('cursor','not-allowed')
                        }
                    })
            }
            
        },
        password_validate() {
             if(this.password == '' || this.password == null)
            {
                this.errors.password = "パスワードが必須です。";
            }
            else{
                this.errors.password = '';
            }
             if(this.confirm_pass == '' || this.confirm_pass == null)
            {
                this.errors.confirmPassword = "パスワードが必須です。";
            }
            else{
                this.errors.confirmPassword = '';
            }
            if(($('#password').val() != $('#confirm_pass').val()) ) {
                console.log('a');
                this.has_error = true;
                this.error_text = "※パスワードが一致しません。 ";
                this.is_disabled = true;
                $("#changePass").css('cursor','not-allowed')
            }
            else {
                  console.log('b');
                this.has_error = false;
                this.is_disabled = false;
                $("#changePass").css('cursor','pointer')
            }
        },
    }
  }
</script>
<style scoped>
.d-flex .alert-danger{
    width:90%;
    top:200px;
}
</style>