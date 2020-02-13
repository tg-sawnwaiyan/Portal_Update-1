<template>    
 <div id="create_fact">
    <div class="card">
        <div class="card-body">                
              <div class="row">
                    
                  <div class="col-md-12">
                      <h4 class="page-header header">{{title}}</h4>
                  </div>
                  <div class="col-md-12">
                        <form>
                      <div class="form-group">
                          <label>施設の種類:<span class="error">*</span></label>
                          <input type="text" class="form-control"  v-model="facility.description"  :placeholder='[[placeholder]]' >
                                <span v-if="errors.description" class="error">{{errors.description}}</span>
                      </div>
                  
                      <div class="form-group">
                          <span class="btn main-bg-color white all-btn" @click="checkValidate()"> {{buttontext}}</span>
                          <router-link to="/facilitieslist" class="btn btn-danger all-btn">キャンセル</router-link>    
                          <!-- <button class="btn news-post-btn all-btn" > 作成する </button> -->
                                                                    
                          <!-- <router-link to="/facilitieslist" class="btn news-post-btn all-btn">更新</router-link> -->
                      </div>  
                          </form>  
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
      errors: {
        description:"",
      },
      facility: {
        description: ""
      },
      title:'',
      label:'',
      placeholder:'',
      buttontext:''
    };
  },
    created() {
        if(this.$route.name == "editfacility"){
            this.title = "施設編集";
            this.label = "施設の種類:";
            this.placeholder = "施設の種類を入力してください。";
            this.buttontext = "保存";
            this.axios
              .get(`/api/facility/edit/${this.$route.params.id}`)
              .then(response => {
                this.facility = response.data;
              });
          }
          else{
            this.title = "院内施設新規作成";
            this.label = "施設の種類:";
            this.placeholder = "施設の種類を入力してください。";
            this.buttontext = "作成";
          }
        },
  

  methods: {
    add() {
     this.$swal({
                            title: "確認",
                            text: "院内施設を投稿してよろしいでしょうか。",
                            type: "info",
                            width: 350,
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
                     this.axios.post("/api/facility/add", this.facility)
                    .then((response) => {
                      this.$loading(false);
                        this.name = ''
                        this.$swal({
                            position: 'top-end',
                            type: 'success',
                            // title:'確認済',
                            text: '院内施設を投稿しました。',
                            // showConfirmButton: false,
                            // timer: 1800,
                            confirmButtonText: "閉じる",
                            confirmButtonColor: "#6cb2eb",
                            width: 250,
                            height: 200,
                        })
                        // alert('Successfully Created')
                     this.$router.push({ name: "facilitieslist" });
                    }).catch(error=>{

                    if(error.response.status == 422){

                        this.errors = error.response.data.errors

                    }
                });
            });
    },
     updateFacility() {
       
          this.$loading(true);
            this.axios.post(`/api/facility/update/${this.$route.params.id}`, this.facility).then(response => {
              this.$loading(false);
            this.description = "";
            this.$swal({
                        position: 'top-end',
                        type: 'success',
                        text: '施設を更新しました。',
                        // showConfirmButton: false,
                        // timer: 1500,
                        confirmButtonText: "閉じる",
                        confirmButtonColor: "#6cb2eb",
                        width: 250,
                        height: 200,

                      })
            // alert("Successfully Updated!");
            this.$router.push({ name: "facilitieslist" });
          }).catch(error => {
            if (error.response.status == 422) {
              this.errors = error.response.data.errors;
            }
          });
        
        
      },
     checkValidate() {
                   if (this.facility.description) {
                        // console.log('exist');
                        this.errors.description = "";
                    } 
                   if(!this.facility.description && !this.$route.params.id){
                        // console.log('null');
                        this.errors.description = " 院内施設の種類が必須です。";
                    }
                    else if(!this.facility.description && this.$route.params.id){
                       this.errors.description = " 施設の種類が必須です。";
                    }
                   if ( !this.errors.description && !this.$route.params.id ) {
                        this.add();
                    }
                    else if(!this.errors.description && this.$route.params.id){
                      this.updateFacility();
                    }
                },
  }
};


</script>


