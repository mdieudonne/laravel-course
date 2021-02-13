import Vue from 'vue'
import VueRouter from 'vue-router'
import ExampleComponent from "./components/ExampleComponent";
import ContactsIndex from "./views/ContactsIndex";
import ContactsCreate from "./views/ContactsCreate";
import ContactsShow from "./views/ContactsShow";
import ContactsEdit from "./views/ContactsEdit";
import BirthdaysIndex from "./views/BirthdaysIndex";
import Logout from "../Actions/Logout";

Vue.use(VueRouter)

export default new VueRouter({
    routes: [
        {
            path: '/', component: ExampleComponent,
            meta: {title: 'Welcome'}
        },
        {
            path: '/contacts', name: 'ContactsIndex', component: ContactsIndex,
            meta: {title: 'Contacts'}
        },
        {
            path: '/contacts/create', name: 'ContactsCreate', component: ContactsCreate,
            meta: {title: 'Add New Contact'}
        },
        {
            path: '/contacts/:id', props: true, name: 'ContactsShow', component: ContactsShow,
            meta: {title: 'Detail for Contact'}
        },
        {
            path: '/contacts/:id/edit', props: true, name: 'ContactsEdit', component: ContactsEdit,
            meta: {title: 'Edit Contact'}
        },
        {
            path: '/birthdays', props: true, name: 'BirthdaysIndex', component: BirthdaysIndex,
            meta: {title: 'This Month\'s Birthdays'}
        },
        {
            path: '/logout', props: true, name: 'Logout', component: Logout,
        },
    ],
    mode: 'history',
})
