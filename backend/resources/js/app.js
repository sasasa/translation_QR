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
            // image_path: 'image',
            // item_name: 'name',
            // item_price: 'price',
            // item_desc: 'description',
            menu: 'Menu',
            allergens: 'allergens',
            ordered_products: 'Ordered Products',

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
            paypay: 'paypay payment',
            takeout: 'Take out',
            food_and_drink_in_the_store: 'Food and drink in the store',
            thanks: 'Thank you very much.',
            wait: 'Please wait for a while as it is.',

            sorry_out_of_stock: 'Sorry, Out of stock.',
        },
    },
    ja: {
        message: {
            // image_path: '画像',
            // item_name: '商品名',
            // item_price: '価格',
            // item_desc: '説明',
            menu: 'メニュー',
            allergens: 'アレルギー品目',
            ordered_products: '注文済み商品',

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
            paypay: 'paypay支払い',
            takeout: 'テイクアウト',
            food_and_drink_in_the_store: '店内飲食',
            thanks: 'ありがとうございました。',
            wait: 'このまま、しばらくお待ちください。',

            sorry_out_of_stock: '申し訳ありません、在庫切れです。',
        },
    },
    ko: {
        message: {
            // image_path: '이미지',
            // item_name: '상품명',
            // item_price: '가격',
            // item_desc: '설명',
            menu: '메뉴',
            allergens: '알레르기 물질',
            ordered_products: '주문 된 상품',

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
            paypay: 'paypay결제하기',
            takeout: '테이크 아웃',
            food_and_drink_in_the_store: '점내에서의 음식',
            thanks: '감사합니다.',
            wait: '이대로 기다려주십시오.',
            sorry_out_of_stock: '죄송 품절입니다.',
        },
    },
    zh: {
        message: {
            // image_path: '图片',
            // item_name: '产品名称',
            // item_price: '价钱',
            // item_desc: '说明',
            menu: '菜单',
            allergens: '过敏物质',
            ordered_products: '订购的产品',

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
            paypay: 'paypay支付',
            takeout: '取出',
            food_and_drink_in_the_store: '在商店吃喝',
            thanks_wait: '非常感谢你。请稍候。',
            thanks: '非常感谢你。',
            wait: '请等待一段时间，因为它是。',
            sorry_out_of_stock: '抱歉，没货了。',
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
