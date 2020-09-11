<template>
    <div>
        <h1>レシート</h1>
        <div class="h1">{{all_items}}点{{all_price}}円</div>
        <div>
            ({{$t('message.tax')}})
        </div>
        <ul>
            <li v-for="order in ordered_orders" v-bind:key="order.id">
                {{order.item.item_name}}(ID{{order.id}}){{order.is_take_out ? "テイクアウト" : ""}}------------{{order.tax_included_price}}円
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: 'print-component',
        props: {
            seatsessionid: {
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
            alert(this.seatsessionid)
            axios
                .post(`/print/${this.seatsessionid}`)
                .then((response) => {
                    this.ordered_orders = response.data.ordered_orders
                    setTimeout(function(){
                        window.print()
                        window.close()
                    }, 100)
                })
                .catch((error) => {
                    console.log(error);
                })
        }
    }
</script>

<style scoped>

</style>