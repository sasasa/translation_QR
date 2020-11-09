<template>
    <ThanksComponent
        v-bind:session_key="session_key"
        v-bind:seat_hash="seat_hash"
        v-bind:lang="lang"
        v-bind:payment="payment"
    />
</template>

<script>
    import ThanksComponent from './ThanksComponent'

    export default {
        name: 'paypaythanks-component',
        components: {
            ThanksComponent,
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
            thanks_lang_payment: {
                type: String,
                required: true,
            },
        },
        data() {
            return {
                thanks: '',
                lang: '',
                payment: '',
            }
        },
        computed: {
        },
        methods: {
        },
        created() {
            const ary = this.thanks_lang_payment.split('%2F')
            this.thanks = ary[1]
            this.lang = ary[2]
            this.payment = ary[3]
        }
    }
</script>

<style scoped>

</style>