import { ref } from "vue";

const isOpen = ref(false);

export function useSidebar() {
    console.log("in use sidebar composable");
    return {
        isOpen,
    };
}
