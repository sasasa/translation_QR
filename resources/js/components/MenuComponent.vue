<template>
    <div>
        <div>
            <a v-bind:href="`/${seat_hash}/ja/${current_genre}/items`">日本語</a>
            <a v-bind:href="`/${seat_hash}/en/${current_genre}/items`">English</a>
            <a v-bind:href="`/${seat_hash}/zh/${current_genre}/items`">中文</a>
            <a v-bind:href="`/${seat_hash}/ko/${current_genre}/items`">한글</a>
        </div>


        <div v-for="genre in genres" v-bind:key="genre.id">
            <a v-bind:href="`/${seat_hash}/${lang}/${genre.genre_key}/items`">{{genre.genre_name}}</a>
            <ul>
                <li v-for="child_genre in genre.children" v-bind:key="child_genre.id">
                    <a v-bind:href="`/${seat_hash}/${lang}/${child_genre.genre_key}/items`">{{child_genre.genre_name}}</a>
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
                    <td>{{item.item_name}}</td>
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
                    <td>
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
                        {{all_itmes}}点{{all_price}}円
                    </span>
                    ({{$t('message.tax')}})
                    <button 
                        v-bind:disabled="payDisabled"
                        v-on:click="pay"
                        class="btn btn-primary">{{$t("message.pay")}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'menu-component',
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
            }
        },
        computed: {
            orderDisabled() {
                return this.total_price == 0
            },
            payDisabled() {
                return this.all_itmes == 0
            },
            all_itmes() {
                return this.ordered_orders.length
            },
            all_price() {
                return Object.keys(this.ordered_orders).reduce((accumulator, idx) => {
                    return accumulator + this.ordered_orders[idx].tax_included_price
                }, 0);
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
            pay() {

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
                if( this.cart[json_item] && this.cart[json_item] > 0 ) {
                    Vue.set(this.cart, json_item, this.cart[json_item] - 1)
                }
                if (this.cart[json_item] == 0) {
                    Vue.delete(this.cart, json_item);
                }

                sessionStorage.setItem('cart', JSON.stringify(this.cart))
            },
            order() {
                this.$router.push({ name: 'order-component' })
            },
        },
        mounted() {
            let data = {
                session_key: this.session_key
            }
            axios
                .post(`/${this.seat_hash}/${this.lang}/${this.current_genre}/json_items`, data)
                .then((response) => {
                    this.items = response.data.items
                    this.genres = response.data.genres
                    this.ordered_orders = response.data.ordered_orders
                    // alert(JSON.stringify(response))
                })
                .catch((error) => {
                    // handle error
                    console.log(error);
                })
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
</style>