<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    links: Array,
});

const defLabel = (i) => {
    const idx = i +1
    if (idx === 1) {
        return "Previous";
    } else if (idx === props.links.length) {
        return "Next";
    } else {
        return `Page ${i}`;
    }
}

// Use default Laravel pagination

</script>

<template>
    <nav v-if="links.length > 3" class="pagination mx-auto mt-4">
        <ul class="flex gap-0.5">
            <li v-for="(page, i) in links"
                :key="i"
            >
            <!--                pagination links active or disabled -->
                <Link
                    :href="page.url || ''"
                    v-html="page.label"
                    :aria-label="defLabel(i)"
                    :title="defLabel(i)"
                    :class="{'active bg-violet-700 text-white': page.active, 'pointer-events-none bg-zinc-300': !page.url}"
                    class="p-2 rounded-md bg-violet-200 hover:bg-violet-400 hover:text-white ease-in"
                />
            </li>
        </ul>
    </nav>
</template>

