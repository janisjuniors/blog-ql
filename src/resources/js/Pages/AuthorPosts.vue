<template>
    <AppLayout>
        <div class="text-center" v-if="error">{{ errorCheck(error.graphQLErrors[0].debugMessage) }}</div>
        <div class="text-center" v-else-if="loading">loading...</div>
        <div v-else>
            <div class="flex space-x-6 w-full justify-center mb-6 mt-3">
                <img
                    class="w-20 h-20 rounded-full object-cover ring-2 ring-gray-300 p-1"
                    :src="'/storage/faces/' + result.user.image + '.jpg'"
                    :alt="result.user.image"
                >
                <div class="flex flex-col text-gray-600 justify-center">
                    <span class="text-lg">
                        {{ result.user.name }}
                    </span>
                    <span>
                        {{ result.user.email }}
                    </span>
                </div>
            </div>
            <PostListItem v-for="post in result.user.posts" :post="post" :key="post.id"/>
        </div>
    </AppLayout>
</template>

<script>
import { useQuery } from '@vue/apollo-composable'
import gql from 'graphql-tag'
import PostListItem from "../Components/PostListItem.vue"
import AppLayout from "../Layouts/AppLayout.vue";

export default {
    components: {
        PostListItem,
        AppLayout
    },
    methods: {
        errorCheck: function (errorMessage) {
            return errorMessage === "Cannot return null for non-nullable field \"Query.user\"." ? 'Sorry, author could not be found!' : 'Something went wrong!';
        }
    },
    setup () {
        const { pathname } = window.location
        const splitPathname = pathname.split("/")
        const id = splitPathname[splitPathname.length - 1]

        const { result, loading, error } = useQuery(gql`
          query getTopic($id: ID!) {
            user(id: $id) {
               name
               image
               email
               posts {
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
            id
        })

        return {
            result,
            loading,
            error
        }
    },
}
</script>
