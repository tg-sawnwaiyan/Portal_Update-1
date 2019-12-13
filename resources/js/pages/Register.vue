<template>
    <div class="loginwrapper">
        <div class="d-flex justify-content-center h-100">     
            <div class="user_card user_registercard">
                <div class="links">
                    <!-- <router-link to="/" class="mr-auto text-white" style="color: #a93f0c!important;font-weight:bold;">ホーム</router-link> -->
                    <router-link to="/login" class="ml-auto text" style="color: #a93f0c!important;font-weight:bold;">ログイン</router-link>
                    <a href="/" class="mr-auto text-white" style="color: #a93f0c!important;font-weight:bold;">ホーム</a>
                    <!-- <a href="/login" class="ml-auto text" style="color: #a93f0c!important;font-weight:bold;">ログイン</a> -->
                </div>

                <div class="d-flex justify-content-center registerform_container">
                    <div class="brand_logo_container">
                        <img src="/images/sample_1.png" class="brand_logo" alt="Logo">
                        <div id="preview">
                          <img v-if="url" :src="url" class="brand_logo" alt="Logo">
                        </div>                        
                    </div>
                </div>

                <div class="alert alert-danger" v-if="has_error && !success">
                    <p v-if="error == 'registration_validation_error'">Validation error (s), please consult the message (s) below.</p>
                    <p v-else>Error, can not register at the moment. If the problem persists, please contact an administrator.</p>
                </div>

                <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post" class="registerformwrapper">
                    <!-- <div id="preview">
                        <img v-if="url" :src="url" class="img-thumbnail img" />
                    </div> -->
                    <div class="input-group mb-3 inputfile">
                        <label class="col-4 col-lg-3 control-label">ロゴを添付</label>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                        </div>
                        <span class="btn all-btn choose-btn" style="color: #a93f0c!important;box-shadow:none!important;" @click="choosefile()">Choose</span> <span id="imgname" style = "padding: 8px 0 0 30px;"></span>
                        <input type="file" class="inputfile" @change="onFileChange"/>
                        <!-- <input type="file" accept="image/*" @change="showMyImage(this)" name="img" id="file" ref="file" class="form-control inputfile"> -->
                    </div>
                    <div class="input-group mb-3">
                        <label class="col-4 col-lg-3 control-label">事業者名</label>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="name" v-model="username" required placeholder="事業者名を入力してください。">
                    </div>
                    
                    <div class="input-group mb-3">
                        <label class="col-4 col-lg-3 control-label">メールアドレス </label>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" name="email" v-model="email" required placeholder="メールアドレスを入力してください。">
                    </div>

                    <div class="input-group mb-3">
                        <label class="col-4 col-lg-3 control-label">パスワード </label>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control" name="password" @keyup="password_validate()" v-model="password" id="pwd" required placeholder="パスワードを入力してください。">
                    </div>

                    <div class="input-group mb-3">
                        <label class="col-4 col-lg-3 control-label">パスワード確認</label>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control" name="comfirm_password" id="confirm_pwd" @keyup="password_validate()" v-model="password_confirmation" required placeholder="パスワードをもう一度確認してください。">
                        <br>
                    </div>
                    <div class="error p-l-162" id="passworderror" style="display:none;">※パスワードが一致しません。</div>

                    <div class="input-group mb-3">
                        <label class="col-4 col-lg-3 control-label">事業者タイプ</label>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-list"></i></span>
                        </div>
                        <select id="type" class="form-control custom-select" name="types" :value="type.id" v-model="type" required>
                            <option value="">事業者タイプを選択してください。</option>
                            <option value="2">病院</option>
                            <option value="3">介護</option>
                        </select>
                    </div>

                    <div class="input-group mb-3 hide form-check form-check-inline" id="showHideActionNursing">
                        <label class="col-4 col-lg-3 control-label">看護種類</label>
                        <div class="input-group-append " id="nursing">
                        </div>
                        <div class="error" id="radioerror" style="margin-bottom: 6px;margin-left: 210px;">必須</div>
                    </div>

                    <div class="input-group mb-3">
                        <label class="col-4 col-lg-3 control-label">都道府県</label>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>

                        </div>
                        <select name="cities" id="cities" v-model="city" @change="getTownship()" class="form-control custom-select" required>
                            <option value="">都道府県を選択してください。</option>
                            <option v-for ="city in cities" :value='city.id' :key="city.id">{{ city.city_name }}</option>
                        </select>
                    </div>

                    <div class="input-group mb-3" v-if="!show">
                        <label class="col-4 col-lg-3 control-label">市区町村</label>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        </div>
                        <select name="township" id="township" v-model='township' class="form-control custom-select" required>
                            <option value="">市区町村を選択してください。</option>
                            <option v-for ="township in townships" :value='township.id' :key='township.id'>{{ township.township_name }}</option>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label class="col-4 col-lg-3 control-label">電話番号</label>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                        </div>
                        <input class="form-control" id="phone" name="phone" v-model="phone" required placeholder="電話番号を入力してください。" maxlength="14">
                    </div>
                    <div id="jsErrorMessage" class="error p-l-162"></div>
                    
                      <div class="form-group col-12 text-center">                          
                              <button type="submit" class="btn register_btn login_btn" id="sub_btn">作成する</button>                          
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
        username: '',
        email: '',
        cities: [],
        city : '',
        townships :[],
        township :'',
        type:'',
        typ:[],
        types:[],
        phone:'',
        address:'',
        password: '',
        password_confirmation: '',
        has_error: false,
        error: '',
        errors: {},
        success: false,
        show: true,
        url: '',
      }
      
    },

    methods: {
      getCities() {
         this.axios.get('/api/auth/getCities')
         .then(function (response) {
             console.log("getCities")
             console.log(response)
          this.cities = response.data.cities;
          }.bind(this));
      },
      getTownship(){
        this.show = false;
        this.axios.get('/api/auth/township',{
          params:{
            city:this.city
          },
        }).then((response)=>{
            console.log("townships")
            console.log(response.data.townships)
          this.townships = response.data.townships
        })
      },
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
    isNumberOnly(event) {
        if(!(event.keyCode >= 48 && event.keyCode <= 57) && !(event.keyCode >= 96 && event.keyCode <= 105) 
            && event.keyCode != 8 && event.keyCode != 46 && !(event.keyCode >= 37 && event.keyCode <= 40)) 
        {
            event.preventDefault();
        }
    },
    password_validate() {
        var pwd = $('#pwd').val();
        var confirm_pwd = $('#confirm_pwd').val();
        window.pwd_same = false;
        var nursing_type_exist = false;
        if(pwd != confirm_pwd) {
            $('#passworderror').css("display","block");
        }
        else {
            $('#passworderror').css("display","none");
            window.pwd_same = true;
        }
    },
    choosefile() {
        $('.inputfile').trigger('click');
    },
      onFileChange(e) {
      const file = e.target.files[0];
      console.log(file);
      this.images = file;
      this.url = URL.createObjectURL(file);
    },
      register() {
        var app = this
        console.log(app.images);
        // testing
        let fData = new FormData();
                        fData.append('img', app.images)
                        fData.append('name', app.username)
                        fData.append('email', app.email)
                        fData.append('password', app.password)
                        fData.append('comfirm_password', app.password_confirmation)
                        fData.append('cities', app.city)
                        fData.append('township', app.township)
                        fData.append('types', app.type)
                        fData.append('phone', app.phone)
        // end
        this.$loading(true);
        this.axios.post('/api/register', fData)
                            .then(response =>
                             {
                                 this.$loading(false);
            this.$swal({
                position: 'top-end',
                type: 'success',
                // title: '作成されました',
                title: '確認のためもうちょっとしばらくお待ちください。',
                showConfirmButton: false,
                timer: 1800,
                width: 250,
                height: 200,
            })
            //app.success = true
            //this.$router.push({name: 'login', params: {successRegistrationRedirect: true}})
        }).catch(error=>{
            if(error.response.status == 422){
                app.errors = error.response.data.errors
          }});
      }

    },
    created(){
      this.getCities()
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