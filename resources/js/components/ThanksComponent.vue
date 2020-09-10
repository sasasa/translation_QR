<template>
    <div>
        <h1>ありがとうございました。しばらくお待ちください。</h1>
        {{all_items}}点
        {{all_price}}円
        <ul>
            <li v-for="order in ordered_orders" v-bind:key="order.id">
                {{order.item.item_name}}(ID{{order.id}}){{order.is_take_out ? "テイクアウト" : "店内飲食"}}{{order.tax_included_price}}円
            </li>
        </ul>
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
                ordered_orders: [],
            }
        },
        computed: {
            all_items() {
                return this.ordered_orders.length
            },
            all_price() {
                return Object.keys(this.ordered_orders).reduce((accumulator, idx) => {
                    return accumulator + this.ordered_orders[idx].tax_included_price
                }, 0);
            },
        },
        methods: {
        },
        mounted() {
            axios
                .post(`/${this.seat_hash}/${this.lang}/json_ordered_orders`, {
                    session_key: this.session_key
                })
                .then((response) => {
                    alert(JSON.stringify(response.data.ordered_orders))
                    this.ordered_orders = response.data.ordered_orders
                    // alert(JSON.stringify(response))
                })
                .catch((error) => {
                    // handle error
                    console.log(error);
                })
            this.$i18n.locale = this.lang
        }
    }
</script>

<style scoped>

</style>