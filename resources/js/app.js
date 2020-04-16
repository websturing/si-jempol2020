import './bootstrap';
import Vue from 'vue';
import Routes from '@/js/routes.js';
import navbar from '@/js/components/template/navbar'

import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en'
import 'element-ui/lib/theme-chalk/index.css';
import VueTheMask from 'vue-the-mask'
import Sticky from 'vue-sticky-directive'


//Import Froala Editor 
import 'froala-editor/js/plugins.pkgd.min.js';
//Import third party plugins
import 'froala-editor/js/third_party/embedly.min';
import 'froala-editor/js/third_party/font_awesome.min';
import 'froala-editor/js/third_party/spell_checker.min';
import 'froala-editor/js/third_party/image_tui.min';
// Import Froala Editor css files.
import 'froala-editor/css/froala_editor.pkgd.min.css';

// Import and use Vue Froala lib.
import VueFroala from 'vue-froala-wysiwyg'
Vue.use(VueFroala)
Vue.config.productionTip = false
Vue.use(VueTheMask)
Vue.use(ElementUI, { locale });
Vue.use(Sticky)
const app = new Vue({
    el: '#app',
    router: Routes,
    data: {
        activeLink: "active",
        activeName: "active",
        activeShow: true,
    },
    components: {
        navbar
    },
});