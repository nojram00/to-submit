import { createWebHistory, createRouter } from "vue-router";

const routes = [
    {
        path : '/',
        component : () => import('./pages/MainDashboard.vue')
    },
    {
        path : '/login',
        component : () => import('./pages/Login.vue')
    },
    {
        path : '/products',
        component : () => import('./pages/Products.vue')
    },
    {
        path : '/create-product',
        component : () => import('./pages/CreateProducts.vue')
    }
]

const router = createRouter({
    history : createWebHistory(),
    routes
})

export default router
