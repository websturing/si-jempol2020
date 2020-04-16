<template>
<div class="page-header page-header-dark">

            <!-- Main navbar -->
            <div class="navbar navbar-expand-md navbar-dark border-transparent">
                <div class="navbar-brand wmin-0 mr-5">
                    <a href="index.html" class="d-inline-block">
                    </a>
                </div>
            </div>
            <!-- /main navbar -->
    
    
            <!-- Page header content -->
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4>{{activeName}} <small class="font-size-base opacity-50">{{account}}</small></h4>
                    <a href="#" class="header-elements-toggle text-white d-md-none"><i class="icon-more"></i></a>
                </div>
    
                <div class="header-elements d-none bg-transparent py-0 border-0 mb-3 mb-md-0">
                    <form action="#">
                        <div class="form-group form-group-feedback form-group-feedback-right">
                            <input type="search" class="form-control bg-light-alpha border-transparent wmin-md-200" placeholder="Search">
                            <div class="form-control-feedback">
                                <i class="icon-search4 font-size-sm"></i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /page header content -->
    
    
            <!-- Secondary navbar -->
            <!-- /secondary navbar -->
			<div class="navbar navbar-expand-md navbar-dark navbar-sticky border-top-0">
			<div class="d-md-none w-100">
				<button type="button" class="navbar-toggler d-flex align-items-center w-100" data-toggle="collapse" data-target="#navbar-navigation">
					<i class="icon-menu-open mr-2"></i>
					Main navigation
				</button>
			</div>

			<div class="navbar-collapse collapse" id="navbar-navigation">
				<ul class="navbar-nav navbar-nav-highlight">
					<li class="nav-item" v-for="(m,mIndex) in menu" :index="m.modul.nama" :key="m.modul.nama" v-if="m.modul.type == 'main'">
						<router-link :to="{ name: m.modul.url}" class="navbar-nav-link" :class="{ active : (activeLink === m.modul.url)}" replace>
							<i :class="m.modul.icon"></i>
							{{m.modul.nama}}
						</router-link>
					</li>
					<li class="nav-item dropdown" v-for="(md,mIndex) in menu" :index="md.modul.nama" :key="md.modul.nama" v-if="md.modul.type == 'parent'">
						
						<a href="#" class="navbar-nav-link dropdown-toggle" :class="{ active : (activeLink === md.modul.url)}" data-toggle="dropdown">
							<i :class="md.modul.icon"></i>
							{{md.modul.nama}}
						</a>

						<div class="dropdown-menu">
							<router-link 
							v-for="(c,CIndex) in menu" :index="c.modul.nama" :key="c.modul.nama" v-if="c.modul.type == 'child' && c.modul.parent_id == md.modul.modul_id"
							:to="{ name: md.modul.url+'-'+c.modul.url}"  class="dropdown-item" :class="{ active : (activeLink === c.modul.nama)}" replace>
								<i :class="c.modul.icon"></i>
								{{c.modul.nama}}
							</router-link>
						</div>
						
					</li>
				</ul>

				<ul class="navbar-nav navbar-nav-highlight ml-md-auto">

					<li class="nav-item dropdown">
						<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
							<i class="icon-cog3"></i> &nbsp;&nbsp; {{account}}
							<span class="d-md-none ml-2">Settings</span>
						</a>

						<div class="dropdown-menu dropdown-menu-right">
							<a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
							<div class="dropdown-divider"></div>
							<a :href="url.logout" class="dropdown-item"><i class="icon-switch"></i>Log Out</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
        </div>
    
</template>


<script>
  import url from '@/js/url'
  export default {
    data() {
      return {
        menu : [],
        account : null,
        url : {
            logout : url.urlWeb+'/logout'
        }
      }
    },
    created(){
      this.GetData();
    },
    props:['activeLink','activeName'],
    methods: {
      handleSelect(key, keyPath) {
        console.log(key, keyPath);
      },
      GetData(){
        axios
        .post(url.urlWeb+'/master/acl',{
          type : 'navbar',
        })
        .then(r => {
          this.menu = r.data.menu
          this.account = r.data.account
        });
      }
    }
  }
</script>