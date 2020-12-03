<template>
    <div>
        <Loading v-show="loading"></Loading>

        <h1 class="thanks-orderd-h1">{{$t('message.thanks')}}<br>{{$t('message.wait')}}
        </h1>
        <section class="thanks-orderd-box">
            <p class="tanks-orderd-taxinprice">
                {{all_items}}点{{all_price}}円({{$t('message.tax')}})
            </p>

            <div
            v-for="(take_out_orders, is_take_out) in ordered_orders"
            v-bind:key="is_take_out">
                <p v-if="is_take_out == '1'">
                    {{$t('message.takeout')}}
                </p>
                <p v-else-if="is_take_out == '0'">
                    {{$t('message.food_and_drink_in_the_store')}}
                </p>
                <ul class="thanks-orderd-list">
                    <li
                    v-for="(orders, item_name) in take_out_orders"
                    v-bind:key="orders[0].id">
                        {{item_name}}---{{orders.length}}
                        <span>{{orders.reduce((acc, order)=>{return Number(order.tax_included_price) + acc}, 0)}}円</span>
                    </li>
                </ul>
            </div>
        </section>
        <div class="notice">
            <p>
                <a href="https://test-qr.grow-up-webmarketing.co.jp/law#/">特定商取引法に基づく表記</a>
            </p>
            <p>|</p>
            <p>
                <a href="https://test-qr.grow-up-webmarketing.co.jp/policy#/">プライバシーポリシー</a>
            </p>
        </div>
        
    </div>
</template>

<script>
    import Loading from './Loading'

    export default {
        name: 'thanks-component',
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
            payment: {
                type: String,
                required: false,
            }
        },
        data() {
            return {
                ordered_orders: [],
                all_items: 0,
                all_price: 0,
                loading: true,
            }
        },
        computed: {
        },
        methods: {
        },
        mounted() {
            axios
                .post(`/api/json_payment`, {
                    session_key: this.session_key,
                    seat_hash: this.seat_hash,
                    payment: this.payment,
                })
                .then((response) => {
                    this.ordered_orders = response.data.ordered_orders
                    this.all_items = response.data.all_items
                    this.all_price = response.data.all_price
                    this.loading = false
                    // alert(JSON.stringify(response.data))
                })
                .catch((error) => {
                    // handle error
                    console.log(error);
                })
            this.$i18n.locale = this.lang
            // 戻るボタンを無効化
            history.pushState(null, null, location.href);
            window.addEventListener('popstate', (e) => {
                history.go(1);
            });
        }
    }
</script>

<style scoped>

</style>