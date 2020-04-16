<template>
    <div class="row">
        <div class="col-md-12">
            <center>
                <img :src="notfound" class="img-fluid">
                <h3>Page Not Found</h3>
                <a class="btn btn-primary" :href="beranda">Kembali Ke Beranda</a>
            </center>

        </div>
    </div>
</template>

<script>
import urlBase from '@/js/url'
export default {
    
    data(){
        return{
            table :{
                data:[],
                isLoading : false,
                search : null
            },
            notfound : urlBase.urlWeb+'/public/images/error.png',
            beranda : urlBase.urlWeb+'/dashboard'
        }
    },
    mounted() {
        console.log('User Data mounted.')
        this.GetData()
        this.$parent.$data.activeShow = false;
    },
    watch: {
      filterText(val) {
        this.$refs.tree.filter(val);
      }
    },
    methods:{
        notif(s,m,type){
            this.$notify({
                title: s,
                message: m,
                type: type
            });
        },
        GetData(){
            this.table.isLoading = true
            this.table.data = []
            axios
                .post(urlBase.urlWeb+'/master/users',{
                    type : "dataAll"
                })
                .then(r => (
                    this.table.data = r.data,
                    this.table.isLoading = false,
                    console.log(this.table.data)
                ));
        },
        edit(index,row){
             axios
                .post(urlBase.urlWeb+'/master/aclGroup',{
                    type : "putsession",
                    aclGroup_id : row.aclGroup_id
                })
                .then(r => (
                    this.$emit('ChildFormUser',row)
                ));
        },
        deleteTable(index,row) {
            this.$confirm('hapus Data ini ?', 'Warning', {
            confirmButtonText: 'OK',
            cancelButtonText: 'Cancel',
            type: 'warning'
            }).then(() => {
                axios
                .post(urlBase.urlWeb+'/master/users',{
                    type : "hapus",
                    id : row.user_id
                })
                .then(r => (
                    this.GetData(),
                    this.notif(r.data.title, r.data.message,r.data.type)
                ));
            }).catch(() => {
                this.$message({
                    type: 'info',
                    message: 'Delete canceled'
                });          
            });
      }
    }
}
</script>
<style>
  .custom-tree-node {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 14px;
    padding-right: 8px;
  }
</style>