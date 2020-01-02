<template>
<layout>
<div>
  <div class="col-md-12" style="border-bottom: 1px dashed #ff6117;padding-bottom: 10px; margin-bottom: 20px;">
     <h5 class="font-weight-bold"><i class="fas fa-map" style="color:#ff6117;"></i>&nbsp;地図検索</h5>
  </div>
  <div class="search-map card-body" @mouseover="getStateHover">
    <div class="row" id="hos">
      <div class="col-md-12">
        <div>
          <!-- <div class="info-box"></div> -->
          <!--start map-->
          <div class="row map-wrap">

          <!-- free word left wrapper--->
            <div class="col-lg-5 col-md-12 col-sm-12 float-left map-leftwrapper">
              <!-- <h2 class="map-header" style="bottom: 184px;">老人ホームや病院<br/>で働きたいあなた<br/>の希望叶えます。</h2> -->
              <h2 class="map-header" style="bottom: 120px;">あなたのやさしい<br/>手を求めてる老人<br/>ホーム・病院が見<br/>つかります。</h2>


              <!--search input-->
                <div class="wrap">
                  <div class="search">
                      <input type="text" class="searchTerm" id="search-free-word" placeholder="地名、施設名などを入力">
                      <button type="submit" class="searchButton" @click="searchfreeword">
                        <i class="fas fa-search"></i> 検索
                    </button>
                  </div>
                </div>
              <!--end search input-->
            </div>
          <!--end free word left wrapper-->

          <!--map right wrapper-->
          <div class="col-lg-7 col-sm-12 col-md-12 float-right">
              <div class="row divisions" id="divisionswrap">
                 <img src="/images/img_map1.png" alt="map" class="img-fluid" style="margin:0 auto;">
                <div class="col-sm-2 hokkaido-box">
                  <div class="mb-3">
                    <div class="division-box">
                      <ul class="hokkaido-wrap">
                        <a data-info="Hokkaido" class="path Hokkaido card-text" @click="getStateClick">
                            <li class="spanclass" id="1" @click="selected = 1" :class="{highlight:selected == 1}">北海道</li>
                        </a>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-sm-2 tohoku-box">
                  <div class="mb-3">
                    <div class="division-box">
                      <ul class="multiple-boxa">
                        <a data-info="Aomori" class="path Aomori card-text" @click="getStateClick" >
                            <li class="spanclass" id="2" @click="selected = 2" :class="{highlight:selected == 2}">青森</li>
                        </a>
                        <a data-info="Iwate" class="path Iwate card-text" @click="getStateClick">
                            <li class="spanclass" id="3" @click="selected = 3" :class="{highlight:selected == 3}" >岩手</li>
                        </a>
                        <a data-info="Akita" class="path Akita card-text" @click="getStateClick">
                            <li class="spanclass" id="5" @click="selected = 5" :class="{highlight:selected == 5}">秋田</li>
                        </a>

                        <a data-info="Miyagi" class="path Miyagi card-text" @click="getStateClick">
                            <li class="spanclass" id="4" @click="selected = 4" :class="{highlight:selected == 4}">宮城</li>
                        </a>

                        <a  data-info="Yamagata" class="path Yamagata card-text" @click="getStateClick">
                            <li class="spanclass" id="6" @click="selected = 6" :class="{highlight:selected == 6}">山形</li>
                        </a>
                        <a data-info="Fukushima" class="path Fukushima card-text" @click="getStateClick">
                            <li class="spanclass" id="7"  @click="selected = 7" :class="{highlight:selected == 7}">福島</li>
                        </a>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="col-sm-2 kanto-box">
                  <div class="mb-3">
                    <!-- <div class="card-header pad-10" style="background-color:#71d5cb">関東</div> -->
                    <div class="division-box">
                      <ul class="multiple-box">
                        <a data-info="Tokyo" class="path Tokyo card-text" @click="getStateClick">
                             <li class="spanclass" id="13" @click="selected = 13" :class="{highlight:selected == 13}" >東京</li>
                        </a>
                        <a data-info="Kanagawa" class="path Kanagawa card-text" @click="getStateClick">
                            <li class="spanclass" id="14" @click="selected = 14" :class="{highlight:selected == 14}">神奈川</li>
                        </a>

                        <a data-info="Saitama" class="path Saitama card-text" @click="getStateClick">
                            <li class="spanclass" id="11" @click="selected = 11" :class="{highlight:selected == 11}">埼玉</li>
                        </a>

                        <a data-info="Chiba" class="path Chiba card-text" @click="getStateClick">
                            <li class="spanclass" id="12" @click="selected = 12" :class="{highlight:selected == 12}">千葉</li>
                        </a>

                        <a data-info="Gunma" class="path Gunma card-text" @click="getStateClick">
                            <li class="spanclass" id="10" @click="selected = 10" :class="{highlight:selected == 10}">群馬</li>
                        </a>

                        <a data-info="Ibaraki" class="path Ibaraki card-text" @click="getStateClick">
                            <li class="spanclass" id="8" @click="selected = 8" :class="{highlight:selected == 8}" >茨城</li>
                        </a>
                        <a data-info="Tochigi" class="path Tochigi card-text" @click="getStateClick">
                              <li class="spanclass" id="9" @click="selected = 9" :class="{highlight:selected == 9}">栃木</li>
                        </a>

                        <a data-info="Yamanashi" class="path Yamanashi card-text" @click="getStateClick">
                            <li class="spanclass" id="19" @click="selected = 19" :class="{highlight:selected == 19}">山梨</li>
                        </a>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="col-sm-3 hokuriku-box">
                  <div class="mb-3">
                    <!-- <div class="card-header pad-10" style="background-color:#75b777">北陸</div> -->
                    <div class="division-box">
                      <ul class="">
                        <a data-info="Niigata" class="path Niigata card-text" @click="getStateClick">
                            <li class="spanclass" id="15" @click="selected = 15" :class="{highlight:selected == 15}"  >新潟</li>
                        </a>

                        <a data-info="Nagano" class="path Nagano card-text" @click="getStateClick">
                            <li class="spanclass" id="20" @click="selected = 20" :class="{highlight:selected == 20}" >長野</li>
                        </a>

                          <a data-info="Toyama" class="path Toyama card-text" @click="getStateClick">
                            <li class="spanclass" id="16" @click="selected = 16" :class="{highlight:selected == 16}">富山</li>
                        </a>

                        <a data-info="Ishikawa" class="path Ishikawa card-text" @click="getStateClick">
                            <li class="spanclass" id="17" @click="selected = 17" :class="{highlight:selected == 17}">石川</li>
                        </a>

                        <a data-info="Fukui" class="path Fukui card-text" @click="getStateClick">
                             <li class="spanclass" id="18" @click="selected = 18" :class="{highlight:selected == 18}">福井</li>
                        </a>

                      </ul>
                    </div>
                  </div>
                </div>

                <div class="col-sm-3 tokai-box">
                  <div class="mb-3">
                    <!-- <div class="card-header pad-10" style="background-color:#c0c743">東海甲信</div> -->
                    <div class="division-box">
                      <ul class="multiple-boxa">
                        <a data-info="Aichi" class="path Aichi card-text" @click="getStateClick">
                              <li class="spanclass" id="23" @click="selected = 23" :class="{highlight:selected == 23}">愛知</li>
                        </a>


                        <a data-info="Shizuoka" class="path Shizuoka card-text" @click="getStateClick">
                            <li class="spanclass" id="22" @click="selected = 22" :class="{highlight:selected == 22}">静岡</li>
                        </a>

                        <a id="21" data-info="Gifu" class="path Gifu card-text" @click="getStateClick">
                            <li class="spanclass" id="21" @click="selected = 21" :class="{highlight:selected == 21}">岐阜</li>
                        </a>

                        <a data-info="Mie" class="path Mie card-text" @click="getStateClick">
                             <li class="spanclass"  id="24" @click="selected = 24" :class="{highlight:selected == 24}">三重</li>
                        </a>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="col-sm-4 kinki-box">
                  <div class="mb-3">
                    <!-- <div class="card-header pad-10" style="background:#efb838">近畿</div> -->
                    <div class="division-box">
                      <ul class="multiple-boxa">
                        <a data-info="Osaka" class="path Osaka card-text" @click="getStateClick">
                            <li class="spanclass" id="27" @click="selected = 27" :class="{highlight:selected == 27}">大阪</li>
                        </a>

                        <a data-info="Hyogo" class="path Hyogo card-text" @click="getStateClick">
                             <li class="spanclass" id="28" @click="selected = 28" :class="{highlight:selected == 28}">兵庫</li>
                        </a>

                        <a data-info="Kyoto" class="path Kyoto card-text" @click="getStateClick">
                            <li class="spanclass"  id="26" @click="selected = 26" :class="{highlight:selected == 26}">京都</li>
                        </a>

                        <a data-info="Nara" class="path Nara card-text" @click="getStateClick">
                            <li class="spanclass"  id="29" @click="selected = 29" :class="{highlight:selected == 29}">奈良</li>
                        </a>

                        <a data-info="Shiga" class="path Shiga card-text" @click="getStateClick">
                              <li class="spanclass"  id="25" @click="selected = 25" :class="{highlight:selected == 25}">滋賀</li>
                        </a>

                        <a data-info="Wakayama" class="path Wakayama card-text" @click="getStateClick">
                            <li class="spanclass" id="30" @click="selected = 30" :class="{highlight:selected == 30}">和歌山</li>
                        </a>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="col-sm-3 chugoku-box">
                  <div class="mb-3">
                    <!-- <div class="card-header pad-10" style="background:#f58c3f;">中国</div> -->
                    <div class="division-box">
                      <ul class="">
                        <a data-info="Okayama" class="path Okayama card-text" @click="getStateClick">
                             <li class="spanclass" id="33" @click="selected = 33" :class="{highlight:selected == 33}">岡山</li>
                        </a>

                        <a data-info="Hiroshima" class="path Hiroshima card-text" @click="getStateClick">
                            <li class="spanclass" id="34" @click="selected = 34" :class="{highlight:selected == 34}">広島</li>
                        </a>

                        <a data-info="Yamaguchi" class="path Yamaguchi card-text" @click="getStateClick">
                            <li class="spanclass" id="35" @click="selected = 35" :class="{highlight:selected == 35}">山口</li>
                        </a>

                        <a data-info="Shimane" class="path Shimane card-text" @click="getStateClick">
                            <li class="spanclass" id="32" @click="selected = 32" :class="{highlight:selected == 32}">島根</li>
                        </a>

                        <a data-info="Tottori" class="path Tottori card-text" @click="getStateClick">
                            <li class="spanclass"  id="31" @click="selected = 31" :class="{highlight:selected == 31}">鳥取</li>
                        </a>


                      </ul>
                    </div>
                  </div>
                </div>

                <div class="col-sm-3 shikoku-box">
                  <div class="mb-3">
                    <!-- <div class="card-header pad-10" style="background:#f1a296;">四国</div> -->
                    <div class="division-box">
                      <ul class="multiple-boxa">
                        <a data-info="Tokushima" class="path Tokushima card-text" @click="getStateClick">
                            <li class="spanclass" id="36"  @click="selected = 36" :class="{highlight:selected == 36}">徳島</li>
                        </a>

                        <a data-info="Kagawa" class="path Kagawa card-text" @click="getStateClick">
                            <li class="spanclass" id="37" @click="selected = 37" :class="{highlight:selected == 37}">香川</li>
                        </a>

                        <a data-info="Kochi" class="path Kochi card-text" @click="getStateClick">
                            <li class="spanclass" id="39" @click="selected = 39" :class="{highlight:selected == 39}">高知</li>
                        </a>

                        <a data-info="Ehime" class="path Ehime card-text" @click="getStateClick">
                            <li class="spanclass" id="38" @click="selected = 38" :class="{highlight:selected == 38}">愛媛</li>
                        </a>

                      </ul>
                    </div>
                  </div>
                </div>

                <div class="col-sm-2 kyushu-box">
                  <div class="mb-3">
                    <!-- <div class="card-header pad-10" style="background-color:#e77a72;">九州・沖縄</div> -->
                    <div class="division-box">
                      <ul class="">
                        <a data-info="Fukuoka" class="path Fukuoka card-text" @click="getStateClick">
                          <li class="spanclass" id="40" @click="selected = 40" :class="{highlight:selected == 40}">福岡</li>
                        </a>

                        <a data-info="Saga" class="path Saga card-text" @click="getStateClick">
                            <li class="spanclass" id="41" @click="selected = 41" :class="{highlight:selected == 41}">佐賀</li>
                        </a>

                        <a data-info="Nagasaki" class="path Nagasaki card-text" @click="getStateClick">
                            <li class="spanclass" id="42" @click="selected = 42" :class="{highlight:selected == 42}">長崎</li>
                        </a>

                        <a data-info="Oita" class="path Oita card-text" @click="getStateClick">
                            <li class="spanclass" id="44" @click="selected = 44" :class="{highlight:selected == 44}">大分</li>
                        </a>

                       <a data-info="Kumamoto" class="path Kumamoto card-text" @click="getStateClick">
                           <li class="spanclass" id="43" @click="selected = 43" :class="{highlight:selected == 43}">熊本</li>
                        </a>


                        <a data-info="Miyazaki" class="path Miyazaki card-text" @click="getStateClick">
                              <li class="spanclass" id="45"  @click="selected = 45" :class="{highlight:selected == 45}">宮崎</li>
                        </a>

                        <a data-info="Kagoshima" class="path Kagoshima card-text" @click="getStateClick">
                            <li class="spanclass" id="46"  @click="selected = 46" :class="{highlight:selected == 46}">鹿児島</li>
                        </a>

                      </ul>
                    </div>
                  </div>
                </div>

                <div class="col-sm-2 okinawa-box">
                  <div class="mb-3">
                    <!-- <div class="card-header pad-10" style="background-color:#e77a72;">九州・沖縄</div> -->
                    <div class="division-box">
                      <ul class="">
                          <a data-info="Okinawa" class="path Okinawa card-text" @click="getStateClick">
                              <li class="spanclass" id="47" @click="selected = 47" :class="{highlight:selected == 47}">沖縄</li>
                        </a>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <!--end map right wrapper-->
        </div>
    
        <section id="map-responsive">
            <div>
             
            </div>
            <div class="freeword-responsive"> 
                <h3 class="map-resicon">
                  <div class="map-text-wrapper">
                    <div>
                      <!-- <img src="/images/map-responsive1.png" alt="" class="img-responsive"> -->
                      <i class="fa icon map-fa-icon"></i>
                    </div>             
                    <div>
                      <p class="text-left"> &nbsp;あなたのやさしい 手を求めてる老人<br class="pc-768"/>ホーム・病院が見つかります。</p>  
                    </div>
                  </div>
                </h3>
                
                
             <!--search input-->
                <div class="search">
                    <input type="text" class="searchTerm" id="search-free-word" placeholder="地名、施設名などを入力">
                    <button type="submit" class="searchButton" @click="searchfreeword">
                      <i class="fas fa-search"></i> 検索
                    </button>
                </div>

                
              <!--end search input-->
            </div>
          
             <bulma-accordion 
              :icon="'custom'"
              >
                        <!--Start hokkaido-box and  tohoku-box -->
                        <bulma-accordion-item>
                            <p slot="title" class="title is-4 has-text-weight-normal">北海道・東北</p>
                            <i slot="icon-closed" class="fa fa-plus-circle map-addicon"></i>
                            <i slot="icon-open" class="fa fa-minus-circle map-addicon"></i>
                            <p slot="content" class="custom_group">
                                <a data-info="Hokkaido" @click="getStateClick">
                                   <li id="1" v-scroll-to="'#scroll-responsive'" @click="selected = 1" :class="{resHighlight:selected == 1}">北海道 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Aomori" @click="getStateClick" >
                                    <li id="2" v-scroll-to="'#scroll-responsive'" @click="selected = 2" :class="{resHighlight:selected == 2}">青森 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Iwate" @click="getStateClick" >
                                    <li id="3" v-scroll-to="'#scroll-responsive'" @click="selected = 3" :class="{resHighlight:selected == 3}">岩手 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Akita" @click="getStateClick">
                                    <li id="5" v-scroll-to="'#scroll-responsive'" @click="selected = 5" :class="{resHighlight:selected == 5}"> 秋田 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Miyagi" @click="getStateClick" >
                                    <li id="4" v-scroll-to="'#scroll-responsive'" @click="selected = 4" :class="{resHighlight:selected == 4}">宮城 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>                                
                                <a data-info="Yamagata" @click="getStateClick" >
                                    <li id="6" v-scroll-to="'#scroll-responsive'" @click="selected = 6" :class="{resHighlight:selected == 6}"> 山形 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Fukushima" @click="getStateClick" >
                                    <li id="7" v-scroll-to="'#scroll-responsive'" @click="selected = 7" :class="{resHighlight:selected == 7}"> 福島 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                            </p>
                        </bulma-accordion-item>
                    <!-- End hokkaido-box and  tohoku-box -->
                    <!--  Start kanto-box -->
                       <bulma-accordion-item>
                            <p slot="title" class="title is-4 has-text-weight-normal">関東</p>
                            <i slot="icon-closed" class="fa fa-plus-circle map-addicon"></i>
                            <i slot="icon-open" class="fa fa-minus-circle map-addicon"></i>
                            <p slot="content" class="custom_group">
                                <a data-info="Tokyo" @click="getStateClick" >
                                   <li id="13" v-scroll-to="'#scroll-responsive'" @click="selected = 13" :class="{resHighlight:selected == 13}">東京 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Kanagawa" @click="getStateClick" >
                                    <li id="14" v-scroll-to="'#scroll-responsive'" @click="selected = 14" :class="{resHighlight:selected == 14}">神奈川 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Chiba" @click="getStateClick" >
                                    <li id="11" v-scroll-to="'#scroll-responsive'" @click="selected = 11" :class="{resHighlight:selected == 11}">埼玉 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Miyagi" @click="getStateClick" >
                                    <li id="12" v-scroll-to="'#scroll-responsive'" @click="selected = 12" :class="{resHighlight:selected == 12}">千葉 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Gunma" @click="getStateClick">
                                    <li id="10" v-scroll-to="'#scroll-responsive'" @click="selected = 10" :class="{resHighlight:selected == 10}"> 群馬 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Ibaraki" @click="getStateClick" >
                                    <li id="8" v-scroll-to="'#scroll-responsive'" @click="selected = 8" :class="{resHighlight:selected == 8}"> 茨城 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Tochigi" @click="getStateClick" >
                                    <li id="9" v-scroll-to="'#scroll-responsive'" @click="selected = 9" :class="{resHighlight:selected == 9}"> 栃木 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                 <a data-info="Yamanashi" @click="getStateClick" >
                                    <li id="19" v-scroll-to="'#scroll-responsive'" @click="selected = 19" :class="{resHighlight:selected == 19}"> 山梨 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                            </p>
                        </bulma-accordion-item>
                        <!-- End kanto-box -->
                    <!-- Start hokuriku-box-->
                        <bulma-accordion-item>
                            <p slot="title" class="title is-4 has-text-weight-normal">北陸</p>
                            <i slot="icon-closed" class="fa fa-plus-circle map-addicon"></i>
                            <i slot="icon-open" class="fa fa-minus-circle map-addicon"></i>
                            <p slot="content" class="custom_group">
                                <a data-info="Niigata" @click="getStateClick" >
                                   <li id="15" v-scroll-to="'#scroll-responsive'" @click="selected = 15" :class="{resHighlight:selected == 15}">新潟 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Nagana" @click="getStateClick" >
                                    <li id="20" v-scroll-to="'#scroll-responsive'" @click="selected = 20" :class="{resHighlight:selected == 20}">長野 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Toyama" @click="getStateClick" >
                                    <li id="16" v-scroll-to="'#scroll-responsive'" @click="selected = 16" :class="{resHighlight:selected == 16}">富山 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Ishikawa" @click="getStateClick" >
                                    <li id="17" v-scroll-to="'#scroll-responsive'" @click="selected = 17" :class="{resHighlight:selected == 17}">石川 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Fukui" @click="getStateClick">
                                    <li id="18" v-scroll-to="'#scroll-responsive'" @click="selected = 18" :class="{resHighlight:selected == 18}"> 福井 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>                               
                            </p>
                        </bulma-accordion-item>
                    <!-- End hokuriku-box-->                    
                        <!--Start tokai-box -->
                        <bulma-accordion-item>
                            <p slot="title" class="title is-4 has-text-weight-normal">東海</p>
                            <i slot="icon-closed" class="fa fa-plus-circle map-addicon"></i>
                            <i slot="icon-open" class="fa fa-minus-circle map-addicon"></i>
                            <p slot="content" class="custom_group">
                                <a data-info="Aichi" @click="getStateClick" >
                                   <li id="23" v-scroll-to="'#scroll-responsive'" @click="selected = 23" :class="{resHighlight:selected == 23}">愛知 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Shizuoka" @click="getStateClick" >
                                    <li id="22" v-scroll-to="'#scroll-responsive'" @click="selected = 22" :class="{resHighlight:selected == 22}">静岡 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Gifu" @click="getStateClick" >
                                    <li id="21" v-scroll-to="'#scroll-responsive'" @click="selected = 21" :class="{resHighlight:selected == 21}">岐阜 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Mie" @click="getStateClick" >
                                    <li id="24" v-scroll-to="'#scroll-responsive'" @click="selected = 24" :class="{resHighlight:selected == 24}">三重 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                            </p>
                        </bulma-accordion-item>
                        <!--End tokai-box -->
                        <!-- Start kansai -box -->
                         <bulma-accordion-item>
                            <p slot="title" class="title is-4 has-text-weight-normal">関西</p>
                            <i slot="icon-closed" class="fa fa-plus-circle map-addicon"></i>
                            <i slot="icon-open" class="fa fa-minus-circle map-addicon"></i>
                            <p slot="content" class="custom_group">
                                <a data-info="Osaka" @click="getStateClick" >
                                   <li id="27" v-scroll-to="'#scroll-responsive'" @click="selected = 27" :class="{resHighlight:selected == 27}">大阪 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Hyogo" @click="getStateClick" >
                                    <li id="28" v-scroll-to="'#scroll-responsive'" @click="selected = 28" :class="{resHighlight:selected == 28}">兵庫 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="kyoto" @click="getStateClick" >
                                    <li id="26" v-scroll-to="'#scroll-responsive'" @click="selected = 26" :class="{resHighlight:selected == 26}">京都<i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Nara" @click="getStateClick" >
                                    <li id="29" v-scroll-to="'#scroll-responsive'" @click="selected = 29" :class="{resHighlight:selected == 29}">奈良 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Shiga" @click="getStateClick">
                                    <li id="25" v-scroll-to="'#scroll-responsive'" @click="selected = 25" :class="{resHighlight:selected == 25}"> 滋賀 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Wakayama" @click="getStateClick" >
                                    <li id="30" v-scroll-to="'#scroll-responsive'" @click="selected = 30" :class="{resHighlight:selected == 30}"> 和歌山 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                            </p>
                        </bulma-accordion-item>
                        <!-- End kinki-box -->
                        <!-- Start chugoku-box and shikoku-box-->
                        <bulma-accordion-item>
                            <p slot="title" class="title is-4 has-text-weight-normal">中国・四国</p>
                            <i slot="icon-closed" class="fa fa-plus-circle map-addicon"></i>
                            <i slot="icon-open" class="fa fa-minus-circle map-addicon"></i>
                            <p slot="content" class="custom_group">
                                <a data-info="Okayama" @click="getStateClick" >
                                   <li id="33" v-scroll-to="'#scroll-responsive'" @click="selected = 33" :class="{resHighlight:selected == 33}">岡山 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Hiroshima" @click="getStateClick" >
                                    <li id="34" v-scroll-to="'#scroll-responsive'" @click="selected = 34" :class="{resHighlight:selected == 34}">広島 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Yamaguchi" @click="getStateClick" >
                                    <li id="35" v-scroll-to="'#scroll-responsive'" @click="selected = 35" :class="{resHighlight:selected == 35}">山口 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Shimane" @click="getStateClick" >
                                    <li id="32" @click="selected = 32" :class="{resHighlight:selected == 32}">島根 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Tottori" @click="getStateClick">
                                    <li id="31" v-scroll-to="'#scroll-responsive'" @click="selected = 31" :class="{resHighlight:selected == 31}"> 鳥取 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Ehime" @click="getStateClick" >
                                    <li id="38" v-scroll-to="'#scroll-responsive'" @click="selected = 38" :class="{resHighlight:selected == 38}"> 愛媛 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Kagawa" @click="getStateClick" >
                                    <li id="37" v-scroll-to="'#scroll-responsive'" @click="selected = 37" :class="{resHighlight:selected == 37}">香川 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Kochi" @click="getStateClick">
                                    <li id="39" v-scroll-to="'#scroll-responsive'" @click="selected = 39" :class="{resHighlight:selected == 39}"> 高知 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Tokushima" @click="getStateClick" >
                                    <li id="36" v-scroll-to="'#scroll-responsive'" @click="selected = 36" :class="{resHighlight:selected == 36}"> 徳島 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                            </p>
                        </bulma-accordion-item>
                        <!-- End chugoku-box and shikoku-box-->
                        <!-- Start kyushu-box and  okinawa-box -->
                        <bulma-accordion-item>
                            <p slot="title" class="title is-4 has-text-weight-normal">九州・沖縄</p>
                            <i slot="icon-closed" class="fa fa-plus-circle map-addicon"></i>
                            <i slot="icon-open" class="fa fa-minus-circle map-addicon"></i>
                            <p slot="content" class="custom_group">
                                <a data-info="Fukuoka" @click="getStateClick" >
                                   <li id="40" v-scroll-to="'#scroll-responsive'" @click="selected = 40" :class="{resHighlight:selected == 40}">福岡 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Saga" @click="getStateClick" >
                                    <li id="41" v-scroll-to="'#scroll-responsive'" @click="selected = 41" :class="{resHighlight:selected == 41}">佐賀 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Nagasak" @click="getStateClick" >
                                    <li id="42" v-scroll-to="'#scroll-responsive'" @click="selected = 42" :class="{resHighlight:selected == 42}">長崎 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Oita" @click="getStateClick" >
                                    <li id="44" v-scroll-to="'#scroll-responsive'" @click="selected = 44" :class="{resHighlight:selected == 44}">大分 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Kumamoto" @click="getStateClick">
                                    <li id="43" v-scroll-to="'#scroll-responsive'" @click="selected = 43" :class="{resHighlight:selected == 43}"> 熊本 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Miyazaki" @click="getStateClick" >
                                    <li id="45" v-scroll-to="'#scroll-responsive'" @click="selected = 45" :class="{resHighlight:selected == 45}"> 宮崎 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Kagoshima" @click="getStateClick" >
                                    <li id="46" v-scroll-to="'#scroll-responsive'" @click="selected = 46" :class="{resHighlight:selected == 46}">鹿児島 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                                <a data-info="Okinawa" @click="getStateClick">
                                    <li id="47" v-scroll-to="'#scroll-responsive'" @click="selected = 47" :class="{resHighlight:selected == 47}"> 沖縄 <i class="fas fa-angle-double-right arrow_icon"></i></li>
                                </a>
                            </p>
                        </bulma-accordion-item>
                        <!--End kyushu-box and   okinawa-box-->
                    </bulma-accordion>                   
        </section>
        <div id="scroll-responsive">
          <div id="job_search" class="row jobselect">
               <span class="col-12" v-if="norecord_msg">
                <div class="container-fuid m-t-20">
                    <p class="nosearch-icon">
                        <svg x="0px" y="0px" width="30" height="30" viewBox="0 0 172 172" style=" fill:red;"><g transform=""><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="none"></path><path d="M86,168.56c-45.59663,0 -82.56,-36.96337 -82.56,-82.56v0c0,-45.59663 36.96337,-82.56 82.56,-82.56v0c45.59663,0 82.56,36.96337 82.56,82.56v0c0,45.59663 -36.96337,82.56 -82.56,82.56z" fill="none"></path><path d="M0,172v-172h172v172z" fill="none"></path><path d="M3.44,168.56v-165.12h165.12v165.12z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="none"></path><path d="M86,168.56c-45.59663,0 -82.56,-36.96337 -82.56,-82.56v0c0,-45.59663 36.96337,-82.56 82.56,-82.56v0c45.59663,0 82.56,36.96337 82.56,82.56v0c0,45.59663 -36.96337,82.56 -82.56,82.56z" fill="none"></path><path d="M0,172v-172h172v172z" fill="none"></path><path d="M3.44,168.56v-165.12h165.12v165.12z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="none"></path><path d="M86,168.56c-45.59663,0 -82.56,-36.96337 -82.56,-82.56v0c0,-45.59663 36.96337,-82.56 82.56,-82.56v0c45.59663,0 82.56,36.96337 82.56,82.56v0c0,45.59663 -36.96337,82.56 -82.56,82.56z" fill="none"></path><g fill="#666666"><path d="M74.53333,17.2c-31.59643,0 -57.33333,25.73692 -57.33333,57.33333c0,31.59641 25.7369,57.33333 57.33333,57.33333c13.73998,0 26.35834,-4.87915 36.24766,-12.97839l34.23203,34.23203c1.43802,1.49778 3.5734,2.10113 5.5826,1.57735c2.0092,-0.52378 3.57826,-2.09284 4.10204,-4.10204c0.52378,-2.0092 -0.07957,-4.14458 -1.57735,-5.5826l-34.23203,-34.23203c8.09923,-9.88932 12.97839,-22.50768 12.97839,-36.24766c0,-31.59641 -25.7369,-57.33333 -57.33333,-57.33333zM74.53333,28.66667c25.39939,0 45.86667,20.46729 45.86667,45.86667c0,25.39937 -20.46728,45.86667 -45.86667,45.86667c-25.39939,0 -45.86667,-20.46729 -45.86667,-45.86667c0,-25.39937 20.46728,-45.86667 45.86667,-45.86667zM91.67734,51.52161c-1.51229,0.03575 -2.94918,0.66766 -3.99765,1.75807l-13.14636,13.14636l-13.14636,-13.14636c-1.07942,-1.10959 -2.56162,-1.73559 -4.10963,-1.73568c-2.33303,0.00061 -4.43306,1.41473 -5.31096,3.57628c-0.8779,2.16155 -0.3586,4.6395 1.31331,6.26669l13.14636,13.14636l-13.14636,13.14636c-1.49777,1.43802 -2.10111,3.5734 -1.57733,5.58259c0.52378,2.0092 2.09283,3.57825 4.10203,4.10203c2.0092,0.52378 4.14457,-0.07956 5.58259,-1.57733l13.14636,-13.14636l13.14636,13.14636c1.43802,1.49778 3.5734,2.10113 5.5826,1.57735c2.0092,-0.52378 3.57826,-2.09284 4.10204,-4.10204c0.52378,-2.0092 -0.07957,-4.14458 -1.57735,-5.5826l-13.14636,-13.14636l13.14636,-13.14636c1.70419,-1.63875 2.22781,-4.1555 1.31865,-6.33798c-0.90916,-2.18248 -3.06468,-3.58317 -5.42829,-3.52739z"></path></g></g></g></svg>
                    </p>
                     <p class="nosearch-data">お探しの条件に合う施設・物件は見つかりませんでした。</p>
                     <p class="nosearch">条件を変更してみると、該当施設が増える可能性がございますので、再度、ご検索ください。</p>
                </div>
            </span>
            <div v-else class="col-12">
             <h5 class="profile_header m-t-10" style="border-left: 5px solid #828282;">現在の検索条件</h5>
            <table class="table table-bordered col-12 ">
              <tbody>
                <tr>
                  <th class="pc-414-table sp-768-block">地域</th>
                  <td class="sp-768-block">
                    <div class="row mt-2 mb-2">
                      <div class="col-lg-9 col-md-8 col-sm-12">
                      <select id="selectCity" class="form-control custom-select" v-model="id" @change="changeTownship">                        
                        <option value="-1">▼市区町村</option>
                        <option v-for="city in cities" :value="city.id" :key="city.id" >{{city.city_name}}</option>                       
                    </select>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 pc-414">
                      <button @click="toggleContent4" class="btn seemore-btn">
                      <i class="fa" aria-hidden="true"></i>
                          <!-- <em>{{city.city_name}}</em> -->
                          <span id="close6"><i class="fas fa-arrow-circle-up"></i> 市区町村エリアを閉じる </span>
                    </button>
                    </div>
                    </div>
                    <div class="toBeToggled4" id="toBeToggled4">     
                      <div class="dropdown">
                          <button type="button" class="btn btn-default btn-sm dropdown-toggle sp-414" data-toggle="dropdown" style="width:100%;text-align:left;">
                          市から探す
                          </button> 
                          <ul class="dropdown-menu dropdown-menu-form" aria-labelledby="dropdownMenuButton" v-if="w_width <= 768" @click.stop="stopTheEvent">
                            <li>
                            <a data-value="option">
                              <div class="row">
                              <div class="col-lg-2 col-md-4 col-sm-4" v-for="township in getTownships" :key="township.id">
                                  <label class="checkbox form-check-label control control--checkbox">
                                      <input class="form-check-input" type="checkbox" :id="township.id" :value="township.id" v-model="townshipID" @change="getCheck($event)">{{township.township_name}}
                                        <div class="control__indicator"></div>
                                  </label>
                              </div>
                              </div>
                            </a>
                              </li>
                          </ul>
                        
                            <a v-if="w_width >= 768">
                              <div class="row">
                              <div class="col-lg-2 col-md-4 col-sm-4" v-for="township in getTownships" :key="township.id">
                                  <label class="checkbox form-check-label control control--checkbox">
                                      <input class="form-check-input" type="checkbox" :id="township.id" :value="township.id" v-model="townshipID" @change="getCheck($event)">{{township.township_name}}
                                        <div class="control__indicator"></div>
                                  </label>
                              </div>
                              </div>
                            </a>
                              
                      </div>                             
                    </div>                    
                  </td>
                </tr>                
                <tr class="toBeToggled1 ShowHide">
                  <th class="pc-414-table sp-768-block">職種</th>
                  <td class="sp-768-block">
                    <!--職種から探す-->
                     <div class="dropdown">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle sp-414" data-toggle="dropdown" style="width:100%;text-align:left;">
                        職種から探す
                        </button> 
                        <ul class="dropdown-menu dropdown-menu-form" aria-labelledby="dropdownMenuButton" v-if="w_width <= 768" @click.stop="stopTheEvent">
                            <li>
                            <a data-value="option">
                            <div class="row">
                                <div class="col-lg-2 col-md-4 col-sm-4" v-for="occupation in occupations" :key="occupation.id">
                                <label class="form-check-label control control--checkbox">
                                <input class="form-check-input" type="checkbox" :id="occupation.id" :value="occupation.id" v-model="occupationID">
                                    {{occupation.name}}
                                <div class="control__indicator"></div>
                                </label>
                                </div>
                            </div>
                            </a>
                            </li>
                        </ul>

                        <a v-if="w_width >= 768">
                          <div class="row">
                            <div class="col-lg-2 col-md-4 col-sm-4" v-for="occupation in occupations" :key="occupation.id">
                              <label class="form-check-label control control--checkbox">
                              <input class="form-check-input" type="checkbox" :id="occupation.id" :value="occupation.id" v-model="occupationID">
                                {{occupation.name}}
                              <div class="control__indicator"></div>
                              </label>
                            </div>
                          </div>
                        </a>
                     </div>
                      
                    <!--end 職種から探す-->
                  </td>
                </tr>
                <tr class="toBeToggled1 ShowHide">
                  <th style="padding:10px;" class="pc-414-table sp-768-block">雇用形態</th>
                  <td class="sp-768-block">
                    <!--雇用形態から探す-->
                    <div class="dropdown">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle sp-414" data-toggle="dropdown" style="width:100%;text-align:left;">
                        雇用形態から探す
                        </button> 
                         <ul class="dropdown-menu dropdown-menu-form" aria-labelledby="dropdownMenuButton" v-if="w_width <= 768"  @click.stop="stopTheEvent">
                            <li>
                        <a>
                          <div class="row col-12">
                              <div class="form-check form-check-inline col-sm-2">
                              <label class="form-check-label control control--checkbox" style="padding-left:5px;">
                              <input class="form-check-input" value="正職員" v-model="empstatus" type="checkbox">
                              正社員(正職員)
                              <div class="control__indicator"></div>
                              </label>
                            </div>
                            <div class="form-check form-check-inline col-sm-2">
                              <label class="form-check-label control control--checkbox" style="padding-left:5px;">
                              <input class="form-check-input" value="契約社員" v-model="empstatus" type="checkbox">
                              契約社員(職員)
                              <div class="control__indicator"></div>
                              </label>
                            </div>
                            <div class="form-check form-check-inline col-sm-2">
                              <label class="form-check-label control control--checkbox" style="padding-left:5px;">
                              <input class="form-check-input" value="非常勤" v-model="empstatus" type="checkbox">
                              非常勤。パート
                              <div class="control__indicator"></div>
                              </label>
                            </div>
                            <div class="form-check form-check-inline col-sm-2">
                              <label class="form-check-label control control--checkbox" style="padding-left:5px;">
                              <input class="form-check-input" value="その他" v-model="empstatus" type="checkbox">
                              その他
                              <div class="control__indicator"></div>
                              </label>
                            </div>
                          </div>
                        </a>
                            </li>
                         </ul>

                        <a v-if="w_width >= 768">
                          <div class="row">
                              <div class="col-lg-2 col-sm-4">
                              <label class="form-check-label control control--checkbox">
                              <input class="form-check-input" value="正職員" v-model="empstatus" type="checkbox">
                              正社員(正職員)
                              <div class="control__indicator"></div>
                              </label>
                            </div>
                            <div class="col-lg-2 col-sm-4">
                              <label class="form-check-label control control--checkbox">
                              <input class="form-check-input" value="契約社員" v-model="empstatus" type="checkbox">
                              契約社員(職員)
                              <div class="control__indicator"></div>
                              </label>
                            </div>
                            <div class="col-lg-2 col-sm-4">
                              <label class="form-check-label control control--checkbox">
                              <input class="form-check-input" value="非常勤" v-model="empstatus" type="checkbox">
                              非常勤。パート
                              <div class="control__indicator"></div>
                              </label>
                            </div>
                            <div class="col-lg-2 col-sm-4">
                              <label class="form-check-label control control--checkbox">
                              <input class="form-check-input" value="その他" v-model="empstatus" type="checkbox">
                              その他
                              <div class="control__indicator"></div>
                              </label>
                            </div>
                          </div>
                        </a>
                    </div>
                    <!--end 雇用形態から探す-->
                  
                  </td>
                </tr>

                <tr class="text-center">
                  <td colspan='2' style="border:none;">
                    <button @click="ShowHide4" class="btn seemore-btn">
                      <i class="fa" aria-hidden="true"></i>
                          <span id="close4"><i class="fas fa-arrow-circle-down"></i> もっと見る</span>
                    </button>
                  </td>
                </tr>

                <tr class="text-center">
                  <td colspan="2" style="border:none;">
                     <button class="main-bg-color create-btn all-btn col-md-2 col-sm-2" @click="search"><i class="fas fa-search"></i>&nbsp; 検索 </button>
                  </td>
                </tr>
              </tbody>
            </table>
            </div>
             <div class="col-12">
                <div class="row pad-free">
                   <div id="job_detail" class="col-lg-6 col-md-12" style="margin-top:20px;" v-for="(job,index) in displayItems" :key="index+'-'+job.title+'-'+job.jobid">
                     <div class="job-content">
                      <div class="job-header">
                        <h5 class="job-tit">
                          <router-link :to="{name: 'job_details', params:{id:job.jobid}}">{{job.jrecord}}{{job.title}}</router-link>
                          </h5>
                        <div class="clearfix">
                          <p class="job_status">{{job.employment_status}}</p>
                          <p class="job_id search_jobid"><span>求人番号:</span>{{job.jobnum}}</p>
                        </div>
                      </div>
                      <div class="job-body d-flex clearfix">
                        <!-- <div class="col-4 job-img">
                          <img src="/upload/news/nursing.JPG"  alt="">
                        </div> -->
                        <div class="col-12 job-box p0-480">
                          <table  class="table table-bordered  table-sm">
                            <tr>
                              <td><span class="job_ico pc-414-inline"><i class="fa fa-map-marker-alt"></i></span><span>最寄り駅</span></td>
                              <td>{{job.nearest_station}}</td>
                            </tr>
                            <tr>
                              <td><span class="job_ico pc-414-inline">&#xa5;</span><span>給料</span></td>
                              <td>{{job.salary_type}} : {{(Number(job.salary)).toLocaleString()}} ¥ </td>
                            </tr>
                            <tr>
                              <td><span class="job_ico pc-414-inline">時</span><span>勤務時間/日/休日の詳細</span></td>
                              <td> {{job.working_hours}} / {{job.holidays}}  </td>
                            </tr>
                            <tr>
                              <td><span class="job_ico pc-414-inline"><i class="fa fa-briefcase"></i></span><span>特別な条件</span></td>
                              <td> {{job.allowances}} </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <div class="mt-4 detail-btn">
                        <span class="btn all-btn" @click="gotoJobdetail(job.jobid)">詳細を見る</span>
                        <!-- <router-link :to="{name: 'job_details', params:{id:job.jobid}}" class="btn all-btn">詳細を見る</router-link> -->
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            <div class="offset-md-4 col-md-8 mt-3" v-if="show_paginate">
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item">
                    <span class="spanclass" @click="first"><i class='fas fa-angle-double-left'></i> 最初</span>
                  </li>
                  <li class="page-item">
                    <span class="spanclass" @click="prev"><i class='fas fa-angle-left'></i> 前へ</span>
                  </li>
                  <li class="page-item" v-for="(i,index) in displayPageRange" :key="index" :class="{active_page: i-1 === currentPage}">
                    <span class="spanclass" @click="pageSelect(i)">{{i}}</span>
                  </li>
                  <li class="page-item">
                    <span class="spanclass" @click="next">次へ <i class='fas fa-angle-right'></i></span>
                  </li>
                  <li class="page-item">
                    <span class="spanclass" @click="last">最後 <i class='fas fa-angle-double-right'></i></span>
                  </li>
                </ul>
              </nav>
            </div>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</layout>
</template>


<script>
import layout from '../components/home.vue'
import { BulmaAccordion, BulmaAccordionItem } from "vue-bulma-accordion";
 
export default {
    components: {
      layout,
      BulmaAccordion,
      BulmaAccordionItem
    },
    //props: ['initOpen'],
    data(){
      return{
        id:'',
        townshipID:[],
        township_id:[],
        cities:[],
        getCity:[],
        township_id:-1,
        moving_in:-1,
        per_month:-1,
        getTownships:[],
        special_features:[],
        fac_types:[],
        fac_id:[],
        medical_acceptance:[],
        subjects:[],
        occupationID:[],
        occupations:[],
        toggleCheck: true,
        toggleCheck_1: false,
        empstatus:[],
        job_data:[],
        currentPage: 0,
        size: 20,
        pageRange: 5,
        items: [],
        show_paginate: false,
        loginuser: true,
        selected: undefined,
        locast:'',
        company:[],
        open:false,
        norecord_msg: false,
        window:{
          width: 0,
          height: 0
        },
        w_width: $(window).width(),
       testclass:''
      }
    },
    created() {
     
        this.axios.get('/api/user').then(response => {
                this.pro_id = response.data.lat_lng[0].id;
                this.loginuser = true;
                }).catch((error) => {
                    this.loginuser = false;
                });
        this.open = !this.initOpen

        window.addEventListener('resize', this.handleResize);
        this.handleResize();
    },
    mounted() {
            $('#navtab').removeClass('news-tabColor hospital-tabColor nursing-tabColor job-tabColor');
            $('#navtab').addClass('job-tabColor');
            $('.tab-content').removeClass('news-borderColor job-borderColor nursing-borderColor hospital-borderColor');
            $('#upper-tab').addClass('job-borderColor');
        },
  methods:{
    stopTheEvent:function(e){
         $('.dropdown-menu').on('click', function(e) {
        if($(this).hasClass('dropdown-menu-form')) {
            e.stopPropagation();
        }
    });
    },
    // toggle(id) {
    // 	const index = this.opened.indexOf(id);
    //   if (index > -1) {
    //   	this.opened.splice(index, 1)
    //   } else {
    //   	this.opened.push(id)
    //   }
    // },
     handleResize() {
        this.window.width = window.innerWidth;
        this.window.height = window.innerHeight;
        //console.log('hello');
    },
    search()
    {
        if(this.townshipID == null || this.townshipID == '')
        {
          this.townshipID[0] = 0;
        }
        if(this.occupationID == null || this.occupationID == '')
        {
          this.occupationID[0] = 0;
        }
        if(this.empstatus == null || this.empstatus == '')
        {
          this.empstatus[0] = 0;
        }

        if ($('#search-free-word').val() != '')
        {

          var search_word = $('#search-free-word').val();
        }

        this.axios.get('api/getjobsearch/'+search_word,{

          params:{
              id: this.id,
              townshipID:this.townshipID,
              occupationID:this.occupationID,
              empstatus:this.empstatus
          },
        }).then((response)=>{
            this.job_data = response.data.job;
          if(this.job_data.length > 0)
          {
               $('#job_search').css("display","block");
          }
          this.cities = response.data.city

          if(this.job_data.length > this.size) {
              this.show_paginate = true;
          }else{
              this.show_paginate = false;
          }
          if(this.job_data.length != 0){
              this.norecord_msg = false;
          }else{
              this.norecord_msg = true;
          }

        })

         // window.scrollTo({ top : 1000, behavior: 'smooth' });
    },
    searchfreeword(){

            //clear all checkbox
            this.id = -1;
            this.townshipID = [];
            this.occupationID = [];
            this.empstatus = [];

            if ($('#search-free-word').val() != '')
            {

                var search_word = $('#search-free-word').val();
            }
            else{
                var search_word = "all";
            }

            this.axios.get('api/getjobsearch/'+ search_word,{
               params:{
                    id: -1,
                    townshipID:-1,
                    occupationID:-1,
                    empstatus:-1

                },
            })
            .then((response)=>{
              if(response.data.job.length > 0)
              {

                $('.jobselect').removeClass('jobselect');
                $('#job_search').css("display","block");
                this.job_data = response.data.job;
                this.cities = response.data.city
                this.getTownships = [];
              
                if(this.job_data.length > this.size) {
                    this.show_paginate = true;
                }else{
                    this.show_paginate = false;
                }
                if(this.job_data.length != 0) {
                    this.norecord_msg = false;
                }else{
                    this.norecord_msg = true;
                }

              }
              else{
                  $('#job_search').css("display","none");
              }



            });



        },

    gotoJobdetail(jid) {
        this.$router.push({ name: 'job_details', params:{id:jid,loginuser:this.loginuser}});
    },

    toggleContent4() {
        this.toggleCheck = !this.toggleCheck;
            if (this.toggleCheck == true) {
                $('#close6').empty();
                $("#toBeToggled4").slideToggle();
                $('#close6').append('<i class="fas fa-arrow-circle-up"></i> 市区町村エリアを閉じる');

            } else {
                $('#close6').empty();
                $("#toBeToggled4").slideToggle();
                $('#close6').append('<i class="fas fa-arrow-circle-down"></i> 市区町村エリアを開く');
            }
        },
       ShowHide4() {
        this.toggleCheck_1 = !this.toggleCheck_1;
            if (this.toggleCheck_1 == true) {
                $('#close4').empty();
                $(".ShowHide").slideDown();
                $('#close4').append('<i class="fas fa-arrow-circle-up"></i> 閉じる');

            } else {
                $('#close4').empty();
                $(".ShowHide").slideUp();
                $('#close4').append('<i class="fas fa-arrow-circle-down"></i> もっと見る');
            }
        },
        changeTownship()
        {
           this.townshipID = [];
            if(localStorage.getItem("nursing_fav") == null){

                this.locast = 0;
            }
            else{
                this.locast = localStorage.getItem("nursing_fav");
            }

            this.axios.get('api/getmap',{
            params:{
              id: this.id,
              township_id:-1,
              moving_in:-1,
              per_month:-1,
              local:this.locast,
              feature:'job',
          },
          })
          .then((response)=>{

          $('.jobselect').removeClass('jobselect');
            this.cities = response.data.city
            this.getCity = response.data.getCity
            this.getTownships = response.data.getTownships
            this.occupations = response.data.occupations
            this.id = id
         })

        this.search();
        },
        // getStation(){
        //    this.axios.get('api/getstation/'+ this.id)
        //   .then((response)=>{
        //     this.company = response.data.company;
        //  })
        // },

      getStateClick(e){     
          //clear all check box
            this.townshipID = [];
            this.occupationID = [];
            this.empstatus = [];
          if(e.target.id == ''){
            var id = $('#selectCity').val();
          }else{
            var id = e.target.id;
          }
          this.id = id;

           if(localStorage.getItem("nursing_fav") == null){

                this.locast = 0;
            }
            else{
                this.locast = localStorage.getItem("nursing_fav");
            }
            this.$loading(true);
          this.axios.get('api/getmap',{
            params:{
              id: this.id,
              township_id:-1,
              moving_in:-1,
              per_month:-1,
              local:this.locast,
              feature:'job'
          },
          })
          .then((response)=>{
            this.$loading(false);
          $('.jobselect').removeClass('jobselect');
          this.cities = response.data.city
          this.getCity = response.data.getCity
          this.getTownships = response.data.getTownships
          
          this.occupations = response.data.occupations
          this.id = id
         })

        document.getElementById('search-free-word').value = '';
        this.search();

      },

      getCheck(e){

         console.log(this.townshipID);
        // console.log(this.townshipID);
        // if(e.target.checked){
        //   this.township_id = e.target.value;
        //    this.township_id.push(e.target.value);
        //    console.log(this.township_id);
        // }
      },
      features(e){
        if(e.target.checked){

        }
      },
      getStateHover(e){
        if(e.target.tagName ==='path'){
         //console.log(e)
        }
      },
      first() {
      this.currentPage = 0;
    },
    last() {
      this.currentPage = this.pages - 1;
    },
    prev() {
      if(0<this.currentPage) {
        this.currentPage--;
      }
    },
    next() {
      if(this.currentPage < this.pages - 1) {
        this.currentPage++;
      }
    },
    pageSelect(index) {
      this.currentPage = index - 1;
    },

    },
    computed: {
    pages() {
      return Math.ceil(this.job_data.length / this.size);
    },
    displayPageRange() {
      const half = Math.ceil(this.pageRange/2);
      const isEven = this.pageRange / 2 == 0;
      const offset = isEven ? 1 : 2;
      let start, end;
      if(this.pages < this.pageRange) {
        start = 1;
        end = this.pages;
      }else if (this.currentPage < half) {
        start = 1;
        end = start + this.pageRange - 1;
      }else if (this.pages - half < this.currentPage) {
        end = this.pages;
        start = end - this.pageRange + 1;
      }else {
        start = this.currentPage - half + offset;
        end = this.currentPage + half;
      }
      let indexes = [];
      for (let i = start; i <= end; i++) {
        indexes.push(i);
      }
      return indexes;
    },
    displayItems() {
      const head = this.currentPage * this.size;
      return this.job_data.slice(head, head + this.size);
    },
    isSelected(page) {
      return page - 1 == this.currentPage;
    }
	},
};


  // $("#search").on("click", function() {
  //   alert('a');
  //     // $("body").scrollTop(0);
  // });


// $(function() {
//   $( '#divisionswrap ul li' ).on( 'click', function(e) {
//         e.preventDefault();
//         $( '#divisionswrap ul li' ).parent().find( 'li.active' ).removeClass( 'active' );
//         $( this ).addClass( 'active' );
//  });
``
// });

      //Hide all panels
      function showCheckboxes() {
  if ($('#checkboxes').is(':visible')) {
    $('#checkboxes').hide();
  }
  else {
    $('#checkboxes').show();
  }
}

                      
$(document).click(function(e) {
  if(e.target.nodeName == 'BODY')
    $('#checkboxes').hide();
});

</script>


<style scoped>

.jobselect {
  display: none;
}
.offset {
  display: none;
}
span.tooltip {
  padding: 0px 5px;
  position: relative;
  background: #ffbb99;
  cursor: pointer;
}

.tooltip-info {
  position: absolute;
  top: -9999px;
  left: -9999px;
}

span.tooltip::before {
  content: attr(data-tooltip);
  position: absolute;
  top: 1.5em;
  font-size: 0.9em;
  padding: 1px 5px;
  display: none;
  color: white;
  background: rgba(0, 0, 0, 0.75);
  border-radius: 4px;
  transition: opacity 0.1s ease-out;
  z-index: 99;
  text-align: left;
}

span:hover::before {
  display: inline-block;
}
[data-toggle="collapse"] .fa:before {
  content: "\f139";
}

[data-toggle="collapse"].collapsed .fa:before {
  content: "\f13a";
}


.card-2 {
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  border-radius:10px;
}
.toBeToggled4 {
    display: block;
}

.toBeToggled1 {
    display: none;
}

table > tbody > tr th{
  background-color: #eeeeee;
  /* text-align:right; */
  width:140px;
  padding:25px;
}
.job-tabColor .nav-link {
    background: #828282 !important;
    color: #fff;
    border-right: 1px solid #fff;
}

.job-borderColor {
    border: 1px solid #828282 !important;
}
.tab-pane{
        padding: 10px;
    }
    .offset{
  width: 500px !important;
  margin: 20px auto;
}
.page-item.active_page .spanclass {
  z-index: 1;
  background-color: #ffbb99;
    background-image: none;
    border: 1px solid #8e3c15;
}
.page-item .spanclass{
  cursor: pointer;
}

/********/
.container {
  padding: 1rem 2%;
}

.toggle {
  align-items: center;
  background: #12C88A;
  border-radius: 4px;
  color: #FFF;
  cursor: pointer;
  display: flex;
  justify-content: flex-start;
  padding: 1rem 1.2rem;
  margin-bottom: 2px;
}

.toggle i {
  font-size: 1.2rem;
  margin-right: .6rem;
}

.content {
  background: #F8F8F8;
  border-radius: 4px;
  padding: 1rem 1.2rem;
}

.content > * {
  line-height: 1.8;
  margin: 0;
  opacity: 1;
  padding: 0;
  visibility: visible;
}

.slide-enter-active,
.slide-leave-active {
  transition:
    padding-top .3s ease-out,
    padding-bottom .3s ease-out;
}

.slide-enter-active > * {
  transition:
    line-height .3s ease-out,
    opacity .1s linear .1s,
    visibility .1s linear .1s;
}

.slide-leave-active > * {
  transition:
    line-height .3s ease-out,
    opacity .1s linear,
    visibility .1s linear;
}

.slide-enter,
.slide-leave-to {
  padding-top: 0;
  padding-bottom: 0;
}

.slide-enter > *,
.slide-leave-to > * {
  line-height: 0;
  opacity: 0;
  visibility: hidden;
}
/* .dropdown{
  display: none;
} */
/************************responsive ****************************/
@media only screen and (max-width:1024px) {
  table > tbody > tr th{  
    width:100px;
  }
 
}
@media only screen and (max-width: 480px){
  table > tbody > tr th{
    padding: 25px 5px;
  }
  table th, table td{
    vertical-align: middle;
  }
  .dropdown-toggle::after {    
    position: absolute;
    right: 12px;
    top: 15px;
  }
}

.dropdown-toggle::after {
    display: inline-block;
    margin-left: 0.255em;
    vertical-align: 0.255em;
    content: "";
    border-top: 0.3em solid;
    border-right: 0.3em solid transparent;
    border-bottom: 0;
    border-left: 0.3em solid transparent;
    margin-left: 94px;
}

</style>
