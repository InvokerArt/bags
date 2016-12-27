<template>
    <div>
        <section class="content">
            <div class="wrap topic">
                <div class="user">
                    <img v-if="user.avatar['_default']" :src="user.avatar['_default']" class="avatar">
                    <img v-else  src="/images/avatar.png" class="avatar">
                    <div class="info">
                        <span class="name">{{user.username}}</span>
                        <span>{{topic.created_at}}<em>阅读{{topic.view_count}}</em></span>
                    </div>
                </div>
                <div class="content">
                    <h2>{{topic.title}}</h2>
                    <div v-html="topic.content"></div>
                    <div class="reply-vote"><img src="/images/wap/vote.png" alt=""><span v-if="topic.vote_count">{{topic.vote_count}}</span><img src="/images/wap/reply.png" alt=""><span v-if="topic.reply_count">{{topic.reply_count}}</span></div>
                </div>
                <div class="replies">
                    <ul>
                        <li v-for="(reply, index) in replies">
                            <div class="user">
                                <img v-if="reply.user.data.avatar['_default']" :src="reply.user.data.avatar['_default']" class="avatar">
                                <img v-else src="/images/avatar.png" class="avatar">
                                <div class="info">
                                    <span class="name">{{reply.user.data.username}}</span>
                                    <span>第{{index+1}}楼<em class="time">{{reply.created_at}}</em></span>
                                </div>
                                <div class="reply-content">
                                    <div v-html="replyContent(reply.replyTo_userid,reply.replyTo_username,reply.content)"></div>
                                </div>
                            </div>
                            <div class="reply-vote">
                                <img src="/images/wap/vote.png" alt=""><span v-if="reply.vote_count">{{reply.vote_count}}</span><img src="/images/wap/reply.png" alt="">
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="add-reply"><input type="text" name="content"><button type="submit" class="mint-button mint-button--primary mint-button--normal">评论</button></div>
            </div>
        </section>
    </div>
</template>

<script type="text/babel">
    export default {
        created() {
            this.id = this.$route.params.id
            this.token = this.$route.params.token
            this.topicShow()
        },
        data() {
            return {
                topic: {},
                user: {},
                replies: {}
            };
        },
        methods: {
            topicShow() {
                var _this = this
                this.$http.get('http://api.51hbjjd.com/topics/'+ this.id, {headers: {'Authorization': 'Bearer '+ this.token}})
                        .then(response => {
                    this.topic = response.data.data
                    this.user = response.data.data.user.data
                    this.replies = response.data.data.replies.data
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
            replyContent(user,name,content){
                var replycontent = '';
                if (user) {
                replycontent += '<a href="m.stone.dev/users/' + user + '">@' + name + '</a> ' + content;
                } else {
                    replycontent = content;
                }
                return replycontent;
            }
        }
    }
</script>