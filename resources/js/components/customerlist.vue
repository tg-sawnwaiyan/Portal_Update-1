<template>
    <div id="customer_list">
        <div class="col-md-12  tab-content">
            <div class="p-2 p0-480">
                <div v-if="norecord_msg" class="card card-default card-wrap">
                    <p class="record-ico">
                        <i class="fa fa-exclamation"></i>
                    </p>
                   
                    <p class="record-txt01">介護施設事業者が登録されていません。</p>
                 
                </div>
                <div v-else class="container-fuid">
                    <h4 class="main-color mb-3">事業者検索 </h4>
                    <div class="row mb-4">
                        <div class="col-md-6">
                      
                            <autocomplete id="cusname"  placeholder="事業者名で検索"  input-class="form-control" :source=customerList :results-display="formattedDisplay" @clear="clearcustomer()"  @selected="getselected($event)">
                            </autocomplete>
                           
                        </div> 
                       
                        <div class="col-md-6 form-check form-check-inline">
                          
                            <label class="form-check-label control control--checkbox"  style="padding-left:5px;">
                            <input type="checkbox" class="form-check-input" value="1"   v-model="recordstatus" @change="searchCustomer">
                            有効
                            <div class="control__indicator"></div>
                            </label>

                            <label class="form-check-label control control--checkbox" style="padding-left:5px;" @change="searchCustomer">
                            <input type="checkbox" class="form-check-input" value="0" v-model="recordstatus"  >
                                無効
                            <div class="control__indicator"></div>
                            </label>

                            <label class="form-check-label control control--checkbox" style="padding-left:5px;" @change="searchCustomer">
                            <input  type="checkbox" class="form-check-input" value="2" v-model="status" >
                            登録承認審査中
                            <div class="control__indicator"></div>
                            </label>
                            
                        </div>
                        
                         <!-- <div class="col-md-6 choose-item">
                              <select  v-model="status" id="selectBox" class="form-control select_box" @change="searchCustomer()">
                                <option selected="selected" value>状態を選択してください。</option>
                                <option value="1"> 有効 </option>                            
                                <option value="0"> 無効 </option>   
                                <option value="2"> 登録承認審査中 </option>                              
                            </select> 
                        </div>                  -->
                        
                    </div>
                    <!-- <div class="row mb-4">
                        <div class="col-md-6">
                             <input type="text" class="form-control" placeholder="事業者名で検索" id="search-word" v-model="searchkeyword" @keyup="searchCustomer()" />
                        </div>
                        <div class="col-md-6 choose-item">
                            <select  v-model="status" id="selectBox" class="form-control select_box" @change="searchCustomer()">
                                <option selected="selected" value>状態を選択してください。</option>
                                <option value="1"> 有効 </option>                            
                                <option value="0"> 無効 </option>   
                                <option value="2"> 登録承認審査中 </option>                              
                            </select>
                        </div>
                    </div> -->
                    
                    <hr/>
                    <h5 class="header">{{title}}</h5>
                    <!-- <div v-if="nosearch_msg" class="container-fuid no_search_data"> -->
                    <div v-if="nosearch_msg" class="card card-default card-wrap no_search_data">
                        <p class="record-ico">
                            <i class="fa fa-exclamation"></i>
                        </p>
                        <p class="record-txt01"> 検索キーワードに該当する事業者は存在しません。</p>
                        
                    </div>                        
                       
                    <div v-else class="container-fuid">
                        <table class="table table-bordered">
                            <tr v-for="customer in customers.data" :key="customer.id">
                                <td  class="p-4">
                                    <div class="row m-0">
                                        <div class="col-sm-12 p-0">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-4 custom_title">
                                                    <strong>事業者番号:</strong>
                                                </div>
                                                <div class="col-lg-10 col-md-8">{{customer.cusnum}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2 col-md-4 custom_title">
                                                    <strong>事業者名:</strong>
                                                </div>
                                                <div class="col-lg-10 col-md-8">{{customer.name}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2 col-md-4 custom_title">
                                                    <strong >状態:</strong>
                                                </div>
                                                <div class="col-lg-10 col-md-8" v-if="customer.status == 0" >登録承認審査中</div>
                                                <div class="col-lg-10 col-md-8" v-else>
                                                    <span v-if="customer.recordstatus == '1'" >有効</span>
                                                    <span v-else >無効</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2 col-md-4 custom_title">
                                                    <strong>メールアドレス:</strong>
                                                </div>
                                                <div class="col-lg-10 col-md-8">{{customer.email}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2 col-md-4 custom_title">
                                                    <strong>電話番号:</strong>
                                                </div>
                                                <div class="col-lg-10 col-md-8">{{customer.phone}}</div>
                                            </div>
                                            <!-- <div class="row">
                                                <div class="col-lg-2 col-md-4 custom_title">
                                                    <strong>住所:</strong>
                                                </div>
                                                <div class="col-lg-10 col-md-8">{{customer.address}}</div>
                                            </div> -->
                                            <!-- <div class="col-md-2 max-width13"><strong>Logo:</strong></div><div class="col-md-10">{{customer.logo}}</div> -->
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <button class="btn delete-borderbtn mr-2 mb-2" v-if="customer.status != 0" @click="deleteCustomer(customer.id,'delete')">削除</button>
                                                    <button class="btn delete-borderbtn mr-2 mb-2" v-if="customer.status == 0" @click="deleteCustomer(customer.id,'denied')">新規登録承認しない</button>
                                                    <!-- <router-link :to="{name:'custedit',params:{id:customer.id}}" class="btn main-bg-color all-btn white">Edit</router-link> -->
                                                    <!-- <button class="btn confirm-borderbtn" v-if="customer.status == 0">確認済</button> -->

                                                    <button class="btn confirm-borderbtn  mb-2" :id="'confirm-btn'+customer.id" v-if="customer.status == 0" @click="comfirm(customer.id)"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;新規登録承認</button>
                                                    <!-- <span class="btn confirm-borderbtn" style="border-color: #ccc!important; color: #ccc!important;cursor:not-allowed;" :id="'confirm-btn'+customer.id" v-else>登録承認済</span>     -->
                                                    <span v-else class="">                                                  
                                            <!-- <button class="btn confirm-orangebtn">プロフィール設定</button> -->
                                            <span v-if="customer.status == 1 && customer.recordstatus == 0" class="btn confirm-disable-orangebtn mr-2 mb-2"><i class="fa fa-list"></i> 施設一覧</span>
                                            <router-link :to="{ path:'/accountlist/'+ type +'/'+ customer.id}" v-if="customer.status == 1 && customer.recordstatus == 1" class="btn confirm-orangebtn mr-2 mb-2"><i class="fa fa-list"></i> 施設一覧</router-link>
                                            <router-link :to="{ path:'/profiledit/'+ type +'/'+ customer.id}" v-if="customer.status == 1" class="btn confirm-orangebtn mb-2"><i class="fa fa-edit"></i> プロフィール設定</router-link>
                                            <p class="mt-2" style="color: #81ad3b;font-weight: bold;"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;この事業者は登録承認済です。</p>
                                                    </span>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-sm-4">
                                            <p class="text-right mt-2">
                                            <router-link :to="{name: 'profiledit', params:{cusid: customer.id}}" v-if="customer.status == 1" class="btn confirm-orangebtn mb-2"><i class="fa fa-map"></i> プロフィール設定</router-link><br>
                                            <router-link :to="{name: 'profile', params:{cusid: customer.id, type: customer.type_id == 2? 'hospital':'nursing'}}" v-if="customer.status == 1" class="btn confirm-orangebtn"><i class="fa fa-edit"></i> ページ編集</router-link>
                                            </p>
                                        </div> -->
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <!-- <div v-for="customer in displayItems" :key="customer.id" class="card card-default m-b-20">
                            <div class="card-body news-post">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3">
                                        <img :src="'/upload/hospital_profile/'+ customer.logo" class="img-fluid" alt="cust" v-if="customer.type_id == 2" @error="imgUrlAlt" />
                                        <img :src="'/upload/nursing_profile/'+ customer.logo" class="img-fluid" alt="cust" v-if="customer.type_id != 2" @error="imgUrlAlt" />
                                    </div>
                                    <div class="col-lg-10 col-md-9">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-4 custom_title">
                                                <strong>事業者名:</strong>
                                            </div>
                                            <div class="col-lg-10 col-md-8">{{customer.name}}</div>
                                            <div class="col-lg-2 col-md-4 custom_title">
                                                <strong >状態:</strong>
                                            </div>
                                            <div class="col-lg-10 col-md-8" v-if="customer.recordstatus == '1'">Activate</div>
                                            <div class="col-lg-10 col-md-8" v-else>Deactivate</div>

                                            <div class="col-lg-2 col-md-4 custom_title">
                                                <strong>メールアドレス:</strong>
                                            </div>
                                            <div class="col-lg-10 col-md-8">{{customer.email}}</div>
                                            <div class="col-lg-2 col-md-4 custom_title">
                                                <strong>電話番号:</strong>
                                            </div>
                                            <div class="col-lg-10 col-md-8">{{customer.phone}}</div>
                                            <div class="col-lg-2 col-md-4 custom_title">
                                                <strong>住所:</strong>
                                            </div>
                                            <div class="col-lg-10 col-md-8">{{customer.address}}</div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <button class="btn delete-borderbtn" @click="deleteCustomer(customer.id)">削除</button>
                                                    <button class="btn confirm-borderbtn" :id="'confirm-btn'+customer.id" v-if="customer.status == 0" @click="comfirm(customer.id)">新規登録承認</button>
                                                    <span class="btn confirm-borderbtn" style="border-color: #ccc!important; color: #ccc!important;cursor:not-allowed;" :id="'confirm-btn'+customer.id" v-else>登録承認済</span>
                                                    <span class="float-right">
                                                    <router-link :to="{name: 'profiledit', params:{cusid: customer.id}}" v-if="customer.status == 1" class="btn confirm-orangebtn">プロフィール設定</router-link>
                                                    <router-link :to="{name: 'profile', params:{cusid: customer.id, type: customer.type_id == 2? 'hospital':'nursing'}}" v-if="customer.status == 1" class="btn confirm-orangebtn">ページ編集</router-link>
                                                    </span>
                                                </div>
                                        </div>
                                    </div>
                                    </div>
                            </div>
                        </div> -->
                    </div>
                    <!-- <pagination :data="customers" @pagination-change-page="searchCustomer"></pagination> -->
                    <div>
                        <pagination :data="customers" @pagination-change-page="searchCustomer" :limit="limitpc">
                                <span slot="prev-nav"><i class="fas fa-angle-left"></i> 前へ</span>
                                <span slot="next-nav">次へ <i class="fas fa-angle-right"></i></span>
                          </pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import Autocomplete from 'vuejs-auto-complete'


    export default {
         components: {
            Autocomplete,
        },

         props:{
            limitpc: {
                type: Number,
                default: 5
            },
        },
        data() {
                return {
                    customers: [],
                    items: [],
                    norecord: 0,
                    norecord_msg: false,
                    nosearch_msg: false,
                    title: '',
                    type: null,
                    status:'',
                    searchkeyword:'',
                    customerList:'',
                    profileList:[],
                    recordstatus :[],
                    status:[],



                    // selectedValue:{
                    //    activate:false,
                    //    deactivate:false,
                    //    pending:false,
                    // },
                     table_name: {
                        profile: ''
                    },
                    cusid:'',
                  
                };
            },
            created() {

                this.$loading(true);
                this.initialCall();
               
                  this.axios.get('/api/job/customerList/'+this.type).then(response=> {
                    this.customerList = response.data;
                });

            },
            methods: {
               
                initialCall(){
                    if(this.$route.path == "/nuscustomerlist"){
                        this.type = "nursing";
                        this.title = "介護施設事業者一覧";
                        this.axios.get("/api/customers/3").then(response => {
                            this.$loading(false);
                            console.log(response.data)
                            this.customers = response.data;
                            this.norecord = this.customers.data.length;
                            if(this.norecord != 0){
                                this.norecord_msg = false;
                            }else{
                                this.norecord_msg = true;
                            }
                        });
                    }
                    else if(this.$route.path == "/hoscustomerlist"){
                        this.type = "hospital";
                        this.title = "病院事業者一覧";
                        this.axios.get("/api/customers/2").then(response => {
                            this.$loading(false);
                            this.customers = response.data;
                            this.norecord = this.customers.data.length;
                            if(this.norecord != 0){
                                this.norecord_msg = false;
                            }else{
                                this.norecord_msg = true;
                            }
                        });
                    }
                },
                getselected($event){
                  
                    this.cusid = $event.display;
                    this.searchCustomer();
                },
                clearcustomer(){
                    this.cusid = '';
                    this.searchCustomer();
                },

               

                
                deleteCustomer(id,type) {
                    if(type == 'delete'){
                        var textval = '事業者を削除してよろしいでしょうか';
                    }
                    else{
                        // var textval = '承認しない場合事業者情報が削除されます。';
                        var textval = '本当に承認しなくてよろしいでしょうか。<br/>承認しない場合事業者情報が削除されます。';
                    }
                    
                        this.$swal({
                            title: "確認",
                            html: textval,
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
                            cancelButtonClass: "all-btn",
                            allowOutsideClick: false,
                            
                        }).then(response => {
                            this.$loading(true);
                            this.axios.delete(`/api/customer/delete/${id}/${type}`).then(response => {
                                this.$loading(false);
                                // this.customers = response.data.customers;
                                this.initialCall();
                                // this.$swal({
                                // // title: "削除済",
                                // text: "事業者を削除しました。",
                                // type: "success",
                                // width: 350,
                                // height: 200,
                                // confirmButtonText: "閉じる",
                                // confirmButtonColor: "#dc3545",
                                // allowOutsideClick: false,
                                // });
                                if(this.norecord != 0){
                                    this.norecord_msg = false;
                                }else{
                                    this.norecord_msg = true;
                                }
                                // let a = this.customers.map(item => item.id).indexOf(id);
                                // this.customers.splice(a, 1);

                            });
                            
                        }).catch(error => {
                            this.$loading(false);
                        });
                    },
                    comfirm(id) {
                        this.$swal({
                            title: "確認",
                            text: "本当に承認してよろしいでしょうか。",
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
                            cancelButtonClass: "all-btn",
                            allowOutsideClick: false,
                            
                        }).then(response => {
                            this.$loading(true);
                            this.axios.get(`/api/confirm/${id}`).then(response => {
                                this.initialCall();
                                // this.displayItems();
                                if (response.data.status == 'success') {
                                    this.$swal({
                                        title: "新規登録承認",
                                        text: "事業者にメールを送信しました",
                                        type: "success",
                                        width: 350,
                                        height: 200,
                                        confirmButtonText: "閉じる",
                                        confirmButtonColor: "#dc3545",
                                        allowOutsideClick: false,
                                    });
                                } else {
                                    this.$swal({
                                        title: "新規登録承認",
                                        text: "顧客はすでに確認されています",
                                        type: "warning",
                                        width: 350,
                                        height: 200,
                                        confirmButtonText: "閉じる",
                                        confirmButtonColor: "#dc3545",
                                        allowOutsideClick: false,
                                    });
                                }
                                this.$loading(false);
                            });
                        }).catch(error => {
                            this.$loading(false);
                        })
                        
                    },
                  

                    searchCustomer(page) {

                     
                        if(typeof page === "undefined"){
                            page = 1;
                        }
                      
                        console.log("this.selectedValue",this.selectedValue);
                        let fd = new FormData();
                        fd.append("status",this.status)
                        fd.append("recordstatus",this.recordstatus);
                        fd.append("cusid",this.cusid);
                      
                        if(this.$route.path == "/nuscustomerlist"){
                            fd.append("type",3)
                        }
                        else{
                            fd.append("type",2)
                        }
                        this.$loading(true);
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                        this.axios.post("/api/customer/search?page="+page, fd).then(response => {
                            this.$loading(false);
                            this.customers = response.data;
                         
                            if(this.customers.data.length != 0) {
                                this.nosearch_msg = false;
                            }else{
                                this.nosearch_msg = true;
                            }
                        });
                    },
                    imgUrlAlt(event) {
                        event.target.src = "/images/noimage.jpg"
                    },                    
            }
    };
</script>
