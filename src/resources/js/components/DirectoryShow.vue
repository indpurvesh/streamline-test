<template>
      <div class="container m-auto p-4">

      <div class="flex items-center">
        
          <h1 class="text-3xl flex-1 block w-full text-indigo-700">
              Directory Details
          </h1>
          <a class="ml-auto px-3 py-2 text-xs bg-indigo-500 hover:bg-indigo-700 text-white rounded" 
            @click.prevent="$modal.show('upload-file')"
            href="#">
                Upload File
          </a>
      </div>
      <div class="block mt-5 w-full">
          <div class="flex">
              <div>
                  <svg  class="w-6 h-6 text-indigo-300" 
                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                  </svg>
              </div>
              <div class="ml-5">
                {{ directory.name }}
              </div>
          </div>
          <div class="block w-full mt-5">
              <div class="text-indigo-500 text-xl mb-5">
                  List of Child Directories
              </div>
              <div class="ml-5">
                <ul>
                    <li v-for="(child,index) in directory.children" :key="index">
                        {{ child.name }}
                    </li>               
                </ul>
              </div>
          </div>
          <div class="block w-full mt-5">
              <div class="text-indigo-500 text-xl mb-5">
                  List of files in this directory
              </div>
              <div class="ml-5">
                <ul>
                    <li class="my-3 flex w-full text-xs text-gray-600" 
                        v-for="(file,index) in directory.files" :key="index">
                        <span class="mx-3">{{ file.mime_type }}</span>
                        <span class="mx-3">{{ file.path }}</span>
                    </li>
               
                   
                </ul>
              </div>
          </div>
      </div>

      <modal name="upload-file">
           
          <div class="p-5">
              <div class=" text-indigo-700 border-b">
                  Upload File
              </div>
              <div class="mt-3">
                  <label for="file" class="w-full block text-gray-700">
                    Select File
                  </label>
                  <input id="file" type="file"  @change="fileOnChange" class="block w-full" name="file" />
              </div>
              <div class="mt-3 py-3">
                  <button @click.prevent="uploadFileOnClick" type="button" class="px-3 py-2 bg-indigo-500 hover:bg-indigo-700 text-white rounded"> 
                      Upload
                  </button>
                  
                  <a @click.prevent="$modal.hide('upload-file')"
                      class="px-3 py-2 bg-gray-500 hover:bg-gray-700 text-white rounded"
                  >
                      Close
                  </a>
              </div>
          </div>
      </modal>
  </div>
</template>

<script>
    export default {
        props: ['initDirectory'],
        data() {
            return {
                file: new FormData(),
                selectedFile: false,
                directory: {}
            }
        },
        methods: {
            fileOnChange(event) {
                 if(event == "") {
                   return false  
                 } 
                this.file.append("file", event.target.files[0])
                this.selectedFile = true
            },
            uploadFileOnClick() {
                
                if (!this.selectedFile) {
                    alert('Please Select the file First')
                    return
                }
                var app = this
                
                let url = `/directory/${this.initDirectory.id}/file` 
                axios.post(url, this.file, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function ({data}) {
                    if (data.success) {
                        app.directory.files.push(data.file_model)
                        app.$modal.hide('upload-file')
                    } else {
                        alert('There is an issue while upladiing a file')
                    }
                })
                .catch(function (error) {
                    alert('There is an issue while upladiing a file')
                });
            }
        },
        mounted() {
            this.directory = this.initDirectory
        }
    }
</script>
