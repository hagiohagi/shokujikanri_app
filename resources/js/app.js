require('./bootstrap');
window.Vue = require('vue').default;

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import MealDetailComponent from './components/MealDetailComponent.vue';
import MealEditComponent from './components/MealEditComponent.vue';

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


InertiaProgress.init({ color: '#4B5563' });

let app = createApp({});
app.component('meal-edit-component' , MealEditComponent);
createApp(MealDetailComponent).mount('#meal-detail');
// createApp(MealEditComponent).mount('#meal-edit');

app.mount('#app');