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
                    <th>画像</th>
                    <td><img v-bind:src="`/storage/${item.image_path}`"></td>
                </tr>
                <!-- <tr>
                    <th>商品キー</th>
                    <td>{{item.item_key}}</td>
                </tr> -->
                <tr>
                    <th>商品名</th>
                    <td>{{item.item_name}}</td>
                </tr>
                <tr>
                    <th>価格</th>
                    <td>{{item.item_price}}</td>
                </tr>
                <tr>
                    <th>説明</th>
                    <td>{{item.item_desc}}</td>
                </tr>
                <tr>
                    <th>購入する</th>
                    <td>
                        <span v-on:click="plus(item)" class="h1 pointer">＋</span>
                        <span v-on:click="minus(item)" class="h1 pointer">－</span>
                        <span class="h1">{{item_number(item)}}</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="card">
            <div class="card-header">ご注文金額</div>
            <div class="card-body text-right">
                {{total_items}}点 {{this.total_price}}円
                <button 
                    v-bind:disabled="orderDisabled"
                    v-on:click="order"
                    class="btn btn-primary">次に進む
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'menu-component',
        props: {
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
            }
        },
        computed: {
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
            order() {
                this.$router.push({ name: 'order-component' })
            },
        },
        mounted() {
            axios
                .get(`/${this.seat_hash}/${this.lang}/${this.current_genre}/json_items`)
                .then((response) => {
                    this.items = response.data.items
                    this.genres = response.data.genres
                    // alert(JSON.stringify(response))
                })
                .catch((error) => {
                    // handle error
                    console.log(error);
                })
            // this.cart = JSON.parse(sessionStorage.getItem('cart'));
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