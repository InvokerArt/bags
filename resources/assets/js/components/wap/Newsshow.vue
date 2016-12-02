<template>
    <div>
        <section class="content">
            <div class="wrap news">
                <img :src="news.image" class="banner">
                <div class="content">
                    <h2>{{news.title}}</h2>
                    <div class="time">{{news.created_at}}</div>
                    <div v-html="news.content"></div>
                </div>
            </div>
        </section>
    </div>
</template>

<script type="text/babel">
    export default {
        created() {
            this.id = this.$route.params.id
            this.newsShow()
        },
        data() {
            return {
                news: {}
            };
        },
        methods: {
            newsShow() {
                var _this = this
                this.$http.get('/api/news/'+ this.id)
                        .then(response => {
                    this.news = response.data.data
            },response => {
                    this.$message({
                        showClose: true,
                        message: '好像哪里出错了!',
                        type: 'error',
                        onClose: function () {
                            _this.$router.push({name: 'user'})
                        }
                    })
                })
            }
        }
    }
</script>