<template>
    <div>
        <Loading v-show="loading"></Loading>
        <div class="before_order" v-if="before_order">
            <transition-group tag="table" class="table">
                <tbody v-for="item in items" v-bind:key="item.id">
                    <tr>
                        <th>{{$t("message.image_path")}}</th>
                        <td><img v-bind:src="`/storage/${item.image_path}`"></td>
                    </tr>
                    <tr>
                        <th>{{$t("message.item_name")}}</th>
                        <td>
                        {{item.item_name}}
                        </td>
                    </tr>
                    <tr>
                        <th>{{$t("message.item_price")}}</th>
                        <td>{{item.item_price}}</td>
                    </tr>
                    <tr>
                        <th>{{$t("message.item_desc")}}</th>
                        <td>{{item.item_desc}}</td>
                    </tr>
                    <tr>
                        <th>{{$t("message.allergens")}}</th>
                        <td>
                            <span v-for="allergen in item.allergens" v-bind:key="allergen.allergen_name">
                                {{allergen.allergen_name}}
                                <img v-bind:src="`/img/allergens/${allergen.allergen_key}.png`">
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>{{$t("message.add_to_cart")}}</th>
                        <td class="select-none">
                            <span v-on:click="plus(item)" class="h1 pointer">＋</span>
                            <span v-on:click="minus(item)" class="h1 pointer">－</span>
                            <span class="h1">{{item_number(item)}}</span>
                        </td>
                    </tr>
                </tbody>
            </transition-group>
            <div class="card">
                <div class="card-header">{{$t("message.order_amount")}}</div>
                <div class="card-body text-right">
                    <label for="takeout">
                        <input id="takeout" type="checkbox" v-model="is_take_out">
                        {{$t('message.takeout')}}
                    </label>

                    <span class="h1">
                        {{total_items}}点 {{this.total_price}}円
                    </span>
                    ({{$t('message.no_tax')}})
                    <button
                        v-bind:disabled="orderDisabled"
                        v-on:click.once="order"
                        class="btn btn-danger">{{$t("message.order_confirmation")}}
                    </button>
                    <button
                        v-on:click="back"
                        class="btn btn-primary">{{$t("message.return_to_menu")}}
                    </button>
                </div>
            </div>
        </div>
        <div class="after_order" v-else>
            <div class="card">
                <div class="card-header">{{$t("message.order_completed")}}</div>
                <div class="card-body text-right">
                    <div>
                        <div class="text-left">
                            ({{$t('message.tax')}})
                        </div>
                        <ul class="text-left">
                            <li v-for="(value, key) in messages" v-bind:key="key">
                                {{key}}<br>{{value}}円
                            </li>
                        </ul>
                        <button
                            v-on:click="back"
                            class="btn btn-primary">{{$t("message.return_to_menu")}}
                        </button>
                    </div>
                    <hr>
                    <div class="mt-3">
                        <span class="h1">
                            {{all_items}}点{{all_price}}円
                        </span>
                        ({{$t('message.tax')}})
                        <button
                            v-bind:disabled="payDisabled"
                            v-on:click.once="pay"
                            class="btn btn-primary">{{$t("message.pay")}}
                        </button>
                    </div>
                </div>
            </div>
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
            }
        },
        methods: {
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
                    return accumulator + this.ordered_orders[idx].tax_included_price
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
                    this.recent_items = response.data.items
                    this.recent_items.forEach((item) => {
                        if (item.is_out_of_stock) {
                            // 時間差でcartに追加されてしまったitemを削除
                            item.is_out_of_stock = 0
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