<template>
    <div class="card"  id="cat_post">
        <div class="card-body">
            <h4 class="page-header header">{{title}}</h4>
            <br>
            <form>
                <div class="form-group">
                    <label>{{label}}<span class="error sp1" style="margin-left:0px;">必須</span></label>
                    <input type="text" class="form-control"  v-model="category.name"  :placeholder='[[placeholder]]'>
                        <span v-if="errors.name" class="error">{{errors.name}}</span>
                </div>
                <div class="form-group"> 
                    <span class="btn main-bg-color white all-btn" @click="checkValidate()"> {{buttontext}}</span>
                    <router-link class="btn btn-danger all-btn" to="/categorylist" > キャンセル </router-link>
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
                    },
                title:'',
                label:'',
                placeholder:'',
                buttontext:'',
            }
        },
          created() {
              if(this.$route.name == "editcategory"){
                    this.title = "カテゴリー編集";
                    this.label = "カテゴリー名 ";
                    this.placeholder = "カテゴリー名を入力してください。";
                    this.buttontext = "保存";
                    this.axios
                        .get(`/api/category/edit/${this.$route.params.id}`)
                        .then(response => {
                            this.category = response.data;
                        });
                }
                else{
                   this.title = "ニュースカテゴリー作成";
                   this.label = "ニュースカテゴリー名 ";
                   this.placeholder = "ニュースカテゴリー名を入力してください。";
                   this.buttontext = "作成";
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
             updateCategory() { 
               
                    this.$loading(true);
                    this.axios.post(`/api/category/update/${this.$route.params.id}`, this.category)
                    .then((response) => {
                        this.$loading(false);
                        this.name = ''
                        this.$swal({
                            position: 'top-end',
                            type: 'success',
                            text: 'カテゴリーを更新しました。',
                            confirmButtonText: "閉じる",
                            confirmButtonColor: "#6cb2eb",
                            width: 300,
                            height: 200,
                        })
                        this.$router.push({name: 'categorylist'});
                    }).catch(error=>{

                    if(error.response.status == 422){
                        this.errors = error.response.data.errors
                    }
                    });                       
                
            },
            checkValidate() {
            
                    if(!this.category.name && !this.$route.params.id){
                      
                        this.errors.name = " ニュースカテゴリー名が必須です。";
                    }
                    else if(!this.category.name && this.$route.params.id){
                     
                        this.errors.name = "カテゴリー名が必須です。";
                    }
                    else if(this.category.name ) {
                       
                        this.errors.name = "";
                    }
                    if (!this.errors.name && !this.$route.params.id ) 
                    {
                        this.add();
                    }
                    else if(!this.errors.name && this.$route.params.id){
                        this.updateCategory();
                    }
                },

        }

}
</script>


