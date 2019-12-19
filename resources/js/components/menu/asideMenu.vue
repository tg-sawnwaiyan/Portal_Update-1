<template>
    <div class="col-lg-2 col-md-12 col-sm-12 pad-free custom-sidebar" id="admin-side-menu">
        <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <div class="adminview-sidebar pc">
                <li>
                    <router-link to="/" class="nav-link"><i class="fa fa-home"></i>&nbsp;ホーム</router-link>
                </li>
                <li v-if="$auth.check(2)">
                    <router-link to="/news_list" class="nav-link" @click="menuToggle()"><i class="fa fa-newspaper"></i>&nbsp;ニュース一覧</router-link>
                </li>
                <li v-if="$auth.check(2)">
                    <router-link to="/categorylist" class="nav-link" ><i class="fa fa-file"></i>&nbsp;カテゴ一覧</router-link>
                </li>
                <li v-if="$auth.check(2)"><router-link to="/facilitieslist" class="nav-link" ><i class="fa fa-sun"></i>&nbsp;施設一覧</router-link></li>
                <li v-if="$auth.check(2)"><router-link to="/featurelist" class="nav-link" ><i class="fa fa-list"></i>&nbsp;&nbsp;特殊機能</router-link></li>
                <li v-if="$auth.check(2)"><router-link to="/occupationlist" class="nav-link"><i class="fa fa-suitcase"></i>&nbsp;&nbsp;職業</router-link></li>
                <li v-if="$auth.check(2)"><router-link to="/subjectlist" class="nav-link"><i class="fa fa-user-md"></i>&nbsp;&nbsp;医学科目</router-link></li>
                <li v-if="$auth.check(2)">
                    <!-- <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed nav-link text-pre"><i class="fa fa-user-lock"></i>&nbsp;管理者確認</a> -->
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed nav-link text-pre"><i class="fa fa-user-lock"></i>&nbsp;管理者確認</a>
                    <ul class="list-unstyled collapse" id="pageSubmenu" style="">
                        <li><router-link to="/customerlist" class="nav-link"><i class="fa fa-user"></i>&nbsp;事業者</router-link></li>
                        <li><router-link to="/commentlist" class="nav-link"><i class="fa fa-list"></i>&nbsp;コメント一覧</router-link></li>
                    </ul>
                </li>
                <li  v-if="$auth.check(2)"><router-link to="/ads" class="nav-link"><i class="fa fa-globe"></i>&nbsp;広告</router-link></li>

                <li v-if="$auth.check(1)"><router-link to="/profiledit" class="nav-link"><i class="fa fa-map" ></i>&nbsp;&nbsp;  プロファイル編集</router-link></li>
                <li v-if="$auth.check(1)"><router-link to="/profile" class="nav-link"><i class="fa fa-map"></i>&nbsp;&nbsp;  マイページ</router-link></li>
                <li v-if="$auth.check(1)"><router-link to="/jobofferlist" class="nav-link"><i class="fa fa-edit" ></i>&nbsp;&nbsp;  仕事一覧</router-link></li>

                <li v-if="$auth.check()">
                    <a href="#" @click.prevent="$auth.logout()" class="nav-link" id="logout" ref="myid"><i class="fa fa-sign-out-alt"></i>&nbsp;&nbsp; ログアウト</a>
                </li>
               
            </div>
        </ul>
     
    </div>
</template>




<script>
</script>



<script>
  export default {
    data() {
      return {
        status:false,
      }
    },
created() {
    axios.interceptors.response.use((response) => {
        console.log(response.data)
        if(response.data.status == "Token is Expired" && this.status == false){

            this.status = true
        Swal.fire({
            title: 'Your Login session is Expired!',
            text: "Please Login Again.",
            icon: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {  
            // console.log()
            
            if (result.value) {
                this.$refs.myid.click();
                response.data.status = "logout success"

            }
        })
        }
        
        return response

        })

    },
    methods: {
       
        // testlogout(){
        //     this.$auth.logout({
        //         success: function() {
        //             this.$router.push({
        //                 name: 'News'
        //             });
        //         },
        //     })

        // }

        menuToggle(){
            $("#admin-side-menu").toggle('medium');
            $("#menu-overlay").toggle('medium');
        }
    }

  }
</script>


<style>
    .box {
  width: 40%;
  margin: 0 auto;
  background: rgba(255,255,255,0.2);
  padding: 35px;
  border: 2px solid #fff;
  border-radius: 20px/50px;
  background-clip: padding-box;
  text-align: center;
}

.button {
  font-size: 1em;
  padding: 10px;
  color: #fff;
  border: 2px solid #06D85F;
  border-radius: 20px/50px;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease-out;
}
.button:hover {
  background: #06D85F;
}

.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}

.popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 30%;
  position: relative;
  transition: all 5s ease-in-out;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #06D85F;
}
.popup .content {
  max-height: 30%;
  overflow: auto;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }
}
</style>