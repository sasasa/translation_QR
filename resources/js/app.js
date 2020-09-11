/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import router from './router'
import { hashBytes, toColorCode, brightness } from './lib/colorize'
window.colorize = function() {
    $(".colored").each((idx, element)=>{
        let crc32 = $(element).data('hash')
          // 文字列をハッシュ化
        let bg = hashBytes(Number(crc32));
        // 反転色
        let fc = [
            ~bg[0] & 0xff,
            ~bg[1] & 0xff,
            ~bg[2] & 0xff,
        ];
        // 背景とフォントの明るさ計算
        let bgL = brightness(bg[0], bg[1], bg[2]);
        let fcL = brightness(fc[0], fc[1], fc[2]);
        // 背景とフォントの明度差が125未満なら、フォント色は白または黒にする。
        // (明度差が大きい方を採用)
        if (Math.abs(bgL - fcL) < 125) {
            fc[0] = fc[1] = fc[2] = ((0xff - bgL) > bgL) ? 0xff : 0x00;
        }
        // スタイル用の色コード文字列に成形。
        let bgCode = toColorCode(bg);
        let fcCode = toColorCode(fc);
        $(element).css('background-color', bgCode).css('color', fcCode)
    })
}
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


// Vue.component('menu-component', require('./components/MenuComponent.vue').default);
Vue.component('view-order-component', require('./components/ViewOrderComponent.vue').default);
Vue.component('print-component', require('./components/PrintComponent.vue').default);

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
            allergens: 'allergens',

            add_to_cart: 'Add to cart',
            order_amount: 'Order amount',
            view_cart: 'View cart',

            order_confirmation: 'Order confirmation',
            return_to_menu: 'Return to menu',
            order_completed: 'Order completed',

            may_i_remove_it_from_your_cart: 'May I remove it from your cart?',
            error: "Error, please call a representative.",
            no_tax: 'Taxes not included.',
            tax: 'including tax',
            pay: 'Pay',
            takeout: 'Take out',
        },
    },
    ja: {
        message: {
            image_path: '画像',
            item_name: '商品名',
            item_price: '価格',
            item_desc: '説明',
            allergens: 'アレルギー品目',

            add_to_cart: 'カートに入れる',
            order_amount: 'ご注文金額',
            view_cart: 'カートを見る',

            order_confirmation: '注文を確定する',
            return_to_menu: 'メニューに戻る',
            order_completed: '注文が完了しました',

            may_i_remove_it_from_your_cart: 'カートから削除してもよろしいですか？',
            error: "エラー、恐れ入りますが係員を呼んでください。",
            no_tax: '税を含まない',
            tax: '税を含む',
            pay: 'お会計',
            takeout: 'テイクアウト',
        },
    },
    ko: {
        message: {
            image_path: '이미지',
            item_name: '상품명',
            item_price: '가격',
            item_desc: '설명',
            allergens: '알레르기 물질',

            add_to_cart: '장바구니에 담기',
            order_amount: '주문 금액',
            view_cart: '장바구니',

            order_confirmation: '주문을 확정하는',
            return_to_menu: '메뉴로 돌아 가기',
            order_completed: '주문이 완료되었습니다',

            may_i_remove_it_from_your_cart: '장바구니에서 삭제 하시겠습니까?',
            error: "오류입니다. 담당자에게 문의하십시오.",
            no_tax: '세금을 포함하지 않는',
            tax: '세금을 포함',
            pay: '결제하기',
            takeout: '테이크 아웃',
        },
    },
    zh: {
        message: {
            image_path: '图片',
            item_name: '产品名称',
            item_price: '价钱',
            item_desc: '说明',
            allergens: '过敏物质',

            add_to_cart: '添加到购物车',
            order_amount: '订单金额',
            view_cart: '查看购物车',

            order_confirmation: '确认订单',
            return_to_menu: '返回菜单',
            order_completed: '订单完成',

            may_i_remove_it_from_your_cart: '您确定要从购物车中删除它吗？',
            error: "错误，请致电代表。",
            no_tax: '不含税',
            tax: '所含税款',
            pay: '支付',
            takeout: '取出',
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
