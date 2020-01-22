<template>    
 <div class="row">
      <div class="col-12">  
          <div class="card">
              <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                         
                        <div class="col-md-12">
                            <h4 class="page-header">Create Medical Acceptance</h4>
                            <br>
                        </div>
                        <div class="col-md-12">
                             <form >
                            <div class="form-group">
                                <label>medical acceptance Name :<span class="error">*</span></label>
                                <input type="text" class="form-control"  v-model="medical.name"  placeholder="medical acceptance" >
                                <span v-if="errors.name" class="error">{{errors.name}}</span>
                       
                            </div>
                        
                            <div class="form-group ">
                                <div class="form-group row">
                                    <div class="col-1 pad-free">
                                        <button class="btn news-post-btn" @click="checkvalidate()">Create</button>
                                    </div>
                                    <div class="col-1 pad-free">
                                        <router-link class="btn btn-warning" to="/medicalacceptancelist" >  Cancel </router-link>
                                    </div>
                                </div>
                            </div>  
                                </form>  
                            </div>
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
                errors:{
                        name: "",
                },
                medical: {
                        name: '',
                        user_id:'',
                        recordstatus: ''
                    }
            }
        },
         created() {
            this.axios
                .get(`/api/medical/edit/${this.$route.params.id}`)
                .then((response) => {
                    this.medical = response.data;
                   
                });
        },
       
         methods: {
           add() {
               console.log('c');
               this.axios.post('/api/medical/add', this.medical)
                    .then((response) => {
                    alert('Successfully Created')
                     this.$router.push({name: 'medicalacceptancelist'});
                    }).catch(error=>{

                    if(error.response.status == 422){

                        this.errors = error.response.data.errors

                    }
                    });
            },checkvalidate()
            {
              
               if(!this.medical.name)
               {
                   
                   this.errors.name = "Name is required";
               }
               else{
                   
                   this.errors.name  = "";
               }
               if(this.$route.params.id && !this.errors.name)
               {
                   console.log(this.$route.params.id)
                   this.updatemedical();
               }
               else if(!this.$route.params.id && !this.errors.name){
                
                   this.add();
               }
            },
              updatemedical() {
               console.log(this.$route)
                this.axios
                    .post(`/api/medical/update/${this.$route.params.id}`, this.medical)
                    .then((response) => {
                          alert('Successfully Updated!')
                        this.$router.push({name: 'medicalacceptancelist'});
                    }).catch(error=>{
                       

                    if(error.response.status == 422){

                        this.errors = error.response.data.errors

                    }
                    });;
            },
            
           
        }
             
}
</script>


