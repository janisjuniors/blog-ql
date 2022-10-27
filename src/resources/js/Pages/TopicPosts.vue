<template>
    <AppLayout>
        <div class="text-center mt-10" v-if="error">{{ errorCheck(error.graphQLErrors[0].debugMessage) }}</div>
        <div class="text-center" v-else-if="loading">loading...</div>
        <div v-else>
            <PostListItem v-for="post in result.topic.posts.data" :post="post" :key="post.id"/>
            <div v-if="result.topic.posts.paginatorInfo.total > 10">
                <PaginationLinks :pagination-data="result.topic.posts.paginatorInfo">
                    <PaginationPrevButton :disabled="page <= 1" @click="prev"/>
                    <PaginationNextButton :disabled="!result.topic.posts.paginatorInfo.hasMorePages" @click="next"/>
                </PaginationLinks>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { useQuery } from '@vue/apollo-composable'
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
        errorCheck: function (errorMessage) {
            return errorMessage === "Cannot return null for non-nullable field \"Query.topic\"." ? 'Sorry, topic could not be found!' : 'Something went wrong!';
        },
        prev: function() {
            this.page = this.page - 1
        },
        next: function() {
            this.page = this.page + 1
        }
    },
    setup () {
        const { pathname } = window.location
        const splitPathname = pathname.split("/")
        const slug = splitPathname[splitPathname.length - 1]

        const { result, loading, error } = useQuery(gql`
          query getTopic($slug: String!, $page: Int!) {
            topic(slug: $slug) {
               posts(first: 10, page: $page) {
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
          }
        `, {
            slug,
            page
        })

        return {
            result,
            loading,
            error,
            page
        }
    },
}
</script>
