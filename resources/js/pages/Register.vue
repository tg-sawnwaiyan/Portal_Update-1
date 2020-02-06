<template>
    <div class="login_wp" >
        <div class="d-flex justify-content-center h-100">
            <div class="user_card user_registercard">
                <div class="links links_2">
                    <!-- <router-link to="/" class="mr-auto text-white" style="color: #a93f0c!important;font-weight:bold;">ホーム</router-link> -->
                    <router-link to="/login" class="ml-auto text">ログイン</router-link>
                    <a href="/" class="mr-auto text-white ">ホーム</a>
                    <!-- <a href="/login" class="ml-auto text" style="color: #a93f0c!important;font-weight:bold;">ログイン</a> -->
                </div>

                <div class="d-flex justify-content-center registerform_container">
                    <div class="brand_logo_container logo_bk">
                        <!-- <h4 style="position:relative; bottom: 60px; width:152px;">事業者新規登録</h4> -->
                        <img src="/images/login.png" class="brand_logo" alt="Logo">
                        <div id="preview">
                          <img v-if="url" :src="url" class="brand_logo" alt="Logo">
                        </div>
                    </div>
                </div>
                <!-- <div class="error" id="radioerror" style="margin-bottom: 6px;margin-left: 210px;" v-if="errors !=''">入カされたデータが不正です</div> -->

                <div class="alert alert-danger" v-if="has_error && !success">
                    <p v-if="error == 'registration_validation_error'">Validation error (s), please consult the message (s) below.</p>
                    <p v-else>Error, can not register at the moment. If the problem persists, please contact an administrator.</p>
                </div>
          <div class="reg_title">事業者登録</div>
                <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post" class="registerformwrapper">
                    <!-- <div id="preview">
                        <img v-if="url" :src="url" class="img-thumbnail img" />
                    </div> -->
                    <!-- <div class="input-group mb-3 mb-7 inputfile">
                        <label class=" col-lg-3 col-md-4 col-12 control-label">ロゴ</label>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                        </div> -->
                        <!-- <span class="btn all-btn choose-btn" style="color: #2C3E50 !important;box-shadow:none!important;" @click="choosefile()">ロゴを選択</span> <span id="imgname" style = "padding: 8px 0 0 30px;">{{img_name}}</span>
                        <input type="file" class="inputfile" name="img" @change="onFileChange"/> -->
                         <!-- <span v-if="errors.img" class="error">{{errors.img}}</span> -->
                        <!-- <input type="file" accept="image/*" @change="showMyImage(this)" name="img" id="file" ref="file" class="form-control inputfile"> -->
                    <!-- </div> -->
                    <div class="input-group mb-3 mb-7">
                        <label class="col-12 col-lg-3 col-md-4 control-label">事業者名</label>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="name" v-model="username" required placeholder="事業者名を入力してください。">
                        <!-- <span v-if="errors.name" class="error p-l-162">{{errors.name}}</span> -->
                    </div>


                    <div class="input-group mb-3 mb-7">
                        <label class="col-12 col-lg-3 col-md-4 control-label">メールアドレス </label>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" name="email" v-model="email" required placeholder="メールアドレスを入力してください。">

                         <div class="col-md-12 pad-free">
                            <span v-if="errors.email" class="error p-l-162">{{errors.email}}</span>
                        </div>
                    </div>


                    <div class="input-group mb-3 mb-7">
                        <label class="col-12 col-lg-3 col-md-4 control-label">パスワード </label>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control" name="password" @keyup="password_validate()" v-model="password" id="pwd" required placeholder="パスワードを入力してください。">
                        <div class="col-md-12 pad-free">
                            <span v-if="errors.password" class="error p-l-162">{{errors.password}}</span>
                        </div>

                    </div>


                    <div class="input-group mb-3 mb-7">
                        <label class="col-12 col-lg-3 col-md-4 control-label">パスワード確認</label>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control" name="comfirm_password" id="confirm_pwd" @keyup="password_validate()" v-model="password_confirmation" required placeholder="パスワードをもう一度入カしてください。">
                         <div class="col-md-12 pad-free">
                            <span v-if="errors.password" class="error p-l-162">{{errors.password}}</span>
                        </div>

                    </div>


                    <!-- <span class="error p-l-162" v-if="passerr">※パスワードが一致しません。</span> -->

                    <div class="input-group mb-3 mb-7">
                        <label class="col-12 col-lg-3 col-md-4 control-label">事業者タイプ</label>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-list"></i></span>
                        </div>
                        <select id="type" class="form-control custom-select" name="types" :value="type.id" v-model="type" required>
                            <option value="">事業者のタイプを選択してください(介護又は病院)。</option>
                            <option value="3">介護</option>
                            <option value="2">病院</option>

                        </select>
                    </div>

                    <div class="input-group mb-3 mb-7 hide form-check form-check-inline" id="showHideActionNursing">
                        <label class="col-12 col-lg-3 col-md-4 control-label">看護種類</label>
                        <div class="input-group-append " id="nursing">
                        </div>
                        <div class="error" id="radioerror" style="margin-bottom: 6px;margin-left: 210px;">必須</div>
                    </div>

                    <!-- <div class="input-group mb-3 mb-7">
                        <label class="col-12 col-lg-3 col-md-4 control-label">都道府県</label>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>

                        </div>
                        <select name="cities" id="cities" v-model="city" @change="getTownship()" class="form-control custom-select" required>
                            <option value="">都道府県を選択してください。</option>
                            <option v-for ="city in cities" :value='city.id' :key="city.id">{{ city.city_name }}</option>
                        </select>
                         <span v-if="errors.cities" class="error">{{errors.cities}}</span>
                    </div> -->

                    <!-- <div class="input-group mb-3 mb-7" v-if="!show">
                        <label class="col-12 col-lg-3 col-md-4 control-label">市区町村</label>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        </div>
                        <select name="township" id="township" v-model='township' class="form-control custom-select" required>
                            <option value="">市区町村を選択してください。</option>
                            <option v-for ="township in townships" :value='township.id' :key='township.id'>{{ township.township_name }}</option>
                        </select>
                         <span v-if="errors.township" class="error">{{errors.township}}</span>
                    </div> -->
                    <span class="p-l-162" style="color:#999;">※ 数字と'-'のみ </span>
                    <div class="input-group mb-3 mb-7">

                        <label class="col-12 col-lg-3 col-md-4 control-label">電話番号</label>

                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                        </div>

                        <input class="form-control" id="phone" name="phone" pattern="[0-9-]*" v-model="phone" required placeholder="電話番号を入力してください。" @keyup="focusPhone" title="Please enter number only." maxlength="14">

                        <div class="col-md-12 pad-free">
                            <span class="error p-l-162" v-if="ph_length || ph_num">※電話番号が正しくありません。もう一度入力してください。</span>
                        </div>

                    </div>
                    <div id="jsErrorMessage" class="error p-l-162"></div>

                      <div class="form-group col-12 text-center">
                              <button type="submit" class="btn register_btn login_btn" id="sub_btn">作成</button>
                      </div>


                </form>
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
            //cities:"",
            //township:""
        },

        success: false,
        show: true,
        url: '',
        ph_length:'',
        ph_num:'',
        Numbers:[]
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
          console.log("response.data types")
          console.log(response.data.types)
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
    // choosefile() {
    //     $('.inputfile').trigger('click');
    // },
    //   onFileChange(e) {
    //   const file = e.target.files[0];
    //   this.images = file;
    //   this.img_name = file.name;
    //   this.url = URL.createObjectURL(file);
    // },
      register() {

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

        this.$loading(true);
        this.axios.post('/api/register', fData)
                            .then(response =>
                             {
                                 this.$loading(false);
            this.$swal({
                position: 'top-end',
                type: 'success',
                title: 'メールを送付しました。',
                text: '確認のためしばらくお待ちください。',
                width: 350,
                height: 200,
                confirmButtonColor: "#6cb2eb",
                confirmButtonText: "閉じる",
                confirmButtonClass: "all-btn",
            })
                this.$router.push({
                    name: 'News'
                });
          }).catch(error=>{
            if(error.response.status == 422){
             this.$loading(false);
             this.errors = error.response.data.errors;
                if(this.errors.name)
                {
                    this.errors.name = "Name is required and must be greater than three.";
                }
                else{
                    this.errors.name = "";
                }
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


                // app.errors = error.response.data.message

            }});


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
