<template>
    <div id="customer_list">
        <div class="col-md-12  tab-content">
            <div class="p-2 p0-480">
                <div v-if="norecord_msg" class="card card-default card-wrap">
                    <p class="record-ico">
                        <i class="fa fa-exclamation"></i>
                    </p>
                    <p>OOPS!!</p>
                    <p class="record-txt01">表示するデータありません</p>
                    <p>表示するデータありません‼新しいデータを作成してください。</p>
                </div>
                <div v-else class="container-fuid">
                    <h4 class="main-color mb-3">事業者検索</h4>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="事業者検索" id="search-word" @keyup="searchCustomer()" />
                        </div>
                    </div>
                    <hr />
                    <h5 class="header">{{title}}</h5>
                    <div v-if="nosearch_msg" class="container-fuid no_search_data">新規作成するデタが消える。</div>
                    <div v-else class="container-fuid">
                        <table class="table table-bordered">
                            <tr v-for="customer in customers.data" :key="customer.id">
                                <td  class="p-4">
                                    <div class="row m-0">
                                        <div class="col-sm-12 p-0">
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
                                                <div class="col-lg-10 col-md-8" v-if="customer.status == 0">Pending</div>
                                                <div v-else>
                                                    <div class="col-lg-10 col-md-8" v-if="customer.recordstatus == '1'">Activate</div>
                                                    <div class="col-lg-10 col-md-8" v-else>Deactivate</div>
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
                                                    <button class="btn delete-borderbtn mr-2 mb-2" @click="deleteCustomer(customer.id)">削除</button>
                                                    <!-- <router-link :to="{name:'custedit',params:{id:customer.id}}" class="btn main-bg-color all-btn white">Edit</router-link> -->
                                                    <!-- <button class="btn confirm-borderbtn" v-if="customer.status == 0">確認済</button> -->

                                                    <button class="btn confirm-borderbtn  mb-2" :id="'confirm-btn'+customer.id" v-if="customer.status == 0" @click="comfirm(customer.id)">新規登録承認</button>
                                                    <!-- <span class="btn confirm-borderbtn" style="border-color: #ccc!important; color: #ccc!important;cursor:not-allowed;" :id="'confirm-btn'+customer.id" v-else>登録承認済</span>     -->
                                                    <span v-else class="">                                                  
                                            <!-- <button class="btn confirm-orangebtn">プロフィール設定</button> -->
                                            <router-link :to="{ path:'/accountlist/'+ type +'/'+ customer.id}" v-if="customer.status == 1" class="btn confirm-orangebtn mr-2 mb-2"><i class="fa fa-edit"></i> 施設一覧</router-link>
                                             <router-link :to="{ path:'/profiledit/'+ type +'/'+ customer.id}" v-if="customer.status == 1" class="btn confirm-orangebtn mb-2"><i class="fa fa-map"></i> プロフィール設定</router-link>
                                            <p class="mt-2">この事業者は登録承認済です。</p>
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
    export default {
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
                };
            },
            created() {

                this.$loading(true);
                this.initialCall();

            },
            methods: {
                initialCall(){
                    if(this.$route.path == "/nuscustomerlist"){
                        this.type = "nursing";
                        this.title = "介護施設事業者一覧";
                        this.axios.get("/api/customers/3").then(response => {
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
                deleteCustomer(id) {
                    this.$loading(true);
                        this.$swal({
                            title: "確認",
                            text: "事業者を削除してよろしいでしょうか。",
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
                            
                            this.axios.delete(`/api/customer/delete/${id}`).then(response => {
                                this.$loading(false);
                                // this.customers = response.data.customers;
                                this.initialCall();
                                this.$swal({
                                    // title: "削除済",
                                    text: "事業者を削除しました。",
                                    type: "success",
                                    width: 350,
                                    height: 200,
                                    confirmButtonText: "閉じる",
                                    confirmButtonColor: "#dc3545"
                                });
                                if(this.norecord != 0){
                                    this.norecord_msg = false;
                                }else{
                                    this.norecord_msg = true;
                                }
                                // let a = this.customers.map(item => item.id).indexOf(id);
                                // this.customers.splice(a, 1);

                            });
                            
                        });
                    },
                    comfirm(id) {
                        this.$loading(true);
                        this.axios.get(`/api/confirm/${id}`).then(response => {
                            console.log(response.data)
                            // this.customers = response.data.customers;
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
                                    confirmButtonColor: "#dc3545"
                                });
                            } else {
                                this.$swal({
                                    title: "新規登録承認",
                                    text: "顧客はすでに確認されています。",
                                    type: "warning",
                                    width: 350,
                                    height: 200,
                                    confirmButtonText: "閉じる",
                                    confirmButtonColor: "#dc3545"
                                });
                            }

                            this.$loading(false);

                            // $('#confirm-btn' + id).css('display', 'none');
                        });
                    },

                    searchCustomer(page) {
                        if(typeof page === "undefined"){
                            page = 1;
                        }
                        var search_word = $("#search-word").val();
                        let fd = new FormData();
                        fd.append("search_word", search_word);
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
