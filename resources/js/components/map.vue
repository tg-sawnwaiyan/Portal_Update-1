<template>
    <div>
        <div class="divisions row " id="divisionswrap">
            <img src="/images/img_map1.png" alt="map" class="img-fluid" style="margin:0 auto;">
            <div class="col-sm-2 hokkaido-box">
                <div class="mb-3">
                <div class="division-box">
                    <ul class="hokkaido-wrap">
                    <a data-info="Hokkaido" class="path Hokkaido card-text" @click="getStateClick($event)">
                        <li class="spanclass" id="1"  @click="selected = 1" :class="{highlight:selected == 1}">北海道</li>
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
                        <li class="spanclass" id="3" @click="selected = 3" :class="{highlight:selected == 3}" >岩手</li>
                    </a>

                    <a data-info="Akita" class="path Akita card-text" @click="getStateClick">
                        <li class="spanclass" id="5" @click="selected = 5" :class="{highlight:selected == 5}">秋田</li>
                    </a>

                    <a data-info="Miyagi" class="path Miyagi card-text" @click="getStateClick">
                        <li class="spanclass" id="4" @click="selected = 4" :class="{highlight:selected == 4}">宮城</li>
                    </a>

                    <a data-info="Yamagata" class="path Yamagata card-text" @click="getStateClick">
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
                        <li class="spanclass" id="8" @click="selected = 8" :class="{highlight:selected == 8}">茨城</li>
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
                            <li class="spanclass" id="33" @click="selected = 33" :class="{highlight:selected == 33}"> 岡山</li>
                    </a>

                    <a data-info="Hiroshima" class="path Hiroshima card-text" @click="getStateClick">
                        <li class="spanclass" id="34"  @click="selected = 34" :class="{highlight:selected == 34}" >広島</li>
                    </a>

                    <a data-info="Yamaguchi" class="path Yamaguchi card-text" @click="getStateClick">
                        <li class="spanclass" id="35"  @click="selected = 35" :class="{highlight:selected == 35}">山口</li>
                    </a>

                    <a data-info="Shimane" class="path Shimane card-text" @click="getStateClick">
                        <li class="spanclass" id="32"  @click="selected = 32" :class="{highlight:selected == 32}">島根</li>
                    </a>

                    <a data-info="Tottori" class="path Tottori card-text" @click="getStateClick">
                        <li class="spanclass"  id="31"  @click="selected = 31" :class="{highlight:selected == 31}">鳥取</li>
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
                        <li class="spanclass" id="37"  @click="selected = 37" :class="{highlight:selected == 37}">香川</li>
                    </a>

                    <a data-info="Kochi" class="path Kochi card-text" @click="getStateClick">
                        <li class="spanclass" id="39"  @click="selected = 39" :class="{highlight:selected == 39}">高知</li>
                    </a>

                    <a data-info="Ehime" class="path Ehime card-text" @click="getStateClick">
                        <li class="spanclass" id="38"  @click="selected = 38" :class="{highlight:selected == 38}">愛媛</li>
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
                        <li class="spanclass" id="40"  @click="selected = 40" :class="{highlight:selected == 40}">福岡</li>
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
        <section id="map-responsive">
            <bulma-accordion :icon="'custom'" >
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
    </div>
    
</template>

<script>
    export default {
        data() {
            return {
                
            };
        },
        methods: {
            getStateClick(e){
                this.$parent.$options.parent.$options.methods.parentGetStateClick(e,this.$parent.$options.parent);
            }
        }
    };
</script>
