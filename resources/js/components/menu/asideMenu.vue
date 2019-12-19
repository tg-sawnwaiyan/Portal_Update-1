<template>
   <div>
       <div class="sidebar-menu"  @click="collapse()">
           click
       </div>
        <div class="custom-sidebar" id="admin-side-menu">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <p class="admin-tit"><i class="fas fa-tachometer-alt"></i><span>管理画面</span></p>
                <ul class="adminview-sidebar pc">
                    <li>
                        <!-- <span>Visit Site</span> -->
                        <router-link to="/" class="nav-link"><i class="fa fa-home"></i>&nbsp;<span class="nav-txt">ホーム</span></router-link>
                    </li>
                    <li v-if="$auth.check(2)">
                        <router-link to="/news_list" class="nav-link" @click="menuToggle()"><i class="fa fa-newspaper"></i>&nbsp;<span class="nav-txt">ニュース一覧</span></router-link>
                    </li>
                    <li v-if="$auth.check(2)">
                        <router-link to="/categorylist" class="nav-link" ><i class="fa fa-file"></i>&nbsp;<span class="nav-txt">カテゴ一覧</span></router-link>
                    </li>
                    <li v-if="$auth.check(2)"><router-link to="/facilitieslist" class="nav-link" ><i class="fa fa-sun"></i>&nbsp;<span class="nav-txt">施設一覧</span></router-link></li>
                    <li v-if="$auth.check(2)"><router-link to="/featurelist" class="nav-link" ><i class="fa fa-list"></i>&nbsp;&nbsp;<span class="nav-txt">特殊機能</span></router-link></li>
                    <li v-if="$auth.check(2)"><router-link to="/occupationlist" class="nav-link"><i class="fa fa-suitcase"></i>&nbsp;&nbsp;<span class="nav-txt">職業</span></router-link></li>
                    <li v-if="$auth.check(2)"><router-link to="/subjectlist" class="nav-link"><i class="fa fa-user-md"></i>&nbsp;&nbsp;<span class="nav-txt">医学科目</span></router-link></li>
                    <li v-if="$auth.check(2)">
                        <!-- <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed nav-link text-pre"><i class="fa fa-user-lock"></i>&nbsp;管理者確認</a> -->
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed nav-link text-pre"><i class="fa fa-user-lock"></i>&nbsp;<span class="nav-txt">管理者確認</span></a>
                        <ul class="list-unstyled collapse" id="pageSubmenu" style="">
                            <li><router-link to="/customerlist" class="nav-link"><i class="fa fa-user"></i>&nbsp;<span>事業者</span></router-link></li>
                            <li><router-link to="/commentlist" class="nav-link"><i class="fa fa-list"></i>&nbsp;<span>コメント一覧</span></router-link></li>
                        </ul>
                    </li>
                    <li  v-if="$auth.check(2)"><router-link to="/ads" class="nav-link"><i class="fa fa-globe"></i>&nbsp;<span class="nav-txt">広告</span></router-link></li>

                    <li v-if="$auth.check(1)"><router-link to="/profiledit" class="nav-link"><i class="fa fa-map" ></i>&nbsp;&nbsp;  <span class="nav-txt">プロファイル編集</span></router-link></li>
                    <li v-if="$auth.check(1)"><router-link to="/profile" class="nav-link"><i class="fa fa-map"></i>&nbsp;&nbsp; <span class="nav-txt">マイページ</span></router-link></li>
                    <li v-if="$auth.check(1)"><router-link to="/jobofferlist" class="nav-link"><i class="fa fa-edit" ></i>&nbsp;&nbsp; <span class="nav-txt">仕事一覧</span> </router-link></li>

                    <li v-if="$auth.check()">
                        <a href="#" @click.prevent="$auth.logout()" class="nav-link"><i class="fa fa-sign-out-alt"></i>&nbsp;<span class="nav-txt">ログアウト</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<style  scoped>
.sidebar-menu {
    position: absolute;
    top: 100px;
    left: 180px;
}
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
</style>
<script>
  export default {
    data() {
      return {
          isVisible: false,
          sidebar_width : "70",
      }
    },
    mounted() {


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

        // menuToggle(){
        //     $("#admin-side-menu").toggle('medium');
        //     $("#menu-overlay").toggle('medium');
        // },
        collapse() {
            this.isVisible = true 
        }

    }

  }
</script>
