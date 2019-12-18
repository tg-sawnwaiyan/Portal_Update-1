<template>
    <div class="loginwrapper">
		<div class="d-flex justify-content-center h-100">
            <div class="user_card">           
                <div class="d-flex justify-content-center">
                <div class="brand_logo_container">
                    <img src="/images/sample_1.png" class="brand_logo" alt="logo">
                </div>
                </div>

                <div class="d-flex justify-content-center">
                    <div class="row width">
                        <div class="col-12 m-t-50">               
                            <form autocomplete="off" @submit.prevent="resetPass" method="post" v-if="!has_success">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control input_user" id="password" name="password" value="" v-model="password" required autofocus placeholder="パスワード ">
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control input_user" id="confirm_pass" name="confirm_pass" value="" v-model="confirm_pass" required autofocus placeholder="パスワード確認">
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                                
                                <div class="d-flex justify-content-center mt-3">
                                <button type="submit" name="button" id="getUser" class="btn login_btn">Submit</button>
                                </div>
                            </form>
                            <div class="col-12" v-if="has_error">
                                <span class="alert alert-danger" v-if="has_error">パスワードが間違っています。</span>
                            </div>
                            
                            <div class="col-12" v-if="has_success">
                                <p class="alert alert-success col-12" style="text-align:center;font-size:1.2em;">
                                    Password Reset Successful.
                                </p>
                                <p class="alert alert-success col-12" style="text-align:center;">
                                    Youn can <router-link to="/login" class="col-12" style="font-weight:bold;font-size:1.2em;">ログイン</router-link> Now.
                                </p>                         
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
        password: null,
        confirm_pass: null,
        has_error: true,
        has_success: false
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
            }
        })
      }
    }
  }
</script>