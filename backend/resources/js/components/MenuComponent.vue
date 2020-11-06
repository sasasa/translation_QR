<template>
    <div>
        <Loading v-show="loading"></Loading>
        <div>
            <div>
                <router-link v-bind:to="`/ja/${current_genre}`" replace>日本語</router-link>
                <router-link v-bind:to="`/en/${current_genre}`" replace>English</router-link>
                <router-link v-bind:to="`/zh/${current_genre}`" replace>中文</router-link>
                <router-link v-bind:to="`/ko/${current_genre}`" replace>한글</router-link>
            </div>


            <div v-for="genre in genres" v-bind:key="genre.id">
                <div v-if="genre.children.length && !genre.item">
                    {{genre.genre_name}}
                </div>
                <div v-else>
                    <router-link v-bind:to="`/${lang}/${genre.genre_key}`" replace>{{genre.genre_name}}</router-link>
                </div>

                <ul>
                    <li v-for="child_genre in genre.children" v-bind:key="child_genre.id">
                        <router-link v-bind:to="`/${lang}/${child_genre.genre_key}`" replace>{{child_genre.genre_name}}</router-link>
                    </li>
                </ul>
            </div>


            <table class="table">
                <tbody v-for="item in items" v-bind:key="item.id">
                    <tr>
                        <th>{{$t("message.image_path")}}</th>
                        <td><img v-bind:src="`/storage/${item.image_path}`"></td>
                    </tr>
                    <tr>
                        <th>{{$t("message.item_name")}}</th>
                        <td>
                            {{item.item_name}}{{item.is_out_of_stock ? `【${$t("message.sorry_out_of_stock")}】` : "" }}
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
            </table>
            <div class="card">
                <div class="card-header">{{$t("message.order_amount")}}</div>
                <div class="card-body text-right">
                    <div>
                        <span class="h1">
                            {{total_items}}点 {{total_price}}円
                        </span>
                        ({{$t('message.no_tax')}})
                        <button
                            v-bind:disabled="orderDisabled"
                            v-on:click="order"
                            class="btn btn-primary">{{$t("message.view_cart")}}
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
                            class="btn btn-primary my-1">{{$t("message.pay")}}
                        </button>
                        <button
                            v-bind:disabled="payDisabled"
                            v-on:click.once="paypay"
                            class="btn btn-primary my-1">{{$t("message.paypay")}}
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
        name: 'menu-component',
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
            current_genre: {
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
                items: [],
                genres: [],
                cart: {},
                ordered_orders: [],
                loading: true,
            }
        },
        computed: {
            orderDisabled() {
                return this.total_price == 0
            },
            payDisabled() {
                return this.all_items == 0
            },
            all_items() {
                const num = this.ordered_orders ? this.ordered_orders.length : 0
                return num
            },
            all_price() {
                let num = 0;
                if (this.ordered_orders) {
                    num = Object.keys(this.ordered_orders).reduce((accumulator, idx) => {
                        return accumulator + this.ordered_orders[idx].tax_included_price
                    }, 0);
                }
                return num
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
        methods: {
            paypay() {
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

                if(item.is_out_of_stock) {
                    Vue.delete(this.cart, json_item)
                    sessionStorage.setItem('cart', JSON.stringify(this.cart))
                    return alert(this.$t("message.sorry_out_of_stock"))
                }

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
                if(item.is_out_of_stock) {
                    Vue.delete(this.cart, json_item)
                    sessionStorage.setItem('cart', JSON.stringify(this.cart))
                    return alert(this.$t("message.sorry_out_of_stock"))
                }

                if( this.cart[json_item] && this.cart[json_item] > 0 ) {
                    Vue.set(this.cart, json_item, this.cart[json_item] - 1)
                }
                if (this.cart[json_item] == 0) {
                    Vue.delete(this.cart, json_item);
                }

                sessionStorage.setItem('cart', JSON.stringify(this.cart))
            },
            order() {
                this.$router.push({ 
                    name: 'order-component',
                    lang: this.lang,
                })
            },
            getData() {
                axios
                    .post(`/api/json_items`, {
                        session_key: this.session_key,
                        lang: this.lang,
                        genre: this.current_genre,
                        seat_hash: this.seat_hash,
                    })
                    .then((response) => {
                        this.items = response.data.items
                        this.genres = response.data.genres
                        this.ordered_orders = response.data.ordered_orders
                        this.loading = false
                        // alert(JSON.stringify(response))
                    })
                    .catch((error) => {
                        // handle error
                        console.log(error);
                    })
            },
        },
        watch: {
            $route (to, from) {
                // ルートの変更の検知
                this.loading = true
                this.getData()
                this.$i18n.locale = this.lang
            }
        },
        updated() {
        },
        mounted() {
            this.getData()
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

            let c = sessionStorage.getItem('cart')
            if(c) {
                this.cart = JSON.parse(c);
            }
            this.$i18n.locale = this.lang
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
.router-link-active {
    text-decoration: underline;
}
</style>