<template>
    <div class="card">
        <div class="card-body">
            <h4 class="page-header header">ニュースカテゴリー作成</h4>
            <br>
            <form @submit.prevent="add">
                <div class="form-group">
                    <label>ニュースカテゴリー名 :<span class="error">*</span></label>
                    <input type="text" class="form-control"  v-model="category.name"  placeholder="ニュースカテゴリー名を入力してください。" >
                        <span v-if="errors.name" class="error">{{errors.name}}</span>
                </div>
                <div class="form-group">
                    <!-- <button class="btn main-bg-color white all-btn">作成する</button> -->
                    <span class="btn main-bg-color white all-btn" @click="checkValidate()"> 作成</span>
                    <router-link class="btn btn-danger all-btn" to="/categorylist" > キャンセル </router-link>
                    <!-- <button class="btn news-post-btn all-btn"  @click="checkValidate()>作成する</button> -->
                    
                </div>
            </form>  
        </div>
    </div>      
</template>
<script>
export default {
          data() {
            return {
                errors: {
                        name: "",
                },
                
    
                category: {
                        name: '',
                        user_id:'',
                        recordstatus: ''
                    }
            }
        },

         methods: {
            add() {
                 this.$swal({
                            title: "確認",
                            text: "ニュースカテゴリを作成してよろしいでしょうか。",
                            type: "info",
                            width: 390,
                            height: 200,
                            showCancelButton: true,
                            confirmButtonColor: "#6cb2eb",
                            cancelButtonColor: "#b1abab",
                            cancelButtonTextColor: "#000",
                            confirmButtonText: "はい",
                            cancelButtonText: "キャンセル",
                            confirmButtonClass: "all-btn",
                            cancelButtonClass: "all-btn"
                        }).then(response => { 
                            this.$loading(true);
                            this.axios.post('/api/category/add', this.category)
                    .then((response) => {
                        this.$loading(false);
                        this.name = ''
                        this.$swal({
                            position: 'top-end',
                            type: 'success',
                            // title:'確認済',
                            text: 'ニュースカテゴリを作成しました。',
                            // showConfirmButton: false,
                            // timer: 1800,
                            confirmButtonText: "閉じる",
                            confirmButtonColor: "#6cb2eb",
                            width: 350,
                            height: 200,
                        })
                        // alert('Successfully Created')
                     this.$router.push({name: 'categorylist'});
                    }).catch(error=>{

                    if(error.response.status == 422){

                        this.errors = error.response.data.errors

                    }
                });
            });
                
            },
            checkValidate() {
                     if (this.category.name) {
                        // console.log('exist');
                        this.errors.name = "";
                    } else {
                        // console.log('null');
                        this.errors.name = " ニュースカテゴリー名が必須です。";
                    }
                   if (
                        !this.errors.name
                        
                    ) {
                        this.add();
                    }
                },

        }

}
</script>


