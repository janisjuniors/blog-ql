<template>
    <div class="flex flex-col justify-center border-b mb-5">
        <h1
            :class="homeLink() ? 'border-gray-500' : ''"
            class="flex justify-center mx-auto items-center text-gray-500 font-medium border-b-4 hover:text-gray-500 hover:border-gray-500 duration-500 text-4xl pb-2 w-fit h-fit mt-7 mb-3">
            <Link href="/">
                Blog QL
            </Link>
        </h1>

        <div
            v-if="result"
            class="flex justify-center items-center text-gray-500 my-5 space-x-6 md:space-x-10 lg:space-x-14">
            <span
                v-for="topic in result.topics"
                :key="topic.id"
                :class="activeLink(topic.slug) ? 'border-gray-500' : 'border-transparent hover:border-gray-300'"
                class="flex justify-center border-b-4 items-center font-medium duration-500 text-xl md:text-2xl lg:text-2xl w-fit h-fit py-1"
            >
                <Link :href="'/topic/' + topic.slug">
                    {{ topic.name }}
                </Link>
            </span>
        </div>
    </div>
</template>

<script>
import { useQuery } from '@vue/apollo-composable'
import gql from 'graphql-tag'
import {Link} from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link
    },
    methods: {
        activeLink(linkSlug) {
            return this.slug === linkSlug
        },
        homeLink() {
            return this.pathname === '/'
        }
    },
    setup () {
        const { pathname } = window.location
        const splitPathname = pathname.split("/")
        const slug = splitPathname[splitPathname.length - 1]

        const { result, loading } = useQuery(gql`
          query getTopics {
           topics {
             id
             name
             slug
           }
          }
        `)

        return {
            result,
            loading,
            slug,
            pathname
        }
    },
}
</script>
