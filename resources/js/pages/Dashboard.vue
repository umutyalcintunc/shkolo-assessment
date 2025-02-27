<script setup lang="ts">
import { ref } from 'vue';
import ConfigureButton from './ConfigureButton.vue';

interface Button {
    id: number;
    label: string;
    color: string | null;
    link: string | null;
}

defineProps<{
    buttons: Button[];
}>();


const isConfiguring = ref(false);

const defaultButton: Button = {
    id: 0,
    label: '',
    color: null,
    link: null,
};
const selectedButton = ref<Button | null>(null);

function handleButtonClick(button: Button) {
    if (button.link) {
        window.open(button.link, '_blank');
    } else {
        selectedButton.value = button;
        isConfiguring.value = true;
    }
}

function editButton(button: Button) {
    console.log('Edit button clicked:', button);
    selectedButton.value = button;
    isConfiguring.value = true;
}


function closeConfiguration() {
    isConfiguring.value = false;
    selectedButton.value = null;
}

function updateButton(updatedButton: Button) {
    console.log('Button updated:', updatedButton);
    closeConfiguration();
}

function deleteButton(buttonId: number
) {
    console.log('Button deleted:', buttonId);
    closeConfiguration();
}

</script>

<template>
    <div v-if="!isConfiguring" class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
        <div
            v-for="button in buttons"
            :key="button.id"
            class="relative flex items-center justify-center aspect-square rounded-md bg-gray-100 dark:bg-gray-800 shadow"
        >
            <button
                class="w-full h-full rounded-md cursor-pointer flex items-center justify-center"
                :class="'bg-' + (button.color || 'gray-200')"
                @click="handleButtonClick(button as Button)"
            >
                <span :class="!button.link ? 'text-8xl font-extrabold text-black leading-none' : ''">
                    {{ button.link ? button.label : '+' }}
                </span>
            </button>

            <button
                v-if="button.link"
                class="absolute top-2 right-2 p-2 bg-white rounded-full shadow cursor-pointer"
                @click.stop="editButton(button)"
            >
                <span class="text-gray-500 text-sm">✏</span>
            </button>
        </div>
    </div>

    <ConfigureButton
        v-else
        :button="selectedButton || defaultButton"
        @update="updateButton"
        @delete="deleteButton"
        @close="closeConfiguration"
    />
</template>
