<template>
    <div class="company">
        <section class="content">
            <div class="wrap">
                <div class="company-info">
                    <div class="pic"><img :src="company.photos[0]" alt=""></div>
                    <div class="detail">
                        <h3>{{company.name}}</h3>
                        <p>地址：{{company.province}}{{company.city}}{{company.area}}{{company.addressDetail}}</p>
                        <p>电话：{{company.telephone}}</p>
                    </div>
                </div>
                <div class="company-categories">
                    <div>主营：<span v-for="(category, index) in categories">{{category.name}}<em v-show="filterNum(index)">、</em></span></div>
                    <mt-button size="normal" type="primary">我要加盟</mt-button>
                </div>
                <mt-navbar v-model="selected">
                    <mt-tab-item id="1">主营产品</mt-tab-item>
                    <mt-tab-item id="2">公司介绍</mt-tab-item>
                    <mt-tab-item id="3">招聘信息</mt-tab-item>
                </mt-navbar>
                <mt-tab-container v-model="selected" class="products">
                    <mt-tab-container-item id="1">
                        <ul>
                            <li v-for="product in products">
                                <img :src="product.images[0]">
                                <div class="product-detail">
                                    <a href="#">{{product.title}}</a>
                                    <span class="price">价格：{{product.price}}/<em v-if="product.unit===1">只</em><em v-if="product.unit===2">个</em><em v-if="product.unit===3">扎</em><em v-if="product.unit===4">袋</em><em v-if="product.unit===5">箱</em></span>
                                </div>
                            </li>
                        </ul>
                    </mt-tab-container-item>
                </mt-tab-container>
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
            this.companyShow()
        },
        data() {
            return {
                company: {},
                categories: [],
                products: [],
                user:'',
                selected: '1'
            };
        },
        methods: {
                companyShow() {
                    var _this = this
                    this.$http.get('http://api.51hbjjd.com/companies/'+ this.id)
                    .then(response => {
                        this.company = response.data.data
                        this.categories = response.data.data.categories.data
                        this.products = response.data.data.products.data
                        this.user = response.data.data.user.data
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
                },
                filterNum(val) {
                    if(val==this.categories.length-1) {
                        return false;
                    }
                    return true;
                }
        }
    }
</script>