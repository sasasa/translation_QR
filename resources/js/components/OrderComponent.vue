<template>
    <div>
        <div class="before_order" v-if="before_order">
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
                    {{total_items}}点 {{this.total_price}}円
                    <button 
                        v-bind:disabled="orderDisabled"
                        v-on:click="order"
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
                    {{message}}
                    <button 
                        v-on:click="back"
                        class="btn btn-primary">{{$t("message.return_to_menu")}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'order-component',
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
                cart: {},
                before_order: true
            }
        },
        methods: {
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
            back() {
                this.$router.back()
            },
            order() {
                let data = {
                    cart: this.cart,
                    lang: this.lang,
                }
                axios
                    .post(`/orders`, data)
                    .then((response) => {
                        this.before_order = false
                        this.message = ''
                    })
                    .catch((error) => {
                        // handle error
                        console.log(error);
                        this.before_order = false
                        this.message = 'Error'
                    })
            }
        },
        computed: {
            items() {
                return Object.keys(this.cart).map((key) => {
                    return JSON.parse(key);
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
        mounted() {
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