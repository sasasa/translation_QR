<template>
    <div>
        <div>
            <a v-bind:href="`/ja/${current_genre}/items`">日本語</a>
            <a v-bind:href="`/en/${current_genre}/items`">English</a>
            <a v-bind:href="`/zh/${current_genre}/items`">中文</a>
            <a v-bind:href="`/ko/${current_genre}/items`">한글</a>
        </div>


        <div v-for="genre in genres" v-bind:key="genre.id">
            <a v-bind:href="`/${lang}/${genre.genre_key}/items`">{{genre.genre_name}}</a>
            <ul v-for="child_genre in genre.children" v-bind:key="child_genre.id">
                <li>
                    <a v-bind:href="`/${lang}/${child_genre.genre_key}/items`">{{child_genre.genre_name}}</a>
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
                <!-- <tr>
                    <th>言語</th>
                    <td>{{item.lang}}</td>
                </tr> -->
                <tr>
                    <th>説明</th>
                    <td>{{item.item_desc}}</td>
                </tr>
                <tr>
                    <th>購入する</th>
                    <td>
                        <span class="h1">＋</span>
                        <span class="h1">－</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'menu-component',
        props: {
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
            }
        },
        mounted() {
            axios
                .get(`/${this.lang}/${this.current_genre}/json_items`)
                .then((response) => {
                    this.items = response.data.items
                    this.genres = response.data.genres
                    // alert(JSON.stringify(response))
                })
            
        }
    }
</script>
