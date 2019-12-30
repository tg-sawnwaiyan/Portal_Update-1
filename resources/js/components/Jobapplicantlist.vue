<template>
     <div class="row">
         <div class="col-12">
                <div class="container-fluid">
                     <h4 class="main-color m-b-10">求職者検索</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <input type="text" class="form-control" placeholder="検索" id="search-item"  />
                                        <input type="hidden" class="form-contrl" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <h5 class="header"> 求職者リスト</h5>
                        <div class="container-fuid">
                            <table class="table table-hover custom-table">
                                <thead style="background-color:rgb(183, 218, 210);">
                                    <tr>
                                         <th>姓</th>

                                        <th>名</th>

                                        <th>生年月日</th>

                                        <th>性別</th>

                                        <th>郵便番号</th>

                                        <th>街路住所</th>

                                        <th>自宅住所</th>

                                        <th>電話番号</th>

                                        <th>メールアドレス</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr  v-for="jobapply in jobapplies" :key="jobapply.id">

                                         <th>{{jobapply.first_name}}</th>

                                        <th>{{jobapply.last_name}}</th>

                                        <th>{{jobapply.birthday}}</th>

                                        <th>{{jobapply.gender}}</th>

                                        <th>{{jobapply.postal}}</th>

                                        <th>{{jobapply.street_address}}</th>

                                        <th>{{jobapply.home_address}}</th>

                                        <th>{{jobapply.phone}}</th>

                                        <th>{{jobapply.email}}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
         </div>
     </div>
</template>
<script>
export default {
   data() {

                return {

                    jobapplies: [],
                };

            },
              created() {
                     this.$loading(true);
                    this.axios.get(`/api/jobapplicantlist/`).then(response => {
                        this.$loading(false);
                        this.jobapplies = response.data;
                        console.log('job', this.jobapplies);
                    });
              }
}
</script>
