<template>
<!--navigation bar-->
<nav class="navbar navbar-expand-lg  main-header">
  <div class="container nav-warp d-flex">
    <div class="d-flex">
      <a class="navbar-brand logo-text" href="/">
        LOGO <span>HERE</span>
      </a>
      <p class="h-tel"><i class="fas fa-phone-alt"></i><span>03-1234-5678</span><br>&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:mpm_secretary@management-partners.co.jp">mpm_secretary@management-partners.co.jp</a></p>
      <ul class="sp_social">
        <li class="social-link" v-if="!$auth.check()"><a href="http://localhost:8000/registerForm"><i class="fab fa-twitter"></i></a></li>
        <li class="social-link" v-if="!$auth.check()"><a href="http://localhost:8000/registerForm"><i class="fab fa-facebook-f"></i></a></li>
      </ul>
    </div>
    <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> -->
    <ul class="gNav">
      <li>
        <router-link :to="{ name: 'News' }"> ニュース（ホーム）</router-link>
      </li>
      <li>
        <router-link :to="{ name: 'nursingSearch' }">介護施設検索</router-link>
      </li>
      <li>
        <router-link :to="{ name: 'hospital_search' }"> 病院検索</router-link>
      </li>
      <li>
        <router-link :to="{ name: 'jobSearch' }">求人検索</router-link>
      </li>
    </ul>

    <div class="collapse navbar-collapse  d-flex justify-content-end" id="navbarSupportedContent">
        <div class="d-flex">
          <ul class="navbar-nav ml-auto pc  d-flex justify-content-end">
              <li class="nav-item" v-if="!$auth.check()">
              <router-link :to="{name: 'login'}" class="nav-link pad-free"><i class="fa fa-sign-in-alt"></i>&nbsp;&nbsp;<span>事業者 ログイン</span></router-link>
            </li>
            <li class="nav-item  m-l-10" v-if="!$auth.check()">
              <router-link :to="{name: 'register'}" class="nav-link pad-free"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;<span>事業者 登録</span></router-link>
            </li> 
            <li class="social-link" v-if="!$auth.check()"><a href="http://localhost:8000/registerForm"><i class="fab fa-twitter"></i></a></li>
            <li class="social-link" v-if="!$auth.check()"><a href="http://localhost:8000/registerForm"><i class="fab fa-facebook-f"></i></a></li>
  
            
            <li class="col-12 userprofile-name pc" v-else>
                    <span v-if="user.data.type_id == 1">
                        <i class="fa fa-user userprofile-img" aria-hidden="true"></i>
                        <label for="" style="color:#ff6117;font-weight:bold;">{{user.data.name}} </label>
                    </span>
                    <span v-if="user.data.type_id == 2">
                      <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 226 226" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,226v-226h226v226z" fill="none"></path><g fill="#63b7ff"><path d="M89.04047,4.52c-9.19067,0 -16.72047,7.5298 -16.72047,16.72047v48.3693c0,9.19067 7.5298,16.72047 16.72047,16.72047h48.3693c9.19067,0 16.72047,-7.5298 16.72047,-16.72047v-48.3693c0.00038,-0.10012 -0.00256,-0.20023 -0.00883,-0.30016c-0.60079,-9.01504 -7.97121,-16.42031 -17.16188,-16.42031zM89.04047,13.56h47.91906c4.36242,0 7.81818,3.42869 8.1307,7.96297v48.0868c0,4.36933 -3.31114,7.68047 -7.68047,7.68047h-48.3693c-4.36933,0 -7.68047,-3.31114 -7.68047,-7.68047v-48.3693c0,-4.36933 3.31114,-7.68047 7.68047,-7.68047zM108.48,27.12v13.56h-13.56v9.04h13.56v13.56h9.04v-13.56h13.56v-9.04h-13.56v-13.56zM30.28047,40.68c-9.2208,0 -16.72047,7.49967 -16.72047,16.72047v150.51953h81.36v-54.24h36.16v54.24h85.88v-150.51953c0,-9.2208 -7.49967,-16.72047 -16.72047,-16.72047h-37.0693v28.92977c0,14.1928 -11.56767,25.76047 -25.76047,25.76047h-48.3693c-14.1928,0 -25.76047,-11.56767 -25.76047,-25.76047v-28.92977zM36.16,103.96h31.64v27.12h-31.64zM94.92,103.96h36.16v27.12h-36.16zM158.2,103.96h31.64v27.12h-31.64zM36.16,153.68h31.64v27.12h-31.64zM158.2,153.68h31.64v27.12h-31.64z"></path></g></g></svg>
                      <label for="" style="color:#1973bf;">{{user.data.name}} </label>
                    </span>
                    <span v-if="user.data.type_id >2">
                      <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 226 226" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,226v-226h226v226z" fill="none"></path><g fill="#e67e22"><path d="M89.04047,4.52c-9.19067,0 -16.72047,7.5298 -16.72047,16.72047v48.3693c0,9.19067 7.5298,16.72047 16.72047,16.72047h48.3693c9.19067,0 16.72047,-7.5298 16.72047,-16.72047v-48.3693c0.00038,-0.10012 -0.00256,-0.20023 -0.00883,-0.30016c-0.60079,-9.01504 -7.97121,-16.42031 -17.16188,-16.42031zM89.04047,13.56h47.91906c4.36242,0 7.81818,3.42869 8.1307,7.96297v48.0868c0,4.36933 -3.31114,7.68047 -7.68047,7.68047h-48.3693c-4.36933,0 -7.68047,-3.31114 -7.68047,-7.68047v-48.3693c0,-4.36933 3.31114,-7.68047 7.68047,-7.68047zM108.48,27.12v13.56h-13.56v9.04h13.56v13.56h9.04v-13.56h13.56v-9.04h-13.56v-13.56zM30.28047,40.68c-9.2208,0 -16.72047,7.49967 -16.72047,16.72047v150.51953h81.36v-54.24h36.16v54.24h85.88v-150.51953c0,-9.2208 -7.49967,-16.72047 -16.72047,-16.72047h-37.0693v28.92977c0,14.1928 -11.56767,25.76047 -25.76047,25.76047h-48.3693c-14.1928,0 -25.76047,-11.56767 -25.76047,-25.76047v-28.92977zM36.16,103.96h31.64v27.12h-31.64zM94.92,103.96h36.16v27.12h-36.16zM158.2,103.96h31.64v27.12h-31.64zM36.16,153.68h31.64v27.12h-31.64zM158.2,153.68h31.64v27.12h-31.64z"></path></g></g></svg>
                            <label for="" style="color:#b34814;">{{user.data.name}} </label>
                    </span>
                    <!-- <label for="">{{user.data.name}}</label> -->
                    <!-- {{user.data.type_id}} -->
                  </li>
            <!-- <li v-if="$auth.check()" class="nav-item btn login-register-btn col-lg-6 p-lr-0">
                <a href="#" @click.prevent="$auth.logout()">Logout</a>
            </li> -->
          </ul>
        </div>
    </div>
  </div>
  <div id="sp_headerbar"  style="width:100%;background:#fff;">
    <ul class="clearfix text-center float-left">
      <li style="display:inline-block;padding: 0 10px;
    border: 1px solid;
    border-radius: 4px;"><svg x="0px" y="0px" width="24" height="24" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g id="original-icon" fill="#c40000" opacity="0" visibility="hidden"><path d="M50.16667,78.83333h107.5v14.33333h-107.5zM50.16667,35.83333h107.5v14.33333h-107.5zM50.16667,121.83333h107.5v14.33333h-107.5zM21.5,75.25c-5.93706,0 -10.75,4.81294 -10.75,10.75c0,5.93706 4.81294,10.75 10.75,10.75c5.93706,0 10.75,-4.81294 10.75,-10.75c0,-5.93706 -4.81294,-10.75 -10.75,-10.75zM21.5,118.25c-5.93706,0 -10.75,4.81294 -10.75,10.75c0,5.93706 4.81294,10.75 10.75,10.75c5.93706,0 10.75,-4.81294 10.75,-10.75c0,-5.93706 -4.81294,-10.75 -10.75,-10.75zM21.5,32.25c-5.93706,0 -10.75,4.81294 -10.75,10.75c0,5.93706 4.81294,10.75 10.75,10.75c5.93706,0 10.75,-4.81294 10.75,-10.75c0,-5.93706 -4.81294,-10.75 -10.75,-10.75z"></path></g><g id="subtracted-icon" fill="#c40000"><path d="M50.16667,78.83333h107.5l0,10.81336c-1.5126,0.69131 -2.92913,1.65951 -4.17264,2.90462l-0.6155,0.61535h-102.71186zM50.16667,35.83333h107.5v14.33333h-107.5zM50.16667,121.83333h24.29256c-1.88479,4.7147 -1.16582,10.22759 2.1569,14.33333h-26.44946zM32.25,86c0,5.93706 -4.81294,10.75 -10.75,10.75c-5.93706,0 -10.75,-4.81294 -10.75,-10.75c0,-5.93706 4.81294,-10.75 10.75,-10.75c5.93706,0 10.75,4.81294 10.75,10.75zM32.25,129c0,5.93706 -4.81294,10.75 -10.75,10.75c-5.93706,0 -10.75,-4.81294 -10.75,-10.75c0,-5.93706 4.81294,-10.75 10.75,-10.75c5.93706,0 10.75,4.81294 10.75,10.75zM32.25,43c0,5.93706 -4.81294,10.75 -10.75,10.75c-5.93706,0 -10.75,-4.81294 -10.75,-10.75c0,-5.93706 4.81294,-10.75 10.75,-10.75c5.93706,0 10.75,4.81294 10.75,10.75zM123.60062,122.43755l-0.6045,-0.60422l1.20887,0z"></path></g><g><g id="Filled_3_" fill="#c40000"><path d="M123.60062,162.99169l-35.82908,-35.82908l10.13652,-10.13652l25.69256,25.69256l40.02993,-40.02993l10.13652,10.13652z"></path></g><g id="Filled_3_" fill="#000000" opacity="0"><path d="M183.90358,122.96087l-50.16644,50.16644c-2.79579,2.80295 -6.46615,4.20085 -10.13652,4.20085c-3.67037,0 -7.34073,-1.39789 -10.13652,-4.20085l-35.82908,-35.82908c-5.59874,-5.59874 -5.59874,-14.67429 0,-20.27304l10.13652,-10.13652c5.59157,-5.59874 14.68146,-5.59874 20.27304,0l15.55604,15.54887l29.89341,-29.88624c5.59157,-5.59874 14.68146,-5.59874 20.27304,0l10.13652,10.13652c5.59874,5.59874 5.59874,14.67429 0,20.27304z"></path></g></g></g></svg>お気に入り<span class="count">3</span></li>
      <li style="display:inline-block;padding: 0 10px;
    border: 1px solid;
    border-radius: 4px;"><svg x="0px" y="0px" width="24" height="24" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#c40000"><path d="M86,15.0472l-78.83333,70.9528h21.5v64.5h59.44694c-1.3545,-4.54367 -2.11361,-9.3525 -2.11361,-14.33333h-43v-63.14225l43,-38.6888l57.61328,51.66439h21.22006zM136.19466,100.24935c-19.78717,0 -35.83333,16.04617 -35.83333,35.83333c0,19.78717 16.04617,35.83333 35.83333,35.83333c19.78717,0 35.83333,-16.04617 35.83333,-35.83333c0,-19.78717 -16.04617,-35.83333 -35.83333,-35.83333zM150.89193,119.24382l10.02213,10.03613l-28.30274,28.30274l-21.13606,-21.13607l10.02213,-10.03613l11.11393,11.11393z"></path></g></g></svg>最近見た施設<span class="count">3</span></li>
    </ul>
    <div class="menu float-right">メニュー <i class="fa fa-bars"></i></div>
  </div>
  <!-- <div id="sp_headerbar sp" style="width:100%;background:#fff;">
      <ul class="clearfix"  v-if="!$auth.check()">
        <li style="width:50%;float:left;border:1px solid #000;list-style:none;text-align:center;"><svg x="0px" y="0px" width="24" height="24" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g id="original-icon" fill="#c40000" opacity="0" visibility="hidden"><path d="M50.16667,78.83333h107.5v14.33333h-107.5zM50.16667,35.83333h107.5v14.33333h-107.5zM50.16667,121.83333h107.5v14.33333h-107.5zM21.5,75.25c-5.93706,0 -10.75,4.81294 -10.75,10.75c0,5.93706 4.81294,10.75 10.75,10.75c5.93706,0 10.75,-4.81294 10.75,-10.75c0,-5.93706 -4.81294,-10.75 -10.75,-10.75zM21.5,118.25c-5.93706,0 -10.75,4.81294 -10.75,10.75c0,5.93706 4.81294,10.75 10.75,10.75c5.93706,0 10.75,-4.81294 10.75,-10.75c0,-5.93706 -4.81294,-10.75 -10.75,-10.75zM21.5,32.25c-5.93706,0 -10.75,4.81294 -10.75,10.75c0,5.93706 4.81294,10.75 10.75,10.75c5.93706,0 10.75,-4.81294 10.75,-10.75c0,-5.93706 -4.81294,-10.75 -10.75,-10.75z"></path></g><g id="subtracted-icon" fill="#c40000"><path d="M50.16667,78.83333h107.5l0,10.81336c-1.5126,0.69131 -2.92913,1.65951 -4.17264,2.90462l-0.6155,0.61535h-102.71186zM50.16667,35.83333h107.5v14.33333h-107.5zM50.16667,121.83333h24.29256c-1.88479,4.7147 -1.16582,10.22759 2.1569,14.33333h-26.44946zM32.25,86c0,5.93706 -4.81294,10.75 -10.75,10.75c-5.93706,0 -10.75,-4.81294 -10.75,-10.75c0,-5.93706 4.81294,-10.75 10.75,-10.75c5.93706,0 10.75,4.81294 10.75,10.75zM32.25,129c0,5.93706 -4.81294,10.75 -10.75,10.75c-5.93706,0 -10.75,-4.81294 -10.75,-10.75c0,-5.93706 4.81294,-10.75 10.75,-10.75c5.93706,0 10.75,4.81294 10.75,10.75zM32.25,43c0,5.93706 -4.81294,10.75 -10.75,10.75c-5.93706,0 -10.75,-4.81294 -10.75,-10.75c0,-5.93706 4.81294,-10.75 10.75,-10.75c5.93706,0 10.75,4.81294 10.75,10.75zM123.60062,122.43755l-0.6045,-0.60422l1.20887,0z"></path></g><g><g id="Filled_3_" fill="#c40000"><path d="M123.60062,162.99169l-35.82908,-35.82908l10.13652,-10.13652l25.69256,25.69256l40.02993,-40.02993l10.13652,10.13652z"></path></g><g id="Filled_3_" fill="#000000" opacity="0"><path d="M183.90358,122.96087l-50.16644,50.16644c-2.79579,2.80295 -6.46615,4.20085 -10.13652,4.20085c-3.67037,0 -7.34073,-1.39789 -10.13652,-4.20085l-35.82908,-35.82908c-5.59874,-5.59874 -5.59874,-14.67429 0,-20.27304l10.13652,-10.13652c5.59157,-5.59874 14.68146,-5.59874 20.27304,0l15.55604,15.54887l29.89341,-29.88624c5.59157,-5.59874 14.68146,-5.59874 20.27304,0l10.13652,10.13652c5.59874,5.59874 5.59874,14.67429 0,20.27304z"></path></g></g></g></svg>お気に入り</li>
        <li style="width:50%;float:left;border:1px solid #000;list-style:none;text-align:center;"><svg x="0px" y="0px" width="24" height="24" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#c40000"><path d="M86,15.0472l-78.83333,70.9528h21.5v64.5h59.44694c-1.3545,-4.54367 -2.11361,-9.3525 -2.11361,-14.33333h-43v-63.14225l43,-38.6888l57.61328,51.66439h21.22006zM136.19466,100.24935c-19.78717,0 -35.83333,16.04617 -35.83333,35.83333c0,19.78717 16.04617,35.83333 35.83333,35.83333c19.78717,0 35.83333,-16.04617 35.83333,-35.83333c0,-19.78717 -16.04617,-35.83333 -35.83333,-35.83333zM150.89193,119.24382l10.02213,10.03613l-28.30274,28.30274l-21.13606,-21.13607l10.02213,-10.03613l11.11393,11.11393z"></path></g></g></svg>最近見た施設</li>
      </ul> 
  </div> -->
</nav>

  <!--end navigation bar-->

</template>
<script>
  export default {
    data(){
      return{
        user:'',
        
      }
    },
    mounted() {
      this.user = this.$auth.watch._data
      console.log("this.user.data")
      console.log(this.$auth.watch._data)
      console.log(this.$auth.watch._data.data.name)
      },

  }
</script>