<template>
    <div class="page-content login-cover">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login form -->
				 <el-form :model="login" ref="login">
						<div class="tab-content card-body">
							<div>
								<div class="text-center mb-3">
									<img :src="url.assets+'/images/logo.png'" width="80px">
									<h5 class="mb-0">SIJEMPOL</h5>
									<span class="d-block text-muted">2020</span>
								</div>
                                <el-form-item 
                                    prop="username"
                                    :rules="{ required: true, message: 'field tidak boleh kosong', trigger: 'blur' }">
                                    <el-input
                                        placeholder="Username"
                                        prefix-icon="icon-user"
                                        v-model="login.username"
                                        :autofocus="true"
                                        @keyup.enter.native="Submit()"
                                        clearable>
                                    </el-input>
                                </el-form-item>

                                <el-form-item 
                                    prop="password"
                                    :rules="{ required: true, message: 'field tidak boleh kosong', trigger: 'blur' }">
                                    <el-input
                                        placeholder="password"
                                        prefix-icon="icon-lock2"
                                        v-model="login.password"
                                        type="password"
                                        @keyup.enter.native="Submit()"
                                        clearable>
                                    </el-input>
                                </el-form-item>
								
								<div class="form-group pull-right">
                                    <div style="width:100% !important">
									    <el-button type="primary" :loading="isLoading" width="100%" @click="Submit()">Login</el-button>
                                    </div>
								</div>
								<span class="form-text text-center text-muted">
                                    Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu Provinsi Kepulauan Riau
                                </span>
							</div>
						</div>
				</el-form>
			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->
</template>

<script>
import urlBase from '@/js/url'
export default {
    
    data(){
        return{
            url:{
               assets : urlBase.urlWeb+'/public',
            },
            isLoading : false,
            login:{
                username : null,
                password : null
            }
            
        }
    },
    mounted() {
        window.history.forward(1)
        console.log('login mounted.')
        this.$parent.$data.activeShow = false;
    },
    methods:{
        notif(s,m,type){
            this.$notify({
                title: s,
                message: m,
                type: type
            });
        },
        redirect(){
            // this.$parent.$data.activeShow = true;
            window.location.href = urlBase.urlWeb+'/dashboard';
            
        },
        Submit(){
             this.$refs['login'].validate((valid) => {
                if (valid) {
                   this.isLoading = true
                   axios
                    .post(urlBase.urlWeb+'/login/submitform',{
                        login : this.login,
                    })
                    .then(r => {
                        console.log(r.data),
                        this.isLoading = false,
                        r.data.code === '500' ? this.notif(r.data.title, r.data.message, r.data.type) : this.redirect()
                    });
                } 
                else {
                    console.log('error submit!!');
                    return false;
                }
            });
        }
    },
}
</script>
