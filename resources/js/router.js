import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

// コンポーネントをインポート
import MenuComponent from './components/MenuComponent.vue';
import OrderComponent from './components/OrderComponent.vue';
import ThanksComponent from './components/ThanksComponent.vue';

export default new VueRouter({
    // モードの設定
    mode: 'hash',
    routes: [
        {
            // routeのパス設定
            path: '/',
            // 名前付きルートを設定したい場合付与
            name: 'menu-component',
            // コンポーネントの指定
            component: MenuComponent
        },
        {
            path: '/order',
            name: 'order-component',
            component: OrderComponent
        },
        {
            path: '/thanks',
            name: 'thanks-component',
            component: ThanksComponent
        },
    ]
});