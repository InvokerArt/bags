<template>
    <div>
        <section class="content">
            <div class="wrap exhibitions">
                <img :src="exhibition.image" class="banner">
                <div class="content">
                    <h2>{{exhibition.title}}</h2>
                    <div class="time">{{exhibition.created_at}}</div>
                    <div v-html="exhibition.content"></div>
                </div>
            </div>
            <footer>
                <ul>
                    <li>
                        <img src="/images/wap/mobile.png">
                        电话联系
                    </li>
                    <li>
                        <img src="/images/wap/talk.png">
                        在线沟通
                    </li>
                </ul>
            </footer>
        </section>
    </div>
</template>

<script type="text/babel">
    export default {
        created() {
            this.id = this.$route.params.id
            this.exhibitionShow()
        },
        data() {
            return {
                exhibition: {}
            };
        },
        methods: {
            exhibitionShow() {
                var _this = this
                this.$http.get('api.51hbjjd.com/exhibitions/'+ this.id)
                        .then(response => {
                    this.exhibition = response.data.data
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