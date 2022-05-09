require('./bootstrap');
window.Vue = require('vue').default;

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import LogoutComponent from './components/LogoutComponent.vue';
import MealDetailComponent from './components/MealDetailComponent.vue';
import DeleteRecordComponent from './components/DeleteRecordComponent.vue';
import DeletePictureComponent from './components/DeletePictureComponent.vue';



const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

app.component('logout-component', LogoutComponent);
app.component('meal-detail-component', MealDetailComponent);
app.component('delete-record-component', DeleteRecordComponent);
app.component('delete-picture-component', DeletePictureComponent);


InertiaProgress.init({ color: '#4B5563' });

const app = createApp({})
app.mount('#app')