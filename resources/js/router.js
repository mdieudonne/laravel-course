import Vue from 'vue'
import VueRouter from 'vue-router'
import ExampleComponent from "./components/ExampleComponent";
import ContactsIndex from "./views/ContactsIndex";
import ContactsCreate from "./views/ContactsCreate";
import ContactsShow from "./views/ContactsShow";
import ContactsEdit from "./views/ContactsEdit";
import BirthdaysIndex from "./views/BirthdaysIndex";

Vue.use(VueRouter)

export default new VueRouter({
    routes: [
        {path: '/', component: ExampleComponent},
        {path: '/contacts', name: 'ContactsIndex', component: ContactsIndex},
        {path: '/contacts/create', name: 'ContactsCreate', component: ContactsCreate},
        {path: '/contacts/:id', props: true, name: 'ContactsShow', component: ContactsShow},
        {path: '/contacts/:id/edit', props: true, name: 'ContactsEdit', component: ContactsEdit},

        {path: '/birthdays', props: true, name: 'BirthdaysIndex', component: BirthdaysIndex},
    ],
    mode: 'history',
})
