<template>
    <div>
        <Loading v-show="loading"></Loading>
        <div>
            <ul class="hqr-select-language">
                <li>
                    <button type="button" class="btn btn-primary">
                    <router-link v-bind:to="`/ja/${current_genre}`" replace>日本語</router-link>
                    </button>
                </li>
                <li>
                    <button type="button" class="btn btn-primary">
                    <router-link v-bind:to="`/en/${current_genre}`" replace>English</router-link>
                    </button>
                </li>
                <li>
                    <button type="button" class="btn btn-primary">
                    <router-link v-bind:to="`/zh/${current_genre}`" replace>中文</router-link>
                    </button>
                </li>
                <li>
                    <button type="button" class="btn btn-primary">
                    <router-link v-bind:to="`/ko/${current_genre}`" replace>한글</router-link>
                    </button>
                </li>
            </ul>

            <div id="spa_panel_main" class="spa_panel dropdown">
                <!-- accordion menu -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    メニュー
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <ul>
                            <li class="dropdown-item" v-for="genre in genres" v-bind:key="genre.id">
                                <span v-if="genre.children.length && !genre.item">
                                    {{genre.genre_name}}
                                </span>
                                <span v-else>
                                    <router-link v-bind:to="`/${lang}/${genre.genre_key}`" replace>{{genre.genre_name}}</router-link>
                                </span>
                                <ul class="dropdown-item">
                                    <li class="dropdown-item" v-for="child_genre in genre.children" v-bind:key="child_genre.id">
                                        <router-link v-bind:to="`/${lang}/${child_genre.genre_key}`" replace>{{child_genre.genre_name}}</router-link>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <img src="/img/header.jpg" class="head_img">


            <div class="container">
                <h2 class="inner-category center">- {{current_genre.toUpperCase()}} -</h2>
                <section class="hqr-item" v-for="item in items" v-bind:key="item.id">
                    <img v-bind:src="`/storage/${item.image_path}`" v-bind:alt="item.item_name" class="menu-item-img">
                    <h2 class="hqr-item-name">
                        {{item.item_name}}{{(item.is_out_of_stock.toString(10) === '1') ? `【${$t("message.sorry_out_of_stock")}】` : "" }}
                    </h2>
                    <div class="hqr-item-summary">
                        <p>
                            {{item.item_desc}}
                        </p>
                    </div>
                    <p class="hqr-item-price">{{item.item_price}}円</p>

                    <details class="hqr-item-allergy-list">
                        <summary>{{$t("message.allergens")}}</summary>
                        <ul>
                            <li v-for="allergen in item.allergens" v-bind:key="allergen.allergen_name">
                                <span>
                                    <img v-bind:src="`/img/allergens/${allergen.allergen_key}.png`">
                                </span>
                                <span>{{allergen.allergen_name}}</span>
                            </li>
                        </ul>
                    </details>
                    <div class="menu-cart">
                        <p>{{$t("message.add_to_cart")}}</p>
                        <div>
                            <!-- <span class="h1">{{item_number(item)}}</span> -->
                            <span v-on:click="plus(item)" class="pointer">
                                <img src="/img/plus-blue.png">
                            </span>
                            <span v-on:click="minus(item)" class="pointer">
                                <img src="/img/minus-blue.png">
                            </span>
                        </div>
                    </div>
                </section>
                
                <div class="footer">
                    <div class="footer-now-cart">
                        <p>
                            <span>{{total_items}}点</span>
                            <span class="pre-total">{{total_price}}円</span>
                            <span>({{$t('message.no_tax')}})</span>
                        </p>
                        
                        <button 
                        v-bind:disabled="orderDisabled"
                        v-on:click="order"
                        type="button" class="btn btn-light">
                            {{$t("message.view_cart")}}
                        </button>
                    </div>
                    <div class="footer-now-finish">
                        <p>
                            <span>{{all_items}}点</span><br>
                            <span class="pre-total">{{all_price}}円</span>
                            ({{$t('message.tax')}})
                        </p>
                        <div>
                            <button 
                            v-bind:disabled="payDisabled"
                            v-on:click.once="pay"
                            type="button" class="btn btn-light">
                                {{$t("message.pay")}}
                            </button>
                            
                            <button 
                            v-bind:style="{display: paypayAvailable}"
                            v-bind:disabled="payDisabled"
                            v-on:click.once="paypay"
                            type="button" class="btn btn-light">
                                {{$t("message.paypay")}}
                            </button>
                        </div>
                    </div>
                    <div class="notice">
                        <p><a href="/law">特定商取引法に基づく表記</a></p>
                        <p>|</p>
                        <p><a href="/policy">プライバシーポリシー</a></p>
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
                paypayAvailable: `inline`,
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
                    num = Object.keys(this.ordered_orders).reduce((acc, idx) => {
                        return acc + Number(this.ordered_orders[idx].tax_included_price)
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

                if(item.is_out_of_stock.toString(10) === '1') {
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
                if(item.is_out_of_stock.toString(10) === '1') {
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
                        this.paypayAvailable = response.data.paypayAvailable
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