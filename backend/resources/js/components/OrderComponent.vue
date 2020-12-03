<template>
    <div>
        <Loading v-show="loading"></Loading>
        <div id="cart" class="before_order" v-if="before_order">

            <h1>CART</h1>
            <transition-group tag="div" class="container">
                <section 
                v-for="item in items"
                v-bind:key="item.id"
                class="order-menu">
                    <div class="cart-flx">
                        <p>
                            <img v-bind:src="`/storage/${item.image_path}`" class="menu-item-img">
                        </p>
                        <div>
                            <p class="hqr-item-name cart-item-name">
                                {{item.item_name}}
                            </p>
                            <div class="hqr-item-summary">
                                <p class="cart-summary">
                                    {{item.item_desc}}
                                </p>
                            </div>
                            <p class="price">{{item.item_price}}円</p>
                        </div>
                    </div>
                    <details class="hqr-item-allergy-list">
                        <summary>{{$t("message.allergens")}}</summary>
                        <ul>
                            <li
                            v-for="allergen in item.allergens"
                            v-bind:key="allergen.allergen_name">
                                <span>
                                    <img v-bind:src="`/img/allergens/${allergen.allergen_key}.png`">
                                </span>
                                <span>{{allergen.allergen_name}}</span>
                            </li>
                        </ul>
                    </details>
                    <div class="quantity">
                        <p>{{item_number(item)}}個</p>

                        <div>
                            <span v-on:click="plus(item)">
                                <img src="/img/plus-blue.png">
                            </span>
                            <span v-on:click="minus(item)">
                                <img src="/img/minus-blue.png">
                            </span>
                        </div>
                    </div>
                </section>
            </transition-group>
            <footer>
                <div class="footer-pre-total">
                    <p class="total-price">{{$t("message.order_amount")}}</p>

                    <div class="cart-footer-flx">
                        <div>
                            <p><span class="pre-total">{{this.total_price}}円</span>({{$t('message.no_tax')}})</p>
                            <div class="takeout">
                                <label for="takeout">
                                    <input id="takeout" type="checkbox" v-model="is_take_out">
                                    {{$t('message.takeout')}}
                                </label>
                            </div>
                        </div>
                        <div class="footer-pre-total-button">
                            <button 
                            v-bind:disabled="orderDisabled"
                            v-on:click.once="order"
                            class="btn btn-light">
                                {{$t("message.order_confirmation")}}
                            </button>
                            <button
                            v-on:click="back"
                            class="btn btn-light">
                                {{$t("message.return_to_menu")}}
                            </button>
                        </div>
                    </div>
                    <div class="notice">
                        <p>
                            <a href="/law">特定商取引法に基づく表記</a>
                        </p>
                        <p>|</p>
                        <p>
                            <a href="/policy">プライバシーポリシー</a>
                        </p>
                    </div>
                </div>
            </footer>
        </div>
        <div class="after_order" v-else>
            <p class="comp-p">
                {{$t("message.order_completed")}}
            </p>
            <article class="comp-box">
                <h1>{{$t("message.ordered_products")}}</h1>
                <section
                v-for="(value, key) in messages"
                v-bind:key="key">
                    <p>{{key}}</p>
                    <p>1点</p>
                    <p>{{value}}円</p>
                </section>
                <p class="tax-rate">({{$t('message.tax')}})</p>
                <button
                v-on:click="back"
                class="btn btn-light back-menu w140">
                    {{$t("message.return_to_menu")}}
                </button>

                <div class="border"></div>
                <div class="tax-in-total-price">
                    <p>
                        {{all_items}}点<br>
                        <span>{{all_price}}円</span>({{$t('message.tax')}})
                    </p>
                    <div class="payment-box">
                        <button
                        v-bind:disabled="payDisabled"
                        v-on:click.once="pay"
                        class="btn btn-light button-blue w140">
                            {{$t("message.pay")}}
                        </button>
                        <button
                        v-bind:style="{display: paypayAvailable}"
                        v-bind:disabled="payDisabled"
                        v-on:click.once="paypay"
                        class="btn btn-light button-blue w140">
                            {{$t("message.paypay")}}
                        </button>
                    </div>
                </div>
                <div class="notice">
                    <p>
                        <a href="/law">特定商取引法に基づく表記</a>
                    </p>
                    <p>|</p>
                    <p>
                        <a href="/policy">プライバシーポリシー</a>
                    </p>
                </div>
            </article>
        </div>
    </div>
</template>

<script>
    import Loading from './Loading'

    export default {
        name: 'order-component',
        components: {
            Loading,
        },
        props: {
            session_key: {
                type: String,
                required: true,
            },
            seat_hash: {
                type: String,
                required: true,
            },
            lang: {
                type: String,
                required: true,
            },
        },
        data() {
            return {
                cart: {},
                before_order: true,
                messages: {},
                ordered_orders: [],
                is_take_out: false,
                recent_items: [],
                loading: false,
                paypayAvailable: `inline`,
            }
        },
        methods: {
            paypay(){
                this.loading = true
                axios
                    .post(`/api/paypay`, {
                        session_key: this.session_key,
                        seat_hash: this.seat_hash,
                        lang: this.lang,
                        payment: 'paypay',
                    })
                    .then((response) => {
                        if (response.data.ok) {
                            location.href = response.data.redirectUrl
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            },
            pay() {
                this.loading = true
                axios
                    .post(`/api/pay`, {
                        session_key: this.session_key,
                        seat_hash: this.seat_hash,
                        lang: this.lang,
                    })
                    .then((response) => {
                        if (response.data.ok) {
                            this.$router.replace({
                                name: 'thanks-component',
                                lang: this.lang,
                            })
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            },
            item_number(item) {
                let json_item = JSON.stringify(item)
                return this.cart[json_item]
            },
            plus(item) {
                let json_item = JSON.stringify(item)
                if( this.cart[json_item] ) {
                    Vue.set(this.cart, json_item, this.cart[json_item] + 1)
                } else {
                    Vue.set(this.cart, json_item, 1)
                }
                sessionStorage.setItem('cart', JSON.stringify(this.cart))
            },
            minus(item) {
                this.cart = JSON.parse(sessionStorage.getItem('cart'));

                let json_item = JSON.stringify(item)
                if( this.cart[json_item] && this.cart[json_item] > 1 ) {
                    Vue.set(this.cart, json_item, this.cart[json_item] - 1)
                } else if( this.cart[json_item] && this.cart[json_item] == 1 && confirm(this.$t("message.may_i_remove_it_from_your_cart"))) {
                    Vue.set(this.cart, json_item, this.cart[json_item] - 1)
                }
                if (this.cart[json_item] == 0) {
                    Vue.delete(this.cart, json_item);
                }

                sessionStorage.setItem('cart', JSON.stringify(this.cart))
            },
            back() {
                this.$router.back()
            },
            order() {
                this.loading = true
                axios
                    .post(`/api/orders`, {
                        cart: this.orderCart,
                        lang: this.lang,
                        session_key: this.session_key,
                        seat_hash: this.seat_hash,
                        is_take_out: this.is_take_out,
                    })
                    .then((response) => {
                        this.before_order = false
                        this.messages = response.data.messages
                        this.ordered_orders = response.data.ordered_orders
                        this.loading = false
                        sessionStorage.clear()
                    })
                    .catch((error) => {
                        // handle error
                        console.log(error);
                        this.before_order = false
                        this.loading = false
                        this.message = this.$t('message.error')
                    })
            }
        },
        computed: {
            payDisabled() {
                return this.all_items == 0
            },
            all_items() {
                return this.ordered_orders.length
            },
            all_price() {
                return Object.keys(this.ordered_orders).reduce((accumulator, idx) => {
                    return accumulator + Number(this.ordered_orders[idx].tax_included_price)
                }, 0);
            },
            orderCart() {
                return Object.keys(this.cart).map((key) => {
                    // IDと個数の組を作る
                    let obj = {}
                    let objKey = JSON.parse(key)
                    obj[objKey.id] = this.cart[key]
                    return obj
                })
            },
            items() {
                return Object.keys(this.cart).map((key) => {
                    return JSON.parse(key);
                })
            },
            itemIDs() {
                return Object.keys(this.cart).map((key) => {
                    return JSON.parse(key).id;
                })
            },
            orderDisabled() {
                return this.total_price == 0
            },
            total_items() {
                return Object.keys(this.cart).reduce((accumulator, key) => {
                    return accumulator + this.cart[key]
                }, 0);
            },
            total_price() {
                return Object.keys(this.cart).reduce((accumulator, key) => {
                    let item = JSON.parse(key)
                    return accumulator + (item.item_price * this.cart[key])
                }, 0);
            }
        },
        watch: {
            $route (to, from) {
                // ルートの変更の検知
                this.$i18n.locale = this.lang
            }
        },
        updated() {
        },
        mounted() {
            let c = sessionStorage.getItem('cart')
            if(c) {
                this.cart = JSON.parse(c);
            }
            this.$i18n.locale = this.lang

            axios
                .post(`/api/item_ids`, {
                    itemIDs: this.itemIDs
                })
                .then((response) => {
                    this.paypayAvailable = response.data.paypayAvailable
                    this.recent_items = response.data.items
                    this.recent_items.forEach((item) => {
                        if (item.is_out_of_stock.toString(10) === '1') {
                            // 時間差でcartに追加されてしまったitemを削除
                            // Xserverのときは '0' が入る
                            // ローカル開発環境の時は 0 が入る
                            item.is_out_of_stock = '0'
                            let json_item = JSON.stringify(item)
                            Vue.delete(this.cart, json_item)
                            sessionStorage.setItem('cart', JSON.stringify(this.cart))
                        }
                    })
                })
                .catch((error) => {
                    console.log(error);
                    this.message = this.$t('message.error')
                })
            setInterval(() => {
                axios
                    .post(`/api/json_ordered_orders`, {
                        session_key: this.session_key,
                        seat_hash: this.seat_hash,
                    })
                    .then((response) => {
                        this.ordered_orders = response.data.ordered_orders
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            }, 30000)
        }
    }
</script>

<style scoped>
.card {
    position: sticky;
    bottom:0px;
}
.pointer {
    cursor: pointer;
}
.select-none {
    user-select: none;
}
/* 表示・非表示アニメーション中 */
.v-enter-active, .v-leave-active {
    transition: all 1200ms;
}
.v-leave-active {
    transition: all 500ms;
}
/* 表示アニメーション開始時 ・ 非表示アニメーション後 */
.v-enter {
    opacity: 0.4;
    background: pink;
}
.v-leave-to {
    opacity: 0;
}
</style>