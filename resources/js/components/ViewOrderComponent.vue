<template>
    <div>
        <h1>注文・お会計確認</h1>

        <p>{{payment_message}}</p>
        <transition-group tag="table" class="table">
            <tr v-for="payment in payments" v-bind:class="classPaymentDisplay(payment)" v-bind:key="payment.id" v-show="isPaymentDisplay(payment)">
                <th>{{payment.seat_session.seat.seat_name}}</th>
                <td>お会計(ID:{{payment.id}})：{{payment.tax_included_price}}円</td>
                <td>
                    <select class="form-control" v-on:change="paymentStateChange(payment, $event)">
                        <option v-for="(val, idx) in payment_states" v-bind:key="idx" v-bind:value="idx" v-bind:selected="payment.payment_state == idx">
                            {{val}}
                        </option>
                    </select>
                </td>
            </tr>
        </transition-group>

        <p>{{message}}</p>
        <transition-group tag="table" class="table">
        <tr v-for="order in orders" v-bind:class="classDisplay(order)" v-bind:key="order.id" v-show="isDisplay(order)">
            <th>{{order.seat_session.seat.seat_name}}</th>
            <td>{{order.item_jp.item_name}}(ID:{{order.id}})</td>
            <td>
                <select class="form-control" v-on:change="takeoutChange(order, $event)">
                    <option v-for="(val, idx) in takeouts" v-bind:key="idx" v-bind:value="idx" v-bind:selected="order.is_take_out == idx">
                        {{val}}
                    </option>
                </select>
            </td>
            <td>
                <select class="form-control" v-on:change="stateChange(order, $event)">
                    <option v-for="(val, idx) in order_states" v-bind:key="idx" v-bind:value="idx" v-bind:selected="order.order_state == idx">
                        {{val}}
                    </option>
                </select>
            </td>
        </tr>
        </transition-group>
    </div>
</template>

<script>
    import moment from "moment";

    export default {
        name: 'view-order-component',
        props: {
        },
        data() {
            return {
                message: 'ここに注文メッセージが表示されます',
                payment_message: 'ここにお会計メッセージが表示されます',
                orders: [],
                payments: [],
                order_states: [],
                payment_states: [],
                takeouts: [
                    '店内飲食',
                    'テイクアウト',
                ]
            }
        },
        watch:  {
            orders: {
                handler: function(after, before) {
                    let audio = new Audio('sound/water-drop3.mp3');
                    audio.addEventListener('canplaythrough', () => {
                        audio.play()
                    }, false);
                },
                deep: true,
                immediate: false,
            }
        },
        methods: {
            print() {

            },
            classDisplay(order) {
                if(order.order_state == "cancel") {
                    return 'cancel'
                } else if(order.order_state == "delivered") {
                    return 'delivered'
                }
            },
            classPaymentDisplay(payment) {
                if(payment.payment_state == "printing") {
                    return 'printing'
                } else if(payment.payment_state == "afterpaying") {
                    return 'afterpaying'
                }
            },
            objectEquals(a, b) {
                let aJSON = JSON.stringify(this.objectSort(a));
                let bJSON = JSON.stringify(this.objectSort(b));

                return aJSON === bJSON
            },
            objectSort(obj) {
                // まずキーのみをソートする
                let keys = Object.keys(obj).sort();
                // 返却する空のオブジェクトを作る
                let map = {};
                // ソート済みのキー順に返却用のオブジェクトに値を格納する
                keys.forEach((key) => {
                    let val = obj[key];
                    // 中身がオブジェクトの場合は再帰呼び出しを行う
                    if(typeof val === "object"){
                        val = this.objectSort(val);
                    }
                    map[key] = val;
                });
                return map;
            },
            isPaymentDisplay(payment) {
                let afterpaying_time = moment(payment.updated_at)
                let now = moment()
                if (now > afterpaying_time.add(30, 's') && payment.payment_state == "afterpaying") {
                    // 支払い済の際は30秒表示する
                    return false
                } else {
                    return true
                }
            },
            isDisplay(order) {
                let cancel_time = moment(order.updated_at)
                let delivered_time = moment(order.updated_at)
                let now = moment()
                if (now > cancel_time.add(30, 's') && order.order_state == "cancel") {
                    // キャンセルの際は30秒表示する
                    return false
                } else if (now > delivered_time.add(30, 's') && order.order_state == "delivered") {
                    // お届け済みの際は30秒表示する
                    return false
                } else {
                    return true
                }
            },
            takeoutChange(order, event) {
                // alert(event.target.value)
                axios
                    .patch(`/api/orders/${order.id}/takeout`, {
                        is_take_out: event.target.value
                    })
                    .then((response) => {
                        this.message = response.data.message
                        order.is_take_out = event.target.value
                        order.updated_at = response.data.updated_at
                        this.classDisplay(order)
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            },
            paymentStateChange(payment, event) {
                axios
                    .patch(`/api/payments/${payment.id}/`, {
                        payment_state: event.target.value
                    })
                    .then((response) => {
                        this.payment_message = response.data.message
                        payment.payment_state = event.target.value
                        payment.updated_at = response.data.updated_at
                        this.classPaymentDisplay(payment)

                        if(payment.payment_state == "printing") {
                            window.open(`/print/${payment.seat_session.id}`)
                        }
                    })
                    .catch((error) => {
                        // handle error
                        console.log(error);
                    })
            },
            stateChange(order, event) {
                axios
                    .patch(`/api/orders/${order.id}/`, {
                        order_state: event.target.value
                    })
                    .then((response) => {
                        this.message = response.data.message
                        order.order_state = event.target.value
                        order.updated_at = response.data.updated_at
                        this.classDisplay(order)
                    })
                    .catch((error) => {
                        // handle error
                        console.log(error);
                    })
            },
            getData() {
                axios
                    .post(`/api/json_orders`)
                    .then((response) => {
                        if(this.orders.length < response.data.orders.length) {
                            let audio = new Audio('sound/shop-chime1.mp3');
                            audio.addEventListener('canplaythrough', () => {
                                audio.play()
                            }, false);
                        }
                        if(this.payments.length < response.data.payments.length) {
                            let audio = new Audio('sound/clearing1.mp3');
                            audio.addEventListener('canplaythrough', () => {
                                audio.play()
                            }, false);
                        }
                        if( !this.objectEquals(this.orders, response.data.orders) ) {
                            this.orders = response.data.orders
                        }
                        if( !this.objectEquals(this.payments, response.data.payments) ) {
                            this.payments = response.data.payments
                        }
                        this.order_states = response.data.order_states
                        this.payment_states = response.data.payment_states
                    })
                    .catch((error) => {
                        // handle error
                        console.log(error);
                    })
            }
        },
        computed: {
        },
        mounted() {
            this.getData()
            setInterval(() => {
                this.getData()
            }, 5000)

        },
    }
</script>

<style scoped>
.cancel,
.printing {
    background: red;
}
.delivered,
.afterpaying {
    background: skyblue;
}

/* 表示・非表示アニメーション中 */
.v-enter-active, .v-leave-active {
    transition: all 12000ms;
}
.v-leave-active {
    transition: all 5000ms;
}
/* 表示アニメーション開始時 ・ 非表示アニメーション後 */
.v-enter {
    opacity: 0.5;
    background: pink;
}
.v-leave-to {
    opacity: 0;
}
</style>