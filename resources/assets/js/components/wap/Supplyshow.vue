<template>
    <div>
        <section class="content">
            <div class="wrap product">
                <div class="info">
                    <img :src="product.images[0]" class="banner">
                    <div class="detail">
                        <h2>{{product.title}}</h2>
                        <span class="price">价格：{{product.price}}/<em v-if="product.unit===1">只</em><em v-if="product.unit===2">个</em><em v-if="product.unit===3">扎</em><em v-if="product.unit===4">袋</em><em v-if="product.unit===5">箱</em></span>
                        <span class="address"><img src="/images/wap/location.png">{{product.province}}{{product.city}}{{product.area}}</span>
                    </div>
                </div>
                <div class="content">
                    <h3>产品描述：</h3>
                    <div v-html="product.content"></div>
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
            this.productShow()
        },
        data() {
            return {
                product: {
                    images:[]
                }
            };
        },
        methods: {
            productShow() {
                var _this = this
                this.$http.get('api.51hbjjd.com/supplies/'+ this.id)
                        .then(response => {
                    this.product = response.data.data
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