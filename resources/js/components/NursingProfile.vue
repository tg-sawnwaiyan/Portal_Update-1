<template>

    <div class="card profile m-t-22 " style="border:none;">
        <!-- <span style="position:fixed;right:50px;" class="btn secondary-bg-color all-btn" @click="createProfile()">作成</span> -->
        <form class="col-md-12 form-class">
            <div class="col-md-12 pad-free">
                <div class="col-md-12 m-lr-0 pad-free">
                    <div class="form-group form-group-wrapper">
                        <label class="heading-lbl col-2 pad-free">パノラマ<span class="error">*</span></label>
                        <input type="file" name="" class="nursing-panorama m-b-10"  id="upload_panorama" @change="preview_panorama()" multiple>

                        <div class="row col-md-12 pad-free panorama panorama-box">
                        <!-- <div > -->
                            <div class="col-sm-3 col-md-3 mt-2 gallery-area-panorama" v-bind:id="'x-panorama'+indx" v-for="(img,indx) in panorama_arr" :key="img.id">
                                <input type="hidden" class="already-panorama" v-model="img.photo">
                                <span class='img-close-btn' v-on:click="DeleteArr(indx,'panorama',img.id,img.photo)">X</span>
                                <img :src="'/upload/nursing_profile/Imagepanorama/'+ img.photo" class="img-fluid panorama-old-img" alt="profile" v-if="img.id!=null"  id="already-panorama">
                                <img :src="img.path" class="img-fluid panorama-new-img" alt="profile" v-if="img.id==null" id="already-panorama">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row col-md-12 text-center">
                        <label class="h_4 next-title"> Panorama</label>
                        <input type="file" name="" class="nursing-panorama m-b-10"  id="upload_panorama" @change="preview_panorama()" multiple>
                    </div>
                        -->

                </div>

                <button v-scroll-to="{ el: '#btn'}" id="btn_click" hidden></button>
                    <div class="form-group form-group-wrapper">
                            <label class="heading-lbl col-2 pad-free">施設名称<span class="error">*</span></label>
                            <input type="text" class="form-control customer-name col-10 float-right" id="btn" placeholder="施設名称を入力してください。" v-model="customer_info.name">
                    </div>
                    <div class="form-group form-group-wrapper">
                            <label class="heading-lbl col-2 pad-free">運営事業者</label>
                            <input type="text" class="form-control customer-name col-10 float-right" id="btn" v-model="nursing_info.operator" placeholder="運営事業者を入力してください。">
                    </div>
                    <div class="form-group form-group-wrapper">
                            <label class="heading-lbl col-2 pad-free">メールアドレス<span class="error">*</span></label>
                            <label class=" col-10 float-right customer-email"> {{customer_info.email}} </label>
                    </div>
                    <div class="form-group form-group-wrapper d-flex">
                            <label class="heading-lbl col-2 pad-free">電話番号<span class="error">*</span></label>
                            <div class="col-10 row">
                            <input type="text" class="form-control customer-phone col-12" id="phone" placeholder="電話番号を入力してください。" v-model="customer_info.phone" v-on:keyup="isNumberOnly" pattern="[0-9-]*" @focusout="focusPhone" title="Please enter number only." maxlength="14">
                            <span class="error" v-if="ph_length || ph_num">※電話番号が正しくありません。もう一度入力してください。</span>    
                            <span class="error" v-else></span>                        
                            </div>
                    </div>
                    <div class="form-group form-group-wrapper">
                            <label class="heading-lbl col-2 pad-free">公式サイト</label>
                            <input type="text" name="official-website" class="form-control website col-10 float-right" v-model="nursing_info.website">
                    </div>
                    <div class="form-group form-group-wrapper">
                            <label class="heading-lbl col-2 pad-free">フォトアルバム</label>
                            
                                    <span class="galleryadd btn all-btn main-bg-color float-right" style="min-width: 0px;" @click="galleryAdd()">
                                    <i class="fas fa-plus-circle"></i> 追加</span>
                                    <span class='changeGalleryLink btn btn all-btn main-bg-color ' style="min-width: 0px;" @click="galleryToggle" >
                                        <i id="gallery" class="fas fa-sort-down"></i>
                                   </span>
                            <div id="changeGalleryLink"  class="col-md-12">
                                    <div class="row" id ="gallery-photo"> 
                                            <div class="col-md-6 gallery-area-photo" v-bind:id="'photo'+indx" v-for="(img,indx) in img_arr" :key="img.id">
                                                    <div class="col-md-12">
                                                            <input type="file" name="" class="nursing-photo m-b-10" v-bind:class="img.classname" id="upload_img" @change="preview_image($event,indx)">
                                                            <div class="col-md-12 m-b-10" v-bind:class="img.id">
                                                                    <input type="hidden" class="already-photo" v-model="img.photo">
                                                                    <img v-bind:src="'/upload/nursing_profile/'+ img.photo" class="img-fluid nursing-image" alt="profile" v-if="img.id != null" @error="imgUrlAlt">
                                                                    <div v-bind:id="'already-photo'+indx" v-else> </div>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="m-t-10">タイトル:</label>
                                                        <input type="text" name="title" placeholder="タイトル" class="form-control m-b-15 title white-bg-color" v-model="img.title">
                                                        <label>コンテンツ:</label>
                                                        <textarea name="description" placeholder="コンテンツ" class="form-control m-b-15 description white-bg-color" v-model="img.description"></textarea>
                                                    </div>
                                                    <div class="col-md-12 text-right">
                                                            <a class="mr-auto text-danger btn delete-borderbtn" @click="DeleteArr(indx,'photo',img.id,img.photo)"> <i class="fa fa-trash"></i> 削除</a>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>

                    <div class="form-group form-group-wrapper">
                            <label class="heading-lbl col-2 pad-free">動画</label> <span class="galleryvideo btn all-btn main-bg-color float-right" style="min-width: 0px;" @click="galleryVideoAdd()">
                                    <i class="fas fa-plus-circle"></i> 追加</span>
                                    <span class='changeGalleryVideoLink  btn btn all-btn main-bg-color ' style="min-width: 0px;" @click="galleryVideoToggle" >
                                        <i id="video" class="fas fa-sort-down"></i>
                                   </span>
                            <div id="changeGalleryVideoLink" class="col-md-12">
                                    <div class="row" id="gallery-video">
                                            <div class="col-md-6 gallery-area-video" v-bind:id="'video'+indx" v-for="(video,indx) in video_arr" :key="video.id">
                                                <div class="col-md-12">
                                                    <label>URL:</label>
                                                    <input type="text" name="url" placeholder="url" class="form-control m-b-15 video-url white-bg-color" v-model="video.photo">
                                                </div>
                                                <div class="col-md-12">
                                                    <label>タイトル:</label>
                                                    <input type="text" name="title" placeholder="タイトル" class="form-control m-b-15 title white-bg-color" v-model="video.title">
                                                    <label>コンテンツ:</label>
                                                    <textarea name="description" placeholder="コンテンツ" class="form-control m-b-15 description white-bg-color" v-model="video.description"></textarea>
                                                </div>
                                                <div class="col-md-12 text-right">
                                                <a class="mr-auto text-danger btn delete-borderbtn" @click="DeleteArr(indx,'video',video.id,video.photo)"> <i class="fa fa-trash"></i> 削除</a>
                                                </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
                <table class="table table-bordered table-wrapper">
                        <tr>
                                <td class="width17" style="border:none;"> <label class="heading-lbl pad-free">特長<span class="error">*</span></label></td>
                                <td style="border:none;">
                                        <!-- <textarea name="feature" id="" cols="30" rows="10" ></textarea> -->
                                        <quill-editor  ref="myQuilEditor" name="feature" class="feature" v-model="nursing_info.feature" @change="onFeatureEditorChange($event)" :options="editorOption" @blur="onEditorBlur($event)" @focus="onEditorFocus($event)"/>

                                </td>
                        </tr>

                </table>

                <!--table 1 for 費用-->
                <table class="table table-bordered table-wrapper">
                    <tr>
                        <td style="border:none;">
                            <div class="form-group">
                                <label class="heading-lbl" style="border-left: 5px solid #f9793c;padding-left: 5px;">費用</label>
                            </div>
                            <div class="form-group">
                                <label class="heading-lbl col-2 pad-free">入居時費用 <span class="error">*</span></label>
                                <div class="col-10 float-right pad-free">
                                    <div class="row">
                                        <div class="col-md-6" style="font-weight:bold;font-size:1.5em;">
                                            <input type="text"  class="form-control col-10 nursing-moving-in-f float-left white-bg-color m-r-10" v-model="nursing_info.moving_in_from"> 円
                                        </div>

                                        <div class="col-md-6" style="font-weight:bold;font-size:1.5em;">
                                            <input type="text"  class="form-control col-10 nursing-moving-in-t float-left white-bg-color m-r-10" v-model="nursing_info.moving_in_to"> 円
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="heading-lbl col-2 pad-free">月額費用 <span class="error">*</span></label>
                                <div class="col-10 float-right pad-free">
                                    <div class="row">
                                        <div class="col-md-6" style="font-weight:bold;font-size:1.5em;">
                                            <input type="text"  class="form-control col-10 nursing-per-month-f float-left white-bg-color m-r-10" v-model="nursing_info.per_month_from"> 円
                                        </div>

                                        <div class="col-md-6" style="font-weight:bold;font-size:1.5em;">
                                            <input type="text"  class="form-control col-10 nursing-per-month-t float-left white-bg-color m-r-10" v-model="nursing_info.per_month_to"> 円
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="heading-lbl col-2 pad-free">支払い方法 <span class="error">*</span></label>
                                <div class="col-10 float-right pad-free">
                                    <input type="text"  class="form-control col-10 nursing-payment-method float-left white-bg-color" v-model="nursing_info.method">
                                    <div class="col-2 float-right">
                                        <span class="btn all-btn main-bg-color" style="min-width: 0px;" @click="methodAdd()"><i class="fas fa-plus-circle"></i> 追加</span>
                                    </div>
                                    <div class="col-md-12 pad-free m-t-50" id="gallery-payment">
                                        <!-- test -->
                                        <div class="pad-free col-md-12 gallery-area-payment" v-bind:id="'payment'+indx" v-for="(payment,indx) in payment_arr" :key="payment.id">
                                            <div class="col-md-12 m-t-15 m-b-15">
                                                <table class="table">
                                                    <tr>

                                                    <td colspan="2" class="text-right" style="border:none;!important">
                                                        <span :class="'btn btn all-btn main-bg-color changeLink'+indx" style="min-width: 0px;" @click="paymentToggle(indx)" >
                                                            <i :id="'icon' + indx" class="fas fa-sort-down"></i>
                                                        </span>
                                                        <a class="mr-auto text-danger btn delete-borderbtn" @click="DeltArr(indx,'payment')">
                                                        <i class="fa fa-trash"></i> 削除</a>
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                    <th>
                                                        <label class="title-lbl">タイプ名</label>
                                                    </th>
                                                    <th>
                                                        <input type="text" name="method[]" class="form-control payment-name white-bg-color" v-model="payment.payment_name">
                                                    </th>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-12 " :id="'changeLink' + indx" >
                                                <div class="col-md-12">
                                                        <h3 class="title-lbl">料金概要</h3>
                                                        <table class="table">
                                                        <tr>
                                                        <th>入居時にかかる費用</th>
                                                        <th>
                                                                <input type="text" name="exp[]" class="form-control expense-moving white-bg-color" v-model="payment.expense_moving">
                                                        </th>
                                                        </tr>
                                                        <tr>
                                                        <th>居室タイプ</th>
                                                        <th>
                                                                <input type="text" name="exp[]" class="form-control living-room-type white-bg-color" v-model="payment.living_room_type">
                                                        </th>
                                                        </tr>
                                                        <tr>
                                                        <th>月額利用料</th>
                                                        <th>
                                                                <input type="text" name="exp[]" class="form-control monthly-fees white-bg-color" v-model="payment.monthly_fees">
                                                        </th>
                                                        </tr>
                                                        <tr>
                                                        <th>広さ</th>
                                                        <th>
                                                                <input type="text" name="exp[]" class="form-control area white-bg-color" v-model="payment.area">
                                                        </th>
                                                        </tr>
                                                        </table>
                                                </div>
                                                <div class="col-md-12">
                                                        <h3 class="title-lbl">料金詳細</h3>
                                                        <table class="table">
                                                        <tr>
                                                        <th class="title-lbl">
                                                                <span>入居にかかる費用</span>
                                                        </th>
                                                        <th>&nbsp;</th>
                                                        </tr>
                                                        <tr>
                                                        <th>入居一時金または敷金</th>
                                                        <th>
                                                                <input type="text" name="breakdown[]" class="form-control deposit white-bg-color" v-model="payment.deposit">
                                                        </th>
                                                        </tr>
                                                        <tr>
                                                        <th>その他（使途）</th>
                                                        <th>
                                                                <input type="text" name="breakdown[]" class="form-control other-use white-bg-color" v-model="payment.other_use">
                                                        </th>
                                                        </tr>
                                                        <tr>
                                                        <th class="title-lbl"><span>月額費用</span></th><th>&nbsp;</th>
                                                        </tr>
                                                        <tr>
                                                        <th>賃料</th>
                                                        <th>
                                                                <input type="text" name="breakdown[]" class="form-control rent white-bg-color" v-model="payment.rent">
                                                        </th>
                                                        </tr>
                                                        <tr>
                                                        <th>管理費</th>
                                                        <th>
                                                                <input type="text" name="breakdown[]" class="form-control admin-expense white-bg-color" v-model="payment.admin_expense">
                                                        </th>
                                                        </tr>
                                                        <tr>
                                                        <th>食費</th>
                                                        <th>
                                                                <input type="text" name="breakdown[]" class="form-control food-expense white-bg-color" v-model="payment.food_expense">
                                                        </th>
                                                        </tr>
                                                        <tr>
                                                        <th>介護上乗せ金（生活サービス費）</th>
                                                        <th>
                                                                <input type="text" name="breakdown[]" class="form-control nurse-care-surcharge white-bg-color" v-model="payment.nurse_care_surcharge">
                                                        </th>
                                                        </tr>
                                                        <tr>
                                                        <th>その他</th>
                                                        <th>
                                                                <input type="text" name="breakdown[]" class="form-control other-monthly-cost white-bg-color" v-model="payment.other_monthly_cost">
                                                        </th>
                                                        </tr>
                                                        <tr>
                                                        <th class="title-lbl"><span>返還金について</span></th>
                                                        <th>&nbsp;</th>
                                                        </tr>
                                                        <tr>
                                                        <th>返還制度</th>
                                                        <th>
                                                                <input type="text" name="breakdown[]" class="form-control refund-system white-bg-color" v-model="payment.refund_system">
                                                        </th>
                                                        </tr>
                                                        <tr>
                                                        <th>償却期間</th>
                                                        <th>
                                                                <input type="text" name="breakdown[]" class="form-control depreciation-period white-bg-color" v-model="payment.depreciation_period">
                                                        </th>
                                                        </tr>
                                                        <tr>
                                                        <th>初期償却</th>
                                                        <th>
                                                                <input type="text" name="breakdown[]" class="form-control initial-deprecration white-bg-color" v-model="payment.initial_deprecration">
                                                        </th>
                                                        </tr>
                                                        <tr>
                                                        <th>その他メッセージ</th>
                                                        <th>
                                                                <input type="text" name="breakdown[]" class="form-control other-message-refund white-bg-color" v-model="payment.other_message_refund">
                                                        </th>
                                                        </tr>
                                                        </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <!-- end table 1 for 費用--->

                <!--table 2 for 施設の概要-->
                <table class="table table-bordered table-wrapper">
                    <tr>
                        <td style="border:none;">
                            <label class="heading-lbl col-2 pad-free">施設の概要</label>
                            <span class="btn all-btn main-bg-color"  style="min-width: 0px;" @click="nurseFacToggleDiv()"><i class="fas fa-sort-down animate"  :class="{'rotate': isRotate1}"></i></span>
                            <!-- testtest -->
                            <div class="col-10 pad-free float-right nurse-fac-toggle-div toggle-div m-t-10">
                                    <table class="table table-striped table-bordered">
                                            <tr>
                                                    <td class="width15 title-bg">事業主体</td>
                                                    <td ><textarea class="form-control white-bg-color business-entity" :options="editorOption" v-model="nursing_info.business_entity"></textarea></td>
                                                        <!-- <td> <quill-editor class="business-entity" ref="myQuilEditor" :options="editorOption" v-model="nursing_info.business_entity"/></td> -->

                                            </tr>
                                            <tr>
                                                    <td class="width15 title-bg">開設年月日</td>

                                                    <td >
                                                        <date-picker class="box date-of-establishment" :lang="lang" v-model="nursing_info.date_of_establishment" id="datepickerbox" valueType="format" style="margin-left:11px;"></date-picker>
                                                        <!-- <textarea class="form-control white-bg-color date-of-establishment" :options="editorOption" v-model="nursing_info.date_of_establishment"></textarea> -->
                                                    </td>
                                                        <!-- <td> <quill-editor  class="date-of-establishment" ref="myQuilEditor" :options="editorOption" v-model="nursing_info.date_of_establishment"/></td> -->
                                            </tr>
                                            <tr>
                                                    <td class="width15 title-bg">土地の権利形態</td>
                                                    <td ><textarea class="form-control white-bg-color land-right-form" :options="editorOption" v-model="nursing_info.land_right_form"></textarea></td>
                                                        <!-- <td> <quill-editor  class="land-right-form" ref="myQuilEditor" :options="editorOption" v-model="nursing_info.land_right_form"/></td> -->
                                            </tr>
                                            <tr>
                                                    <td class="width15 title-bg">建物の権利形態</td>
                                                    <td ><textarea class="form-control white-bg-color building-right-form" :options="editorOption" v-model="nursing_info.building_right_form"></textarea></td>
                                                        <!-- <td> <quill-editor  class="building-right-form" ref="myQuilEditor" :options="editorOption" v-model="nursing_info.building_right_form"/></td> -->
                                            </tr>
                                            <tr>
                                                    <td class="width15 title-bg">敷地面積</td>
                                                    <td ><textarea class="form-control white-bg-color site-area" :options="editorOption" v-model="nursing_info.site_area"></textarea></td>
                                                        <!-- <td> <quill-editor  class="site-area" ref="myQuilEditor" :options="editorOption" v-model="nursing_info.site_area"/></td> -->
                                            </tr>
                                            <tr>
                                                    <td class="width15 title-bg">延床面積</td>
                                                    <td ><textarea class="form-control white-bg-color floor-area" :options="editorOption" v-model="nursing_info.floor_area"></textarea></td>
                                                        <!-- <td> <quill-editor  class="floor-area" ref="myQuilEditor" :options="editorOption" v-model="nursing_info.floor_area"/></td> -->
                                            </tr>
                                            <tr>
                                                    <td class="width15 title-bg">構造</td>
                                                    <td ><textarea class="form-control white-bg-color construction" :options="editorOption" v-model="nursing_info.construction"></textarea></td>
                                                    <!-- <td > <quill-editor  class="construction" ref="myQuilEditor" :options="editorOption" v-model="nursing_info.construction"/></td> -->
                                            </tr>
                                            <tr>
                                                    <td class="width15 title-bg">定員</td>
                                                    <td ><textarea class="form-control white-bg-color capacity" :options="editorOption" v-model="nursing_info.capacity"></textarea></td>
                                                        <!-- <td > <quill-editor  class="capacity" ref="myQuilEditor" :options="editorOption" v-model="nursing_info.capacity"/></td> -->
                                            </tr>
                                            <tr>
                                                    <td class="width15 title-bg">総居室・戸数</td>
                                                    <td ><textarea class="form-control white-bg-color num-rooms" :options="editorOption" v-model="nursing_info.num_rooms"></textarea></td>
                                                        <!-- <td > <quill-editor  class="num-rooms" ref="myQuilEditor" :options="editorOption" v-model="nursing_info.num_rooms"/></td> -->
                                            </tr>
                                            <tr>
                                                    <td class="width15 title-bg">居住の権利形態</td>
                                                    <!-- <td ><textarea class="form-control white-bg-color residence-form" :options="editorOption" v-model="nursing_info.residence_form"></textarea></td> -->
                                                        <td > <quill-editor  class="residence-form" ref="myQuilEditor" @change="onResidenceEditorChange($event)" :options="editorOption" v-model="nursing_info.residence_form"/></td>
                                            </tr>
                                            <tr>
                                                    <td class="width15 title-bg">類型</td>
                                                    <td>
                                                        <select class="form-control white-bg-color fac-type">
                                                            <option>施設タイプを選択</option>
                                                            <option v-for="fac in fac_types" :key="fac.id" v-bind:value="fac.id" :selected="fac.id == nursing_info.fac_type">{{ fac.description }}</option>
                                                        </select>
                                                    </td>
                                                    <!-- <td ><textarea class="form-control white-bg-color fac-type" :options="editorOption" v-model="nursing_info.fac_type"></textarea></td> -->
                                                        <!-- <td > <quill-editor  class="fac-type" ref="myQuilEditor" :options="editorOption" v-model="nursing_info.fac_type"/></td> -->
                                            </tr>
                                            <tr>
                                                    <td class="width15 title-bg">入居条件</td>
                                                    <td ><textarea class="form-control white-bg-color occupancy-condition" :options="editorOption" v-model="nursing_info.occupancy_condition"></textarea></td>
                                                        <!-- <td > <quill-editor  class="occupancy-condition" ref="myQuilEditor" :options="editorOption" v-model="nursing_info.occupancy_condition"/></td> -->
                                            </tr>
                                            <tr>
                                                    <td class="width15 title-bg">居室区分・間取り等</td>
                                                    <td><textarea class="form-control white-bg-color room-floor" :options="editorOption"  v-model="nursing_info.room_floor"></textarea></td>
                                                        <!-- <td > <quill-editor  class="room-floor" ref="myQuilEditor" :options="editorOption"  v-model="nursing_info.room_floor"/></td> -->
                                            </tr>
                                            <tr>
                                                    <td class="width15 title-bg">居室設備</td>
                                                    <td ><textarea class="form-control white-bg-color living-room-facilities" :options="editorOption" v-model="nursing_info.living_room_facilities"></textarea></td>

                                                        <!-- <td > <quill-editor  class="equipment" ref="myQuilEditor" :options="editorOption" v-model="nursing_info.equipment"/></td> -->
                                            </tr>
                                            <tr>
                                                    <td class="width15 title-bg">共用施設・設備</td>
                                                    <td ><textarea class="form-control white-bg-color equipment" :options="editorOption" v-model="nursing_info.equipment"></textarea></td>
                                                        <!-- <td > <quill-editor  class="living-room-facilities" ref="myQuilEditor" :options="editorOption" v-model="nursing_info.living_room_facilities"/></td> -->
                                            </tr>
                                    </table>
                            </div>
                        </td>
                    </tr>
                </table>
                <!-- end table 2 for 施設の概要 -->

                <!-- table 3 for 協力医療機関 -->
                <table class="table table-bordered table-wrapper">
                    <tr>
                        <td style="border:none;">
                            <div class="form-group">
                                <label class="heading-lbl col-2 pad-free">協力医療機関 <span class="error">*</span></label>
                                <div class="col-10 pad-free float-right ">
                                    <span class="btn all-btn main-bg-color" style="min-width: 0px;" @click="cooperateAdd()">
                                            <i class="fas fa-plus-circle"></i> 追加</span>

                                    <div class="col-md-12 pad-free" id="gallery-cooperate">
                                        <!-- cooperation -->
                                        <div class="col-md-12 m-t-30 m-b-20 gallery-area-cooperate" v-bind:id="'cooperate'+indx" v-for="(cooperate,indx) in cooperate_arr" :key="cooperate.id">

                                            <div class="clearfix" style="margin-bottom:30px;text-align:right">                                               
                                                <span :class="'btn all-btn main-bg-color cooperateChangeLink'+indx" style="min-width: 0px;" @click="cooperateToggle(indx)" >
                                                        <i :id="'cooperatetogg' + indx" class="fas fa-sort-down"></i>
                                                </span>
                                                 <a class="mr-auto text-danger btn delete-borderbtn" @click="DeltArr(indx,'cooperate')"> 
                                                <i class="fa fa-trash"></i> 削除</a>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-2 pad-free">名前 :</label>
                                                <input type="text" class="form-control col-10 float-right cooperate-name white-bg-color" name="co-medical-header[]" v-model="cooperate.name">
                                            </div>
                                              <div :id="'cooperateChangeLink' + indx">
                                            <table class="table table-bordered">
                                            <tr>
                                                <th class="width15 title-bg">診療科目</th>
                                                <th ><textarea class="form-control clinical-sub white-bg-color" name="clinical-sub" v-model="cooperate.clinical_subject"></textarea></th>
                                            </tr>
                                            <tr>
                                                <th class="width15 title-bg">協力内容</th>
                                                <th><textarea class="form-control details white-bg-color" name="details" v-model="cooperate.details"></textarea></th>
                                            </tr>
                                            <tr>
                                                <th class="width15 title-bg">診療費用</th>
                                                <th><textarea class="form-control expense white-bg-color" name="expense" v-model="cooperate.medical_expense"></textarea></th>
                                            </tr>
                                            <tr>
                                                <th class="width15 title-bg">備考</th>
                                                <th><textarea class="form-control remark white-bg-color" name="remark" v-model="cooperate.remark"></textarea></th>
                                            </tr>
                                            </table>
                                           
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <!-- end table 3 for 協力医療機関 -->

                <!-- table 4 for 医療面の受入れ  -->
                <table class="table table-bordered table-wrapper">
                    <tr>
                        <td>
                            <div class="form-group">
                                <label class="heading-lbl col-2 pad-free">医療面の受入れ</label>
                                <span class="btn all-btn main-bg-color" style="min-width: 0px;" @click="acceptanceList()"><i class="fas fa-sort-down animate" :class="{'rotate': isRotate2}"></i></span>
                                <div class="col-md-10 float-right m-t-10 accept-toggle-div toggle-div pad-free">
                                    <label for="" class="m-r-15"><i class="fas fa-check green"></i> 受入れ可</label>
                                    <label for="" class="m-r-15"><i class="fas fa-times red"></i> 受入れ不可</label>
                                    <label for="" class="m-r-15"><i class="fas fa-adjust blue"></i> 応相談</label>
                                    <div class="row">
                                        <div class="col-md-6" v-for="medical in medical_acceptance" :key="medical.id">
                                            <div class="col-md-12 accept-box">
                                                {{medical.name}} {{medical.id}}
                                                <div class="float-right">
                                                    <label ><input type="radio"  class="medical-acceptance custom-radio" :name="'medical'+medical.id" :checked="medical.accept_checked" v-bind:value="'accept-'+medical.id"> <i class="fas fa-check green"></i></label>
                                                    <label ><input type="radio" class="medical-acceptance custom-radio " :name="'medical'+medical.id" :checked="medical.unaccept_checked" v-bind:value="'unaccept-'+medical.id"> <i class="fas fa-times red"></i></label>
                                                    <label ><input type="radio" class="medical-acceptance custom-radio" :name="'medical'+medical.id" :checked="medical.negotiate_checked" v-bind:value="'negotiate-'+medical.id"> <i class="fas fa-adjust blue"></i></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                            <label for="">備考</label>
                                            <!-- <textarea name="" class="form-control"></textarea> -->
                                            <quill-editor  ref="myQuilEditor" :options="editorOption" @change="onAcceptanceEditorChange($event)" name="" class="acceptance-remark" v-model="nursing_info.acceptance_remark"/>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>

                <!-- end table 4 for 医療面の受入れ -->

                <!-- table 5 for 職員体制 -->
                <table class="table table-bordered table-wrapper">
                    <tr>
                        <td>
                            <label class="heading-lbl col-2 pad-free">職員体制</label>
                            <span class="btn all-btn main-bg-color" style="min-width: 0px;" @click="staffToggleDiv()"><i class="fas fa-sort-down animate" :class="{'rotate': isRotate3}"></i></span>

                            <div class="col-10 pad-free float-right staff-toggle-div toggle-div m-t-10">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <td class="width15 title-bg">介護に関わる職員体制（入居者：職員）</td>
                                        <td><textarea class="form-control staff white-bg-color" :options="editorOption" v-model="staff_info.staff"></textarea></td>
                                        <!-- <td><quill-editor  ref="myQuilEditor" class="staff" :options="editorOption" v-model="staff_info.staff"/></td>                                                       -->
                                    </tr>
                                    <tr>
                                        <td class="width15 title-bg">介護職員</td>
                                        <td><textarea class="form-control nursing-staff white-bg-color" :options="editorOption" v-model="staff_info.nursing_staff"></textarea></td>
                                            <!-- <td><quill-editor  ref="myQuilEditor" class="nursing-staff" :options="editorOption" v-model="staff_info.nursing_staff"/></td> -->
                                    </tr>
                                    <tr>
                                        <td class="width15 title-bg">夜間の最少職員数</td>
                                        <td><textarea class="form-control min-num-staff white-bg-color" :options="editorOption" v-model="staff_info.min_num_staff"></textarea></td>
                                            <!-- <td><quill-editor  ref="myQuilEditor" class="min-num-staff" :options="editorOption" v-model="staff_info.min_num_staff"/></td>                                                        -->
                                    </tr>
                                    <tr>
                                        <td class="width15 title-bg">看護職員数</td>
                                        <td><textarea class="form-control num-staff white-bg-color" :options="editorOption" v-model="staff_info.num_staff"></textarea></td>
                                        <!-- <td><quill-editor  ref="myQuilEditor" class="num-staff" :options="editorOption" v-model="staff_info.num_staff"/></td> -->
                                    </tr>
                                    <tr>
                                        <td class="width15 title-bg">
                                            <label for="">備考</label>
                                        </td>
                                        <td>
                                            <quill-editor  ref="myQuilEditor" name="" :options="editorOption" @change="onNursingEditorChange($event)" class="nursing-remarks" v-model="staff_info.remarks"/>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
                <!-- end table 5 for 職員体制 -->

                <!-- table 6 for こだわりの特長  -->
                <table class="table table-bordered table-wrapper">
                    <tr>
                        <td>
                            <div class="form-group">
                                <label  class="heading-lbl col-2 pad-free">こだわりの特長</label>
                                <span class="btn all-btn main-bg-color" style="min-width: 0px;" @click="specialFeAdd()"><i class="fas fa-sort-down animate" :class="{'rotate': isRotate4}"></i></span>

                                <div class="col-md-10 float-right special-feature-toggle-div toggle-div m-t-10">
                                    <div class="row">
                                        <div v-for="feat in feature_list" :key="feat.id" class="form-check form-check-inline col-sm-3">
                                            <label  class="form-check-label control control--checkbox" style="padding-left:5px;">
                                                <input type="checkbox" class="form-check-input"  name="special-features" v-bind:value="feat.id" @click="stationCheck(feat.id)" v-model="feat.checked">
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

                <!-- end table 6 for こだわりの特長  -->

                <!-- table 7 for 公式サイト -->
                <table class="table table-bordered table-wrapper">
                    <tr>
                        <td>
                            <label class="heading-lbl col-2 pad-free">地図</label>
                            <span class="btn all-btn main-bg-color" style="min-width: 0px;" @click="maptogglediv()"><i class="fas fa-sort-down animate" :class="{'rotate': isRotate5}"></i></span>
                            <div class="col-md-10 float-right m-t-10 map-toggle-div toggle-div pad-free">
                                <div class="col-md-12">
                                    <div class="col-md-12 pad-free" id="mapbox">
                                        <GoogleMap :address="customer_info.address" :township="customer_info.townships_id" :city="city_id" :township_list="township_list" :lat_num='nursing_info.latitude' :lng_num='nursing_info.longitude'></GoogleMap>
                                    </div>
                                    
                                    <!-- <GoogleMap :address="customer_info.address" :lat_num='35.6803997' :lng_num='139.76901739' v-if="nursing_info.latitude == 0"></GoogleMap> -->
                                    <!-- <div class="form-group">
                                            <label>住所<span class="error">*</span></label>
                                            <quill-editor  ref="myQuilEditor"  name="address" :options="editorOption" @change="onCustomerAddressChange($event)" class="customer-address" v-model="customer_info.address"/>
                                    </div> -->

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
                                                                                                    <input type="checkbox"  name="station" v-bind:value="stat.station_id" @click="featureCheck(stat.station_id)" v-model="stat.checked">
                                                                                                    {{stat.station_name}}
                                                                                            </label>
                                                                                    </div>
                                                                            </div>
                                                                    </div>
                                                            </div>
                                                    </td>
                                            </tr>
                                    </table> -->
                                    <!-- End Test Station Area -->

                                    <div class="form-group">
                                            <label>交通 / アクセス<span class="error">*</span></label>
                                            <!-- <textarea name="address" rows="10" class="form-control"></textarea> -->
                                            <quill-editor  ref="myQuilEditor" name="address" :options="editorOption" class="transporation-access" @change="onAccessEditorChange($event)" v-model="nursing_info.access"/>
                                    </div>

                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <!-- end table 7 for 公式サイト -->
                <div style="position:fixed;width:100%;background:rgba(0,0,0,.5);left:0;right:0;bottom:0;padding:0 0 10px 0;">
                    <div class="row col-2 col-offset-5 mx-auto">
                        <span class="btn secondary-bg-color col-8 offset-2 all-btn m-t-15 pad-10" @click="createProfile()" id="create-profile">更新</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>

import 'quill/dist/quill.snow.css'
import {quillEditor} from 'vue-quill-editor'
import {Button, Input,Select} from 'iview'
import GoogleMap from './GoogleMap.vue'
import DatePicker from 'vue2-datepicker';

export default {
        components: {
            GoogleMap,
            Button,
            Input,
            Select,
            quillEditor,
            DatePicker
        },

       data() {
            return {
                lang:{
                days: ['日', '月', '火', '水', '木', '金', '土'],
                months: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
                placeholder: {
                date: new Date().toISOString().slice(0,10),

                }
            },
                isRotate1: false,
                isRotate2: false,
                isRotate3: false,
                isRotate4: false,
                isRotate5: false,
                fac_list: [],
                feature_list:[],
                medical_acceptance:[],
                customer_info:[],customer_info_push:[], nursing_info:[], staff_info:[], staff_info_push:[],
                acceptance: [],

                img_arr:[],
                video_arr:[],
                panorama_arr:[], tmp_list:[],test:[],
                cooperate_arr:[], cooperate_list:[],
                payment_arr:[],payment_list:[],
                profile_type:'nursing',
                profile_arr:[], test:'',
                station_list:[],chek_feature : [], panorama_count:'0', fac_types:[],
                stations:[],

                // to delete
                count:-1, v_count: -1, c_count: -1, p_count: -1,
                type:'',
                title:[], v_title:[],
                description:[], v_description:[],
                img:[],
                sub:[], coop_details:[], expense:[],remark:[],
                method:[],move_in:[],room_type:[],monthly_usage:[],breadth:[],
                security_deposit:[],other_use:[], rent:[], management_fee:[],
                food_expense:[],life_service:[],cost_other:[],return_system:[],
                depreciation_period:[],initial_depreciation:[],other_message:[],
                cooperate_list:[], payment_list:[],meth_details:[],
                // end
                content: '',
                editorOption:{
                        debug:'info',
                        placeholder:'Type your post...',
                        readonly:true,
                        theme:'snow',
                }, 

                feature_val: '',
                acceptance_remark_val: '',
                nursing_remarks_val: '',
                residence_form_val: '',
                customer_address_val:'',
                // customer_address_val: '',
                access_val: '',
                panorama_length: 0,
                new_panorama_img: [],
                ph_length: false,
                ph_num: false,
                city_id: 0,
                township_list: []
            }
        },

        mounted() {
           document.getElementById('btn_click').click();
        },

        created(){

            if(this.type != undefined && this.cusid!= undefined){
                localStorage.setItem('cusType',this.type);
                localStorage.setItem('cusId',this.cusid);
            }

            this.type = localStorage.getItem('cusType');
            this.cusid = Number(localStorage.getItem('cusId'));

            this.initialCall();

        },

        methods: {
            initialCall(){
                this.axios
                .get('/api/customerinfo/'+this.cusid)
                .then(response=>{
                    this.customer_info = response.data; 
                    this.axios
                    .get('/api/nurscities/'+this.customer_info.townships_id)
                    .then(response=>{
                        this.city_id = Number(response.data[0].city_id); 
                        this.township_list = response.data[0].township_list;
                    });
                });            
                this.axios
                .get('/api/nursinginfo/'+this.cusid)
                .then(response=>{
                    this.nursing_info = response.data;

                    if(this.nursing_info.latitude == 0){
                        localStorage.setItem('lat_num',35.6803997);
                        localStorage.setItem('lng_num',139.76901739);
                    }
                    else{
                        localStorage.setItem('lat_num',this.nursing_info.latitude);
                        localStorage.setItem('lng_num',this.nursing_info.longitude);
                    }

                });

                this.axios
                .get('/api/staffinfo/'+this.cusid)
                .then(response=>{
                    this.staff_info = response.data;
                });

                this.axios
                .get('/api/facilities')
                .then(response=>{
                    this.fac_list = response.data;
                });

                this.axios
                .get('/api/facility_types')
                .then(response=>{
                    this.fac_types = response.data;
                });

                this.axios
                .get('/api/medical/acceptancewithtransactions/'+this.cusid)
                .then(response => {
                    this.medical_acceptance = response.data;
                });

                this.axios
                .get('/api/feature/'+this.profile_type+'/'+this.cusid)
                .then(response=>{
                    this.feature_list = response.data;
                });

                this.axios
                .get('/api/nursing-pgallery/'+this.cusid)
                .then(response=>{
                    this.img_arr = response.data;
                });

                this.axios
                .get('/api/nursing-panorrama-gallery/'+this.cusid)
                .then(response=>{
                    this.panorama_arr = response.data;
                    this.panorama_length = this.panorama_arr.length;
                });

                this.axios
                .get('/api/nursing-vgallery/'+this.cusid)
                .then(response=>{
                    this.video_arr = response.data;
                });

                this.axios
                .get('/api/nursing-cooperate/'+this.cusid)
                .then(response=>{
                    this.cooperate_arr = response.data;
                });

                this.axios
                .get('/api/nursing-payment/'+this.cusid)
                .then(response=>{
                    this.payment_arr = response.data;
                });
                this.$loading(false);
            },
            focusPhone(){

              var input_data = $('#phone').val(); 
                
              if(input_data.length >= 10 && input_data.length <= 14 && input_data.charAt(input_data.length - 1) != '-' && input_data.charAt(0) != '-')
              {  
                  this.ph_num = false;
                  this.ph_length = false;
              }
              else{   
                  this.ph_num = true;
                  this.ph_length = true;
              }
            },
            imgUrlAlt(event) {
                event.target.src = "images/noimage.jpg"
            },

            onEditorBlur(quill) {
            
            },

            onEditorFocus(quill) {
            
            },

            maptogglediv() {
                $(".map-toggle-div").toggle('medium');
                this.isRotate5 = !this.isRotate5;
            },

            nurseFacToggleDiv() {
                $(".nurse-fac-toggle-div").toggle('medium');
                this.isRotate1 = !this.isRotate1;

            },

            staffToggleDiv() {
                $(".staff-toggle-div").toggle('medium');
                this.isRotate3 = !this.isRotate3;
            },

            featureCheck(check_id) {
                $('.feature-'+check_id).attr('checked','true');
            },
            stationCheck(check_id) {
                $('.station-'+check_id).attr('checked','true'); 
            },                
            preview_image(event,indx) {
                $('#already-photo'+indx).html("<img src='"+URL.createObjectURL(event.target.files[0])+"' class='img-fluid nursing-image'>");
                this.img_arr[indx]['photo'] = event.target.files[0].name;
            },

            preview_panorama() {
                for(var i=0; i< event.target.files.length; i++) {
                    var pathreal = URL.createObjectURL(event.target.files[i]);
                    this.panorama_arr.push({id:null,type:"panorama",photo:event.target.files[i].name,title:'',description:'', path:pathreal, file:event.target.files[i]});
                }              
            },

            closeBtnMethod: function(indx,id,photo) {
                if(confirm("Are you sure you want to delete?"))
                {
                    if(id) {
                        this.panorama_arr.splice(indx, 1);
                        let fd = new FormData();
                            fd.append('id',id);
                            fd.append('type','panorama');
                            fd.append('photo',photo);
                            fd.append('customer_id',this.cusid)

                            this.axios
                            .post('/api/delete-pgallery',fd)
                            .then(response=>{
                                // this.panorama_arr = response.data;
                            });
                    } else {
                        this.panorama_arr.splice(indx, 1);
                    }
                }
            },


            DeltArr(indx,type) {

                if(type == 'cooperate') {
                    this.cooperate_arr.splice(indx,1);
                }

                if(type == 'payment') {
                    this.payment_arr.splice(indx,1);
                }

                // var arr_list = [];
                // var arr_count = document.getElementsByClassName('gallery-area-'+type);
               
                //     for(var i=0; i< arr_count.length; i++) {
                //         arr_list[i] = document.getElementsByClassName('gallery-area-'+type);
                //     }

                //     for(var i=0; i<= arr_count.length; i++) {
                    
                //         if(i == indx) {
                        
                //             arr_list.splice(indx,1);
                        
                //             var ele = document.getElementById(type+indx);
                //             var parentEle = document.getElementById('gallery-'+type);
                //             parentEle.removeChild(ele);
                //         }
                //         else{
                //             arr_list.splice(indx,1);
                        
                //             var ele = document.getElementById(type+indx);
                //             var parentEle = document.getElementById('gallery-'+type);
                //             parentEle.removeChild(ele);
                //         }
                //     }
                

            },
            DeleteArr(indx,type,id,photo) {
                
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

                    if(type == 'photo' || type == 'panorama') {
                        if(id){                             
                            let fd = new FormData();
                            fd.append('id',id);
                            fd.append('type',type);
                            fd.append('photo',photo);
                            fd.append('customer_id',this.cusid)
                            fd.append('custype','nursing')
                            
                            if(type == 'photo'){
                                this.img_arr.splice(indx,1);
                            }
                            else{
                                this.panorama_arr.splice(indx, 1);
                            }

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
                                if(error.response.status == 422){
                                    this.errors = error.response.data.errors
                                }
                            })
                        } else {
                            if(type == 'photo'){
                                this.img_arr.splice(indx,1);
                            }
                            else{
                                this.panorama_arr.splice(indx, 1);
                            }
                        }
                    }

                    else if(type == 'video') {
                        this.video_arr.splice(indx,1);
                    }
                    
                    })
            },

            galleryAdd() {
                this.img_arr.push({id:null,photo:'',title:'',description:''});
            },

            galleryVideoAdd() {
                this.video_arr.push({id:null,photo:'',title:'',description:''});
            },

            methodAdd() {
                this.payment_arr.push({id:null,payment_name:'',expense_moving:'',monthly_fees:'',living_room_type:'', area:'',details:'',deposit:'',other_use:'',rent:'',
                admin_expense:'',food_expense:'', nurse_care_surcharge:'',other_monthly_cost:'',refund_system:'',depreciation_period:'', initial_deprecration:'',
                other_message_refund:''});
            },

            cooperateAdd() {
                this.cooperate_arr.push({id:null,name:'',clinical_subject:'',details:'',medical_expense:'',remark:''});
            },

            acceptanceList() {
                $(".accept-toggle-div").toggle('medium');
                this.isRotate2 = !this.isRotate2;
            },

            specialFeAdd() {
                $(".special-feature-toggle-div").toggle('medium');
                this.isRotate4 = !this.isRotate4;
            },
            StationAdd() {
                $(".station-toggle-div").toggle('medium');
                this.isRotate4 = !this.isRotate4;
            },
            onDrop: function(e) {
                e.stopPropagation();
                e.preventDefault();
                var files = e.dataTransfer.files;
                this.createFile(files[0]);
            },
            onChange(e) {
                var files = e.target.files;
                this.createFile(files[0]);
            },
            createFile(file) {
                if (!file.type.match('image.*')) {
                alert('Select an image');
                return;
                }
                var img = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = function(e) {
                vm.image = e.target.result;
                }
                reader.readAsDataURL(file);
            },
            removeFile() {
                this.image = '';
            },
            onFeatureEditorChange({ editor, html, text }) { 
                this.nursing_info['feature'] = html
            },
            onNursingEditorChange({ editor, html, text }) {
                this.staff_info['remarks'] = html
            },
            onAcceptanceEditorChange({ editor, html, text }) {
                this.nursing_info['acceptance_remark'] = html
            },
            onResidenceEditorChange({ editor, html, text }) {
                this.nursing_info['residence_form'] = html
            },
            onAccessEditorChange({ editor, html, text }) { 
                this.nursing_info['access'] = html
            },

            paymentToggle(id)
            {
                
                var class_by_id = $('#icon'+id).attr('class');
                if(class_by_id == "fas fa-sort-down animate rotate")
                {
                    $('#icon'+id).removeClass("fas fa-sort-down animate rotate");
                    $('.changeLink'+id).addClass("fas fa-sort-down");
                    $('#changeLink'+id).show('medium');
                }
                else {
                    $('#icon'+id).removeClass("fas fa-sort-down");
                    $('.changeLink'+id).removeClass("fas fa-sort-down");
                    $('#icon'+id).addClass("fas fa-sort-down animate rotate");
                    $('#changeLink'+id).hide('medium');
                }

            },
            cooperateToggle(id)
            {
               
                var class_by_id = $('#cooperatetogg'+id).attr('class');
                if(class_by_id == "fas fa-sort-down animate rotate")
                {
                    $('#cooperatetogg'+id).removeClass("fas fa-sort-down animate rotate");
                    $('.cooperateChangeLink'+id).addClass("fas fa-sort-down");
                    $('#cooperateChangeLink'+id).show('medium');
                }
                else {
                    $('#cooperatetogg'+id).removeClass("fas fa-sort-down");
                    $('.cooperateChangeLink'+id).removeClass("fas fa-sort-down");
                    $('#cooperatetogg'+id).addClass("fas fa-sort-down animate rotate");
                    $('#cooperateChangeLink'+id).hide('medium');
                }       

            },

            galleryToggle()
            {
                var class_by_id = $('#gallery').attr('class');

                if(class_by_id == "fas fa-sort-down animate rotate")
                {
                    $('#gallery').removeClass("fas fa-sort-down animate rotate");
                    $('.changeGalleryLink').addClass("fas fa-sort-down");
                    $('#changeGalleryLink').show('medium');
                    $('.galleryadd').show();
                }
                else {
                    $('#gallery').removeClass("fas fa-sort-down");
                    $('.changeGalleryLink').removeClass("fas fa-sort-down");
                    $('#gallery').addClass("fas fa-sort-down animate rotate");
                    $('#changeGalleryLink').hide('medium');
                    $('.galleryadd').show();
                    $('.galleryadd').hide();
                }
            },

            galleryVideoToggle()
            {
                var class_by_id = $('#video').attr('class');

                if(class_by_id == "fas fa-sort-down animate rotate")
                {
                    $('#video').removeClass("fas fa-sort-down animate rotate");
                    $('.changeGalleryVideoLink').addClass("fas fa-sort-down");
                    $('#changeGalleryVideoLink').show('medium');
                    $('.galleryvideo').show();
                }
                else {
                    $('#video').removeClass("fas fa-sort-down");
                    $('.changeGalleryVideoLink').removeClass("fas fa-sort-down");
                    $('#video').addClass("fas fa-sort-down animate rotate");
                    $('#changeGalleryVideoLink').hide('medium');
                    $('.galleryvideo').hide();
                }
            },            

            createProfile() {

                this.$loading(true);
                
                this.profile_arr = [];

                this.nursing_info.latitude = $('#new_lat').val();
                this.nursing_info.longitude = $('#new_long').val();
                this.customer_info.address = $('#address_val').val();
                
                this.customer_info.townships_id = Number($('#gmaptownship').val());
                localStorage.setItem('lat_num',this.nursing_info.latitude);
                localStorage.setItem('lng_num',this.nursing_info.longitude);

                // Photo 
                let pt = new FormData();               
                for(var i =this.img_arr.length-1;i>=0;i--)
                {
                    this.img_arr[i]['type'] = 'photo';
                    if(this.img_arr[i]['photo'] == null || this.img_arr[i]['photo'] == '')
                    {
                        this.img_arr.splice(i,1);
                    }
                
                    var img = document.getElementsByClassName('gallery-area-photo');
                    var file = img[i].getElementsByClassName('nursing-photo')[0].files[0];
                    if(file) {                             
                        pt.append(i ,file )  
                    }      
                }

                this.axios.post('/api/nursing/movephoto', pt)
                    .then(response => {
                    }).catch(error=>{
                        console.log(error);
                    if(error.response.status == 422){
                        this.errors = error.response.data.errors
                    }
                })

                // Video
                for(var i =this.video_arr.length-1;i>=0;i--){
                    if(this.video_arr[i].photo == null || this.video_arr[i].photo == '' )
                    {
                        this.video_arr.splice(i,1);
                    }   
                }

                // Cooperate
                for(var i =this.cooperate_arr.length-1;i>=0;i--){
                    if(this.cooperate_arr[i].name == null || this.cooperate_arr[i].name == '')
                    {
                        this.cooperate_arr.splice(i,1);
                    }   
                }

                // Payment Method
                for(var i =this.payment_arr.length-1;i>=0;i--){
                    if(this.payment_arr[i].payment_name == null || this.payment_arr[i].payment_name == '')
                    {
                        this.payment_arr.splice(i,1);
                    }   
                }

               var s_features =[];
                    $.each($("input[name='special-features']:checked"), function(){
                            s_features.push($(this).val());
                    });
                this.chek_feature.push({special_feature_id:s_features});


                var acceptance=[];
                $.each($("input:radio.medical-acceptance:checked"), function(){
                        var accept_val = $(this).val();
                        var tmp_arr = accept_val.split('-');
                        var type = tmp_arr[0];
                        var id = tmp_arr[1];
                        var type = tmp_arr[0];
                        var acceptance_id = tmp_arr[1];
                        acceptance.push({id:id,type:type});
                });
                
                // Panorama
                let fd = new FormData();
                for(var i = 0; i< this.panorama_arr.length; i++) {
                    if(this.panorama_arr[i]['path']!=''){ 
                        fd.append(i ,this.panorama_arr[i]["file"] )
                    }                   
                }
                    
                this.axios.post('/api/nursing/movepanorama', fd)
                    .then(response => {
                    }).catch(error=>{
                        console.log(error);
                        if(error.response.status == 422){
                            this.errors = error.response.data.errors
                        }
                    })

                this.profile_arr.push({nursing_profile:this.nursing_info,customer_info:this.customer_info,staff_info:this.staff_info, cooperate_list:this.cooperate_arr,
                                        payment_list:this.payment_arr, video:this.video_arr, image: this.img_arr, panorama: this.panorama_arr,
                                        acceptance:acceptance,chek_feature:this.chek_feature
                });
                
                if(this.profile_arr.length > 0) {
                    this.axios
                        .post(`/api/nursing/profile/${this.cusid}`,this.profile_arr)
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
                        }).catch(error=>{
                        this.$loading(false);
                        if(error.response.status == 422){
                        this.profile_arr = 'error';
                        this.errors = error.response.data.errors

                        }
                    }) ;
                } 
            },
            isNumberOnly: function(event) {
                var input_data = $('#phone').val();
                var code = 0;
                code = input_data.charCodeAt();
                if((48 <= code && code <= 57) && (this.customer_info.phone.length >= 10 && this.customer_info.phone.length <= 14)){
                    this.ph_num = false;
                    this.ph_length = false;
                }else{
                    this.ph_num = true;
                    this.ph_length = true;
                }
            }
        }
}

</script>

 <style>
  .quill-editor{
    background-color: #fff;
  }
  .panorama-box {
    padding: 10px 10px 20px 0px;
    margin: 0px;
    margin-bottom: 15px;
  }
 </style>
