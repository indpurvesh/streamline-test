<template>
    <ul>
        <li class="appearance-none w-full block">
            
            <div @click="toggle">
                {{ directory.name }}
                <span v-if="isFolder">[{{ isOpen ? '-' : '+' }}]</span>
            </div>
            <ul v-show="isOpen" class="block w-full ml-5" v-if="isFolder">
                <li v-for="(file, fileIndex) in directory.files" :key="`file-${fileIndex}`">
                    File Path: {{ file.path }}
                </li>
                <directory-item
                    class="item"
                    :init-fetch="true"
                    v-for="(child, index) in directory.children"
                    :key="index"
                    :init-directory="child"
                ></directory-item>
            </ul>
      </li>
    </ul>
</template>
<script>
export default {
    props: {
        'initDirectory' : {
            type: [Object]
        }, 
        'initFetch' : {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            isOpen: false,
            directory: {}
        }
    },
    methods: {
        toggle: function() {
            if (this.isFolder) {
                this.isOpen = !this.isOpen;
            }
        },
        fetchDirectory() {
            let url = `/directory/${this.initDirectory.id}/file`
            var app = this
            axios.get(url, this.file)
            .then(function ({data}) {
                app.directory = data
                app.$set(app, 'directory', data)
                if (app.isFolder) {
                   app.isOpen = !app.isOpen;
                }
            })
            .catch(function (error) {
                alert('There is an issue while fetching directory info')
            });
        }
    },

    computed: {
        isFolder: function() {
            return this.directory.children && this.directory.children.length;
        }
    },
    mounted() {
        if (this.initFetch) {
            this.fetchDirectory()
        } else {
            this.directory = this.initDirectory
        }
    }
}
</script>
