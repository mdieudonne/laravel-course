import Vue from 'vue'
import VueRouter from 'vue-router'
import ExampleComponent from "./components/ExampleComponent";
import ContactsCreate from "./views/ContactsCreate";
import ContactsShow from "./views/ContactsShow";
import ContactsEdit from "./components/ContactsEdit";

Vue.use(VueRouter)

export default new VueRouter({
    routes: [
        {path: '/', component: ExampleComponent},
        {path: '/contacts/create', name: 'ContactsCreate', component: ContactsCreate},
        {path: '/contacts/:id', props: true, name: 'ContactsShow', component: ContactsShow},
        {path: '/contacts/:id/edit', props: true, name: 'ContactsEdit', component: ContactsEdit},
    ],
    mode: 'history',
})
