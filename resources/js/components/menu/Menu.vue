<template>
<!--navigation bar-->
<nav class="navbar navbar-expand-lg  main-header">

        <div class="container nav-warp d-flex">


          <div class="d-flex">
            <a class="navbar-brand logo-text" href="/">
              LOGO <span>HERE</span>
            </a>
            <p class="h-tel"><i class="fas fa-phone-alt"></i><span>03-1234-5678</span><br>&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:mpm_secretary@management-partners.co.jp">mpm_secretary@management-partners.co.jp</a></p>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
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
        
                  <li class="nav-item col-12 userprofile-name pc" v-else>
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
                  <li v-if="$auth.check()" class="nav-item btn login-register-btn col-lg-6 p-lr-0">
                      <a href="#" @click.prevent="$auth.logout()">Logout</a>
                  </li>
                </ul>
              </div>
          </div>
        </div>
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