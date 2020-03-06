<template>
    <!-- Page Content  -->
    <div class="row">
        <div class="col-md-12">
            <div class="card text-dark">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="page-header header">{{ header }}</h4>
                            <br />
                        </div>
                        <form @submit.prevent="add" class="mt-2 pb-5 col-md-12">
                          <div class="form-group" v-if="this.$auth.check(2)">
                            <div class="form-group" v-if="editcheck">
                              <label>事業者名</label>
                              <label>{{cusName}}</label>
                              <br>
                              <label>施設名</label>
                              <label>{{profileName}}</label>
                            </div>
                            <div v-else>
                            <label>事業者名</label>
                            <autocomplete placeholder="事業者名を検索" input-class="form-control" :source=customerList :results-display="formattedDisplay" @selected="getSelected($event)">
                            </autocomplete>
                            <br>
                            <label>施設名</label>
                            <select v-model="selectedValue" class="division form-control" @change="getProfile($event)">
                                <option value="0">選択してください。</option>
                                <option v-for="profile in profileList" :key="profile.id" v-bind:value="profile.id">
                                    {{profile.name}}
                                </option>
                            </select>
                            </div>
                          </div>
                            <div class="form-group">
                                <label for="title">
                                    タイトル
                                    <span class="error sp2">必須</span>
                                </label>
                                <input type="title" class="form-control box" id="title" name="title" v-model="joboffer.title" placeholder="タイトルを入力してください。" />
                                <!-- <span v-if="errors.title" class="error">{{ errors.title }}</span> -->
                                 <span v-if="errors.title" class="error">{{errors.title}}</span>
                            </div>

                            <div class="form-group">
                                <label for="description">
                                    仕事内容
                                    <span class="error sp2">必須</span>
                                </label>
                                <textarea name="description" class="form-control" cols="50" rows="5" v-model="joboffer.description" placeholder="仕事内容を入力してください。"></textarea>
                                <!-- <span v-if="errors.description" class="error">{{errors.description}}</span> -->
                                 <!-- <span v-if="errors.includes('description')" class="error">題名は必須です。(description)</span> -->
                                <span v-if="errors.description" class="error">{{errors.description}}</span>
                            </div>

                            <!-- <div class="form-group row">
                <div class="col-sm-3">
                  <label for="title">
                    <strong>
                      施設種別
                      <span class="error sp2">必須</span>
                    </strong>
                  </label>
                </div>

                <div class="col-sm-9">
                  <input
                    type="title"
                    class="form-control box"
                    id="title"
                    name="title"
                    v-model="joboffer.title"
                  />
                  <div class="mt-1">
                    <span v-if="errors.title" class="error">{{errors.title[0]}}</span>
                  </div>
                </div>
              </div>-->

                            <!-- <div class="form-group row">
                <div class="col-sm-3">
                  <label for="description">
                    <strong>
                      仕事内容
                      <span class="error sp2">必須</span>
                    </strong>
                  </label>
                </div>

                <div class="col-sm-9">
                  <textarea
                    name="description"
                    class="form-control"
                    cols="50"
                    rows="5"
                    v-model="joboffer.description"
                  ></textarea>
                  <div class="mt-1">
                    <span v-if="errors.description" class="error">{{errors.description[0]}}</span>
                  </div>
                </div>
              </div>-->
<!-- ---------------------------------------------------------------------- -->
                            <!-- <div class="form-group">
                                <label for="description" class="mt-2">
                                    経験・スキル:
                                    <a class="btn btn-sm main-bg-color all-btn white mb-2 ml-4" @click="addRow">
                                        <i class="fas fa-plus-circle"></i> 新スキルを追加
                                    </a>
                                </label>
                                <div class="mb-5">
                                    <div class="form-group row sk" id="newlinktpl" v-for="(field,id) in joboffer.fields" :key="id">
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" v-model="field.skills" placeholder="経験・スキルを入力してください。" />
                                          
                                        </div>

                                        <div class="col-sm-3">
                                            <a class="text-danger" style="cursor: pointer;" @click="delRow(id)">削除</a>
                                        </div>
                                    </div>
                                </div>
                                <div id="newlink"></div>
                            </div> -->


                              <div class="form-group">
                                <label for="skill">
                                    経験・スキル
                                    <span class="error sp2">必須</span>
                                </label>
                               
                                <textarea name="skills" class="form-control" cols="50" rows="5" v-model="joboffer.skills" placeholder="経験・スキルを入力してください。"></textarea>
                            
                             
                            </div>



                         
<!-- --------------------------------------------------------------------------- -->

                            <!-- <div class="mb-1 row">
                <div class="col-sm-3">
                  <label for="skill">
                    <strong>経験・スキル</strong>
                  </label>
                </div>
                <div class="col-sm-9">
                  <a class="btn btn-sm main-bg-color all-btn white mb-2" @click="addRow">
                    <i class="fas fa-plus-circle"></i> 新スキルを追加
                  </a>
                </div>
              </div>
              <div class="mb-5">
                <div
                  class="form-group row sk"
                  id="newlinktpl"
                  v-for="(field,id) in joboffer.fields"
                  :key="id"
                >
                  <div class="col-sm-3"></div>

                  <div class="col-sm-7">
                    <input type="text" class="form-control" v-model="field.skills" />

                  </div>

                  <div class="col-sm-2">
                    <a class="text-danger" style="cursor: pointer;" @click="delRow(id)">削除</a>
                  </div>
                </div>
              </div>
              <div id="newlink"></div>-->
                            <div class="form-group">
                                <label for="location">
                                    郵便番号 
                                    <!-- <span class="error sp2">必須</span> -->
                                </label>
                                <div class="row m-0">
                                    <div class="col-sm-6 col-12 pl-0 tel-input">
                                        <input type="text" class="form-control box" id="postal" placeholder="165879" v-model="joboffer.postal" v-on:keydown="postalNumber" maxlength="7" />
                                    </div>
                                    <div class="col-sm-6 col-12 tel-button">
                                      <span class="float-left submit1 btn main-bg-color continue all-btn submit" @click="getPostal">郵便番号より住所を検索</span>
                                        <span class="float-left eg-txt">例）1006740 (<a href="https://www.post.japanpost.jp/zipcode/" target="_blank">郵便番号検索</a>)</span>
                                    </div>
                                </div>
                                <span id="jsErrorMessage" class="m-t-8"></span>                                
                                <!-- <span v-if="errors.includes('postal')" class="error">題名は必須です。(postal)</span> -->
                                 <!-- <span v-if="errors.postal" class="error">{{errors.postal}}</span> -->
                            </div>
                            <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                  <label for="location">
                                      都道府県
                                      <span class="error sp2">必須</span>
                                  </label>

                          
                                  <select v-model="joboffer.pref" class="division form-control"  @change="getTownship(2)">
                                        <option value="0">選択してください。</option>
                                        <option v-for="cities in city_list" :key="cities.id" v-bind:value="cities.id">
                                            {{cities.city_name}}
                                        </option>
                                  </select>
                              
                                  
                                  <!-- <input type="text" class="form-control box" v-model="joboffer.pref" placeholder="都道府県を入力してください。" /> -->
                                  <!-- <span v-if="errors.pref" class="error">{{errors.pref}}</span> -->
                                  <!-- <span v-if="errors.includes('pref')" class="error">題名は必須です。(pref)</span> -->
                                  <span v-if="errors.pref" class="error">{{errors.pref}}</span>
                                </div>
                                <div class="col-md-6">
                                    <label for="location">
                                        番地（建物名)
                                        <span class="error sp2">必須</span>
                                    </label>
                                
                                    <select v-model="joboffer.str_address" class="division form-control" @change="getLocation()"  >
                                        <option value="0">市区町村を選択してください。</option>
                                        <option v-for="tw in townships" :key="tw.id" v-bind:value="tw.id">
                                            {{tw.township_name}}
                                        </option>
                                    </select>
                                    <!-- <input type="text" class="form-control box" v-model="joboffer.str_address" placeholder="市区町村、番地を入力してください。" /> -->
                                    <span v-if="errors.str_address" class="error">{{errors.str_address}}</span>
                                    <!-- <span v-if="errors.includes('str_address')" class="error">題名は必須です。(str_address)</span> -->
                                    <!-- <span v-if="errors.name" class="error">{{errors.str_address}}</span> -->
                                </div>
                              </div>
                                
                            </div>
                            <!-- <div class="form-group">
                                
                            </div> -->
                            <div class="form-group">
                                <label for="location">
                                    勤務地
                                    <span class="error sp2">必須</span>
                                </label>
                                <textarea name="location" class="form-control" cols="50" rows="5" v-model="joboffer.location" placeholder="勤務地を入力してください。"></textarea>
                                 <span v-if="errors.location" class="error">{{errors.location}}</span>
                                 <!-- <span v-if="errors.includes('location')" class="error">題名は必須です。(location)</span> -->

                            </div>

                            <!-- <div class="form-group row">
                <div class="col-sm-3">
                  <label for="勤務地">
                    <strong>
                      勤務地
                      <span class="error sp2">必須</span>
                    </strong>
                  </label>
                </div>

                <div class="col-sm-9">
                  <textarea
                    name="location"
                    class="form-control"
                    cols="50"
                    rows="5"
                    v-model="joboffer.location"
                  ></textarea>
                  <div class="mt-1">
                    <span v-if="errors.location" class="error">{{errors.location[0]}}</span>
                  </div>
                </div>
              </div>-->

                            <!-- <div class="form-group row">
                <div class="col-sm-3">
                  <label for="neareststation">
                    <strong>最寄り駅</strong>
                  </label>
                </div>

                <div class="col-sm-9">
                  <textarea
                    name="neareststation"
                    class="form-control"
                    cols="50"
                    rows="5"
                    v-model="joboffer.nearest_station"
                    placeholder="最寄り駅を入力してください。"
                  ></textarea>
                </div>
              </div>-->

                            <div class="form-group">
                                <label for="neareststation">最寄り駅</label>
                                <textarea name="neareststation" class="form-control" cols="50" rows="5" v-model="joboffer.nearest_station" placeholder="最寄り駅を入力してください。"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="neareststation">雇用形態</label>
                                <br />
                                <label class="control control--radio">
                                    <input type="radio" value="契約社員" v-model="joboffer.employmentstatus" /> 契約社員 &nbsp;&nbsp;&nbsp;
                                    <div class="control__indicator"></div>
                                </label>
                                <label class="control control--radio">
                                    <input type="radio" value="非常勤" v-model="joboffer.employmentstatus" /> 非常勤 &nbsp;&nbsp;&nbsp;
                                    <div class="control__indicator"></div>
                                </label>

                                <label class="control control--radio">
                                    <input type="radio" value="正職員" v-model="joboffer.employmentstatus" /> 正職員 &nbsp;&nbsp;&nbsp;
                                    <div class="control__indicator"></div>
                                </label>

                                <label class="control control--radio">
                                    <input type="radio" value="その他" v-model="joboffer.employmentstatus" /> その他
                                    <div class="control__indicator"></div>
                                </label>
                            </div>

                            <!-- <div class="form-group row">
                <div class="col-sm-3">
                  <label for="neareststation">
                    <strong>雇用形態</strong>
                  </label>
                </div>

                <div class="col-sm-9">
                  <label>
                    <input
                      type="radio"
                      value="ContractEmployee"
                      v-model="joboffer.employmentstatus"
                    />
                    <strong>契約社員</strong>
                  </label>

                  <label>
                    <input type="radio" value="Part" v-model="joboffer.employmentstatus" />
                    <strong>非常勤</strong>
                  </label>

                  <label>
                    <input type="radio" value="Full" v-model="joboffer.employmentstatus" />
                    <strong>正職員</strong>
                  </label>

                  <label>
                    <input type="radio" value="Other" v-model="joboffer.employmentstatus" />
                    <strong>その他</strong>
                  </label>
                </div>
              </div>-->

                            <!-- <div class="form-group row">
                <div class="col-sm-3"></div>

                <div class="col-sm-9">
                  <span
                    v-if="errors.employment_status"
                    class="error"
                  >{{errors.employment_status[0]}}</span>
                </div>
              </div>-->

                            <div class="form-group">
                                <label for="salary">職種</label>
                                <span class="error sp2">必須</span>
                                <select v-model="joboffer.occupation_id" class="form-control">
                                    <option value="-1">なし</option>
                                    <option v-for="occupation in OccupationList" :key="occupation.id" :value="occupation.id">{{occupation.name}}</option>
                                </select>
                                <span v-if="errors.occupation_id" class="error">{{errors.occupation_id}}</span>
                            </div>

                            <div class="form-group">
                                <label for="salary">
                                    給与
                                    <span class="error sp2">必須</span>
                                </label>
                                <div class="row m-0">
                                  <div class="col-sm-4 pl-0 col-12 joboffer-salary-type">
                                    <select v-model="joboffer.salary_type" class="form-control">
                                        <option v-bind:value='-1'>選択 </option>
                                        <option value='時給'>時給</option>
                                        <option value="日給">日給</option>
                                        <option value="月給">月給</option>
                                    </select>
                                      <p v-if="errors.salary_type" class="error">{{errors.salary_type}}</p>
                                    </div>
                                       <!-- <span v-if="errors.includes('salary_type')" class="error">題名は必須です。(salary_type)</span> -->
                                    <div class="col-sm-4 col-12 joboffer-salary">
                                      <input type="text" class="form-control" v-model="joboffer.salary" name="salary" placeholder="給与を入力してください。" v-on:keydown="isNumber" />
                                      <p v-if="errors.salary" class="error">{{errors.salary}}</p>
                                    </div>
                                    <!-- <span v-if="errors.includes('salary')" class="error">題名は必須です。(salary)</span> -->

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="salary_remark">給料備考</label>
                                <textarea name="salary_remark" class="form-control" cols="50" rows="5" v-model="joboffer.salary_remark" placeholder="給料備考を入力してください。"></textarea>
                            </div>

                            <!-- <div class="form-group row">
                <div class="col-sm-3">
                  <label for="salary">
                    <strong>
                      給与
                      <span class="error sp2">必須</span>
                    </strong>
                  </label>
                </div>

                <div class="col-sm-9">
                  <input type="text" class="form-control" v-model="joboffer.salary" name="salary" />
                  <div class="mt-2">
                    <span v-if="errors.salary" class="error">{{errors.salary[0]}}</span>
                  </div>
                </div>
              </div>-->

                            <div class="form-group">
                                <label for="allowance">諸手当</label>
                                <textarea name="allowance" class="form-control" cols="50" rows="5" v-model="joboffer.allowances" placeholder="諸手当を入力してください。"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="insurance">各種保険</label>
                                <textarea name="insurance" class="form-control" cols="50" rows="5" v-model="joboffer.insurance" placeholder="各種保険を入力してください。"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="workhour">
                                    就業時間
                                    <span class="error sp2">必須</span>
                                </label>
                                <input type="workhour" class="form-control" name="workhour" v-model="joboffer.working_hours" placeholder="就業時間を入力してください。" />
                                <span v-if="errors.working_hours" class="error">{{errors.working_hours}}</span>
                                <!-- <span v-if="errors.includes('working_hours')" class="error">題名は必須です。(working_hours)</span> -->

                            </div>

                            <div class="form-group">
                                <label for="holiday">休日休暇</label>
                                <textarea name="holiday" class="form-control" cols="50" rows="5" v-model="joboffer.holidays" placeholder="休日休暇を入力してください。"></textarea>
                            </div>
                            <div class="form- group row">
                                <div class="col-sm-3"></div>
                            </div>

                            <div class="form-group mt-3 pb-5">
                                <span class="btn main-bg-color white all-btn"  @click="checkValidate()">{{subtitle}}</span>
                                <router-link class="btn bt-red all-btn" to="/jobofferlist">キャンセル</router-link>
                            </div>
                        </form>
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
        data() {
                return {
                header: "求人作成",
                subtitle: "作成",
                errors: {
                  title: '',
                  description:'',
                  postal:'',
                  pref:'',
                  str_address:'',
                  location:'',
                  salary_type:'',
                  salary:'',
                  working_hours:'',
                  occupation_id: ''
                },
                OccupationList: {
                    id: "",
                    name: ""
                },

                    joboffer: {
                        title: "",
                        description:"",
                        customer_id: "",
                        occupation_id: -1,
                        description: "",
                        salary_type:-1,
                        fields: [{
                            skills: "",

                            id: ""
                        }],
                        skills:"",
                        postal: "",
                        zipcode_id: "",
                        pref: "",
                        str_address: "",
                        township_id: "",
                        location: "",
                        nearest_station: "",
                        employmentstatus: "",
                        working_hours: "",
                        employment_status: [{
                            pchecked: false,
                            fchecked: false,
                            echecked: false,
                            cchecked: false,
                            ochecked: false
                        }],
                        salary_type: '-1',
                        salary: "",
                        salary_remark: '',

                        insurance: "",

                        holidays: "",

                        user_id: "",

                        recordstatus: "",
                        profile_id: 0,
                    },

                    ischeck: "",

                    selectedValue: 0,
                    city_list:[],
                    townships:[],
                    customerList: {
                    id: "",
                    name: "",
                    email: "",
                    type_id: ""
                    },
                    editcheck: false,
                    cusName: '',
                    profileList: {
                        id:"",
                        name:""
                    },
                    profileName: '',
                    table_name: {
                        profile: ''
                    }
                };
            },

            created() {
              this.joboffer.pref = 0;
              this.joboffer.str_address = 0;
             
                this.axios.get("/api/job/occupationlist").then(
                    function(response) {
                        this.OccupationList = response.data;
                    }.bind(this)
                );

                 this.axios.get('/api/hospital/citiesList')
                .then(response => {
                    this.city_list = response.data;
                });
                this.axios.get('/api/job/customerList')
                .then(response=> {
                  this.customerList = response.data;
                  this.formattedDisplay(this.customerList);
                });
                this.joboffer.employmentstatus = "ContractEmployee";

                if (this.$route.name == 'jobedit') {
                    this.editcheck = true;
                    this.axios

                        .get(`/api/job/edit/${this.$route.params.id}`)

                    .then(response => {
                      console.log("response.data.job",response.data.job);
                        this.joboffer.title = response.data.job[0].title;
                        if(response.data.job[0].zip7_code == null){
                          this.joboffer.postal = "";
                          this.joboffer.zipcode_id = null;
                        }
                        else{
                          this.joboffer.postal = '0' + response.data.job[0].zip7_code;
                          this.joboffer.zipcode_id = response.data.job[0].zip_id;
                        }            
                                         
                    
                        // this.joboffer.pref = response.data[0].cityname;
                        this.joboffer.pref = response.data.job[0].city_id;
                        this.getTownship(1);
                        this.joboffer.str_address = response.data.job[0].township_id;

                        this.joboffer.customer_id = response.data.job[0].customer_id;

                        this.selectedValue = response.data.job[0].occupation_id;
                        this.joboffer.occupation_id = response.data.job[0].occupation_id;

                        this.joboffer.description = response.data.job[0].description;

                        // this.joboffer.fields.skills = response.data.job[0].skills;
                        this.joboffer.skills = response.data.job[0].skills;

                        // let arr = [];

                        // arr = this.joboffer.fields.skills.split(",");

                        // this.createskill(arr);

                        this.joboffer.location = response.data.job[0].location;

                        this.joboffer.nearest_station = response.data.job[0].nearest_station;

                        this.joboffer.employmentstatus = response.data.job[0].employment_status;

                        // this.ischeck = response.data.employment_status;

                        // this.createCheck(this.ischeck);
                        this.joboffer.salary_type = response.data.job[0].salary_type;
                        this.joboffer.salary = response.data.job[0].salary;
                        this.joboffer.salary_remark = response.data.job[0].salary_remark;

                        this.joboffer.allowances = response.data.job[0].allowances;

                        this.joboffer.insurance = response.data.job[0].insurance;

                        this.joboffer.working_hours = response.data.job[0].working_hours;

                        this.joboffer.holidays = response.data.job[0].holidays;

                        this.joboffer.user_id = response.data.job[0].user_id;

                        this.joboffer.recordstatus = response.data.job[0].recordstatus;

                        this.joboffer.profile_id = response.data.job[0].profile_id;
                        this.header = " 求人編集";
                        this.subtitle = "保存";
                        this.axios.get('/api/job/customerList')
                        .then(response=> {
                          var cus_list = response.data;
                          for(var i=0; i<cus_list.length; i++){
                            if(this.joboffer.customer_id == response.data[i].id){
                              this.cusName = response.data[i].name + '「 ' +response.data[i].email+ ' 」';
                              if(response.data[i].type_id == 2){
                                this.table_name.profile = 'nursing_profiles';
                            }else{
                                this.table_name.profile = 'hospital_profiles';
                            }
                            }
                          }
                          this.axios.post(`/api/job/profileName/${this.joboffer.profile_id}`,this.table_name)
                        .then(response=> {
                          console.log("profilename",response.data)
                            for(var i=0; i<response.data.length; i++){
                                if(this.joboffer.profile_id == response.data[i].id){
                                    this.profileName = response.data[i].name;
                                }
                            }
                            // this.profileName = response.data[0].name;
                        });
                          this.customerList = response.data;
                        });
                        
                        return this.header;
                        return this.subtitle;
                    });
                }else{
                  this.editcheck = false;
                }
            },

            methods: {
              checkValidate() {

                         if (this.joboffer.title == '') {
                            this.errors.title = '施設種別名は必須です。';
                        } else {
                            this.errors.title = "";
                        }

                          if (this.joboffer.description == '') {
                            this.errors.description = '仕事内容は必須です。';
                        } else {
                            this.errors.description = "";
                        }

                        // if (this.joboffer.postal == '') {
                        //     this.errors.postal = '郵便番号は必須です。';
                        // } else {
                        //     this.errors.postal = "";
                        // }

                        if (this.joboffer.pref == '') {
                            this.errors.pref = '都道府県は必須です。';
                        } else {
                            this.errors.pref = "";
                        }

                        if (this.joboffer.str_address == '') {
                            this.errors.str_address = '市区町村は必須です。';
                        } else {
                            this.errors.str_address = "";
                        }

                        if (this.joboffer.location == '') {
                            this.errors.location = '勤務地は必須です。';
                        } else {
                            this.errors.location = "";
                        }

                        if (this.joboffer.salary_type == '-1') {
                            this.errors.salary_type = " 給与タイプは必須です。";
                        }
                        else {
                            this.errors.salary_type = null;
                        }

                        if (this.joboffer.salary == '') {
                            this.errors.salary = '給与は必須です。';
                        } else {
                            this.errors.salary = "";
                        }

                        if (this.joboffer.working_hours == '') {
                            this.errors.working_hours = '就業時間は必須です。';
                        } else {
                            this.errors.working_hours = "";
                        }

                        if (this.joboffer.occupation_id == '-1') {
                            this.errors.occupation_id = " 職種は必須です。";
                        }
                        else {
                            this.errors.occupation_id = null;
                        }

                        if (
                            !this.errors.title &&
                            !this.errors.description &&
                            // !this.errors.postal &&
                            !this.errors.pref &&
                            !this.errors.location &&
                            !this.errors.description &&
                            !this.errors.salary_type &&
                            !this.errors.salary &&
                            !this.errors.working_hours&&
                            !this.errors.occupation_id

                        ) {

                            this.add();
                        }
                  },
                getPostal: function(event) {
                    if (this.joboffer.postal.length > 5) {
                        var postal = this.joboffer.postal;
                        this.axios.post("/api/hospital/postList/" + postal).then(response => {
                            var post_data = response.data.postal_list;
                            var length = response.data.postal_list.length;
                            if (length > 0) {
                                var pref = post_data[0]["city_id"];
                                this.joboffer.zipcode_id = post_data[0]["id"];
                                this.joboffer.pref = post_data[0]["city_id"];
                                this.getTownship(1);
                                this.joboffer.str_address = response.data.township_id[0]['id'];                               
                                this.joboffer.location = post_data[0]["street"];
                                $('#jsErrorMessage').html('<div></div>');
                            } else {
                                this.joboffer.str_address = 0;
                                this.joboffer.pref = 0;
                                this.joboffer.city = "";
                                $("#jsErrorMessage").html(
                                    '<div class="error">郵便番号の書式を確認してください。</div>'
                                );
                            }
                        });
                    }
                },
                    getTownship(town_id){
                   
                    this.axios.get('/api/auth/township',{
                      params:{
                        city:this.joboffer.pref
                      },
                    }).then((response)=>{
                       if(town_id == 2)
                      {
                        this.joboffer.location = ''
                        // this.joboffer.postal = '';
                        this.joboffer.zipcode_id = null;
                        this.joboffer.str_address = 0;
                      }
                      this.townships = response.data.townships
                    })
                  },
                  getLocation(){
    
                    //  this.joboffer.postal = '';
                     this.joboffer.location = '';
                  },

                add() {
              
                    if (this.$route.params.id) {
                        this.updateJob();
                    } else {
                        this.$swal({
                            title: "確認",
                            text: "求人を作成してよろしいでしょうか。",
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
                           
                        }
                        ).then(response => {
                           this.$loading(true);
                            this.axios
                                .post("/api/job/add", this.joboffer)

                            .then(response => {
                               this.$loading(false);
                                    this.$swal({
                                        position: "top-end",
                                        type: "success",
                                        title: "求人を作成しました。",
                                        // text: "ファイルが作成されました。",
                                        // type: "success",
                                        width: 350,
                                        height: 200,
                                        confirmButtonText: "閉じる",
                                        confirmButtonColor: "#6cb2eb",
                                    });

                                    // alert('Successfully Created')

                                    this.$router.push({
                                        name: "jobofferlist"
                                    });

                                    this.$route.params.id = null;
                                })
                                .catch(error => {
                                   this.$loading(false);
                                    if (error.response.status == 422) {
                                        this.errors = error.response.data.errors;
                                    }
                                });
                        });
                    }
                },

                getParent: function() {
                  this.joboffer.occupation_id = this.selectedValue;
                },
            //      add() {
            //      if(this.errors.length ==0)
            //     {
            //       // this.$swal({
            //       //       title: "確認",
            //       //       text: "更新よろしいでしょうか。",
            //       //       type: "info",
            //       //       width: 350,
            //       //       height: 200,
            //       //       showCancelButton: true,
            //       //       confirmButtonColor: "#6cb2eb",
            //       //       cancelButtonColor: "#b1abab",
            //       //       cancelButtonTextColor: "#000",
            //       //       confirmButtonText: "更新",
            //       //       cancelButtonText: "キャンセル",
            //       //       confirmButtonClass:  "all-btn",
            //       //       cancelButtonClass: "all-btn"
            //       //   }).then(response => {
            //         console.log("add fun no error");
            //         this.axios.post("/api/job/add", this.joboffer)
            //         .then(response => {
            //         this.name = ''
            //         // console.log(response);
            //         this.$swal({
            //         position: 'top-end',
            //         type: 'success',
            //         title: '作成されました',
            //         confirmButtonText: "はい",
            //         confirmButtonColor: "#6cb2eb",

            //         width: 250,
            //         height: 200,
            //         })
            //         // alert('Successfully Created')
            //         this.$router.push({name: 'jobofferlist'});
            //         }).catch(error=>{

            //             if(error.response.status == 422){

            //                 this.errors = error.response.data.errors

            //             }
            //         })
            // // })
            //     }
            // },

                addRow: function() {
                    this.joboffer.fields.push({
                        skills: "",

                        id: ""
                    });
                },

                delRow: function(id) {
                    this.joboffer.fields.splice(id, 1);

                    // this.joboffer.fields.pop();
                },

                createskill: function(arr) {
                    this.joboffer.fields.shift();

                    for (var i = 0; i < arr.length; i++) {
                        this.joboffer.fields.push({
                            skills: arr[i],

                            id: arr[i]
                        });
                    }
                },

                isNumber: function(event) {
                    if (!(event.keyCode >= 48 && event.keyCode <= 57) && !(event.keyCode >= 96 && event.keyCode <= 105) && event.keyCode != 8 && event.keyCode != 46 && !(event.keyCode >= 37 && event.keyCode <= 40)) {
                        event.preventDefault();
                    }
                },

                // onBlurNumber(e) {
                //   this.joboffer.salary = this.thousandSeprator(this.joboffer.salary);
                // },
                // thousandSeprator(amount) {
                //   if (amount !== '' || amount !== undefined || amount !== 0 || amount !== '0' || amount !== null) {
                //       return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                //   } else {
                //       return amount;
                //   }
                // },

                // my_function (event) {
                // 	// const char = String.fromCharCode(event.keyCode);
                // 	// if (!/[0-9]/.test(char)) {
                //   // 	event.preventDefault();
                //   // }

                //   var keyCode = event.key;
                //   if ( (keyCode != 8 || keyCode ==32 ) && (keyCode < 48 || keyCode > 57)) {
                //     console.log(keyCode);
                //     return false;
                //   }
                // },
                // createCheck: function(check) {

                //     this.joboffer.employment_status.shift()

                //     if (check == "Full") {

                //         this.joboffer.employment_status.push({

                //             fchecked: 1,

                //         });

                //     } else if (check == "Part") {

                //         this.joboffer.employment_status.push({

                //             pchecked: 1,

                //         });

                //     } else {

                //         this.joboffer.employment_status.push({

                //             fchecked: 1,

                //             pchecked: 1

                //         });

                //     }

                // },

                updateJob() {
                      if (this.$route.params.id){
                        this.$swal({
                        title: "確認",
                        text: "求人を更新してよろしいでしょうか。",
                        type: "info",
                        width: 350,
                        height: 200,
                        showCancelButton: true,
                        confirmButtonColor: "#6cb2eb",
                        cancelButtonColor: "#b1abab",
                        cancelButtonTextColor: "#000",
                        confirmButtonText: "はい",
                        cancelButtonText: "キャンセル",
                        confirmButtonClass:  "all-btn",
                        cancelButtonClass: "all-btn"
                    }).then(response => {
                         this.$loading(true);
                        this.axios.post(`/api/job/update/${this.$route.params.id}`, this.joboffer)

                        .then(response => {
                            this.joboffer = response.data.job;
                           this.$loading(false);
                        
                                this.$swal({
                                    title: "求人を更新しました。",
                                    // text: "ファイルが更新されました。",
                                    type: "success",
                                    width: 350,
                                    height: 200,
                                    confirmButtonText: "閉じる",
                                    confirmButtonColor: "#6cb2eb"
                                });

                                this.$router.push({
                                    name: "jobofferlist"
                                });
                            })
                            .catch(error => {
                                if (error.response.status == 422) {
                                    this.errors = error.response.data.errors;
                                }
                            });
                        });
                    }
                  },
                  formattedDisplay(result) {
                    return result.name + '「' + result.email + '」';
                  },
                  getSelected(event){
                      if(event.selectedObject.type_id == 3){
                          this.table_name.profile = 'nursing_profiles';
                      }else {
                          this.table_name.profile = 'hospital_profiles';
                      }

                        this.joboffer.customer_id = event.value;
                        this.axios.post(`/api/job/profileList/${this.joboffer.customer_id}`,this.table_name)
                    .then(response=> {
                    this.profileList = response.data;
                    console.log('jjjj',this.profileList)
                    if(this.profileList != ''){
                        this.selectedValue = this.profileList[0].id;
                        this.joboffer.profile_id = this.profileList[0].id;
                    }else{
                        this.selectedValue = 0;
                    }
                    });
                  },
                  getProfile(event){
                      console.log('event', event.target.value)
                      this.joboffer.profile_id = event.target.value;
                  },
                  postalNumber: function(event) {
                if(!(event.keyCode >= 48 && event.keyCode <= 57) && !(event.keyCode >= 96 && event.keyCode <= 105) 
                    && event.keyCode != 8 && event.keyCode != 46 && !(event.keyCode >= 37 && event.keyCode <= 40)) 
                {
                    event.preventDefault();
                }
            },
                }
            };

</script>

<style scoped>
    .bt-red
    {
    color: #fff;
    background-color: #e3342f;
    border-color: #e3342f;
    }
    .bt-suc
    {   
        color: #fff;
        background-color: #0cc72c; 
        border-color: #0cc72c;
    }
</style>
