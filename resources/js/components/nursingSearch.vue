<template>
    <layout>
        <div>
            <div class="col-md-12" style="border-bottom: 1px dashed #ff6117;padding-bottom: 10px; margin-bottom: 20px;">
                <h5 class="font-weight-bold"><i class="fas fa-map" style="color:#ff6117;"></i>&nbsp;地図検索</h5>
            </div>
            <div class="search-map"  @mouseover="getStateHover">
                <div class="row" id="hos">
                    <div class="col-md-12">
                        <div>
                            <div class="row map-wrap"  id="searchMap">
                                <!-- search map and path -->
                                <div class="col-lg-5 col-md-12 col-sm-12 float-left map-leftwrapper">
                                    <!-- <h2 class="map-header">あなたらしい<br/>暮らしができる<br/> 老人ホームが <br/>見つかります。</h2> -->
                                    <h2 class="map-header">あなたらしい暮ら<br/>しができる。そん<br/>な老人ホームが見 <br/>つかります。</h2>
                                    <!--search input-->
                                    <div class="wrap">
                                        <div class="search">
                                            <input type="text"  id="search-free-word" class="searchTerm" placeholder="地名、施設名などを入力">
                                            <button class="searchButton"  @click="searchfreeword" >
                                            <i class="fas fa-search"></i> 検索
                                        </button>
                                        </div>
                                    </div>
                                    <!--end search input-->
                                </div>
                                <div class="col-lg-7 col-md-12 col-sm-12 float-right">
                                    <div class="divisions row" id="divisionswrap">
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
                                                <a data-info="Aomori" class="path Aomori card-text" @click="getStateClick">
                                                    <li class="spanclass" id="2" @click="selected = 2" :class="{highlight:selected == 2}">青森</li>
                                                </a>
                                                <a data-info="Iwate" class="path Iwate card-text" @click="getStateClick">
                                                    <li class="spanclass" id="3" @click="selected = 3" :class="{highlight:selected == 3}">岩手</li>
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
                                                    <li class="spanclass" id="7" @click="selected = 7" :class="{highlight:selected == 7}">福島</li>
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
                                                    <li class="spanclass" id="13" @click="selected = 13" :class="{highlight:selected == 13}">東京</li>
                                                </a>
                                                <a data-info="Kanagawa" class="path Kanagawa card-text" @click="getStateClick">
                                                    <li class="spanclass" id="14" @click="selected = 14" :class="{highlight:selected == 14}">神奈川</li>
                                                </a>

                                                <a data-info="Saitama" class="path Saitama card-text" @click="getStateClick">
                                                    <li class="spanclass" id="11" @click="selected = 11" :class="{highlight:selected == 11}" >埼玉</li>
                                                </a>
                                                <a data-info="Chiba" class="path Chiba card-text" @click="getStateClick">
                                                    <li class="spanclass" id="12" @click="selected = 12" :class="{highlight:selected == 12}">千葉</li>
                                                </a>

                                                <a data-info="Gunma" class="path Gunma card-text" @click="getStateClick">
                                                    <li class="spanclass" id="10" @click="selected = 10" :class="{highlight:selected == 10}">群馬</li>
                                                </a>

                                                <a data-info="Ibaraki" class="path Ibaraki card-text" @click="getStateClick">
                                                    <li class="spanclass" id="8"  @click="selected = 8" :class="{highlight:selected == 8}">茨城</li>
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
                                                    <li class="spanclass" id="15" @click="selected = 15" :class="{highlight:selected == 15}" >新潟</li>
                                                </a>
                                                <a data-info="Nagano" class="path Nagano card-text" @click="getStateClick">
                                                    <li class="spanclass" id="20" @click="selected = 20" :class="{highlight:selected == 20}">長野</li>
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


                                                <a data-info="Shizuoka" class="path Shizuoka card-text" @click="getStateClick" >
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
                                                    <li class="spanclass" id="36" @click="selected = 36" :class="{highlight:selected == 36}">徳島</li>
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
                                                    <li class="spanclass" id="45" @click="selected = 45" :class="{highlight:selected == 45}">宮崎</li>
                                                </a>

                                                <a data-info="Kagoshima" class="path Kagoshima card-text" @click="getStateClick">
                                                    <li class="spanclass" id="46" @click="selected = 46" :class="{highlight:selected == 46}">鹿児島</li>
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

                                <!-- <div class="map">
                                </div> -->

                            </div>
                            <section id="map-responsive">
                                <!-- <div>
                                
                                </div> -->
                                <div class="freeword-responsive"> 
                                    <h3 class="map-resicon">
                                    <div class="map-text-wrapper">
                                        <div>
                                        <!-- <img src="/images/map-responsive1.png" alt="" class="img-responsive"> -->
                                        <i class="fa icon map-fa-icon"></i>
                                        </div>             
                                        <div>
                                        <p class="text-left"> &nbsp;あなたらしい暮らしができる。そん<br class="pc-768"/>な老人ホームが見つかります。</p>    
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
                                                        <li id="32" v-scroll-to="'#scroll-responsive'" @click="selected = 32" :class="{resHighlight:selected == 32}">島根 <i class="fas fa-angle-double-right arrow_icon"></i></li>
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
                            <!-- search city , township  -->
                            <div id="scroll-responsive">
                                <div class="row select" id="filter" style="justify-content:space-between">
                                    <h5 class="profile_header" style="border-left: 5px solid #ff9563;">現在の検索条件</h5>
                                    <div class="col-sm-5 col-md-5">
                                        <div><p class="nurs-sub-heading">地域で絞り込む</p></div>
                                        <div class="card search-border-dash">

                                        <div class="card-body">
                                            <select id="selectCity" class="form-control custom-select" @change="nursingSearchData(1);" style="background-color: #fff;" v-model="id">
                                            <option value="-1">▼市区町村</option>
                                            <option  :value="city.id" v-for="city in cities" :key="city.id">{{city.city_name}}</option>
                                            </select>
                                            <select id="selectTownship" class="form-control mt-1 custom-select" style="background-color: #fff;" @change="nursingSearchData(2);" v-model="township_id">
                                            <option value="-1">▼市区町村</option>
                                            <option  :value="selectTownship.id"  v-for="selectTownship in getTownships" :key="selectTownship.id">{{selectTownship.township_name}}</option>
                                            </select>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 col-md-5">
                                        <div><p class="nurs-sub-heading">料金で絞り込む</p></div>
                                        <div class="card search-border-dash">
                                        <div class="card-body">
                                            <div class="">
                                            <select name="" id="" class="form-control custom-select" style="background-color: #fff;" @change="nursingSearchData" v-model="moving_in">
                                                <option data-price-type="" value="-1">▼入居一時金</option>
                                                <!-- <option data-price-type="" value="0">一時金なし</option> -->
                                                <option data-price-type="" value="500000">50万円以下</option>
                                                <option data-price-type="" value="1000000">100万円以下</option>
                                                <option data-price-type="" value="2000000">200万円以下</option>
                                                <option data-price-type="" value="3000000">300万円以下</option>
                                                <option data-price-type="" value="4000000">400万円以下</option>
                                                <option data-price-type="" value="5000000">500万円以下</option>
                                                <option data-price-type="" value="6000000">600万円以下</option>
                                                <option data-price-type="" value="7000000">700万円以下</option>
                                                <option data-price-type="" value="8000000">800万円以下</option>
                                                <option data-price-type="" value="9000000">900万円以下</option>
                                                <option data-price-type="" value="1000000">1,000万円以下</option>
                                                <option data-price-type="" value="20000000">2,000万円以下</option>
                                                <option data-price-type="" value="30000000">3,000万円以下</option>
                                                <option data-price-type="more" value="30000000">3,000万円以上</option>
                                            </select>
                                            <select name="" id="" class="form-control  mt-1 custom-select" style="background-color: #fff;" @change="nursingSearchData" v-model="per_month">
                                                <option data-price-type="" value="-1">▼月額利用料</option>
                                                <option data-price-type="" value="100000">10万円以下</option>
                                                <option data-price-type="" value="120000">12万円以下</option>
                                                <option data-price-type="" value="140000">14万円以下</option>
                                                <option data-price-type="" value="160000">16万円以下</option>     
                                                <option data-price-type="" value="180000">18万円以下</option>
                                                <option data-price-type="" value="200000">20万円以下</option>
                                                <option data-price-type="" value="220000">22万円以下</option>
                                                <option data-price-type="" value="240000">24万円以下</option>
                                                <option data-price-type="" value="260000">26万円以下</option>
                                                <option data-price-type="" value="280000">28万円以下</option>
                                                <option data-price-type="" value="300000">30万円以下</option>
                                                <option data-price-type="" value="350000">35万円以下</option>
                                                <option data-price-type="" value="400000">40万円以下</option>
                                                <option data-price-type="" value="450000">45万円以下</option>
                                                <option data-price-type="" value="500000">50万円以下</option>
                                                <option data-price-type="more" value="500000">50万円以上</option>
                                            </select>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2 col-md-2 align-self-center">
                                        <span class="btn seemore-btn select" style="width:100%;padding:20px 10px;" id="showSearchMap" @click="showSearchMap"><i class="fas fa-exchange-alt"></i>&nbsp;都道府県を再選択する</span>
                                    </div>
                                </div>
                            </div>
                            <!-- google map  -->

                            <section id="holder">
                                <div class="row" >
                                    <div class="col-sm-12 col-md-12">
                                        <!-- <div v-if="loading" class=" m-t-10 m-b-10" style="background-color:gray;opacity:0.8;position:relative;z-index:10;">
                                        <div class="lds-ripple m-t-10 m-b-10" >
                                            <div>
                                                <div></div><div></div>
                                            </div>
                                            </div>
                                            <div class="col-12 overlay" style="z-index:9">

                                            </div>
                                        </div> -->
                                        <div class="m-t-10 m-b-10">
                                            <div v-if="loading" class=" m-t-10 m-b-10" style="background-color:#000;opacity:0.5;position:relative;z-index:10;">
                                                <div class="lds-ripple m-t-10 m-b-10" >
                                                    <div>
                                                        <div></div><div></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 overlay" style="z-index:9"></div>
                                            </div>
                                            <div id="mymap"></div>
                                        </div>
                                        <!-- <div id="mymap" class="select m-t-10 m-b-10"></div> -->
                                    </div>
                                </div>
                            </section>
                            <!-- nursing list -->
                            <div id="nursing-search" >
                                <span v-if="norecord_msg && loading==false">
                                    <div class="container-fuid m-t-20">
                                        <p class="nosearch-icon">
                                            <svg x="0px" y="0px" width="30" height="30" viewBox="0 0 172 172" style=" fill:red;"><g transform=""><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="none"></path><path d="M86,168.56c-45.59663,0 -82.56,-36.96337 -82.56,-82.56v0c0,-45.59663 36.96337,-82.56 82.56,-82.56v0c45.59663,0 82.56,36.96337 82.56,82.56v0c0,45.59663 -36.96337,82.56 -82.56,82.56z" fill="none"></path><path d="M0,172v-172h172v172z" fill="none"></path><path d="M3.44,168.56v-165.12h165.12v165.12z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="none"></path><path d="M86,168.56c-45.59663,0 -82.56,-36.96337 -82.56,-82.56v0c0,-45.59663 36.96337,-82.56 82.56,-82.56v0c45.59663,0 82.56,36.96337 82.56,82.56v0c0,45.59663 -36.96337,82.56 -82.56,82.56z" fill="none"></path><path d="M0,172v-172h172v172z" fill="none"></path><path d="M3.44,168.56v-165.12h165.12v165.12z" fill="none"></path><path d="M86,172c-47.49649,0 -86,-38.50351 -86,-86v0c0,-47.49649 38.50351,-86 86,-86v0c47.49649,0 86,38.50351 86,86v0c0,47.49649 -38.50351,86 -86,86z" fill="none"></path><path d="M86,168.56c-45.59663,0 -82.56,-36.96337 -82.56,-82.56v0c0,-45.59663 36.96337,-82.56 82.56,-82.56v0c45.59663,0 82.56,36.96337 82.56,82.56v0c0,45.59663 -36.96337,82.56 -82.56,82.56z" fill="none"></path><g fill="#666666"><path d="M74.53333,17.2c-31.59643,0 -57.33333,25.73692 -57.33333,57.33333c0,31.59641 25.7369,57.33333 57.33333,57.33333c13.73998,0 26.35834,-4.87915 36.24766,-12.97839l34.23203,34.23203c1.43802,1.49778 3.5734,2.10113 5.5826,1.57735c2.0092,-0.52378 3.57826,-2.09284 4.10204,-4.10204c0.52378,-2.0092 -0.07957,-4.14458 -1.57735,-5.5826l-34.23203,-34.23203c8.09923,-9.88932 12.97839,-22.50768 12.97839,-36.24766c0,-31.59641 -25.7369,-57.33333 -57.33333,-57.33333zM74.53333,28.66667c25.39939,0 45.86667,20.46729 45.86667,45.86667c0,25.39937 -20.46728,45.86667 -45.86667,45.86667c-25.39939,0 -45.86667,-20.46729 -45.86667,-45.86667c0,-25.39937 20.46728,-45.86667 45.86667,-45.86667zM91.67734,51.52161c-1.51229,0.03575 -2.94918,0.66766 -3.99765,1.75807l-13.14636,13.14636l-13.14636,-13.14636c-1.07942,-1.10959 -2.56162,-1.73559 -4.10963,-1.73568c-2.33303,0.00061 -4.43306,1.41473 -5.31096,3.57628c-0.8779,2.16155 -0.3586,4.6395 1.31331,6.26669l13.14636,13.14636l-13.14636,13.14636c-1.49777,1.43802 -2.10111,3.5734 -1.57733,5.58259c0.52378,2.0092 2.09283,3.57825 4.10203,4.10203c2.0092,0.52378 4.14457,-0.07956 5.58259,-1.57733l13.14636,-13.14636l13.14636,13.14636c1.43802,1.49778 3.5734,2.10113 5.5826,1.57735c2.0092,-0.52378 3.57826,-2.09284 4.10204,-4.10204c0.52378,-2.0092 -0.07957,-4.14458 -1.57735,-5.5826l-13.14636,-13.14636l13.14636,-13.14636c1.70419,-1.63875 2.22781,-4.1555 1.31865,-6.33798c-0.90916,-2.18248 -3.06468,-3.58317 -5.42829,-3.52739z"></path></g></g></g></svg>
                                        </p>
                                        <p class="nosearch-data">お探しの条件に合う施設・物件は見つかりませんでした。</p>
                                        <p class="nosearch">条件を変更してみると、該当施設が増える可能性がございますので、再度、ご検索ください。</p>
                                    </div>
                                </span>
                                <div class="row" v-if="nus_data.length > 0">
                                        <div class="card-carousel-wrapper col-12" v-if="loading==false">
                                            <div class="nav-box" @click="moveCarousel(-1)" :disabled="atHeadOfList">
                                            <div class="nav-content mr-2">
                                                <div class="card-carousel--nav__left"></div>
                                            </div>
                                            </div>
                                            <div class="card-carousel">
                                            <div class="card-carousel--overflow-container">
                                                <div class="card-carousel-cards" :style="{ transform: 'translateX' + '(' + currentOffset + 'px' + ')'}">
                                                <!-- <div @mouseover="mouseover(items.alphabet)" @mouseleave="mouseleave(items.alphabet)" class="card-carousel--card"  v-for="items in nus_data" :id="items.alphabet"  :key="items.nursing_id"> -->
                                                <div class="card-carousel--card">
                                                    <div class="MarkerHover">
                                                        <table class="nursingSearch-tbl">
                                                        <tbody>
                                                        <tr >
                                                            <td class="pt-2 pb-2"  v-for="(items,index) in nus_data" @mouseover="mouseover(items.alphabet)" @mouseleave="mouseleave(items.alphabet)" :id="items.alphabet" :key="items.nursing_id">
                                                                <div class="wd-in">
                                                                    <p class="mb-2 clearfix"><span class="num-room">{{items.num_rooms}} </span><span class="float-right">{{items.date_of_establishment}}</span></p>

                                                                    <p class="item-fav btn btn-sm" v-if="items.fav_check == ''" :class="'view_pro_id'+items.nursing_id" style="" @click="favAddFun('add',items.nursing_id,index);">
                                                                        <i class="fas fa-plus-square" style="color:#c40000;"></i> お気に入りに追加 {{items.fav_check}}
                                                                    </p>

                                                                    <p class="item-fav btn btn-sm" v-if="items.fav_check == 'check'" :class="'done_pro_id'+items.nursing_id" style="color:#aaa;" @click="favAddFun('remove',items.nursing_id,index);">
                                                                        <i class="fas fa-check-double" style="color:#c40000!important;"></i>&nbsp; 追加済み
                                                                    </p>

                                                                    <p class="item-name"><img :src="'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld='+items.alphabet+'|ff9563|000000'" alt="">
                                                                        <router-link :to="{name: 'profile', params: {cusid:items.cus_id, type: 'nursing'}}" class="pseudolink" style="font-weight:bold;color:#ff6117 !important">{{items.name}}</router-link>
                                                                    </p>
                                                                    <p>{{items.city_name}} <i class="fas fa-angle-double-right" style="color:#b9b5b5;"></i> {{items.township_name}}</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td  v-for="items in nus_data" @mouseover="mouseover(items.alphabet)" @mouseleave="mouseleave(items.alphabet)" :id="items.alphabet" :key="items.nursing_id">
                                                                <div class="wd-in">
                                                                    <span class="type-name">{{items.type_name}}</span>

                                                                    <div class="row" style="margin-top:10px;">
                                                                        <div class="col-4 col-lg-5 col-md-5" style="padding-top:3px;">
                                                                            <div class="carousel-img">
                                                                            <img :src="'/upload/nursing_profile/'+items.logo" alt="image" class="img-fluid" @error="imgUrlAlt"/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-8 col-lg-7 col-md-7 m-b-15">
                                                                            <ul class="nursingSearch-list m-l-10">
                                                                                <li class="d-flex"><p class="text-truncate"><span>住所</span><span> {{items.township_name}} {{items.address}}</span></p></li>
                                                                                <li class="d-flex"><span>電話 </span><span>{{items.phone}}</span></li>
                                                                                <li class="d-flex"><span>サイト</span><a :href="'http://'+ items.website" target="_blank"  class="text-truncate">{{items.website}}</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td  v-for="items in nus_data" @mouseover="mouseover(items.alphabet)" @mouseleave="mouseleave(items.alphabet)" :id="items.alphabet" :key="items.nursing_id">
                                                                <div class="wd-in">
                                                                    <table class="table table-bordered price-tbl text-center">
                                                                        <thead>
                                                                            <tr style="background-color:#ffffcc">
                                                                                <th class="text-center" style="background-color:#ffffcc">入居時費用</th>
                                                                                <th class="text-center" style="background-color:#ffffcc">月額費用</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td><span>{{(Number(items.moving_in_to)/10000).toLocaleString()}} </span>万円</td>
                                                                                <td><span>{{(Number(items.per_month_to)/10000).toLocaleString()}} </span>万円</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>

                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="nav-box" @click="moveCarousel(1)" :disabled="atEndOfList">
                                            <div class="nav-content ml-2">
                                                <div class="card-carousel--nav__right"></div>
                                            </div>
                                            </div>
                                        </div>
                                        <div id="nursingView" class="col-12">
                                        <h5 class="profile_subtit">もっと探す条件</h5>
                                        </div>
                                        <!--list-->
                                    <div id="filtertable" class="col-12">
                                        <table class="table table-bordered col-12 box-wrap">
                                            <tbody>
                                                <tr>
                                                    <th>地域</th>
                                                    <td>
                                                        <select id="selectCity" class="col-9 form-control custom-select mt-2 mb-2" v-model="id" @change="ChangeTownship">
                                                        <option value="-1">▼市区町村</option>
                                                        <option v-for="city in cities" :value="city.id" :key="city.id">{{city.city_name}}</option>
                                                    </select>
                                                    <button @click="toggleContent" class="btn col-3 seemore-btn">
                                                        <i class="fa" aria-hidden="true"></i>
                                                        <!-- <em>{{city.city_name}}</em> -->
                                                        <span id="close"><i class="fas fa-arrow-circle-up"></i> 市区町村エリアを閉じる</span>
                                                    </button>
                                                    <div class="toBeToggled" id="toBeToggled">
                                                            <div class="form-check form-check-inline col-sm-2"   v-for="township in getTownships" :key="township.id">
                                                            <label class="form-check-label control control--checkbox" style="padding-left:5px;">
                                                            <input class="form-check-input" type="checkbox" :id="township.id" :value="township.id" v-model="townshipID" @click="check">
                                                                {{township.township_name}}
                                                            <div class="control__indicator"></div>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th v-if="showOne" style="padding:10px;">入居時の条件</th>
                                                    <td v-if="showOne">
                                                            <div class="form-check form-check-inline col-sm-2" id="customCheck1">
                                                            <label class="form-check-label control control--checkbox" style="padding-left:5px;">
                                                                <input class="form-check-input" :id="1" value="自立" v-model="MoveID" type="checkbox">
                                                                自立
                                                                <div class="control__indicator"></div>
                                                            </label>
                                                            </div>
                                                            <div class="form-check form-check-inline col-sm-3" id="customCheck1">
                                                            <label class="form-check-label control control--checkbox" style="padding-left:5px;">
                                                                <input class="form-check-input" :id="2" value="要支援" v-model="MoveID" type="checkbox">
                                                                要支援
                                                                <div class="control__indicator"></div>
                                                            </label>
                                                            </div>
                                                            <div class="form-check form-check-inline col-sm-3" id="customCheck1">
                                                            <label class="form-check-label control control--checkbox" style="padding-left:5px;">
                                                                <input class="form-check-input" :id="3" value="要介護" v-model="MoveID" type="checkbox">
                                                                要介護
                                                                <div class="control__indicator"></div>
                                                            </label>
                                                            </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th v-if="showOne">特長</th>
                                                    <td v-if="showOne">
                                                        <div class="form-check form-check-inline col-sm-2" v-for="feature in special_features" :key="feature.id">
                                                        <label class="form-check-label control control--checkbox" style="padding-left:5px;">
                                                            <input class="form-check-input" type="checkbox" v-model="SpecialFeatureID" :id="feature.id" :value="feature.id" @click="features($event)">
                                                            {{feature.name}}
                                                            <div class="control__indicator"></div>
                                                        </label>
                                                    </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th v-if="showOne">施設の種類</th>
                                                    <td v-if="showOne">
                                                    <div class="form-check form-check-inline col-sm-2" v-for="fac_type in fac_types" :key="fac_type.id">
                                                        <label class="form-check-label control control--checkbox" style="padding-left:5px;">
                                                        <input class="form-check-input" type="checkbox" v-model="FacTypeID" :id="fac_type.id" :value="fac_type.id">
                                                        {{fac_type.description}}
                                                        <div class="control__indicator"></div>
                                                        </label>
                                                    </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th v-if="showOne">医療面・診療科目</th>
                                                    <td v-if="showOne">
                                                    <div class="form-check form-check-inline col-sm-2" v-for="medical in medical_acceptance" :key="medical.id">
                                                        <label class="form-check-label control control--checkbox" style="padding-left:5px;">
                                                        <input class="form-check-input" type="checkbox" v-model="MedicalAcceptanceID" :id="medical.id" :value="medical.id">
                                                        {{medical.name}}
                                                        <div class="control__indicator"></div>
                                                        </label>
                                                    </div>
                                                    </td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td colspan="2">
                                                        <button @click="showOne = !showOne" class="btn btn-link mt-2">
                                                        <!-- <span v-show="showOne"><i class="fas fa-arrow-circle-up"></i>閉じる</span> -->
                                                        <button v-show="showOne" class="btn seemore-btn">
                                                        <i class="fa" aria-hidden="true"></i>
                                                            <span id="close4"><i class="fas fa-arrow-circle-up"></i> 閉じる</span>
                                                        </button>
                                                        <!-- <span v-show="!showOne"><i class="fas fa-arrow-circle-down"></i>もっと見る</span> -->
                                                        <button v-show="!showOne" class="btn seemore-btn">
                                                        <i class="fa" aria-hidden="true"></i>
                                                            <span id="close4"><i class="fas fa-arrow-circle-down"></i> もっと見る</span>
                                                        </button>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td colspan="2" style="border:none;">
                                                        <button class="main-bg-color create-btn all-btn" id="search" style="width:16%;" @click="search"><i class="fas fa-search"></i>&nbsp; 検索 </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--end search list-->

                            <div class=" col-12">
                                <div class="row" v-if="loading==false">
                                    <div id="job_detail" class="col-md-6 col-sm-12" style="margin-top:20px;" v-for="(nus,index) in displayItems" :key="nus.id">
                                        <div class="nur-content">
                                            <div class="job-header">
                                                <div class="row pad-free">
                                                    <div class="col-8">
                                                    <h5 class="nur-tit">
                                                        <router-link :to="{name: 'profile', params: {cusid:nus.cus_id, type: 'nursing'}}" class="pseudolink" style="font-weight:bold;">{{nus.name}}</router-link>
                                                    </h5>
                                                    
                                                    <div class="d-flex" >
                                                        
                                                        <span v-for="(fac,index) in fac_types" :key="index+'-'+fac.description+'-'+nus.id">                                                    
                                                            <span v-if="fac.id == nus.fac_type" class="fac_list">
                                                                {{fac.description}}
                                                            </span>
                                                        </span>
                                                        <span class="nur_date"><span style="font-weight:bold;color:green;">開設年月日 :</span> {{nus.date_of_establishment}}</span>
                                                    </div>
                                                        
                                                    </div>

                                                    <div class="col-4 text-right">
                                                    <span class="btn fav-profile fav-item fav-color" v-if="nus.fav_check == ''" :class="'view_pro_id'+nus.nursing_id" style="display:block;" @click="favAddFun('add',nus.nursing_id,index);"><i class="fas fa-plus-square" style="color:#c40000!important;"></i>&nbsp; お気に入りに追加</span>
                                                    <span class="btn fav-profile fav-item fav-color" v-if="nus.fav_check == 'check'" :class="'done_pro_id'+nus.nursing_id" style="color:#aaa;display:block;" @click="favAddFun('remove',nus.nursing_id,index);"><i class="fas fa-check-double" style="color:#c40000!important;"></i>&nbsp; 追加済み</span>
                                                    </div>
                                                </div>
                                            </div>         

                                            <p class="m-b-10"><span class="job_ico"><i class="fa fa-map-signs"></i></span>{{nus.city_name}} <i class="fas fa-angle-double-right" style="color:#b9b5b5;"></i> {{nus.township_name}} </p>
                                            <div class="col-12 pad-free m-b-10 clearfix">
                                                <span class="num-room"> {{nus.num_rooms}} </span>
                                                <p class="hos_phone float-right" v-if="nus.phone"><span class="circle-phone" ><i class="fa fa-phone-alt"></i></span><span class="phone-no">{{nus.phone}}</span></p>
                                            </div>
                                            <div class="job-body row  clearfix">
                                                <div class="col-4 job-img">
                                                    <img :src="'/upload/nursing_profile/'+nus.logo" alt="image" @error="imgUrlAlt">
                                                    <div class="mt-4 col-12 detail-btn text-center">
                                                        <router-link :to="{name: 'profile', params: {cusid:nus.cus_id, type: 'nursing'}}" class="btn all-btn" style="font-weight:bold;">詳細を見る</router-link>
                                                    </div>
                                                </div>
                                                <div class="col-8 job-box">
                                                    <table  class="table table-bordered table-sm">
                                                        <!-- <tr>
                                                        <td style="width:30%;"><span class="job_ico"><i class="fa fa-user"></i></span>名前</td>
                                                        <td>{{nus.name}}</td              >
                                                        </tr> -->
                                                        <tr>
                                                            <td style="width:30%"><span class="job_ico">&#xa5;</span>入居時費用</td>
                                                            <!-- <td><span class="cash-lbl">{{Number(nus.moving_in_to)/10000}} </span>万円</td> -->
                                                            <td class="cash-lbl">
                                                                {{(Math.floor(Number(nus.moving_in_from)/10000))==0? '' : (Math.floor(Number(nus.moving_in_from)/10000)).toLocaleString()+'万' }}{{(Number(nus.moving_in_from)%10000)==0 ? '' : (Number(nus.moving_in_from)%10000).toLocaleString()}}円
                                                                    ~
                                                                {{(Math.floor(Number(nus.moving_in_to)/10000))==0? '' : (Math.floor(Number(nus.moving_in_to)/10000)).toLocaleString()+'万' }}{{(Number(nus.moving_in_to)%10000)==0 ? '' : (Number(nus.moving_in_to)%10000).toLocaleString()}}円
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:30%"><span class="job_ico">&#xa5;</span>月額費用</td>
                                                            <td>
                                                                <font class="cash-lbl">
                                                                    {{(Math.floor(Number(nus.per_month_from)/10000))==0? '' : (Math.floor(Number(nus.per_month_from)/10000)).toLocaleString()+'万' }}{{(Number(nus.per_month_from)%10000)==0 ? '' : (Number(nus.per_month_from)%10000).toLocaleString()}}円
                                                                        ~
                                                                    {{(Math.floor(Number(nus.per_month_to)/10000))==0? '' : (Math.floor(Number(nus.per_month_to)/10000)).toLocaleString()+'万' }}{{(Number(nus.per_month_to)%10000)==0 ? '' : (Number(nus.per_month_to)%10000).toLocaleString()}}円
                                                                </font>
                                                            </td>
                                                        </tr>
                                                        <!-- <tr>
                                                        <td style="width:30%;"><span class="job_ico"><i class="fa fa-envelope"></i></span>メールアドレス</td>
                                                        <td>{{nus.email}}</td>
                                                        </tr> -->
                                                        <tr>
                                                        <td style="width:30%;"><span class="job_ico"><i class="fa fa-map-marker-alt"></i></span>住所</td>
                                                        <td>{{nus.address}}</td>
                                                        </tr>
                                                        <tr>
                                                        <td style="width:30%;"><span class="job_ico"><i class="fa fa-map-marker-alt"></i></span>アクセス</td>
                                                        <td><p v-html="nus.access"></p></td>
                                                        </tr>
                                                        <tr>
                                                        <td style="width:30%;"><span class="job_ico"><i class="fa fa-building"></i></span>運営事業者</td>
                                                        <td>{{nus.operator}}</td>
                                                        </tr>
                                                        <!-- <tr>
                                                        <td style="width:30%;"><span class="job_ico">&#xa5;</span>入居時費用</td>
                                                        <td>{{nus.moving_in}} </td>
                                                        </tr> -->
                                                    </table>
                                                    <h5 class="header m-t-10">こだわりの特長</h5>
                                                 
                                                    <span v-for="(spe,index) in specialfeature" :key="index+'-'+spe.name+'-'+nus.id">
                                                    <span v-if="spe.customer_id == nus.customer_id" class="feature_list">
                                                        {{spe.name}}
                                                    </span>
                                                    </span>

                                                        <!-- <h5 class="header m-t-10">医療受入</h5>
                                                        <span v-for="(med,index) in medicalacceptance" :key="index+'-'+med.name+'-'+nus.id">
                                                        <span v-if="med.customer_id == nus.customer_id" class="feature_list">
                                                            {{med.name}}
                                                        </span>
                                                        </span> -->
                                                </div>
                                                <!-- <div class="col-4">
                                                    <h5 class="header m-t-10">施設タイプ</h5>
                                                        <span v-for="(fac,index) in factype" :key="index+'-'+fac.description+'-'+nus.id">
                                                        <span v-if="fac.id == nus.fac_type" class="fac_list">
                                                            {{fac.description}}
                                                        </span>
                                                        </span>
                                                    <div>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="offset-md-4 col-md-8 mt-3" v-if="show_paginate">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                        <li class="page-item">/
                                            <span class="spanclass pc-480" @click="first"><i class='fas fa-angle-double-left'></i> 最初</span>
                                        </li>
                                        <li class="page-item">
                                            <span class="spanclass" @click="prev"><i class='fas fa-angle-left'></i><span class="pc-paginate"> 前へ</span></span>
                                        </li>
                                        <li class="page-item" v-for="(i,index) in displayPageRange" :key="index" :class="{active_page: i-1 === currentPage}">
                                            <span class="spanclass" @click="pageSelect(i)">{{i}}</span>
                                        </li>
                                        <li class="page-item">
                                            <span class="spanclass" @click="next"><span class="pc-paginate">次へ </span><i class='fas fa-angle-right'></i></span>
                                        </li>
                                        <li class="page-item">
                                            <span class="spanclass pc-480" @click="last">最後 <i class='fas fa-angle-double-right'></i></span>
                                        </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-2 p-l-0">
                        <asidebar></asidebar>
                    </div>-->
                </div>
            </div>
        </div>
    </layout>
</template>

<script>
    import layout from '../components/home.vue'
    import {
        eventBus
    } from '../event-bus.js';

    export default {

        name: "mymap",
        components: {
        layout
        },

        data() {

            return {
                cityid:[],
                listid : '',
                map: null,
                markers: [],
                searchmarkers:[],
                marker:[],
                selectedLocation: null,
                infoBoxOpen: false,
                places: [],
                id: [],
                townshipID:[],
                township_id:-1,
                moving_in:-1,
                per_month:-1,
                cities: '',
                getCity: [],
                getTownships: [],
                special_features: [],
                fac_types: [],
                fac_id: [],
                medical_acceptance: [],
                show: false,
                showOne: true,
                currentOffset: 0,
                windowSize: 4,
                paginationFactor: 328,
                window:{
                width: 0,
                height: 0
                },
                nursingList: [],
                alphabet: [],
                markerHover:[],
                SpecialFeatureID:[],
                MedicalAcceptanceID:[],
                FacTypeID:[],
                MoveID:[],
                nus_data:[],
                specialfeature:[],
                medicalacceptance:[],
                factype:[],
                selectedcity:'',
                citylatlng:[],
                view_pro_id: [],
                currentPage: 0,
                size: 20,
                pageRange: 5,
                items: [],
                show_paginate: false,
                onchangeid:0,
                localst:'',
                selected: undefined,
                toggleCheck: true,
                loading: false,
                coordinate:[],
                norecord_msg: false,
                ci : false,
            }
        },

        created(){
            window.addEventListener('resize', this.handleResize)
            this.handleResize();

            if(this.window.width >= 360 && this.window.width < 375) {
                this.windowSize = 1;
                    this.paginationFactor=277;

            }
            else if(this.window.width >= 375 && this.window.width < 452) {
                this.windowSize = 1;
                this.paginationFactor=277;


            }

            else if(this.window.width >= 450 && this.window.width < 768) {
                this.windowSize = 1;
                    this.paginationFactor=277;
                // this.paginationFactor=277;

              
              

            }
            else if(this.window.width >= 768 && this.window.width < 992) {
                this.windowSize = 1;
                this.paginationFactor=341;

            }
            else if(this.window.width >= 992 && this.window.width < 1024) {
                this.windowSize = 2;
                this.paginationFactor=398;

                // console.log(this.window.width);
                // console.log(this.windowSize);
            }

            else if (this.window.width >= 1024 && this.window.width < 1200) {
                this.windowSize = 3;
                this.paginationFactor=412;
           

            }

                else if (this.window.width >= 1200 && this.window.width < 1280) {
                this.windowSize = 2;
                this.paginationFactor=412;
                //  console.log(this.window.width);

            }

            else if (this.window.width >= 1280 && this.window.width < 1440) {
                this.windowSize = 3;
                this.paginationFactor=329;
                // this.paginationFactor=355;
                // console.log(this.window.width);
                // console.log(this.paginationFactor);
                // console.log(this.windowSize);


            }

            else if (this.window.width >= 1440 && this.window.width < 1880) {
                this.windowSize = 3;
                this.paginationFactor=344;


            }
            // $(document).scroll(function() {
            //         $(".custom_group").css({"position": "fixed","top":"100px"});
            //         var cur_pos = $(this).scrollTop();

            //         // $('.ele').each(function(active_el){
            //         //     if($(this).position().top <= (cur_pos+71)){
            //         //         $('.top-fixed-btn.active').removeClass('active');
            //         //         $('.top-fixed-btn').eq(active_el).addClass('active');
            //         //     }
            //         // });

            //         if (cur_pos >= 100) {
            //             $(".custom_group").css({"position": "fixed","top":"100px"});
            //         } else {
            //             $(".custom_group").css({"position": "unset", "top": "unset"});
            //         }
            //     });

            // else if( this.window.width > 1700) {

            // }
        },

        mounted() {
            $('#navtab').removeClass('news-tabColor hospital-tabColor nursing-tabColor job-tabColor');
            $('#navtab').addClass('nursing-tabColor');
            $('.tab-content').removeClass('news-borderColor job-borderColor nursing-borderColor hospital-borderColor');
            $('#upper-tab').addClass('nursing-borderColor');
        },

        computed: {
            atEndOfList() {
                return this.currentOffset <= (this.paginationFactor * -1) * (this.nus_data.length - this.windowSize);
            },
            atHeadOfList() {
                return this.currentOffset === 0;
            },
            pages() {
                return Math.ceil(this.nus_data.length / this.size);
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
            return this.nus_data.slice(head, head + this.size);
            },
            isSelected(page) {
            return page - 1 == this.currentPage;
            }
        },

        methods: {
            handleResize() {
                this.window.width = window.innerWidth;
                this.window.height = window.innerHeight;
            },

            searchfreeword(){
                this.ci = true;
                //clear all drop down
                this.id = -1;
                this.township_id = -1;
                this.moving_in = -1;
                this.per_month = -1;

                if ($('#search-free-word').val() != '')
                {
                    this.id = -1;

                    var search_word = $('#search-free-word').val();
                }
                else{
                    var search_word = 'all';
                }

                if(localStorage.getItem("nursing_fav") == null){

                    this.locast = 0;
                }
                else{
                    this.locast = localStorage.getItem("nursing_fav");
                }




                this.axios.get('/api/getnursingsearch/'+search_word,{
                params:{
                id: -1 ,
                township_id:-1,
                Moving_in:-1,
                Per_month:-1,
                local:this.locast

                },
                })
                .then((response) => {
                  
                  

                        $("#mymap").css({'display' : 'block','height' : '500px','width':'100%'});
                        $("#filtertable").css("display", "block");
                        $("#nursing-search").css("display", "block");
                      
                         if(response.data.nursing.length != 0){
                            this.norecord_msg = false;
                            this.changeMap(response);
                        }else{
                            $("#mymap").css({'display' : 'none'});
                            this.norecord_msg = true;
                        }
                    
                  
                    // document.getElementById('search-free-word').value = '';

                });

            },

            check() {
                this.onchangeid = 0;
                this.moving_in = -1;
                this.township_id = -1;
            },

            openInfoWindow(marker) {
                this.selectedLocation = marker;
                this.infoBoxOpen = true;
            },
            closeInfoWindow() {
                this.infoBoxOpen = false;
            },
            showSearchMap() {
                //clear all checkbox
                this.id = [];
                this.townshipID = [];
                this.SpecialFeatureID = [];
                this.FacTypeID = [];
                this.MoveID = [];
                this.MedicalAcceptanceID = [];
                this.nus_data = [];

                $('#searchMap').removeClass('select');
                $('#showSearchMap').addClass('select');
                $('#filter').addClass('select');
                $("#mymap").css("display", "none");
                $("#nursing-search").css("display", "none");
                $("#filtertable").css("display", "none");
                document.getElementById('search-free-word').value = '';
            },

            moveCarousel(direction) {
                // Find a more elegant way to express the :style. consider using props to make it truly generic
                if (direction === 1 && !this.atEndOfList) {
                this.currentOffset -= this.paginationFactor;
                } else if (direction === -1 && !this.atHeadOfList) {
                this.currentOffset += this.paginationFactor;
                }
            },
            // map onclick function
            getStateClick(e,lat,lng) {
                $('.select').removeClass('select');
                $('#searchMap').addClass('select');
                $('#showSearchMap').removeClass('select');
                $('#filter').removeClass('select');
                // this.$loading(true);
                this.loading = true;
               localStorage.setItem('features', 'nursing');
                this.ci = false;
                this.township_id= -1;
                this.moving_in = -1;
                this.per_month = -1;
                $("#nursing-search").css("display", "block");
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
                // this.$loading(true);
                this.axios.get('/api/getmap',{
                    params:{
                    id: this.id,
                    township_id:-1,
                    moving_in:-1,
                    per_month:-1,
                    local:this.locast,
                    feature:'nursing'
                    },
                })
                    .then((response) => {
                    //   this.$loading(false);
                    $("#mymap").css({'display' : 'block','height' : '500px','width':'100%'});
                    // $("#mymap").css('display', 'block');
                    $("#nursing-search").css("display", "block");
                    $("#filtertable").css("display", "block");
                    
                    this.changeMap(response)
                    })

                //  this.changeSearch();
            },
            // map onclick function
            // map change dropdown function
            nursingSearchData(index){
                this.loading = true;
                this.ci = false;
                if(index == 1) //if choose city
                {
                    this.township_id = -1;
                    this.townshipID = [];
                }
                else{ //if choose township
                this.townshipID = [];
                this.townshipID[0] = this.township_id;
                }

                //if change dropdown , clear array
                this.MoveID = [];
                this.MedicalAcceptanceID = [];
                this.FacTypeID = [];
                this.SpecialFeatureID = [];
                this.onchangeid = 1;
                if(localStorage.getItem("nursing_fav") == null){

                    this.locast = 0;
                }
                else{
                    this.locast = localStorage.getItem("nursing_fav");
                }

                this.axios.get('/api/getmap',{
                    params:{
                    id: this.id,
                    township_id:this.township_id,
                    moving_in:this.moving_in,
                    per_month:this.per_month,
                    local:this.locast,
                    feature:'nursing'
                    },

                })
                .then((response) => {

                    this.changeMap(response)

                })

                //  this.changeSearch();

            },
            // map change dropdown function
            // make infowindow, marker , google map
            coordinates(theCity, lat, lng){
             
                
                if(this.township_id == -1){
                    var mapProp = {
                        center: new google.maps.LatLng(lat, lng),
                        minZoom: 7,
                        maxZoom: 14,
                        zoom: 7,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        options: {
                            gestureHandling: 'greedy'
                        }
                    };
                }else{
                    var mapProp = {
                        center: new google.maps.LatLng(lat, lng),
                        minZoom: 7,
                        maxZoom: 14,
                        zoom: 10,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        options: {
                            gestureHandling: 'greedy'
                        }
                    };
                }
                this.map = new google.maps.Map(document.getElementById("mymap"), mapProp);
                this.loading = true
                let  coor =[];
                var townshipName = [];
                var town = [];
                const city_coordinates = [];
                const arr = [];
                if(this.township_id != -1){
                    // get township postalcode
                    for (let i = 0; i < this.getTownships.length; i++) {
                        if(this.getTownships[i]['id'] == this.township_id){
                            townshipName.push(this.getTownships[i]['postalcode'])
                            town.push(this.getTownships[i]['township_name'])
                        }
                    }
                }else if(this.townshipID != 0){
                    for (let i = 0; i < this.townshipID.length; i++) {
                        for (let k = 0; k < this.getTownships.length; k++) {
                            if(this.getTownships[k]['id'] == this.townshipID[i]){
                                townshipName.push(this.getTownships[k]['postalcode'])
                                town.push(this.getTownships[k]['township_name'])
                            }                    
                        }                    
                    }
                }

               var township_name = townshipName;
             
               if(this.ci == true && (this.townshipID[0] == "-1" || this.townshipID.length == 0))
               {                   
                    this.loading = false;                    
               }
               else if(this.ci == false && (this.townshipID[0] == 0 || this.townshipID[0] == "-1" || this.townshipID.length == 0)){             
                        this.axios.get("/api/cityJson/"+theCity).then(respon => {
                            var city_coordinates = respon.data
                            this.coordinate = city_coordinates.reduce((acc, val) => acc.concat(val), []);
                            this.boundariesGoogleMap(lat,lng,this.coordinate);            
                        }); 
        
                }  
                else{
           
                    this.axios.get('/api/townshipJson/'+township_name).then(res => {
                        var city_coordinates = res.data
                        this.coordinate = city_coordinates.reduce((acc, val) => acc.concat(val), []);
                         this.boundariesGoogleMap(lat,lng,this.coordinate);       
                    })
                }
            },

            boundariesGoogleMap(lat,lng,coor){        
                
                var data = coor.reduce((acc, val) => acc.concat(val), []);    
                for (let i = 0; i < data.length; i++) {
                    this.map.data.addGeoJson(data[i]); 
                }
                var bounds = new google.maps.LatLngBounds();
                this.map.data.forEach(function(feature){
                    var geo = feature.getGeometry();
                    geo.forEachLatLng(function(LatLng){
                    bounds.extend(LatLng)
                    });
                });
                this.map.fitBounds(bounds);

                this.map.data.setStyle({
                strokeColor: "red",
                fillColor: 'red',
                strokeOpacity: 0.8,
                fillOpacity: 0.1,
                strokeWeight: 1
                })
                this.loading = false;
            },

            infoWindow(item, mmarker){
                var infoWindowContent = new Array();
                if(item != null && mmarker != null)
                {
                    for (var i = 0; i < item.length; i++) {
                        infoWindowContent.push([
                            '<div id="info_content">' +
                            '<div class="">' +
                                '<table class="table" style="margin-bottom:0px;">' +
                                '<thead>' +
                                    '<tr>' +
                                    '<td colspan="2"><span class="type-name">' +
                                    item[i]['type_name']+
                                    '</span>'+
                                    '</td>' +
                                    '</tr>' +
                                '</thead>' +
                                '<tbody>' +
                                    '<tr>' +
                                    '<td colspan="2" class="text-left" style="padding-bottom:0px;">' +
                                    '<img src="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld='+item[i]['alphabet']+'|ff9563|000000" alt="" style="margin-right:10px;">' +
                                    '<span class="item-name">' + item[i]['name'] + '</span> <br>' +
                                    '</td>' +
                                '</tr>' +

                                '<tr>' +
                                '<td>' +
                                '<img src="/upload/nursing_profile/' + item[i]['logo'] + '" alt="image" width="100px" style="border:1px solid #ccc;"/>' +
                                '</td>' +
                                '<td style="padding-bottom:0px;">' +
                                    '<p class="hos_phone float-right"><span class="circle-phone"><i class="fa fa-phone-alt"></i></span>' + item[i]['phone'] + '</p>' +
                                '</td>' +
                                '</tr>' +
                                ' <tr>' +
                                '<td colspan="2" style="padding-top:0px;">' +
                                    '<div class="">' +
                                    '<table class="table table-bordered price-tbl text-center" style="margin-bottom:0px">'+
                                    '<thead><tr style="background-color:#ffffcc"><th class="text-center" style="background-color:#ffffcc">入居時費用</th><th class="text-center" style="background-color:#ffffcc">月額利用料</th></tr></thead>'+
                                    '<tbody>'+
                                    '<tr><td><span>'+ (Number(item[i]['moving_in_to'])/10000).toLocaleString() + '</span>万円</td><td><span>'+ (Number(item[i]['per_month_to'])/10000).toLocaleString() + '</span>万円</td></tr>'+
                                    '</tbody>'+
                                    '</table>'+
                                    '</div>' +
                                '</td>' +
                                '</tr>' +
                                '</tbody>' +
                                '</table>' +
                            '</div>' +
                            '</div>'
                        ])
                    }
                    var markers = mmarker;
                    var bounds = new google.maps.LatLngBounds();
                    this.markerHover = [];
                    var infoWindow = new google.maps.InfoWindow(),marker, i;
                }

                for (let i = 0; i < this.markers.length; i++) {
                    var beach = this.markers[i]
                    var lats = this.markers[i]['lat']
                    var lngs = this.markers[i]['lng']
                    var img = this.markers[i]['alphabet']
                    var myLatLng = new google.maps.LatLng(lats, lngs);
                    var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                    marker = new google.maps.Marker({
                        position: position,
                        map: this.map,
                        zoom:7,
                        icon: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' + img + '|ff9563|000000',
                        title: this.markers[i]['name'],
                        options: {
                        gestureHandling: 'greedy'
                    }
                    });
                    bounds.extend(position);



                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infoWindow.setContent(infoWindowContent[i][0]);
                        infoWindow.open(this.map, marker);
                    }
                    })(marker, i));

                    this.markerHover.push(marker)
                    var boundsListener = google.maps.event.addListener((this.map), 'bounds_changed', function(event) {
                    google.maps.event.removeListener(boundsListener);
                    });

                }
                this.map.fitBounds(bounds);
                // this.map.panToBounds(bounds);
            },

            // make infowindow, marker , google map
            clearmap(citylatlng)
            {
                // for clean googleMap
                var lat = citylatlng[0]['latitude']
                var lng = citylatlng[0]['longitude']
                var theCity = citylatlng[0]['city_name']
                const result = jp_township.features
                const coordinates = []
                for (var i = 0; i < result.length; i++) {
                    if (result[i].Name == theCity) {
                    coordinates.push(result[i].geometry['coordinates'])
                    }
                }
                var coordinate = coordinates.reduce((acc, val) => acc.concat(val), []);
                var data = {
                    type: "Feature",
                    geometry: {
                    "type": "Polygon",
                    "coordinates": coordinate
                    },
                };
                var mapProp = {
                    center: new google.maps.LatLng(lat, lng),
                    zoom: 5,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                };
                this.map = new google.maps.Map(document.getElementById("mymap"), mapProp);
                this.map.data.addGeoJson(data);
                this.map.data.setStyle({
                    strokeColor: "red",
                    fillColor: 'red',
                    strokeOpacity: 0.8,
                    fillOpacity: 0.1,
                    strokeWeight: 1
                })
            },
            
            // make infowindow, marker , google map
            changeMap(response){
                $('.select').removeClass('select');
                $('#searchMap').addClass('select');
                $('#showSearchMap').removeClass('select');
                $('#filter').removeClass('select');
                this.cities = response.data.city
                this.getCity = response.data.getCity
                this.getTownships = response.data.getTownships
                this.specialfeature = response.data.specialfeature;
                this.special_features = response.data.special_features
                this.fac_types = response.data.fac_types
                this.medical_acceptance = response.data.medical_acceptance
                this.nus_data = response.data.nursing
                if(this.nus_data.length != 0){
                    this.norecord_msg = false;
                }else{
                    this.norecord_msg = true;
                }
                if(this.nus_data.length > this.size) {
                  this.show_paginate = true;
                }else{
                  this.show_paginate = false;
                }
                this.markers = response.data.nursing;

                var mmarker = new Array();
                var item = [];
                for (var i = 0; i < this.markers.length; i++) {
                    mmarker.push([this.markers[i]['alphabet'], this.markers[i]['lat'], this.markers[i]['lng']])
                    item.push(this.markers[i])
                }

                if(this.getCity.length > 0) //if city  choose
                {
                    const theCity = response.data.getCity[0]['city_eng']
                    const lat = response.data.getCity[0]['latitude']
                    const lng = response.data.getCity[0]['longitude']

                    if(this.markers.length > 0 )
                    {
                        this.coordinates(theCity,lat,lng);
                        this.infoWindow(item, mmarker);
                    }
                    else{
                        this.coordinates(theCity,lat,lng);
                    }
                }
                else{ //if city not choose
                    this.coordinates(null,'38.25759','140.8667');
                    this.infoWindow(item, mmarker);
                }               
            },


            search(){

                if(this.townshipID == null || this.townshipID == '')
                {
                this.townshipID[0] = 0;
                }
                if(this.SpecialFeatureID == null || this.SpecialFeatureID == '')
                {
                this.SpecialFeatureID[0] = 0;
                }
                if(this.MedicalAcceptanceID == null || this.MedicalAcceptanceID == '')
                {
                this.MedicalAcceptanceID[0] = 0;
                }
                if(this.FacTypeID == null || this.FacTypeID == '')
                {
                this.FacTypeID[0] = 0;
                }
                if(this.MoveID == null || this.MoveID == '')
                {
                this.MoveID[0] = 0;
                }
                if(this.onchangeid == 1)
                {

                    if(this.township_id == -1)
                    {
                        this.townshipID[0] = 0;
                    }
                    else{
                        this.townshipID[0] = this.township_id;
                        this.township_id = -1;
                    }
                }
                else{

                    this.township_id = -1;
                }

                this.moving_in = -1;
                this.per_month = -1;

                if ($('#search-free-word').val() != '')
                {
                    this.id = -1;
  
                    var search_word = $('#search-free-word').val();
                }


                if(localStorage.getItem("nursing_fav") == null){

                    this.locast = 0;
                }
                else{
                    this.locast = localStorage.getItem("nursing_fav");
                }


                this.axios.get('api/getnursingsearch/'+search_word,{
                params:{
                    id: this.id,
                    townshipID:this.townshipID,
                    SpecialFeatureID:this.SpecialFeatureID,
                    MedicalAcceptanceID:this.MedicalAcceptanceID,
                    FacTypeID:this.FacTypeID,
                    MoveID:this.MoveID,
                    Moving_in:this.moving_in,
                    Per_month:this.per_month,
                    local:this.locast

                },
                }).then((response)=>{
                   

                this.nus_data = response.data.nursing;
                this.specialfeature = response.data.specialfeature;
                this.medicalacceptance = response.data.medicalacceptance;
                this.factype = response.data.factype;
                this.searchmarkers = response.data.nursing;
                this.citylatlng = response.data.getCity;
                this.markers = response.data.nursing;
                var mmarker = new Array()
                var item = []
                if(this.nus_data.length > 0){
                   

                    for (var i = 0; i < this.searchmarkers.length; i++) {
                        mmarker.push([this.searchmarkers[i]['alphabet'], this.searchmarkers[i]['lat'], this.searchmarkers[i]['lng']])
                        item.push(this.searchmarkers[i])
                    }
                    const theCity = this.searchmarkers[0]['city_eng']
                    const lat = this.searchmarkers[0]['lat']
                    const lng = this.searchmarkers[0]['lng']

                    // google map
                 
                    this.coordinates(theCity,lat,lng)

                    this.infoWindow(item, mmarker);
                    this.norecord_msg = false;
                }
                else{
                   
                    //if choose city
                    if(this.citylatlng.length > 0)
                    {
                       
                        const theCity = this.citylatlng[0]['city_eng']
                        const lat = this.citylatlng[0]['latitude']
                        const lng = this.citylatlng[0]['longitude']

                        this.coordinates(theCity,lat,lng);
                    }
                    else{
                        console.log('dd');
                   
                        var mapProp = {
                        center: new google.maps.LatLng(35.6804, 139.7690),
                        zoom: 5,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        };
                        this.map = new google.maps.Map(document.getElementById("mymap"), mapProp);
                    }
                    this.norecord_msg = true;
                }
                if (this.nus_data > this.size){
                this.show_paginate = true;
              }else {
                this.show_paginate = false;
              }
                });
            },

            // hover animate function
            mouseover(index) {
                for (let i = 0; i < this.markerHover.length; i++) {
                    if(this.markers[i]['alphabet'] == index)
                    {
                    this.markerHover[i].setAnimation(google.maps.Animation.BOUNCE);
                    }
                }
            },

            mouseleave(index){
                for (let i = 0; i < this.markerHover.length; i++) {
                    if(this.markers[i]['alphabet'] == index)
                    {
                    this.markerHover[i].setAnimation(null);
                    }
                }
            },

            features(e) {
                if (e.target.checked) {

                }
            },

            getStateHover(e) {
                // if(e.target.tagName ==='AREA'){
                //  console.log(e)
                // }
            },

            imgUrlAlt(event) {
                event.target.src = "images/noimage.jpg"
            },
            
            favAddFun(status,index,ind){    
                if(status == 'add'){
                    this.nus_data[ind].fav_check = 'check';

                    if(localStorage.getItem("nursing_fav")){
                        var fav_arr = JSON.parse("[" + localStorage.getItem("nursing_fav") + "]");
                        fav_arr.push(index);
                        fav_arr = [...new Set(fav_arr)];
                        localStorage.setItem("nursing_fav", fav_arr);
                        // $("#nus-fav-local").html(fav_arr.length);
                        this.nusFav = fav_arr.length;
                    }
                    else{
                        var fav_arr = [index];
                        localStorage.setItem("nursing_fav", fav_arr);
                        // $("#nus-fav-local").html(fav_arr.length);
                        this.nusFav = fav_arr.length;
                    }
                    
                    $(".fav-nursing-link-box>a").css({'cursor':'pointer','pointer-events':'auto'});
                }
                else{
                    //  alert(status);
                    this.nus_data[ind].fav_check = '';

                    var fav_arr = JSON.parse("[" + localStorage.getItem("nursing_fav") + "]");
                    var index = fav_arr.indexOf(index);
                    if (index > -1) {
                        fav_arr.splice(index, 1);
                        localStorage.setItem("nursing_fav", fav_arr);
                    }
                    // $("#nus-fav-local").html(fav_arr.length);
                    this.nusFav = fav_arr.length;

                    if(fav_arr.length == 0){
                        $(".fav-nursing-link-box>a").css({'cursor':'not-allowed','pointer-events':'none'})
                    }
                    else{
                        $(".fav-nursing-link-box>a").css({'cursor':'pointer','pointer-events':'auto'})
                    }

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

            toggleContent() {
                this.toggleCheck = !this.toggleCheck;
                if (this.toggleCheck == true) {
                $('#close').empty();
                $("#toBeToggled").slideDown();
                $('#close').append('<i class="fas fa-arrow-circle-up"></i> 市区町村エリアを閉じる');

                } else {
                $('#close').empty();
                $("#toBeToggled").slideUp();
                $('#close').append('<i class="fas fa-arrow-circle-down"></i> 市区町村エリアを開く');
                }
            },

            ChangeTownship(){
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
                        feature:'nursing'
                    },
                })
                .then((response) => {
                    $('.hospitalselect').removeClass('hospitalselect');
                    this.cities = response.data.city
                    this.getCity = response.data.getCity
                    this.getTownships = response.data.getTownships
                    this.special_features = response.data.special_features
                    this.subjects = response.data.subjects;
                    //   this.sub_child = response.data.sub_child;
                    //console.log("aaa",this.subjects);
                    // this.id = id;
                })
                    this.search();
            },
        }
  };
</script>

<style scoped>
.lds-ripple {
  /* display: inline-block;
  position: absolute;
  width: 80px;
  height: 80px;
  top: 40%;
  left: 50%;
  z-index: 1; */
  position: absolute;
  width: 100% !important;
  height: 500px !important;

}
.lds-ripple > div {
  display: flex;
  position: absolute;
  width: 100%;
  height: 100%;
  justify-content: center;
  align-items: center;
   z-index: 999;
}
.lds-ripple > div  div{
  position: absolute;
  border: 4px solid #fff;
  opacity: 1;
  border-radius: 50%;
  z-index: 999;
  animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
}
.lds-ripple > div div:nth-child(2) {
  animation-delay: -0.5s;
}
@keyframes lds-ripple {
  0% {
    width: 0;
    height: 0;
    opacity: 1;
  }
  100% {
    width: 72px;
    height: 72px;
    opacity: 0;
  }
}

.overlay{
  /* position: relative;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.19);
  opacity: 0.1; */
  top: 0;
  background-color: rgba(0, 0, 0, 0.19);
  position: absolute;
  background: #000;
  width: 100%;
  height: 500px;
}

  .path {
    cursor: pointer;
  }

  .selected {
    fill: #5c5959;
    stroke: #111;
    stroke-width: 2px;
    stroke-linejoin: round;
    color: #f27a24 !important;
    font-weight: bold;
  }

  .path {
    -moz-transition-property: opacity;
    -o-transition-property: opacity;
    -webkit-transition-property: opacity;
    transition-property: opacity;
    -moz-transition-duration: 0.5s;
    -o-transition-duration: 0.5s;
    -webkit-transition-duration: 0.5s;
    transition-duration: 0.5s;
    -moz-transition-timing-function: ease;
    -o-transition-timing-function: ease;
    -webkit-transition-timing-function: ease;
    transition-timing-function: ease;
    -moz-transition: fill 0.75s;
    -o-transition: fill 0.75s;
    -webkit-transition: fill 0.75s;
    transition: fill 0.75s;
  }

  .path:hover,
  .path:focus {
    cursor: pointer;
  }

  .path:hover,
  .path:hover .path,
  .path:focus,
  .path:focus .path {
    color: #000;
  }

  .path:hover,
  a:hover {
    fill: #20487c !important;
    stroke: #002868 !important;
    stroke-width: 2px;
    stroke-linejoin: round;
    cursor: pointer;
  }

  .select {
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


  .left-div {
    background-color: #e8e7e7;
    text-align: right;
    width: 140px;
    padding: 25px;
  }

  .left-div-1 {
    background-color: #e8e7e7;
    text-align: right;
    width: 140px;
    padding: 25px;
  }

  .left-div-2 {
    background-color: #e8e7e7;
    text-align: right;
    width: 140px;
    padding: 25px;

  }
  .toBeToggled {
    display: block;
  }

  .toBeToggled2 {
    display: block;
  }

  .toBeToggled1 {
    display: none;
  }

  .table th,
  .table td {
    border-top: none !important;
  }

  table>tbody>tr th {
    background-color: #eeeeee94;
    width: 140px;
    padding: 25px;
  }

  label {
    color: black !important;
  }

  .vue-map-container {
    height: 640px;
  }


  .justBlock {
    width: 100px;
    height: 100px;
    line-height: 100px;
    text-align: center;
    background-color: #bada55;
    color: darkgreen;
    font-family: sans-serif;
    /* &:hover {
    cursor:pointer;
  } */
  }

  #mymap {
    width: 100%;
    /* height: 500px; */
  }

div#holder {
    position: absolute;
}

.hidden {
    display: none;
}

/* div.overlay {
    position: relative;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: #5e5e5e;
    opacity: 0.7;
    z-index: 1;
} */

/* div.overlay.standard { background: #fff url('/images/google/loading.jpg') no-repeat 50% 50%; } */

  .card_1 {
    display: inline-block;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, .15);
    margin: 20px;
    position: relative;
    /* margin-bottom: 50px; */
    transition: all .2s ease-in-out;
  }

  .card_1:hover {
    /*box-shadow: 0 5px 22px 0 rgba(0,0,0,.25);*/
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
    /* margin-bottom: 54px; */
  }

  .image {
    height: 200px;
    opacity: .7;
    overflow: hidden;
    transition: all .2s ease-in-out;
  }

  .image:hover,
  .card_1:hover .image {
    height: 200px;
    opacity: 1;
  }

  .text {
    background: #FFF;
    padding: 20px;
    min-height: 200px;
  }

  .text p {
    margin-bottom: 0px;
  }

  .fab {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    position: absolute;
    margin-top: -50px;
    right: 20px;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, .3);
    color: #fff;
    font-size: 48px;
    line-height: 48px;
    text-align: center;
    background: #0066A2;
    -webkit-transition: -webkit-transform .2s ease-in-out;
    transition: transform .2s ease-in-out;
  }

  .fab:hover {
    background: #549D3C;
    cursor: pointer;
    -ms-transform: rotate(90deg);
    -webkit-transform: rotate(90deg);
    transform: rotate(90deg);
  }
    #nursing-search{
      display: none;
    }

  #nursing-search .card-carousel-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 20px 0;
    color: #666a73;
  }

  #nursing-search .card-carousel {
    display: flex;
    justify-content: center;
    width: 1320px;
    overflow:auto;
  }

  #nursing-search .card-carousel--overflow-container {
    overflow: hidden;
    /* width: 992px; */
    /* background: grey;  */
  }

  #nursing-search .card-carousel--nav__left,
  #nursing-search .card-carousel--nav__right {
    display: inline-block;
    width: 15px;
    height: 15px;
    padding: 5px;
    box-sizing: border-box;
    border-top: 5px solid #ff9563;
    border-right: 5px solid #ff9563;
    margin: 4px 0px;
    transition: transform 150ms linear;
  }

  #nursing-search .card-carousel--nav__left[disabled],
  #nursing-search .card-carousel--nav__right[disabled] {
    opacity: 0.2;
    border-color: black;
  }

  #nursing-search .card-carousel--nav__left {
    transform: rotate(-135deg);
  }

  #nursing-search .card-carousel--nav__left:active {
    transform: rotate(-135deg) scale(0.9);
  }

  #nursing-search .card-carousel--nav__right {
    transform: rotate(45deg);
  }

  #nursing-search .card-carousel--nav__right:active {
    transform: rotate(45deg) scale(0.9);
  }

  #nursing-search .card-carousel-cards {
    display: flex;
    transition: transform 150ms ease-out;
    transform: translatex(0px);
  }

  #nursing-search .card-carousel-cards .card-carousel--card {
    /* margin: 0 10px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
    background-color: #fff;
    border-radius: 4px;
    z-index: 3;
    margin-bottom: 2px;
    transition: all 0.3s cubic-bezier(.25,.8,.25,1); */
  }

  #nursing-search .card-carousel-cards .card-carousel--card:hover {
    /* box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22); */

  }

  #nursing-search .card-carousel-cards .card-carousel--card:first-child {
    margin-left: 0;
  }

  #nursing-search .card-carousel-cards .card-carousel--card:last-child {
    margin-right: 0;
  }


  #nursing-search .card-carousel-cards .card-carousel--card img:hover {
    opacity: 0.5;
  }

  #nursing-search .card-carousel-cards .card-carousel--card--footer {
    border-top: 0;
    padding: 7px 15px;
  }

  #nursing-search .card-carousel-cards .card-carousel--card--footer p {
    padding: 3px 0;
    margin: 0;
    margin-bottom: 2px;
    font-size: 19px;
    font-weight: 500;
    color: #2c3e50;
    user-select: none;
  }

  #nursing-search .card-carousel-cards .card-carousel--card--footer p:nth-of-type(2) {
    font-size: 12px;
    font-weight: 300;
    padding: 6px;
    background: rgba(40, 44, 53, 0.06);
    display: inline-block;
    position: relative;
    margin-left: 4px;
    color: #666a73;
  }

  #nursing-search .card-carousel-cards .card-carousel--card--footer p:nth-of-type(2):before {
    content: "";
    float: left;
    position: absolute;
    top: 0;
    left: -12px;
    width: 0;
    height: 0;
    border-color: transparent rgba(40, 44, 53, 0.06) transparent transparent;
    border-style: solid;
    border-width: 12px 12px 12px 0;
  }

 #nursing-search .card-carousel-cards .card-carousel--card--footer p:nth-of-type(2):after {
    content: "";
    position: absolute;
    top: 10px;
    left: -1px;
    float: left;
    width: 4px;
    height: 4px;
    border-radius: 2px;
    background: white;
    box-shadow: -0px -0px 0px #004977;
}
#nursing-search .nav-box[disabled] .card-carousel--nav__left,
#nursing-search .nav-box[disabled] .card-carousel--nav__right {
    border-top: 5px solid #000;
    border-right: 5px solid #000;
}
#nursing-search .nav-box[disabled] .nav-content {
    border: 2px solid #000;
    background: #fff
}

.nav-content {
    width: 40px;
    height: 40px;
    line-height: 50px;
    vertical-align: middle;
    background: #fffff4;
    border: 2px solid #ff9563;
    border-radius: 50%;
    text-align: center;
}
.fav-profile {
    top:0px;
    right:15px;
}
.nursing-tabColor .nav-link {
    background: #ff9563 !important;
    color: #fff;
    border-right: 1px solid #fff;
}

.nursing-borderColor {
    border: 1px solid #ff9563 !important;
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
.carousel-img{   
    position: absolute;
  }

@media only screen and (max-width: 360px)  {
   #nursing-search .card-carousel {
        width: 200px!important;
    }
     #nursing-search .card-carousel{
      overflow: visible;
    }
    .nav-content
    {
     
      border: none;
      width: 0px;
    }
    #nursing-search .nav-box[disabled] .nav-content {
    border:none;
    background: #fff;
}
    
}

@media only screen and (max-width: 375px) {
   #nursing-search .card-carousel {
        width: 278px!important;
    }
    #nursing-search .card-carousel{
      overflow: visible;
    }
    .nav-content
    {
     
      border: none;
      width: 0px;
    }
    #nursing-search .nav-box[disabled] .nav-content {
    border:none;
    background: #fff;
}
 #nursing-search .card-carousel--nav__left,
 #nursing-search .card-carousel--nav__right {
    margin-left:-7px;
  }
}




@media only screen and (max-width: 450px) {
   #nursing-search .card-carousel {
        width: 280px !important;
    }
     #nursing-search .card-carousel{
      overflow: visible;
    }
    .nav-content
    {
     
      border: none;
      width: 0px;
    }
    #nursing-search .nav-box[disabled] .nav-content {
    border:none;
    background: #fff;

}
 #nursing-search .card-carousel--nav__left,
 #nursing-search .card-carousel--nav__right {
    margin-left:-7px;
  }
  .carousel-img{
    width: 100px;   
  }
}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (max-width: 1023px) and (min-width: 768px) {
   #nursing-search .card-carousel {
        width: 415px!important;
    }
    .carousel-img{
      width: 140px;     
    }
}
@media only screen and (max-width: 768px) and (min-width: 449px) {
   #nursing-search .card-carousel {
        width: 279px!important;
    }
}
@media only screen and (max-width: 992px) and (min-width: 768px) {
   #nursing-search .card-carousel {
        width: 342px!important;
    }
           .wd-in {
    width: 320px;
}
}
/* Large devices (laptops/desktops, 992px and up) */
/* @media only screen and (max-width: 1024px) and (min-width: 992px) {
   #nursing-search .card-carousel {
        width: 823px!important;
    }
        .wd-in {
    width: 381px;
}
} */

@media only screen and (max-width: 1020px) and (min-width: 992px) {
   #nursing-search .card-carousel {
        width: 823px!important;
    }
        .wd-in {
    width: 377px;
}
}
@media only screen and (max-width: 1200px) and (min-width: 1024px) {
   #nursing-search .card-carousel {
        width: 827px!important;
    }
    .wd-in {
    width: 391px;
}
}

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (max-width: 1440px) and (min-width: 1201px) {
    #nursing-search .card-carousel {
        /* width: 988px!important; */
        width: 988px!important;
    }
    .wd-in {
    width: 308px;
}
}
@media only screen and (max-width: 1880px) and (min-width: 1440px) {
     #nursing-search .card-carousel {
        width: 1033px!important;
    }
    .wd-in {
        width: 323px;
    }
}
</style>
