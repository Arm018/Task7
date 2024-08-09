<script setup>
import VerticalNavSectionTitle from '@/@layouts/components/VerticalNavSectionTitle.vue'
import VerticalNavGroup from '@layouts/components/VerticalNavGroup.vue'
import VerticalNavLink from '@layouts/components/VerticalNavLink.vue'
</script>

<template>
    <!-- 👉 Dashboards -->
    <VerticalNavGroup
        :item="{
      title: 'Dashboards',
      icon: 'ri-home-smile-line',
    }"
    >
        <VerticalNavLink
            :item="{
        title: 'Home',
        to: '/admin/dashboard',
      }"
        />
        <VerticalNavLink
            :item="{
        title: 'Manage Authors',
        to: '/admin/authors',
      }"
        />
        <VerticalNavLink
            :item="{
        title: 'Manage Books',
        to: '/admin/books',
      }"
        />


    </VerticalNavGroup>



</template>
