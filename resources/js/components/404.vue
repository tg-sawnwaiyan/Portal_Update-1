<template>
    <!-- <div>Your Login session is Expired! <br/> <a href="#" @click.prevent="$auth.logout()">Please Login Again.</a></div> -->
<div>
    <nav class="navbar navbar-expand-lg  main-header">
        <div class="container nav-warp d-flex">
        <div class="d-flex align-items-center">
            <a class="navbar-brand logo-text">               
            <h4 class="logo_subtitle">介護医療福祉の総合サイト</h4>
            <img src="/images/fixed_logo.png" style="width:215px;height:auto;" />
            </a>
        </div>
        </div>
    </nav>
    <div class="unauth-page">
        <div class="content">
            <div class="unauth-title">
            <div class="col-12" style="margin:0 auto;margin-bottom: 30px;">
                <img src="/images/cloud-cross.png" style="width: 34%;">               
            
            </div>
                <p class="unauth-title">ページがみつかりません。                
                <span style="font-size:20px;display:block;">URLに間違いがないかご確認ください。</span>
                </p>
                 <div class="text-center">
                <a href="/" class="gohome all-btn" style="">ホームページに戻る</a>
                 </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
export default {
    methods:{
        created(){
            this.$loading(false);
            if(this.$route.params.reload){
                // location.reload();
            }
        },
        logout(){              
            this.loginuser = 'false';
            localStorage.setItem('loginuser', this.loginuser);
            if(this.$auth.check(2)){
                this.$auth.logoutAdmin();
            }
            else{
                this.$auth.logout();
            }
        }
    }
}
</script>