<template>
   <div>
       <div class="sidebar-menu" @click='isClick = !isClick'>
           click
       </div>
       <transition name="slide">
            <div class="custom-sidebar" id="admin-side-menu" v-if="visit == 'false'" :style="{width: isClick ? '280px' : '60px'}">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <!-- <span class="admin-tit"><i class="fas fa-tachometer-alt"></i><span>管理画面</span></p> -->
                    <div class="admin-logo">
                        <a href="/">LOGO <span v-show="isClick">HERE</span></a>
                    </div>
                    
                    <ul class="adminview-sidebar pc">
                        <li class="admintit-item">
                            <i class="fas fa-tachometer-alt"></i><span class="nav-txt" v-show="isClick">管理画面</span>
                        </li>
                        <li v-if="$auth.check(2)">
                            <!-- <router-link to="/news_list" class="nav-link" @click="menuToggle()"><i class="fa fa-newspaper"></i>&nbsp;<span class="nav-txt">ニュース一覧</span></router-link> -->
                            <a href="#pageSubmenu01" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed nav-link text-pre"><i class="fa fa-newspaper"></i>&nbsp;&nbsp;<span class="nav-txt" v-show="isClick">ニュース一</span>
                            </a>
                            <ul class="collapse submenu" id="pageSubmenu01">
                                <li><router-link to="/news_list" class="nav-link"><i class="fa fa-list"></i>&nbsp;<span>ニュース一覧</span></router-link></li>
                                <li><router-link to="/commcategorylistentlist" class="nav-link"><i class="fa fa-list"></i>&nbsp;<span>カテゴ一覧</span></router-link></li>
                            </ul>
                        </li>
                        <li v-if="$auth.check(2)">
                            <a href="#pageSubmenu02" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed nav-link text-pre"><i class="fas fa-user-md"></i>&nbsp;&nbsp;<span class="nav-txt" v-show="isClick">介護施設</span>
                            </a>
                            <ul class="collapse submenu" id="pageSubmenu02">
                                <li v-if="$auth.check(2)"><router-link to="/facilitieslist" class="nav-link" ><i class="fa fa-sun"></i>&nbsp;<span class="nav-txt">施設一覧</span></router-link></li>
                                <li v-if="$auth.check(2)"><router-link to="/featurelist" class="nav-link" ><i class="fa fa-list"></i>&nbsp;&nbsp;<span class="nav-txt">特殊機能</span></router-link></li>
                                <li v-if="$auth.check(2)"><router-link to="/occupationlist" class="nav-link"><i class="fa fa-suitcase"></i>&nbsp;&nbsp;<span class="nav-txt">職業</span></router-link></li>
                                <li><router-link to="/customerlist" class="nav-link"><i class="fa fa-user"></i>&nbsp;<span>事業者</span></router-link></li>
                                <li><router-link to="/commentlist" class="nav-link"><i class="fa fa-list"></i>&nbsp;<span>コメント一覧</span></router-link></li>
                            </ul>
                        </li>
                        <li v-if="$auth.check(2)">
                            <a href="#pageSubmenu03" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed nav-link text-pre"><i class="fas fa-briefcase-medical"></i>&nbsp;&nbsp;<span class="nav-txt" v-show="isClick">病院</span>
                            </a>
                            <ul class="collapse submenu" id="pageSubmenu03">
                                <li v-if="$auth.check(2)"><router-link to="/facilitieslist" class="nav-link" ><i class="fa fa-sun"></i>&nbsp;<span class="nav-txt">施設一覧</span></router-link></li>
                                <li v-if="$auth.check(2)"><router-link to="/featurelist" class="nav-link" ><i class="fa fa-list"></i>&nbsp;&nbsp;<span class="nav-txt">特殊機能</span></router-link></li>
                                <li><router-link to="/customerlist" class="nav-link"><i class="fa fa-user"></i>&nbsp;<span>事業者</span></router-link></li>
                                <li><router-link to="/commentlist" class="nav-link"><i class="fa fa-list"></i>&nbsp;<span>コメント一覧</span></router-link></li>
                                <li v-if="$auth.check(2)"><router-link to="/subjectlist" class="nav-link"><i class="fa fa-user-md"></i>&nbsp;&nbsp;<span class="nav-txt">医学科目</span></router-link></li>
                            </ul>
                        </li>
                        <!-- <li v-if="$auth.check(2)"><router-link to="/facilitieslist" class="nav-link" ><i class="fa fa-sun"></i>&nbsp;<span class="nav-txt">施設一覧</span></router-link></li>
                        <li v-if="$auth.check(2)"><router-link to="/featurelist" class="nav-link" ><i class="fa fa-list"></i>&nbsp;&nbsp;<span class="nav-txt">特殊機能</span></router-link></li>
                        <li v-if="$auth.check(2)"><router-link to="/occupationlist" class="nav-link"><i class="fa fa-suitcase"></i>&nbsp;&nbsp;<span class="nav-txt">職業</span></router-link></li>
                        <li v-if="$auth.check(2)"><router-link to="/subjectlist" class="nav-link"><i class="fa fa-user-md"></i>&nbsp;&nbsp;<span class="nav-txt">医学科目</span></router-link></li>
                        <li v-if="$auth.check(2)">
                            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed nav-link text-pre"><i class="fa fa-user-lock"></i>&nbsp;管理者確認</a>
                            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed nav-link text-pre"><i class="fa fa-user-lock"></i>&nbsp;<span class="nav-txt">管理者確認</span></a>
                            <ul class="list-unstyled collapse" id="pageSubmenu" style="">
                                <li><router-link to="/customerlist" class="nav-link"><i class="fa fa-user"></i>&nbsp;<span>事業者</span></router-link></li>
                                <li><router-link to="/commentlist" class="nav-link"><i class="fa fa-list"></i>&nbsp;<span>コメント一覧</span></router-link></li>
                            </ul>
                        </li> -->
                        <li  v-if="$auth.check(2)"><router-link to="/ads" class="nav-link"><i class="fa fa-globe"></i>&nbsp;&nbsp;<span class="nav-txt" v-show="isClick">広告</span></router-link></li>

                        <li v-if="$auth.check(1)"><router-link to="/profiledit" class="nav-link"><i class="fa fa-map" ></i>&nbsp;&nbsp;<span class="nav-txt">プロファイル編集</span></router-link></li>
                        <li v-if="$auth.check(1)"><router-link to="/profile" class="nav-link"><i class="fa fa-map"></i>&nbsp;&nbsp;<span class="nav-txt">マイページ</span></router-link></li>
                        <li v-if="$auth.check(1)"><router-link to="/jobofferlist" class="nav-link"><i class="fa fa-edit" ></i>&nbsp;&nbsp;<span class="nav-txt">仕事一覧</span> </router-link></li>

                        <li v-if="$auth.check()">
                            <a href="#" @click.prevent="$auth.logout()" class="nav-link" id="logoutId" ref="myid"><i class="fa fa-sign-out-alt"></i>&nbsp;&nbsp;<span class="nav-txt" v-show="isClick">ログアウト</span></a>
                        </li>
                    </ul>
                </div>
            </div> 
      </transition>
    </div>
</template>
<style  scoped>
.slide-enter-active {
   -moz-transition-duration: 0.3s;
   -webkit-transition-duration: 0.3s;
   -o-transition-duration: 0.3s;
   transition-duration: 0.3s;
   -moz-transition-timing-function: ease-in;
   -webkit-transition-timing-function: ease-in;
   -o-transition-timing-function: ease-in;
   transition-timing-function: ease-in;
   transition: transform 0.5s ease;
}

.slide-leave-active {
   -moz-transition-duration: 0.3s;
   -webkit-transition-duration: 0.3s;
   -o-transition-duration: 0.3s;
   transition-duration: 0.3s;
   -moz-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
   -webkit-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
   -o-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
   transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
}

.slide-enter-to, .slide-leave {
   max-height: 100vh;
   overflow: hidden;
}

.slide-enter, .slide-leave-to {
   overflow: hidden;
   max-height: 100vh;
  transform: translateX(-100%);
  transition: all 0.5s ease-in 0s;
}
</style>

<script>
  export default {
    data() {
      return {
        status:false,
        isClick: true,
      }
    },
created() {
    console.log("aside "+this.$auth.check())
    console.log("aside visit "+this.visit)
    axios.interceptors.response.use((response) => {
        // console.log(response.data)
        if(response.data.status == "Token is Expired" && this.status == false){

            this.status = true
        // Swal.fire({
        //     title: 'セッションの有効期限が切れています。！',
            // text: "お手数ですがログイン画面より再度ログインしてください。",
        //     icon: 'warning',
        //     showCancelButton: false,
        //     confirmButtonColor: '#3085d6',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: 'OK'
        // }).then((result) => {  
        //     // console.log()
            
        //     if (result.value) {
        //         this.$refs.myid.click();
        //         response.data.status = "logout success"

        //     }
        // })
        this.visit = 'true';
        localStorage.setItem('visit',this.visit);
        this.$router.push({name: 'Unauthorized'});
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
        // visitSite() {
        //     this.visit = true;
        //     this.$router.push({name: 'News'});
        // },

        menuToggle(){
            $("#admin-side-menu").toggle('medium');
            $("#menu-overlay").toggle('medium');
        }
    }

  }
</script>


