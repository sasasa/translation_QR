/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import router from './router'
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('menu-component', require('./components/MenuComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


import VueI18n from 'vue-i18n'
Vue.use(VueI18n)
const messages = {
    en: {
        message: {
            image_path: 'image',
            item_name: 'name',
            item_price: 'price',
            item_desc: 'description',
            add_to_cart: 'Add to cart',
            order_amount: 'Order amount',
            view_cart: 'View cart',

            order_confirmation: 'Order confirmation',
            return_to_menu: 'Return to menu',
            order_completed: 'Order completed',
        },
    },
    ja: {
        message: {
            image_path: '画像',
            item_name: '商品名',
            item_price: '価格',
            item_desc: '説明',
            add_to_cart: 'カートに入れる',
            order_amount: 'ご注文金額',
            view_cart: 'カートを見る',

            order_confirmation: '注文を確定する',
            return_to_menu: 'メニューに戻る',
            order_completed: '注文が完了しました',
        },
    },
    ko: {
        message: {
            image_path: '이미지',
            item_name: '상품명',
            item_price: '가격',
            item_desc: '설명',
            add_to_cart: '장바구니에 담기',
            order_amount: '주문 금액',
            view_cart: '장바구니',

            order_confirmation: '주문을 확정하는',
            return_to_menu: '메뉴로 돌아 가기',
            order_completed: '주문이 완료되었습니다',
        },
    },
    zh: {
        message: {
            image_path: '图片',
            item_name: '产品名称',
            item_price: '价钱',
            item_desc: '说明',
            add_to_cart: '添加到购物车',
            order_amount: '订单金额',
            view_cart: '查看购物车',

            order_confirmation: '确认订单',
            return_to_menu: '返回菜单',
            order_completed: '订单完成',
        },
    },
}

const i18n = new VueI18n({
    locale: 'ja',
    messages,
})

const app = new Vue({
    el: '#app',
    router,
    i18n,
});
