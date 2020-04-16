<template>
    <div>
       <froala id="edit" :tag="'textarea'" :config="config" v-model="model"></froala>

       {{model}}
    </div>
</template>

<script>
import VueFroala from 'vue-froala-wysiwyg';
import urlBase from '@/js/url';

export default {
  data () {
    return {
      config: {
        imageUploadURL: urlBase.urlWeb,
        events: {
          'initialized': function () {
            console.log('initialized')
          },
          'image.inserted': function ($img, response) {
            // Image was inserted in the editor.
            
            console.log(this)
            console.log($img.attributes.src)
          },
          'image.removed': function ($img,response) {
            // Do something here.
            // this is the editor instance.
             console.log($img.attributes)
            }
        }        
      },
      model: urlBase.urlWeb
    }
  }
}
</script>
