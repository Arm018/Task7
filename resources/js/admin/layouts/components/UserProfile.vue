<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
import avatar1 from '@images/avatars/avatar-1.png'

const adminName = ref('')
const router = useRouter()

onMounted(async () => {
    try {
        const response = await axios.get('/api/admin')
        adminName.value = response.data.name
    } catch (error) {
        console.error('Failed to fetch admin name:', error)
    }
})

const logout = async () => {
    try {
        await axios.post('/admin/logout', {}, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        window.location.href = '/'
    } catch (error) {
        console.error('Logout failed:', error)
    }
}
</script>

<template>
    <VBadge
        dot
        location="bottom right"
        offset-x="3"
        offset-y="3"
        color="success"
        bordered
    >
        <VAvatar
            class="cursor-pointer"
            color="primary"
            variant="tonal"
        >
            <VImg :src="avatar1" />

            <!-- SECTION Menu -->
            <VMenu
                activator="parent"
                width="230"
                location="bottom end"
                offset="14px"
            >
                <VList>
                    <!-- 👉 User Avatar & Name -->
                    <VListItem>
                        <template #prepend>
                            <VListItemAction start>
                                <VBadge
                                    dot
                                    location="bottom right"
                                    offset-x="3"
                                    offset-y="3"
                                    color="success"
                                >
                                    <VAvatar
                                        color="primary"
                                        variant="tonal"
                                    >
                                        <VImg :src="avatar1" />
                                    </VAvatar>
                                </VBadge>
                            </VListItemAction>
                        </template>

                        <VListItemTitle class="font-weight-semibold">
                            {{ adminName }}
                        </VListItemTitle>
                        <VListItemSubtitle>Admin</VListItemSubtitle>
                    </VListItem>
                    <VDivider class="my-2" />

                    <!-- 👉 Profile -->
                    <VListItem link>
                        <template #prepend>
                            <VIcon
                                class="me-2"
                                icon="ri-user-line"
                                size="22"
                            />
                        </template>

                        <VListItemTitle>Profile</VListItemTitle>
                    </VListItem>

                    <!-- Divider -->
                    <VDivider class="my-2" />

                    <!-- 👉 Logout -->
                    <VListItem @click="logout">
                        <template #prepend>
                            <VIcon
                                class="me-2"
                                icon="ri-logout-box-r-line"
                                size="22"
                            />
                        </template>

                        <VListItemTitle>Logout</VListItemTitle>
                    </VListItem>
                </VList>
            </VMenu>
            <!-- !SECTION -->
        </VAvatar>
    </VBadge>
</template>
