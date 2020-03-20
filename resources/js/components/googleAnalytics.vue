<template>

    <div>
        <div class="row">

            <div class="form-group">
                <label for="">Start Date</label>
                <date-picker class="box date-of-establishment" valueType="format" v-model="analytics.startDate"></date-picker>
            </div>
            <div class="form-group">
                <label for="">End Date</label>
                <date-picker class="box date-of-establishment" v-model="analytics.endDate" valueType="format"></date-picker>
                <button class="btn btn-sm btn-outline-primary" @click="analyticsReport()">Search Report</button>
            </div>
            
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="card-title">
                            eventReport
                            </div>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>avgSessionDuration</th>
                                        <th>deviceCategory</th>
                                        <th>eventAction</th>
                                        <th>eventCategory</th>
                                        <th>eventLabel</th>
                                        <th>pageviewsPerSession</th>
                                        <th>sessions</th>
                                        <th>totalEvents</th>
                                        <th>uniqueEvents</th>
                                        <th>users</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="report in eventReport" >
                                        <th>{{report.avgSessionDuration}}</th>
                                        <th>{{report.deviceCategory}}</th>
                                        <th>{{report.eventAction}}</th>
                                        <th>{{report.eventCategory}}</th>
                                        <th>{{report.eventLabel}}</th>
                                        <th>{{report.pageviewsPerSession}}</th>
                                        <th>{{report.sessions}}</th>
                                        <th>{{report.totalEvents}}</th>
                                        <th>{{report.uniqueEvents}}</th>
                                        <th>{{report.users}}</th>
                                    </tr>
                                </tbody>
                            </table>
                         </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="card-title">
                            browser
                            </div>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>browser</th>
                                        <th>session</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="browser in browser" >
                                        <th>{{browser.browser}}</th>
                                        <th>{{browser.sessions}}</th>
                                       
                                    </tr>
                                </tbody>
                            </table>
                         </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="card-title">
                            mostVisitedPages
                            </div>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>url</th>
                                        <th>pageTitle</th>
                                        <th>pageViews</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="mostVisited in mostVisitedPages">
                                        <th>{{mostVisited.url}}</th>
                                        <th>{{mostVisited.pageTitle}}</th>
                                        <th>{{mostVisited.pageViews}}</th>
                                       
                                    </tr>
                                </tbody>
                            </table>
                         </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="card-title">
                                active visitor
                            </div>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>date</th>
                                        <th>visitors</th>
                                        <th>pageViewsCount</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="visitor in visitors">
                                        <th>{{visitor.date}}</th>
                                        <th>{{visitor.visitors}}</th>
                                        <th>{{visitor.pageViews}}</th>
                                       
                                    </tr>
                                </tbody>
                            </table>
                         </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="card-title">
                                total visitors
                            </div>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>date</th>
                                        <th>visitors</th>
                                        <th>pageViewsCount</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="visitors in total_visitors" >
                                        <th>{{visitors.date}}</th>
                                        <th>{{visitors.visitors}}</th>
                                        <th>{{visitors.pageViews}}</th>
                                       
                                    </tr>
                                </tbody>
                            </table>
                         </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="card-title">
                                User Info
                            </div>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>browser</th>
                                        <th>browserVersion</th>
                                        <th>deviceCategory</th>
                                        <th>country</th>
                                        <th>region</th>
                                        <th>city</th>
                                        <th>users</th>
                                        <th>uniquePageviews</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="custormReport in custormReport">
                                        <th>{{custormReport.browser}}</th>
                                        <th>{{custormReport.browserVersion}}</th>
                                        <th>{{custormReport.deviceCategory}}</th>
                                        <th>{{custormReport.country}}</th>
                                        <th>{{custormReport.region}}</th>
                                        <th>{{custormReport.city}}</th>
                                        <th>{{custormReport.users}}</th>
                                        <th>{{custormReport.uniquePageviews}}</th>
                                       
                                       
                                    </tr>
                                </tbody>
                            </table>
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
            lang:{
                days: ['日', '月', '火', '水', '木', '金', '土'],
                months: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
                placeholder: {
                date: new Date().toISOString().slice(0,10),
                },
                
            },
            analytics:{
                startDate:'',
                endDate:''
            },
               
            eventReport:[],
            browser:[],
            mostVisitedPages:[],
            visitors:[],
            total_visitors:[],
            top_referrers:[],
            custormReport:[]



            
        } //return 
    },
    
    methods: {
        analyticsReport:function(){
          
            this.$loading(true)
            this.axios.post(`api/analytics`,this.analytics).then(res => {
                this.$loading(false)
            
                this.eventReport      = res.data.eventReport;
                this.browser          = res.data.browser;
                this.mostVisitedPages = res.data.mostVisitedPages;
                this.visitors         = res.data.visitors;
                this.total_visitors   = res.data.total_visitors;
                this.top_referrers    = res.data.top_referrers;
                this.custormReport    = res.data.custormReport; 
                // console.log('eventReport',this.eventReport,
                //             'browser',this.browser,
                //             'mostVisitedRages',this.mostVisitedPages,
                //             'visitor',this.visitor,
                //             'total_visitor',this.total_visitors,
                //             'top_referrers',this.top_referrers)
            })
        }

    }, // methods



    
}
</script>