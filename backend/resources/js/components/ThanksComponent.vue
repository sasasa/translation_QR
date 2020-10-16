<template>
    <div>
        <h1>{{$t('message.thanks_wait')}}</h1>
        <div class="h1">{{all_items}}点{{all_price}}円</div>
        <div>
            ({{$t('message.tax')}})
        </div>

        <div v-for="(take_out_orders, is_take_out) in ordered_orders" v-bind:key="is_take_out">
            <span v-if="is_take_out">
                <br>{{$t('message.takeout')}}
            </span>
            <span v-else>
                <br>{{$t('message.food_and_drink_in_the_store')}}
            </span>
            <ul>
                <li v-for="(orders, item_name) in take_out_orders" v-bind:key="orders[0].id">
                    {{item_name}}---
                    {{orders.length}}<br>
                    {{orders.reduce((accumulator, order)=>{return order.tax_included_price + accumulator}, 0)}}円
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'thanks-component',
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
                ordered_orders: [],
                all_items: 0,
                all_price: 0,
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
                })
                .then((response) => {
                    this.ordered_orders = response.data.ordered_orders
                    this.all_items = response.data.all_items
                    this.all_price = response.data.all_price
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