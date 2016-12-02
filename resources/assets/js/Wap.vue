<template>
    <div>
        <mt-header :title="header_title" v-if="visible">
            <router-link :to="'/'" slot="left">
                <mt-button icon="back"></mt-button>
            </router-link>
            <mt-button slot="right"><i class="fa fa-bars"></i></mt-button>
        </mt-header>
        <router-view></router-view>
    </div>
</template>

<style>
    html, body {
        background-color: #ececec;
        -webkit-overflow-scrolling: touch;
        user-select: none;
        margin:0;
    }
    a {
        color: inherit;
    }
    .mint-header {
        background-color: #5fad0a
    }
</style>

<script type="text/babel">
    export default {
        computed: {
            header_title:function(){
                return this.$route.name
            },
            visible() {
                return ['/'].indexOf(this.$route.path) < 0;
            }
        }
    };
</script>