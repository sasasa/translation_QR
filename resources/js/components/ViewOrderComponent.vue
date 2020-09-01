<template>
    <div>
        <h1>注文確認</h1>
        <table class="table">
        <tr v-for="order in orders" v-bind:key="order.id">
            <th>{{order.item.item_name}}(ID:{{order.id}})</th>
            <td>
                <select>
                    <option v-for="state in order_states" v-bind:key="state">
                        {{state}}
                    </option>
                </select>
            </td>
            <td>{{order.seat_session.seat.seat_name}}</td>
        </tr>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'view-order-component',
        props: {
        },
        data() {
            return {
                messages: {},
                orders: [],
                order_states: [],
            }
        },
        methods: {
        },
        computed: {
        },
        mounted() {
            setInterval(() => {
                axios
                    .post(`/json_orders`)
                    .then((response) => {
                        // alert(JSON.stringify(response.data.orders))
                        this.orders = response.data.orders
                        this.order_states = response.data.order_states
                    })
                    .catch((error) => {
                        // handle error
                        console.log(error);
                    })
            }, 5000)

        },
    }
</script>

<style scoped>

</style>