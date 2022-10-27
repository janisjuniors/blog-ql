<template>
    <AppLayout>
        <div class="text-center mt-10" v-if="error">{{ errorCheck(error.graphQLErrors[0].debugMessage) }}</div>
        <div class="text-center" v-else-if="loading">loading...</div>
        <div class="flex flex-col space-y-6 mb-16" v-else>
            <div class="mt-5 mb-5 text-gray-500">
                By
                <span class="underline">
                    <Link :href="`/author/` + result.post.user.id">
                        {{ result.post.user.name }}
                    </Link>
                </span>
                in
                <Link :href="`/topic/` + result.post.topic.slug">
                    <span class="underline">
                        {{ result.post.topic.name }}
                    </span>
                </Link>
                ● {{ timeAgo(result.post.created_at) }}
            </div>
            <div class="text-5xl mb-8">{{ result.post.title }}</div>
            <p class="text-gray-500 whitespace-pre-line" style="margin-top: 3rem">{{ result.post.content }}</p>
            <div class="flex space-x-6" style="margin-top: 3rem">
                <img
                    class="w-20 h-20 rounded-full object-cover ring-2 ring-gray-300 p-1"
                    :src="'/storage/faces/' + result.post.user.image + '.jpg'"
                    :alt="result.post.user.image"
                >
                <div class="flex flex-col text-gray-600 justify-center">
                    <span class="text-lg">
                        Written by
                        <Link :href="'/author/' + result.post.user.id">
                            <span class="underline">{{ result.post.user.name }}</span>
                        </Link>
                    </span>
                    <span>
                        Published in
                        <Link :href="'/topic/' + result.post.topic.slug">
                            <span class="underline">{{ result.post.topic.name }}</span>
                        </Link>
                        on {{ longDate(result.post.created_at) }}
                    </span>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { useQuery } from '@vue/apollo-composable'
import { Link } from "@inertiajs/inertia-vue3";
import AppLayout from "../Layouts/AppLayout.vue";
import moment from 'moment'

import gql from 'graphql-tag'

export default {
    components: {
        Link,
        AppLayout
    },
    methods: {
        timeAgo: function (date) {
            return moment(date).fromNow();
        },
        longDate: function (date) {
            return moment(date).format('MMMM Do YYYY');
        },
        errorCheck: function (errorMessage) {
            return errorMessage === "Cannot return null for non-nullable field \"Query.post\"." ? 'Sorry, post could not be found!' : 'Something went wrong!';
        }
    },
    setup () {
        const { pathname } = window.location
        const splitPathname = pathname.split("/")
        const id = splitPathname[splitPathname.length - 1]

        const { result, loading, error } = useQuery(gql`
          query getPost($id: ID!) {
            post(id: $id) {
              id
              title
              content
              created_at
              user {
                id
                name
                image
              }
              topic {
                name
                slug
              }
            }
          }
        `,
            {
                id
            }
        )

        return {
            result,
            loading,
            error
        }
    },
}
</script>
