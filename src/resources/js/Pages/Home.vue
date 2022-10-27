<template>
    <AppLayout>
        <div class="text-center" v-if="loading">loading...</div>
        <div v-else>
            <PostListItem v-for="post in result.posts.data" :post="post" :key="post.id"/>
            <PaginationLinks v-if="result.posts.paginatorInfo.total > 10" :pagination-data="result.posts.paginatorInfo">
                <PaginationPrevButton :disabled="page <= 1" @click="prev"/>
                <PaginationNextButton :disabled="!result.posts.paginatorInfo.hasMorePages" @click="next"/>
            </PaginationLinks>
        </div>
    </AppLayout>
</template>

<script>
import {useQuery} from '@vue/apollo-composable'
import gql from 'graphql-tag'
import PostListItem from "../Components/PostListItem.vue"
import AppLayout from "../Layouts/AppLayout.vue";
import PaginationLinks from "../Components/PaginationLinks.vue";
import PaginationNextButton from "../Components/PaginationNextButton.vue"
import PaginationPrevButton from "../Components/PaginationPrevButton.vue"
import {ref} from "vue";

let page = ref(1);

export default {
    components: {
        PostListItem,
        AppLayout,
        PaginationLinks,
        PaginationNextButton,
        PaginationPrevButton
    },
    methods: {
        prev: function() {
            this.page = this.page - 1
        },
        next: function() {
            this.page = this.page + 1
        }
    },
    setup() {
        const {result, loading} = useQuery(gql`
          query getPosts($page: Int!) {
            posts(page: $page) {
            paginatorInfo {
                total
                firstItem
                lastItem
                hasMorePages
            }
            data {
              id
              title
              lead
              created_at
              user {
                id
                name
              }
              topic {
                name
                slug
              }
            }
          }
        }
        `, {
            page
        })


        return {
            result,
            loading,
            page
        }
    },
}
</script>
