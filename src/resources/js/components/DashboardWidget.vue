<template>
    <ul>
        <li class="appearance-none flex items-center" 
            v-for="(directory, index) in initDirectories"
            :key="index"
        >
             <directory-item :init-directory="directory"></directory-item>
      </li>
    </ul>
</template>
<script>
export default {
    props: ['initDirectories'],
    
    mounted() {
        // this.directories = this.initDirectories
    }
}
</script>
