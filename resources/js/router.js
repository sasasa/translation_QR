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
            path: '/order/:lang',
            name: 'order-component',
            component: OrderComponent,
            props: true,
        },
        {
            path: '/thanks/:lang',
            name: 'thanks-component',
            component: ThanksComponent,
            props: true,
        },
        {
            // routeのパス設定
            path: '/:lang/:current_genre',
            // 名前付きルートを設定したい場合付与
            name: 'menu-component',
            // コンポーネントの指定
            component: MenuComponent,
            props: true,
        },
    ]
});