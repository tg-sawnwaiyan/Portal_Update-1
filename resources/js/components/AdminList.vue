<template>
<div class="row">
        <div class="col-12">
    <div class="loginwrapper">
        <div class="d-flex justify-content-center h-100">     
            <div class="admin_card admin_registercard">
                <div class="row m-b-10">
                <div class="col-md-12">
                    <router-link :to="{name:'admincreate'}" class="float-right main-bg-color create-btn all-btn">
                        <i class="fas fa-plus-circle"></i> 管理者新規作成
                    </router-link>
                </div>
            </div>
                <div class="col-md-12 scrolldiv">
                <h6 class="header">管理者一覧</h6>
                <table class="table table-hover custom-table">
                    <thead style="background-color:rgb(183, 218, 210);">
                        <tr>
                            <th>管理者名</th>
                            <th>メールアドレス</th>
                            <th></th>
                        </tr>
                    </thead> 
                    <tbody>
                        <tr v-for="admin in admin_list" :key="admin.id">
                            <td>{{admin.name}}</td>
                            <td >{{admin.email}}</td>
                            <td class="text-right">
                                <router-link :to="{name: 'admincreate', params: { id: admin.id }}" class="btn edit-borderbtn">編集</router-link>
                                <button class="btn text-danger delete-borderbtn" @click="deleteFeature(admin.id)">削除</button>
                            </td>
                        </tr>
                    </tbody>
                </table> 
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
          admin_list :[]
      }
    },
    created (){
        this.axios.get("/api/admin/admin_list").then(response => {
            this.admin_list = response.data;
            console.log(this.admin_list)
        });
    },
    methods: {
                deleteFeature(id) {
                        this.$swal({
                            title: "確認",
                            text: "特徴を削除してよろしいでしょうか。",
                            type: "warning",
                            width: 350,
                            height: 200,
                            showCancelButton: true,
                            confirmButtonColor: "#dc3545",
                            cancelButtonColor: "#b1abab",
                            cancelButtonTextColor: "#000",
                            confirmButtonText: "はい",
                            cancelButtonText: "キャンセル",
                            confirmButtonClass: "all-btn",
                            cancelButtonClass: "all-btn"
                        }).then(response => {
                            this.axios
                                .delete(`/api/admin/delete/${id}`)
                                .then(response => {
                                    console.log(response.data)
                                    this.admin_list = response.data;
                                    this.$swal({
                                        text: "特徴を削除しました。",
                                        type: "success",
                                        width: 350,
                                        height: 200,
                                        confirmButtonText: "閉じる",
                                        confirmButtonColor: "#dc3545"
                                    });
                                })
                                .catch(() => {
                                    this.$swal("Failed", "wrong");
                                });
                        });
                    },
    }
}
</script>

