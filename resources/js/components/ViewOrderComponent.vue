<template>
    <div>
        <h1>注文確認</h1>
        <p>{{message}}</p>
        <transition-group tag="table" class="table">
        <tr v-for="order in orders" v-bind:class="classDisplay(order)" v-bind:key="order.id" v-show="isDisplay(order)">
            <th>{{order.seat_session.seat.seat_name}}</th>
            <td>{{order.item_jp.item_name}}(ID:{{order.id}})</td>
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
                message: '',
                orders: [],
                order_states: [],
            }
        },
        watch:  {
            orders: {
                handler: function(after, before) {
                    let audio = new Audio('water-drop3.mp3');
                    audio.addEventListener('canplaythrough', () => {
                        audio.play()
                    }, false);
                },
                deep: true,
                immediate: false,
            }
        },
        methods: {
            classDisplay(order) {
                if(order.order_state == "cancel") {
                    return 'cancel'
                } else if(order.order_state == "delivered") {
                    return 'delivered'
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
            isDisplay(order) {
                let cancel_time = moment(order.updated_at)
                let delivered_time = moment(order.updated_at)
                let now = moment()
                
                if (now > cancel_time.add(2, 'm') && order.order_state == "cancel") {
                    // キャンセルの際は2分表示する
                    return false
                } else if (now > delivered_time.add(30, 's') && order.order_state == "delivered") {
                    // お届け済みの際は30秒表示する
                    return false
                } else {
                    return true
                }
            },
            stateChange(order, event) {
                axios
                    .patch(`/orders/${order.id}/`, {
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
                    .post(`/json_orders`)
                    .then((response) => {
                        if(this.orders.length < response.data.orders.length) {
                            // 注文あり
                            let audio = new Audio('splash-big1.mp3');
                            audio.addEventListener('canplaythrough', () => {
                                audio.play()
                            }, false);
                        }
                        if( !this.objectEquals(this.orders, response.data.orders) ) {
                            // 変化があったとき
                            this.orders = response.data.orders
                        }
                        this.order_states = response.data.order_states
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
.cancel {
    background: red;
}
.delivered {
    background: skyblue;
}

/* 表示・非表示アニメーション中 */
.v-enter-active, .v-leave-active {
    transition: all 15000ms;
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