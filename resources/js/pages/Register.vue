<template>
    <div id="register" class="loginwrapper">
        <div class="login_content">
            <div class="logo_wrap">
                <div class="brand_logo_container logo_bk">
                    <img src="/images/login.png" class="brand_logo" alt="介護医療福祉の総合サイト[TIS ティーズ]">
                    <div id="preview">
                        <img v-if="url" :src="url" class="brand_logo" alt="介護医療福祉の総合サイト[TIS ティーズ]">
                    </div>
                </div>
            </div>
            <div class="user_card user_registercard">
                <div class="login_link">
                    <a href="/" class="home_link">ホーム</a>
                <router-link to="/login" class="ml-auto text">ログイン</router-link>    
                </div>
                <div class="form_content">
                    <div class="reg_title">事業者新規登録</div>
                    <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post" class="registerformwrapper">                       
                         <div class="form-group row">
                            <label class="col-12 col-lg-3 col-md-4 control-label">事業者名</label>
                            <div class="col-12 col-lg-9 col-md-8  p-0">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                   <input type="text" class="form-control" name="name" v-model="username"  placeholder="事業者名を入力してください。" @keyup="focusName">
                                    <span v-if="errors.username" class="error">{{errors.username}}</span>
                                </div>
                            </div>
                        </div>

                        <div  class="form-group row">                           
                            <label class="col-12 col-lg-3 col-md-4 control-label">メールアドレス </label>
                            <div class="col-12 col-lg-9 col-md-8  p-0">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="email" v-model="email"  placeholder="メールアドレスを入力してください。"  @keyup="focusMail"> 
                                    <span v-if="errors.email" class="error">{{errors.email}}</span>
                                </div>
                            </div>
                        </div>

                        <div  class="form-group row">
                            <label class="col-12 col-lg-3 col-md-4 control-label">パスワード </label>
                            <div class="col-12 col-lg-9 col-md-8  p-0">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control" name="password" @keyup="password_validate()" v-model="password" id="pwd"  placeholder="パスワードを入力してください。">
                                    <span v-if="errors.password" class="error">{{errors.password}}</span>
                                </div>
                            </div>
                         </div>

                         <div  class="form-group row">
                            <label class="col-12 col-lg-3 col-md-4 control-label">パスワード確認</label>
                            <div class="col-12 col-lg-9 col-md-8  p-0">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control" name="comfirm_password" id="confirm_pwd" @keyup="password_validate()" v-model="password_confirmation"  placeholder="パスワードをもう一度入カしてください。">
                                    <span v-if="errors.password" class="error">{{errors.password}}</span>
                                </div>
                            </div>
                        </div>

                        <div  class="form-group row">
                            <label class="col-12 col-lg-3 col-md-4 control-label">事業者タイプ</label>
                            <div class="col-12 col-lg-9 col-md-8  p-0">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-list"></i></span>
                                    </div>
                                    <select id="type" class="form-control custom-select" name="types" :value="type.id" v-model="type" @change="focusType" >
                                        <option value="">事業者のタイプを選択してください(介護又は病院)</option>
                                        <option value="3">介護</option>
                                        <option value="2">病院</option>
                                    </select>
                                    <span v-if="errors.type" class="error">{{errors.type}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group hide form-check form-check-inline" id="showHideActionNursing">
                            <label class="col-12 col-lg-3 col-md-4 control-label">看護種類</label>
                            <div class="input-group-append " id="nursing">
                            </div>
                            <div class="error" id="radioerror" style="margin-bottom: 6px;margin-left: 210px;">必須</div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-12 col-lg-3 col-md-4 control-label">電話番号</label>
                            <div class="col-12 col-lg-9 col-md-8  p-0">
                                <span style="color:#999;">※ 数字と'-'のみ </span>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                    </div>
                                    <input class="form-control" id="phone" name="phone" pattern="[0-9-]*" v-model="phone"  placeholder="電話番号を入力してください。" @keyup="focusPhone" title="Please enter number only." maxlength="14">
                                    <span class="error" v-if="ph_length || ph_num">※電話番号が必須です。</span>
                                </div>
                            </div>
                        </div>
                        <!-- <div id="jsErrorMessage" class="error"></div> -->

                            <div class="form-group col-12 text-center">
                                    <button type="submit" class="btn register_btn login_btn" id="sub_btn">作成</button>
                            </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  export default {
    data() {
      return {
        images:'',
        img_name:'',
        username: '',
        email: '',
        //cities: [],
        //city : '',
        //townships :[],
        //township :'',
        type:'',
        typ:[],
        types:[],
        phone:'',
        address:'',
        password: '',
        password_confirmation: '',
        passerr: false,
        has_error: false,
        error: '',
        errors: {
            img:"",
            name:"",
            email:"",
            password:"",
            username:"",
            type:''
            //cities:"",
            //township:""
        },

        success: false,
        show: true,
        url: '',
        ph_length:'',
        ph_num:'',
        Numbers:[],
        mail_reg:  /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/
      }

    },

    methods: {
        // isNumberOnly: function(event) {

        //   var input_data = $('#phone').val();


        //     if(input_data == '')
        //     {
        //         this.Numbers = [];
        //     }
        //     var code = 0;
        //     code = String.fromCharCode(event.keyCode).charCodeAt();

        //     if(event.key == "Backspace")
        //     {
        //        this.Numbers.splice(this.Numbers.length-1);
        //     }
        //     else{

        //         if(this.Numbers.length < 14 )
        //          {
        //             this.Numbers.push(code);
        //          }

        //     }
        //  console.log(this.Numbers);

        //     if((this.phone.length >= 10 && this.phone.length <= 14) ){

        //         this.ph_num = false;
        //         this.ph_length = false;
        //     }else{

        //         this.ph_num = true;
        //         this.ph_length = true;
        //     }

        // },
    //   getCities() {
    //      this.axios.get('/api/auth/getCities')
    //      .then(function (response) {
    //          console.log("getCities")
    //          console.log(response)
    //       this.cities = response.data.cities;
    //       }.bind(this));
    //   },
    //   getTownship(){
    //     this.show = false;
    //     this.axios.get('/api/auth/township',{
    //       params:{
    //         city:this.city
    //       },
    //     }).then((response)=>{
    //         console.log("townships")
    //         console.log(response.data.townships)
    //       this.townships = response.data.townships
    //     })
    //   },
      getType(){
        this.axios.get('/api/auth/getTypes',{
          params:{
            type:this.type
          },
        }).then((response)=>{
          this.types = response.data.types
    
        })
      },
    // isNumberOnly(event) {
    //     console.log('numbers');
    //     if(!(event.keyCode >= 48 && event.keyCode <= 57) && !(event.keyCode >= 96 && event.keyCode <= 105)
    //         && event.keyCode != 8 && event.keyCode != 46 && !(event.keyCode >= 37 && event.keyCode <= 40))
    //     {
    //         event.preventDefault();
    //     }
    // },
    password_validate() {
        // var pwd = $('#pwd').val();
        // var confirm_pwd = $('#confirm_pwd').val();
        window.pwd_same = false;
        var nursing_type_exist = false;
        if(this.password != this.password_confirmation) {
            // this.passerr = true;
            this.errors.password = "※パスワードが一致しません。";
            // $('#passworderror').css("display","block");
        }
        else {
            // $('#passworderror').css("display","none");
            // this.passerr = false;
            this.errors.password = null;
            window.pwd_same = true;
        }
    },
    focusName:function(event)
    {
        if(this.username != null || this.username != '')
        {
            this.errors.username = ''
        }
    },
    focusType:function(event)
    {
        if(this.type != '')
        {
            this.errors.type = ''
        }
    },

       focusMail: function(event) {
     
    
                if((this.email != '' && this.mail_reg.test(this.email))){
                
                    this.errors.email='';
                }else{
                  
                    this.errors.email ='※メールアドレスが正しくありません。もう一度入力してください。';
                  
                }
             
            },
            
  
      register() {
        
          if(this.type == '')
          {
             this.errors.type = "事業者タイプを選択してください。";
          }
          else{
              this.errors.type = '';
          }
    
          if(this.username == null || this.username == '')
          {
              this.errors.username = "事業者名が必須です。";
          }
          else
          {
              this.errors.username = "";
          }

          if(this.email == null || this.email == '')
          {
              this.errors.email = "メールアドレスが必須です。";
          }
          else
          {
              this.errors.email = "";
          }

          if(this.password_confirmation == null || this.password_confirmation == '' || this.password == null || this.password == '')
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

        var input_data = $('#phone').val();
        if(input_data.length >= 10 && input_data.length <= 14)
        {
            this.ph_num = false;
            this.ph_length = false;
        } else {
            this.ph_num = true;
            this.ph_length = true;
            return;
        }

        if(this.errors.email == '' && this.errors.username == '' && this.errors.password == '' && this.errors.type == '' && this.ph_num == false && this.ph_length == false)
        {
            
            var app = this
            let fData = new FormData();
            //fData.append('img', app.images)
            fData.append('name', app.username)
            fData.append('email', app.email)
            fData.append('password', app.password)
            fData.append('comfirm_password', app.password_confirmation)
            //fData.append('cities', app.city)
            //fData.append('township', app.township)
            fData.append('types', app.type)
            fData.append('phone', app.phone)
            var seltype = app.type == 2 ? '病院': '介護';
           
            this.$swal({
                title: 'この内容で登録しますか。',  
                html: "事業者名:"+app.username+"<br/>メールアドレス:"+app.email+"<br/>事業者タイプ:"+seltype+"<br/>電話番号:"+app.phone,              
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'はい',
                cancelButtonText: 'いいえ',
                showCloseButton: true,
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                }).then((result) => {
                    if(result) {
                        this.$loading(true);
                        this.axios.post('/api/register', fData).then(response => {
                        this.$loading(false);
                            this.$swal({
                                position: 'top-end',
                                type: 'success',
                                title: 'サイト管理者に登録情報を通知いたしました。',
                                html: "登録審査後、事業者様にメールにてお知らせいたします。<br/>しばらくおまちください。",
                                width: 350,
                                height: 200,
                                confirmButtonColor: "#6cb2eb",
                                confirmButtonText: "閉じる",
                                confirmButtonClass: "all-btn",
                                allowOutsideClick: false,
                            })
                            this.$router.push({
                                name: 'News'
                            });
                        }).catch(error => {
                            this.$loading(false);
                            if(error.response.status == 422){
                            
                            this.errors = error.response.data.errors;
                        
                            if(this.errors.email)
                            {
                                this.errors.email = "このメールアドレスは既に存在します。";
                            }
                            else{
                                this.errors.email = "";

                            }
                            if(this.errors.password)
                            {
                                this.errors.password = "パスワードは6桁以上必要です。"
                            }
                            else{
                                this.errors.password = "";
                            }
                        }
                        
                        })
                        
                    } 
                })
                // .catch(error =>{

                //         this.$swal('Cancelled', 'Your file is still intact', 'info')
                //     });
                }
             
            
       


      },
      focusPhone(){

        var input_data = $('#phone').val();

        if(input_data.charAt(input_data.length - 1) != '-' && input_data.charAt(0) != '-' && input_data.length >= 10 && input_data.length <= 14)
        {
            this.ph_num = false;
            this.ph_length = false;
        }
        else{
            this.ph_num = true;
            this.ph_length = true;
        }

      }

    },
    created(){
      //this.getCities()
    }

  }
</script>

<style>

.img{
    opacity: 1;
    transition: 0.5s;
    width:200px;
    height:200px;
  }

</style>
