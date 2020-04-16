<template>
    <div>

        <el-row>
             <el-col :span="24">
                <div class="sub-title">Cari Data Perizinan / Nonperizinan</div>
                <el-autocomplete
                class="wide-dropdown"
                v-model="state2"
                :fetch-suggestions="querySearch"
                placeholder="Please Input"
                :trigger-on-focus="false"
                @select="handleSelect"
                ></el-autocomplete>
            </el-col>
        </el-row>
        <br/>
        <el-row :gutter="5">
            <el-col :span="8">
                <el-card class="box-card" shadow="never">
                    <el-row :gutter="20">
                        <el-col :span="5">
                            <img :src="url.assets+'/icon/checklist.png'" class="img-fluid">
                        </el-col>
                        <el-col :span="18">
                            <h1>DATA PERMOHONAN</h1>
                        </el-col>
                    </el-row>
                    <el-divider content-position="right">aktifitas terakhir</el-divider>
                    afriandi
                </el-card>
            </el-col>
            <el-col :span="8">
                <el-card class="box-card" shadow="never">
                    <el-row :gutter="20">
                        <el-col :span="5">
                            <img :src="url.assets+'/icon/contract.png'" class="img-fluid">
                        </el-col>
                        <el-col :span="18">
                            <h1>SURAT KEPUTUSAN</h1>
                        </el-col>
                    </el-row>
                    <el-divider content-position="right">aktifitas terakhir</el-divider>
                    afriandi
                </el-card>
            </el-col>
            <el-col :span="8">
                    <el-card class="box-card" shadow="never">
                        <el-row :gutter="20">
                            <el-col :span="5">
                                <img :src="url.assets+'/icon/track.png'" class="img-fluid">
                            </el-col>
                            <el-col :span="18">
                                <h1>TRACKING DATA</h1>
                            </el-col>
                        </el-row>
                    <el-divider content-position="right">aktifitas terakhir</el-divider>
                    afriandi
                </el-card>
            </el-col>
        </el-row>
    </div>
</template>

<script>
import urlBase from '@/js/url'
import navbar from '@/js/components/template/navbar';

export default {
    data(){
        return{
            url:{
                assets : urlBase.urlWeb+'/public',
            },
            state2 : '',
            links : '',

        }
    },
    mounted() {
        console.log('Component mounted.')
        this.$parent.$data.activeLink = 'dashboard';
        this.$parent.$data.activeName = 'Dashboard';
        // this.links = this.loadAll();
        this.GetNamaizin()
    },
    methods:{
        querySearch(queryString, cb) {
            var links = this.links;
            var results = queryString ? links.filter(this.createFilter(queryString)) : links;
            // call callback function to return suggestions
            cb(results);
        },
        createFilter(queryString) {
            return (a) => {
            return (a.value.toLowerCase().indexOf(queryString.toLowerCase()) > -1);
            };
        },
        loadAll() {
            return [
                { "value": "vue", "link": "https://github.com/vuejs/vue" },
                { "value": "element", "link": "https://github.com/ElemeFE/element" },
                { "value": "cooking", "link": "https://github.com/ElemeFE/cooking" },
                { "value": "mint-ui", "link": "https://github.com/ElemeFE/mint-ui" },
                { "value": "vuex", "link": "https://github.com/vuejs/vuex" },
                { "value": "vue-router", "link": "https://github.com/vuejs/vue-router" },
                { "value": "babel", "link": "https://github.com/babel/babel" }
                ];
            },
            handleSelect(item) {
                console.log(item);
        },
        GetNamaizin(){
            axios
                .post(urlBase.urlWeb+'/opd/izin',{
                    type : "namaIzin",
                })
                .then(r => (
                    // console.log(r.data),
                    this.links = r.data
                ));
        }
    },
    components:{
        navbar
    }
}
</script>
<style scoped>
.wide-dropdown {
  width: 600px !important;
}
</style>