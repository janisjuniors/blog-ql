<template>
    <div class="flex mb-7 mt-2 flex-col cursor-default shadow p-6 bg-gray-100 space-y-4">
        <Link :href="`/post/` + post.id">
            <div class="font-medium text-lg hover:underline cursor-pointer">
                {{ post.title }}
            </div>
        </Link>
        <p class="text-gray-600 my-1">{{ post.lead }}</p>
        <p class="text-gray-700 my-1 flex justify-between">
            <span>
                By
                <span class="underline">
                    <Link :href="`/author/` + post.user.id">
                        {{ post.user.name }}
                    </Link>
                </span>
                in
                <span class="underline text-gray-800 hover:text-gray-600 cursor-pointer">
                    <Link :href="`/topic/` + post.topic.slug">
                        {{ post.topic.name }}
                    </Link>
                </span>
            </span>
            <span>
                {{ longDate(post.created_at) }}
            </span>
        </p>
    </div>
</template>

<script>
import moment from "moment";
import { Link } from '@inertiajs/inertia-vue3'

export default {
    props: {
        post: Object
    },
    components: {
        Link
    },
    methods: {
        longDate: function (date) {
            return moment(date).format('MMMM Do YYYY');
        }
    },
 }
</script>
