<template>
    <div v-if="paginationData" class="flex flex-col items-center">
            <span class="text-sm font-semibold text-gray-900">
                Showing
                <span>
                    {{ paginationData.firstItem }}
                </span>
                to
                <span>
                    {{ paginationData.lastItem }}
                </span>
                of
                <span>
                    {{ paginationData.total }}
                </span>
                Entries
            </span>
        <div class="inline-flex mt-2 xs:mt-0">
            <slot/>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        paginationData: Object,
    },
}
</script>
