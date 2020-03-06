<template>
  <div class="card profile m-t-22 " style="border:none;">
    <form class="col-md-12 form-class pad-free-750">
        <div class="col-md-12 pad-free">
            <div class="row">             
               <div class="col-lg-4 col-md-5">
                  <div class="form-group form-group-wrapper">
                        <img :src="logo" class="profile_logo m-b-8 img-fluid fit-image-profile" @error="imgUrlAlt" >                             
                      <div class="m-t-10">
                          <span class="btn-file d-inline-block">画像を選択                     
                          <input type="file" name="" class ="pro-logo m-b-10" @change="logo_preview(this)">                                      
                          </span>     
                          <span class="pl-4"></span>                                  
                            <span id="imgname" class="d-inline-block align-top pl-2">{{img_name}}</span>
                      </div>                      
                  </div>
              </div>            
              <div class="col-lg-8 col-md-7">
                  <div class="form-group form-group-wrapper d-flex">
                      <label class="heading-lbl col-md-2 col-12 pad-free">施設名称 <span class="error sp2">必須</span></label>
                      <input type="text" class="form-control customer-name col-md-10 col-12 nursing_input" placeholder="施設名称を入力してください。" v-model="hospital_info.name">
                  </div>

                  <div class="form-group form-group-wrapper d-flex">
                          <label class="heading-lbl col-md-2 col-12 pad-free">メールアドレス <span class="error sp2">必須</span></label>
                          <!-- <label class="col-md-10 col-12 customer-email"> {{hospital_info.email}} </label> -->
                          <input type="text" class="form-control customer-email col-md-10 col-12 nursing_input" placeholder="email" v-model="hospital_info.email">
                  </div>
                  <div class="form-group form-group-wrapper d-flex">
                          <label class="heading-lbl col-md-2 col-12 pad-free">電話番号 </label>                            
                          <input type="text" class="form-control customer-phone col-md-10 col-12 nursing_input" id="phone" placeholder="電話番号を入力してください。" v-model="hospital_info.phone" v-on:keyup="isNumberOnly" pattern="[0-9-]*"  @focusout="focusPhone"  maxlength="14" title="Please enter number only.">
                          <!-- v-on:keyup="isNumberOnly" -->
                          <span class="error" v-if="ph_length || ph_num">※電話番号が正しくありません。もう一度入力してください。</span>
                          <span class="error" v-else></span>
                        
                  </div>
              </div>
            </div>

        
            <div class="form-group form-group-wrapper row ml-0 mr-0">
                <label class="heading-lbl col-md-2 col-12 pad-free">公式サイト</label>
                <input type="text" name="official-website" class="form-control col-md-10 col-12  hos-768 website white-bg-color" v-model="hospital_info.website" />
            </div>


            <div class="form-group form-group-wrapper row mr-0 ml-0">
                <label class="heading-lbl col-md-2 col-12 pad-free">混雑状況</label>
                <textarea name="congestion" class="form-control col-md-10 col-12  hos-768 congestion white-bg-color" v-model="hospital_info.congestion"></textarea>
            </div>

        <!-- <div class="form-group">
                <label>フォトアルバム<span class="error">*</span></label>
                <input type="file" class="" value="Upload Photo" id="upload_file" @change="preview_image();" multiple>
                <div class="col-md-12">
                        <div class="row" id="image_preview"></div>
                </div>
        </div>-->       

        <!-- <div class="form-group form-group-wrapper row ml-0 mr-0">
          <label class="heading-lbl col-2 pad-free">
            診療科目
            <span class="error">*</span>
          </label>
          <textarea
            name="medicaldepartment"
            class="form-control col-10 white-bg-color subject"
            v-model="hospital_info.subject"
          ></textarea>
        </div> -->

        <!-- test -->        
        <table class="table table-bordered table-wrapper">
            <tr>
                <td>
                    <div class="form-group m-b-0">
                        <label  class="headinglbl col-6 col-lg-2 col-md-3 pad-free">診療科目</label>
                        <span class="bg-trans btn dropdown-arrow nursing_toggle_responsive" @click="toggleEvent('clinical-subject','1')">
                            詳細 <i class="fas fa-sort-down animate" :class="{'rotate': isRotate1}"></i></span>
                        <div class="col-xl-10 col-md-12 float-right clinical-subject-toggle-div toggle-div m-t-10">
                        
                            <div class="row"> <div v-for="subj in clinical_subj" :key="subj.id" class="form-check form-check-inline col-6 col-md-4 col-lg-3">
                                    <label class="form-check-label control control--checkbox" style="padding-left:5px;">
                                        <input type="checkbox" class="form-check-input"  name="subject" v-bind:value="subj.id" @click="subjectCheck(subj.id)" v-model="subj.checked">
                                          {{subj.name}}
                                        <div class="control__indicator"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <!-- end -->


        <div class="form-group form-group-wrapper row ml-0 mr-0">
            <label class="heading-lbl col-2 pad-free"> 専門医</label>
            <textarea name="specialist" class="form-control col-md-10 col-12 hos-768 specialist white-bg-color" v-model="hospital_info.specialist" ></textarea>
        </div>  

        <table class="table table-bordered table-wrapper">
            <tr>
                <th class="nursing_table pc-414-table sp-768-block" style="border:none;"> <label class="heading-lbl hos_lbl pad-free">医院からのお知らせ </label></th>
                <td class="nursing_table1 pc-414-table sp-768-block" style="border:none;">
                    <!-- <textarea name="feature" id="" cols="30" rows="10" ></textarea> -->
                    <quill-editor  ref="myQuilEditor" name="detailsinfo" class="details-info" @change="onDetailInfoEditorChange($event)" v-model="hospital_info.details_info" :options="editorOption"/>
                </td>
            </tr>
        </table>
        <!-- <div class="form-group">
                            <label class="heading-lbl">診療科目<span class="error">*</span></label>
                            <textarea name="subject" class="form-control"></textarea>
        </div>-->

        <table class="table table-bordered table-wrapper">
          <tr>
            <td>
              <label class="headinglbl col-6 col-lg-2 col-md-3 pad-free">診療時間 </label>
              <span  class="bg-trans btn dropdown-arrow nursing_toggle_responsive" @click="toggleEvent('schedule','2')">詳細
                <i class="fas fa-sort-down animate" :class="{'rotate': isRotate2}"></i>
              </span>

              <div class="col-md-10 hos_toggle float-right m-t-10 schedule-toggle-div toggle-div pad-free">
                <div class="col-12">
                  <div class="row">
                    <table class="table table-striped table-bordered">
                      <tr class="first-row"> 
                        <th>&nbsp;</th>
                        <th class="text-center">午前</th>
                        <th class="text-center">午後</th>
                      </tr>

                      <tr>
                        <td class="text-center font-weight-bold second-row">月</td>
                        <td>
                          <div class="row">
                            <div class="col-lg-6">
                              <span>から</span>
                              <input type="text" class="form-control am-from0 white-bg-color" placeholder="0:00" v-model="schedule_arr.am_mon_from"/>
                            </div>

                            <div class="col-lg-6 m-t-768">
                              <span>まで</span>
                              <input type="text" class="form-control am-to0 white-bg-color" placeholder="0:00" v-model="schedule_arr.am_mon_to"/>
                            </div>
                          </div>
                        </td>

                        <td>
                          <div class="row">
                            <div class="col-lg-6">
                              <span>から</span>
                              <input type="text" class="form-control pm-from0 white-bg-color" placeholder="0:00" v-model="schedule_arr.pm_mon_from"/>
                            </div>

                            <div class="col-lg-6 m-t-768">
                              <span>まで</span>
                              <input type="text" class="form-control pm-to0 white-bg-color" placeholder="0:00" v-model="schedule_arr.pm_mon_to"/>
                            </div>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td class="text-center font-weight-bold second-row">火</td>
                        <td>
                          <div class="row">
                            <div class="col-lg-6">
                              <span>から</span>
                              <input type="text" class="form-control am-from1 white-bg-color" placeholder="0:00" v-model="schedule_arr.am_tue_from"/>
                            </div>
                            <div class="col-lg-6 m-t-768">
                              <span>まで</span>
                              <input type="text"

                                class="form-control am-to1 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.am_tue_to"

                              />

                            </div>

                          </div>

                        </td>

                        <td>

                          <div class="row">

                            <div class="col-lg-6">

                              <span>から</span>

                              <input

                                type="text"

                                class="form-control pm-from1 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.pm_tue_from"

                              />

                            </div>

                            <div class="col-lg-6 m-t-768">

                              <span>まで</span>

                              <input

                                type="text"

                                class="form-control pm-to1 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.pm_tue_to"

                              />

                            </div>

                          </div>

                        </td>

                      </tr>

                      <tr>

                        <td class="text-center font-weight-bold second-row">水</td>

                        <td>

                          <div class="row">

                            <div class="col-lg-6">

                              <span>から</span>

                              <input

                                type="text"

                                class="form-control am-from2 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.am_wed_from"

                              />

                            </div>

                            <div class="col-lg-6 m-t-768">

                              <span>まで</span>

                              <input

                                type="text"

                                class="form-control am-to2 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.am_wed_to"

                              />

                            </div>

                          </div>

                        </td>

                        <td>

                          <div class="row">

                            <div class="col-lg-6">

                              <span>から</span>

                              <input

                                type="text"

                                class="form-control pm-from2 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.pm_wed_from"

                              />

                            </div>

                            <div class="col-lg-6 m-t-768">

                              <span>まで</span>

                              <input

                                type="text"

                                class="form-control pm-to2 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.pm_wed_to"

                              />

                            </div>

                          </div>

                        </td>

                      </tr>

                      <tr>

                        <td class="text-center font-weight-bold second-row">木</td>

                        <td>

                          <div class="row">

                            <div class="col-lg-6">

                              <span>から</span>

                              <input

                                type="text"

                                class="form-control am-from3 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.am_thu_from"

                              />

                            </div>

                            <div class="col-lg-6 m-t-768">

                              <span>まで</span>

                              <input

                                type="text"

                                class="form-control am-to3 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.am_thu_to"

                              />

                            </div>

                          </div>

                        </td>

                        <td>

                          <div class="row">

                            <div class="col-lg-6">

                              <span>から</span>

                              <input

                                type="text"

                                class="form-control pm-from3 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.pm_thu_from"

                              />

                            </div>

                            <div class="col-lg-6 m-t-768">

                              <span>まで</span>

                              <input

                                type="text"

                                class="form-control pm-to3 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.pm_thu_to"

                              />

                            </div>

                          </div>

                        </td>

                      </tr>

                      <tr>

                        <td class="text-center font-weight-bold second-row">金</td>

                        <td>

                          <div class="row">

                            <div class="col-lg-6">

                              <span>から</span>

                              <input

                                type="text"

                                class="form-control am-from4 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.am_fri_from"

                              />

                            </div>

                            <div class="col-lg-6 m-t-768">

                              <span>まで</span>

                              <input

                                type="text"

                                class="form-control am-to4 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.am_fri_to"

                              />

                            </div>

                          </div>

                        </td>

                        <td>

                          <div class="row">

                            <div class="col-lg-6">

                              <span>から</span>

                              <input

                                type="text"

                                class="form-control pm-from4 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.pm_fri_from"

                              />

                            </div>

                            <div class="col-lg-6 m-t-768">

                              <span>まで</span>

                              <input

                                type="text"

                                class="form-control pm-to4 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.pm_fri_to"

                              />

                            </div>

                          </div>

                        </td>

                      </tr>

                      <tr>

                        <td class="text-center font-weight-bold second-row">土</td>

                        <td>

                          <div class="row">

                            <div class="col-lg-6">

                              <span>から</span>

                              <input

                                type="text"

                                class="form-control am-from5 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.am_sat_from"

                              />

                            </div>

                            <div class="col-lg-6 m-t-768">

                              <span>まで</span>

                              <input

                                type="text"

                                class="form-control am-to5 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.am_sat_to"

                              />

                            </div>

                          </div>

                        </td>

                        <td>

                          <div class="row">

                            <div class="col-lg-6">

                              <span>から</span>

                              <input

                                type="text"

                                class="form-control pm-from5 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.pm_sat_from"

                              />

                            </div>

                            <div class="col-lg-6 m-t-768">

                              <span>まで</span>

                              <input

                                type="text"

                                class="form-control pm-to5 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.pm_sat_to"

                              />

                            </div>

                          </div>

                        </td>

                      </tr>

                      <tr>

                        <td class="text-center font-weight-bold second-row">日</td>

                        <td>

                          <div class="row">

                            <div class="col-lg-6">

                              <span>から</span>

                              <input

                                type="text"

                                class="form-control am-from6 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.am_sun_from"

                              />

                            </div>

                            <div class="col-lg-6 m-t-768">

                              <span>まで</span>

                              <input

                                type="text"

                                class="form-control am-to6 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.am_sun_to"

                              />

                            </div>

                          </div>

                        </td>

                        <td>

                          <div class="row">

                            <div class="col-lg-6">

                              <span>から</span>

                              <input

                                type="text"

                                class="form-control pm-from6 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.pm_sun_from"

                              />

                            </div>

                            <div class="col-lg-6 m-t-768">

                              <span>まで</span>

                              <input

                                type="text"

                                class="form-control pm-to6 white-bg-color" placeholder="0:00"

                                v-model="schedule_arr.pm_sun_to"

                              />

                            </div>

                          </div>

                        </td>

                      </tr>

                    </table>

                  </div>

                </div>

              </div>

            </td>

          </tr>

        </table>



        <div class="form-group form-group-wrapper row ml-0 mr-0">
          <label class="heading-lbl col-md-2 col-12 pad-free">休診日 </label>
          <textarea name="close-day" class="form-control white-bg-color close-day col-md-10 col-12 hos-768" v-model="hospital_info.closed_day" ></textarea>
        </div>



        <table class="table table-bordered table-wrapper">
          <tr>
            <td>
              <div class="form-group m-b-0">
                <label class="headinglbl col-6 col-lg-2 col-md-3 pad-free">施設情報 </label>
                <span class="bg-trans btn dropdown-arrow nursing_toggle_responsive" @click="toggleEvent('hos-fac','3')" >詳細 
                    <i class="fas fa-sort-down animate"  :class  ="{'rotate': isRotate3}"></i>
                </span>

                <div class="col-xl-10 col-md-12 float-right hos-fac-toggle-div toggle-div m-t-10">
                  <div class="row">
                    <div v-for="fac in fac_list" :key="fac.id" class="form-check form-check-inline col-6 col-md-4 col-lg-3">
                      <label class="form-check-label control control--checkbox" style="padding-left:5px;">
                        <input type="checkbox" class="form-check-input" name="facility" :class="'facility-'+fac.id" v-bind:value="fac.id" @click="facilityCheck(fac.id)" v-model="fac.checked" />
                        {{fac.description}}
                        <div class="control__indicator"></div>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        </table>

        <table class="table table-bordered table-wrapper">
          <tr>
            <td>
              <div class="form-group m-b-0">
                <label class="hos_lbl headinglbl col-6 col-lg-2 col-md-3 pad-free">こだわりの特長</label>
                <span class="bg-trans btn dropdown-arrow nursing_toggle_responsive btn-toggle" @click="toggleEvent('special-feature','4')">
                  詳細 <i class="fas fa-sort-down animate" :class="{rotate:isRotate4}"></i>
                </span>

                <div class="col-xl-10 col-md-12 float-right special-feature-toggle-div toggle-div m-t-10">
                  <div class="row">
                    <div v-for="feat in feature_list" :key="feat.id" class="form-check form-check-inline col-6 col-md-4 col-lg-3">
                      <label class="form-check-label control control--checkbox" style="padding-left:5px;">
                        <input type="checkbox" class="form-check-input" name="special-features" :class="'feature-'+feat.id" v-bind:value="feat.id" @click="featureCheck(feat.id)" v-model="feat.checked"/>
                        {{feat.name}}
                        <div class="control__indicator"></div>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        </table>

        <!-- <div class="form-group form-group-wrapper">
          <label class="heading-lbl">地図</label>
          <span
            class="btn all-btn main-bg-color m-l-10"
            style="min-width: 0px;"
            @click="maptogglediv()"
          >
            <i class="fas fa-sort-down"></i>
          </span>
          <div class="map-toggle-div toggle-div">
            <div class="col-md-12">
              <GoogleMap></GoogleMap>
            </div>
            <div class="form-group">
              <label>
                郵便番号
                <span class="error">*</span>
              </label>
              <input
                type="text"
                v-model="this.postal"
                name="postal"
                class="postal form-control"
                id="postal"
                v-on:keyup="getPostal"
                placeholder="郵便番号を入力してください。"
                maxlength="7"
              />
              <div id="jsErrorMessage"></div>
            </div>
            <div class="form-group">
              <label>
                市区町村、番地（建物名）:
                <span class="error sp1">必須</span>
              </label>
              <input
                type="text"
                id="city"
                name="city"
                class="city form-control"
                placeholder="市区町村、番地を入力してください。"
                v-model="this.city"
        />-->

        <!-- <span v-if="errors.city" class="error">{{errors.city[0]}}</span> -->

        <!-- <input type="text" class="form-control" id="city" placeholder="市区町村、番地を入力してください。" v-model="zipStreet"> -->

        <!-- <p>例）東京都千代田区丸の内1-9-1 グラントウキョウノースタワー40階</p>
            </div>
            <div class="form-group">
              <label>
                住所
                <span class="error">*</span>
              </label>
              <textarea
                name="address"
                rows="10"
                class="form-control customer-address"
                v-model="hospital_info.address"
              ></textarea>
            </div>
            <div class="form-group">
              <label>
                交通 / アクセス
                <span class="error">*</span>
              </label>
              <textarea
                name="access"
                rows="10"
                class="form-control access"
                v-model="hospital_info.access"
              ></textarea>
            </div>
          </div>
        </div>-->



        <!-- <table class="table table-bordered table-wrapper">

          <tr>

            <td>

              <label class="heading-lbl col-2 pad-free">地図</label>

              <span

                class="btn all-btn main-bg-color"

                style="min-width: 0px;"

                @click="maptogglediv()"

              >

                <i class="fas fa-sort-down animate" :class="{rotate:isRotate5}"></i>

              </span>

              <div class="col-md-10 float-right m-t-10 map-toggle-div toggle-div pad-free">

                <div class="col-md-12">

                    <GoogleMap :address="hospital_info.address" :lat_num='nursing_info.latitude' :lng_num='nursing_info.longitude' v-if="nursing_info.latitude != 0"></GoogleMap>
                    <GoogleMap :address="hospital_info.address" :lat_num='35.6803997' :lng_num='139.76901739' v-if="nursing_info.latitude == 0"></GoogleMap>



                  <div class="form-group">

                    <label>
                      交通 / アクセス

                      <span class="error">*</span>

                    </label>

                    <textarea

                      name="access"

                      rows="10"

                      class="form-control access white-bg-color"

                      v-model="hospital_info.access"

                    ></textarea>

                  </div>

                </div>

              </div>

            </td>

          </tr>

        </table> -->
        <!-- Test Station Area -->
        <!-- <table class="table table-bordered table-wrapper">
                <tr>
                        <td>
                                <div class="form-group">
                                        <label  class="heading-lbl col-2 pad-free">駅</label>
                                        <span class="btn all-btn main-bg-color" style="min-width: 0px;" @click="StationAdd()"><i class="fas fa-sort-down animate" :class="{'rotate': isRotate4}"></i></span>
                                        <div class="col-md-10 float-right station-toggle-div toggle-div m-t-10">
                                                <div class="row">
                                                        <div v-for="stat in station_list" :key="stat.id" class="col-md-3 m-b-20">
                                                                <label>
                                                                        <input type="checkbox"  name="station" v-bind:value="stat.id" @click="stationCheck(stat.id)" v-model="stat.checked">
                                                                        {{stat.name}}
                                                                </label>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </td>
                </tr>
        </table> -->
        <!-- End Test Station Area -->

        <div class="form-group form-group-wrapper">
          <label class="headinglbl col-6 col-lg-2 pad-free">フォトアルバム</label>          
           <span class='changeGalleryLink bg-trans btn dropdown-arrow nursing_toggle_responsive' @click="toggleEvent('photo','6')">
              詳細 <i id="gallery" class="fas fa-sort-down" :class="{'rotate': isRotate6}"></i>
            </span>

          <!-- <div id="changeGalleryLink" class="col-md-12">
                <div class="row" id ="gallery-photo">
                        <div class="col-md-6 gallery-area-photo" v-bind:id="'photo'+indx" v-for="(img,indx) in img_arr" :key="img.id">
                                <div class="col-md-12">
                                        <input type="file" name="" class="hospital-photo m-b-10" v-bind:class="img.id" id="upload_img" @change="preview_image(img.id,indx)">
                                        <div class="col-md-12 m-b-10" v-bind:class="img.id">
                                                <input type="hidden" class="already-photo" v-model="img.photo">
                                                <img :src="'/upload/hospital_profile/'+ img.photo" class="img-fluid" alt="profile" v-if="img.photo" v-bind:id="'already-photo'+indx" @error="imgUrlAlt">
                                        </div>
                                </div>
                                <div class="col-md-12">
                                        <input type="text" name="title" placeholder="タイトル" class="form-control m-b-15 title white-bg-color" v-model="img.title">
                                        <textarea name="description" placeholder="コンテンツ" class="form-control m-b-15 description white-bg-color" v-model="img.description"></textarea>
                                </div>
                                <div class="col-md-12 text-right">
                                        <a class="mr-auto text-danger btn delete-borderbtn" @click="DeltArr(indx,'photo')"> <i class="fa fa-trash"></i> 削除</a>
                                </div>
                        </div>
                </div>
          </div> -->

        <div id="changeGalleryLink" class="row col-12 m-0 photo-toggle-div pad-free">
          <div class="col-12 col-lg-12 float-right p-0">
            <span class="galleryadd btn all-btn main-bg-color float-right nursing_add_responsive" style="min-width: 0px;" @click="galleryAdd()">
            <i class="fas fa-plus-circle"></i> 追加
            </span>
          </div>      
            <div class="row col-12 pad-free m-0" id="gallery-photo">
            
              <div class="col-md-6 gallery-area-photo p0-990" v-bind:id="'photo'+indx" v-for="(img,indx) in img_arr" :key="img.id" >
                    <div class="col-md-12">
                          <!-- <input type="file" name class="hospital-photo m-b-15 p-t-10"  v-bind:class="'classname'+indx" id="upload_img" @change="preview_image($event,indx)" />  
                        <div class="col-md-12" v-bind:class="img.id">
                            <input type="hidden" class="already-photo" v-model="img.photo" />
                            <div>
                            <img v-bind:src="img.src" class="img-fluid hospital-image" alt="profile" v-if="img.src != null" @error="imgUrlAlt"/>
                            </div>
                        </div> -->
                         <span class="btn-file d-inline-block">画像を選択        
                          <input type="file" name="" class="hospital-photo" v-bind:class="img.classname" id="upload_img" @change="preview_image($event,indx)">
                          </span> 
                          <span class="d-inline-block align-top pt-2" v-bind:id="'img_name'+indx"></span>
                          <div class="col-md-12  p0-480" v-bind:class="img.id">
                              <input type="hidden" class="already-photo" v-model="img.photo">
                              <img v-bind:src="img.src" class="img-fluid hospital-image" alt="profile" v-if="img.src!=null" @error="imgUrlAlt">
                          </div>
                    </div>

                    <div class="col-md-12">
                        <label class="m-t-10 font-weight-bold">タイトル</label>
                        <input type="text" name="title" placeholder="タイトルを入力してください。" class="form-control m-b-15 white-bg-color" v-model="img.title" />
                        <label class="font-weight-bold">コンテンツ</label>
                        <textarea name="description" placeholder="コンテンツを入力してください。" class="form-control m-b-15 description white-bg-color" v-model="img.description" ></textarea>
                    </div>
                    <div class="col-md-12 text-right hos-del">
                        <a class="mr-auto text-danger btn delete-borderbtn" @click="DeltArr(indx,img.id,'photo')">
                            <i class="fa fa-trash"></i> 削除
                        </a>
                    </div>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group form-group-wrapper">
          <label class="headinglbl col-6 col-lg-2 pad-free">動画</label>         

           <span class='changeGalleryVideoLink bg-trans btn dropdown-arrow nursing_toggle_responsive' @click="toggleEvent('video','7')">
           詳細 <i id="video" class="fas fa-sort-down" :class="{'rotate': isRotate7}"></i>
           </span>

          <div id="changeGalleryVideoLink" class="row col-12 m-0 p-0 video-toggle-div">
            <div class="col-12 col-lg-12 float-right p-0">
              <span class="galleryvideo btn all-btn main-bg-color float-right nursing_add_responsive" style="min-width: 0px;" @click="galleryVideoAdd()" >
              <i class="fas fa-plus-circle"></i> 追加</span>
            </div>
            <div class="row col-12 pad-free m-0" id="gallery-video">
              <!-- Add by + Button -->
              <div class="col-md-6 gallery-area-photo p0-990 p0-480" v-bind:id="'video'+indx" v-for="(video,indx) in video_arr" :key="video.id" >
                <div class="col-md-12">
                  <label class="font-weight-bold">URL</label>
                  <input type="text" name="url" placeholder="URLを入力してください。" class="form-control m-b-15 video-url white-bg-color" v-model="video.photo" />                
                </div>

                <div class="col-md-12">
                  <label class="font-weight-bold">タイトル</label>
                  <input type="text" name="title" placeholder="タイトルを入力してください。" class="form-control m-b-15 white-bg-color" v-model="video.title" />
                  <label class="font-weight-bold">コンテンツ</label>
                  <textarea name="description" placeholder="コンテンツを入力してください。" class="form-control m-b-15 description white-bg-color" v-model="video.description" ></textarea>

                </div>
                <div class="col-md-12 text-right hos-del">
                  <a class="mr-auto text-danger btn delete-borderbtn" @click="DeltArr(indx,video.id,'video')">
                  <i class="fa fa-trash"></i> 削除
                  </a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <table class="table table-bordered table-wrapper">
            <tr>
                <td>
                    <label class="headinglbl col-6 col-lg-2 pad-free">地図</label>
                    <span class="bg-trans btn dropdown-arrow nursing_toggle_responsive" @click="toggleEvent('map','5')">詳細 <i class="fas fa-sort-down animate" :class="{'rotate': isRotate5}"></i></span>
                    <div class="col-md-10 hos_toggle float-right m-t-10 map-toggle-div toggle-div pad-free">
                        <div class="col-md-12">
                            <GoogleMap :address="address_show" :township="hospital_info.townships_id" :lat_num='hospital_info.latitude' :lng_num='hospital_info.longitude' :city="city_id" :township_list="township_list"></GoogleMap>
                            <!-- <GoogleMap :address="hospital_info.address" :lat_num='35.6803997' :lng_num='139.76901739' v-if="hospital_info.latitude == 0"></GoogleMap> -->

                            <div class="form-group">
                                <label>交通 / アクセス</label>
                                <!-- <textarea name="address" rows="10" class="form-control"></textarea> -->
                                <quill-editor  ref="myQuilEditor" name="address" :options="editorOption" class="transporation-access" @change="onAccessEditorChange($event)" v-model="hospital_info.access"/>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>  
        <div class="bottom-fixed-btn">
            <div class="row justify-content-center">
                <div class="col-8 col-md-3 col-lg-2">
                    <span class="btn secondary-bg-color col-8 offset-2 all-btn" @click="Create_Profile()" id="create-profile">保存</span>
                </div>                        
            </div>
        </div>      
      </div>
    </form>
  </div>
</template>



<script>
import 'quill/dist/quill.snow.css'
import {quillEditor} from 'vue-quill-editor'
// import {Button, Input,Select} from 'iview'
import GoogleMap from './GoogleMap.vue'
// import { timeout } from 'q'
export default {
         components: {
                GoogleMap,
                quillEditor,
                // Button,
                // Input,
                // Select,
        },
       data() {
            return {
                fac_list: [],
                img_arr:[],
                video_arr:[],
                feature_list:[],
                profile_type:'hospital',
                schedule_arr:[],shedule_am:[],shedule_pm:[],
                schedule_list:[],
                hospital_info:[],
                hospital_info_push:[],
                hospital_info:[],  save_hospital_info:[],
                chek_feature : [],
                subjects:[],
                facilities:[],
                city: '',
                postal: '',clinical_subj:[],

                isRotate1: false,
                isRotate2: false,
                isRotate3: false,
                isRotate4: false,
                isRotate5: false,
                isRotate6: false,
                isRotate7: false,

                editorOption:{
                    debug:'info',
                    placeholder:'Type your post...',
                    readonly:true,
                    theme:'snow',
                    access_val: '',
                    detail_info: '', stations:[], station_list:[],
            },
            ph_length: false,
            ph_num: false,
            city_id: 0,
            township_list: [],
            address_show:'',
            logo:'',
            img_name:'',
            pro_id: 0,
            }
        },
        created(){
            this.pro_id = Number(this.$route.params.id);
            this.type = this.$route.params.type;

            this.initialCall();
        },
        methods: {
            initialCall(){
              this.address_show = $('#address_show').val();
           
                this.axios
                .get('/api/clinical-subject/'+this.pro_id)
                .then(response=>{
                    this.clinical_subj = response.data;
                });

                this.axios
                .get('/api/schedule/'+this.pro_id)
                .then(response=>{
                    this.schedule_arr = response.data;
                });

                this.axios
                .get('/api/hospitalinfo/'+this.pro_id)
                .then(response=>{
                    this.hospital_info = response.data;
                    this.logo = '/upload/hospital_profile/'+ this.hospital_info.logo;
                    this.address_show = this.hospital_info.address;
        
                    this.axios
                    .get('/api/nurscities/'+this.hospital_info.townships_id)
                    .then(response=>{
                        this.city_id = Number(response.data[0].city_id);
                        this.township_list = response.data[0].township_list;
                    });

                    if(this.hospital_info.latitude == 0){
                        localStorage.setItem('lat_num',35.6803997);
                        localStorage.setItem('lng_num',139.76901739);
                    }
                    else{
                        localStorage.setItem('lat_num',this.hospital_info.latitude);
                        localStorage.setItem('lng_num',this.hospital_info.longitude);
                    }
                });
                this.axios
                .get('/api/pgallery/'+this.pro_id + '/hospital')
                .then(response=>{
                        this.img_arr = response.data;

                });
                this.axios
                .get('/api/vgallery/'+this.pro_id+'/hospital')
                .then(response=>{
                        this.video_arr = response.data;
                });
                this.axios
                .get('/api/feature/'+this.profile_type+'/'+this.pro_id)
                .then(response=>{
                        this.feature_list = response.data;
                });
                this.axios
                .get('/api/facility/'+this.profile_type+'/'+this.pro_id)
                .then(response=>{
                        this.fac_list = response.data;
                });
            },
            imgUrlAlt(event) {
                event.target.src = "/images/noimage.jpg"
            },
            logo_preview(fileInput) {
                this.logo = URL.createObjectURL(event.target.files[0]);
                this.img_name = document.getElementsByClassName('pro-logo')[0].files[0].name;
              },
            preview_image(event,indx) {
                console.log("indc",indx);
                this.img_arr[indx]['photo'] = event.target.files[0].name;
                this.img_arr[indx]['src'] = URL.createObjectURL(event.target.files[0]);
                $('#img_name'+indx).text(event.target.files[0].name);
            },
            toggleEvent(type,indx) {
                $("."+type+"-toggle-div").toggle('medium');
                this['isRotate'+indx] = !this['isRotate'+indx];
            },

            facilityCheck(check_id) {
                    $('.facility-'+check_id).attr('checked','true');
            },
            featureCheck(check_id) {
                    $('.feature-'+check_id).attr('checked','true');
            },
            stationCheck(check_id) {
                $('.station-'+check_id).attr('checked','true');
            },
            subjectCheck(check_id) {
                    $('.subject-'+check_id).attr('checked','true');
            },
            DeltArr(indx,id,type) {


              this.$swal({
                        title: "確認",
                        text: "職種を削除してよろしいでしょうか。",
                        type: "warning",
                        width: 350,
                        height: 200,
                        showCancelButton: true,
                        confirmButtonColor: "#dc3545",
                        cancelButtonColor: "#b1abab",
                        cancelButtonTextColor: "#000",
                        confirmButtonText: "削除",
                        cancelButtonText: "キャンセル",
                        confirmButtonClass: "all-btn",
                        cancelButtonClass: "all-btn"
                    }).then(response => {
                        console.log(type+"/"+id)
                        if(type == 'photo') {
                            if(id){

                                let fd = new FormData();
                                fd.append('id',id);
                                fd.append('photo',this.img_arr[indx]['photo']);
                                fd.append('customer_id',this.pro_id)
                                fd.append('custype','hospital')
                                this.img_arr.splice(indx,1);

                                this.axios
                                .post('/api/delete-pgallery',fd)
                                .then(response=>{

                                    this.$swal({
                                        text: "職種を削除しました。",
                                        type: "success",
                                        width: 350,
                                        height: 200,
                                        confirmButtonText: "閉じる",
                                        confirmButtonColor: "#dc3545"
                                    });
                                })
                                .catch(error=>{
                                    console.log(error)
                                    if(error.response.status == 422){
                                        this.errors = error.response.data.errors
                                    }
                                })
                            } else {
                                this.img_arr.splice(indx,1);
                            }
                        }

                        if(type == 'video') {
                            this.video_arr.splice(indx,1);
                        }
                 });

            },
            galleryAdd() {
                var date = new Date;
                var s = date.getMilliseconds();
                var m = date.getMinutes();
                var h = date.getHours();
                this.img_arr.push({id:null,photo:'',title:'',description:'', src:null});
            },
            onAccessEditorChange({ editor, html, text }) {
                this.hospital_info.access = html;
            },
            onDetailInfoEditorChange({ editor, html, text }) {
                this.hospital_info.details_info = html;
            },
            galleryVideoAdd() {
                   this.video_arr.push({title:'',description:'',url:''});

            },
            StationAdd() {
                $(".station-toggle-div").toggle('medium');
                this.isRotate4 = !this.isRotate4;
            },
            Create_Profile () {
                var logo = document.getElementsByClassName('pro-logo')[0].files[0];
               
                this.save_hospital_info = [];
                this.$loading(true);

                if(this.hospital_info.details_info === undefined)
                {
                  this.hospital_info.details_info = "";
                }

                this.hospital_info.latitude = $('#new_lat').val();
                this.hospital_info.longitude = $('#new_long').val();
                this.hospital_info.address = $('#address_show').val();
                this.address_show = $('#address_show').val();

                this.hospital_info.townships_id = Number($('#gmaptownship').val());
                localStorage.setItem('lat_num',this.hospital_info.latitude);
                localStorage.setItem('lng_num',this.hospital_info.longitude);

                if(logo)
                {
                  this.hospital_info.logo = logo.name;
                  let fd = new FormData();   
                  fd.append('logo', logo)
                  this.axios.post('/api/hospital/movephoto', fd)
                      .then(response => {
                          }).catch(error=>{

                              if(error.response.status == 422){
                                  this.errors = error.response.data.errors
                              }
                      })
                }
               
                let pt = new FormData();
                var img = document.getElementsByClassName('gallery-area-photo');
           
                for(var i =this.img_arr.length-1;i>=0;i--)
                {
                    this.img_arr[i]['type'] = 'photo';
                    if(this.img_arr[i]['photo'] == null || this.img_arr[i]['photo'] == '')
                    {
                        this.img_arr.splice(i,1);
                    }
                    var file = img[i].getElementsByClassName('hospital-photo')[0].files[0];
                   
                    if(file) {
                    
                        pt.append(i ,file )
                    }
                  
                }

         

                // if(logo){
                //     this.hospital_info.logo = logo.name;
                //     pt.append('logo', logo)
                // }

                for(var i =this.video_arr.length-1;i>=0;i--)
                {
                    this.video_arr[i]['type'] = 'video';
                    if(this.video_arr[i].photo == null || this.video_arr[i].photo == '' )
                    {
                        this.video_arr.splice(i,1);
                    }

                }

            
                this.axios.post('/api/hospital/movephoto', pt)
                    .then(response => {
                        }).catch(error=>{

                            if(error.response.status == 422){
                                this.errors = error.response.data.errors
                            }
                    })

                this.chek_feature = [];
                var s_features =[];
                    $.each($("input[name='special-features']:checked"), function(){
                        s_features.push($(this).val());
                    });
                    this.chek_feature.push({special_feature_id:s_features});

                  var chek_facility = [];

                    $.each($("input[name='facility']:checked"), function(){
                            chek_facility.push($(this).val());
                    });
                    this.facilities = chek_facility.join(',');

                this.subjects = [];
                var chek_subj = [];
                    $.each($("input[name='subject']:checked"), function(){
                            chek_subj.push($(this).val());
                    });
                    this.subjects.push({subject_id:chek_subj});

                // Consultation
                this.schedule_list = [];
                for(var j = 0; j< 2; j++) {
                    for(var i = 0; i< 7; i++) {
                            if(j == 0) { this.shedule_am[i] = $('.form-control.am-from'+i+'').val() + '-' + $('.form-control.am-to'+i+'').val(); }
                            if(j == 1) { this.shedule_pm[i] = $('.form-control.pm-from'+i+'').val() + '-' + $('.form-control.pm-to'+i+'').val(); }
                    }
                    if(j == 0) { this.schedule_list.push(this.shedule_am); }
                    if(j == 1) { this.schedule_list.push(this.shedule_pm); }
                }


                    this.save_hospital_info.push({ hospital_info:this.hospital_info,hospital_info:this.hospital_info,facilities:this.facilities,
                    schedule_list:this.schedule_list,chek_feature:this.chek_feature, subjects:this.subjects, image:this.img_arr,video:this.video_arr
                });



                if(this.save_hospital_info.length > 0) {

                  console.log("this.save_hospital_info",this.save_hospital_info);

                    this.axios
                    .post(`/api/hospital/profile/${this.pro_id}`,this.save_hospital_info)
                    .then((response) => {

                        this.initialCall();

                        this.$swal({
                            position: 'top-end',
                            type: 'success',
                            title: '更新されました',
                            confirmButtonText: "閉じる",
                            confirmButtonColor: "#6cb2eb",
                            width: 250,
                            height: 200,
                        })
                        this.$loading(false);
                    }).catch(error=>{

                        this.$loading(false);
                        if(error.response.status == 422){
                            this.save_hospital_info = 'error';
                            this.errors = error.response.data.errors
                        }
                    }) ;
                }
            },
              isNumberOnly: function(event) {
              var input_data = $('#phone').val();
              var code = 0;
              code = input_data.charCodeAt();

              if((48 <= code && code <= 57) && (this.hospital_info.phone.length >= 10 && this.hospital_info.phone.length <= 14)){
                  this.ph_num = false;
                  this.ph_length = false;
              }else{
                  this.ph_num = true;
                  this.ph_length = true;
              }
            },
            focusPhone(){
              var input_data = $('#phone').val();
              console.log("input_data",input_data);
              console.log("input_data",input_data.length);
              if(input_data.length == 0 || (input_data.length >= 10 && input_data.length <= 14 && input_data.charAt(input_data.length - 1) != '-' && input_data.charAt(0) != '-'))
              {
                  this.ph_num = false;
                  this.ph_length = false;
              }
              else{
                  this.ph_num = true;
                  this.ph_length = true;
              }
            }
            },

        }

</script>
<style scoped>
.profile-logo{
    max-height: 120px;
    overflow: hidden;
}
.quill-editor{
    background-color: #fff;
}
 @media screen and (max-width:414px){
     .d-flex{
         display:  block !important;
     }
 }
</style>
