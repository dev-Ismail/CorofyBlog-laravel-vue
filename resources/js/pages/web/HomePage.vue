<template>
    <div id="home-page">

        <slider></slider>
        


        <section class="site-section py-sm">
            <div class="container">
                <div class="row blog-entries">

                    <!------------ searching Posts ----------------->
                    <searching :searchVal="searchVal" v-if="searchVal"></searching>

                    <!------------ Latest Posts ----------------->
                    <div class="col-md-12 col-lg-8 main-content" v-else>
                        <h2 class="mb-4">Latest Posts</h2>
                        <div class="row">
                            <div class="col-md-6" v-for="post in posts.data" :key="post.id" >
                                <router-link :to=" '/post/' + post.slug " class="blog-entry" data-animate-effect="fadeIn">
                                    <img :src=" '/images/posts/' + post.img" alt="Image placeholder">
                                    <div class="blog-content-body">
                                        <div class="post-meta">
                                            <span class="mr-2"> {{ post.added_at }}  </span> &bullet;
                                            <span class="ml-2"><span class="fa fa-comments"></span> {{ post.comments_count }} </span>
                                        </div>
                                        <h2>{{post.body.substring(0, 40)  + '...' }}</h2>
                                    </div>
                                </router-link>
                            </div>
                        </div>

                        <!-- pagination Component -->
                        <pagination :data="posts" @pagination-change-page="getLatestPosts" :limit="3" ></pagination>

                    </div>

                    <!-- sidebar Component -->
                    <sidebar></sidebar>

                </div>
            </div>
        </section>


    </div>
</template>
<script>
    import Sidebar from './../../components/web/Sidebar'
    import Searching from './../../components/web/Searching'
    import Slider from './../../components/web/Slider'
    
    export default {
        components:{
            Sidebar,
            Slider,
            Searching,
        },
        data(){
            return{
                posts: {}
            }
        },
        mounted() {
            this.getLatestPosts();
        },
        computed: {
            searchVal: function() {
                return this.$store.state.searchVal;
            }
        },
        methods:{
            getLatestPosts( page = 1 ){
                axios.get('/api/lastedPosts?page=' + page)
                // .then( resquest => console.log( resquest.data.data ) )    
                .then( 
                    resquest => {  
                        this.posts = resquest.data 
                    }
                )
                .catch( error => console.log(error) )
            },
        }
    }
    
</script>