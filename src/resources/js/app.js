import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import ApolloClient from 'apollo-boost'
import '../css/app.css';
import {DefaultApolloClient} from "@vue/apollo-composable";

const apolloClient = new ApolloClient({
    uri: 'http://127.0.0.1:8000/graphql'
})

createInertiaApp({
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup: function ({el, App, props, plugin}) {
        createApp({render: () => h(App, props)})
            .use(plugin)
            .provide(DefaultApolloClient, apolloClient)
            .mount(el)
    },
});
