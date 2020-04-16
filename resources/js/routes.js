import Vue from 'vue';
import VueRouter from 'vue-router';

import urlBase from '@/js/url';
import Dashboard from '@/js/components/Dashboard';
import masterModul from '@/js/master/modul';
import masterAcl from '@/js/master/acl';
import masterUsers from '@/js/master/users/users';

import notfound404 from '@/js/master/404';

import perizinanPermohonanData from '@/js/components/perizinan/permohonan/data';
import perizinanPermohonanForm from '@/js/components/perizinan/permohonan/form';
import perizinanPermohonanDetail from '@/js/components/perizinan/permohonan/detail';
import perizinanperusahaan from '@/js/components/perizinan/perusahaan/perusahaan';

import login from '@/js/master/login';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    base: urlBase.urlBase,
    hash: false,
    routes: [{
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            meta: { disallowAuthed: true }
        },
        {
            path: '/modul',
            name: 'master-modul',
            component: masterModul
        },
        {
            path: '/master-acl',
            name: 'master-acl',
            component: masterAcl
        },
        {
            path: '/master-users',
            name: 'master-users',
            component: masterUsers
        },
        {
            path: '/perizinan-permohonan-form/:id',
            name: 'perizinan-permohonan-form',
            component: perizinanPermohonanForm
        },
        {
            path: '/perizinan-permohonanData',
            name: 'perizinan-permohonanData',
            component: perizinanPermohonanData
        },
        {
            path: '/perizinan-permohonanDetail/:id',
            name: 'perizinan-permohonanDetail',
            component: perizinanPermohonanDetail
        },
        {
            path: '/perizinan-perusahaan',
            name: 'perizinan-perusahaan',
            component: perizinanperusahaan
        },
        {
            path: '/login',
            name: 'login',
            component: login
        },


        {
            path: '*',
            name: '404',
            component: notfound404
        },
    ]
});

export default router;