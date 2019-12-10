<template>
     <GmapMap
            id="googlemap"
            ref="map"
            :center="center"
            :zoom="10"
          >
            <GmapMarker
              v-for="(m, index) in markers"
              :key="index"
              :position="m.position"
              :clickable="true"
              :draggable="true"
              @click="center=m.position"
            />
     </GmapMap>         
</template>

<script>
export default {
   data(){
       return{

            markers: [
                    {  position: { lat: 0, lng: 0 }  },
                ],
            center: {
                lat: 0,
                lng: 0
            },
       }

   }
}
</script>