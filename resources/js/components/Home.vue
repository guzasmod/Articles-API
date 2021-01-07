<template>
    <div>


  <!-- <div class="bg"
       :style="{ backgroundImage: 'url(' + image + ')' }">
       </div> -->

<!-- <div class="container">
	<div class="row">
	<img src="https://ik.imagekit.io/demo/img/responsive_images_srcset_sizes_assets/big/1.jpeg" srcset="https://ik.imagekit.io/demo/img/tr:w-500/responsive_images_srcset_sizes_assets/big/1.jpeg 500w, https://ik.imagekit.io/demo/img/tr:w-800/responsive_images_srcset_sizes_assets/big/1.jpeg 800w, https://ik.imagekit.io/demo/img/tr:w-1024/responsive_images_srcset_sizes_assets/big/1.jpeg 1024w" sizes="(min-width: 1024px) 1024px, 100vw">
	</div>
</div> -->
<div :style="{ backgroundImage: 'url(' + image + ')' }" class="bg"></div>


<!-- <h1>Hello</h1> -->

  </div>
</template>

<script>
export default {
      data() {
    return {
    //   image: { backgroundImage: "url(https://vuejs.org/images/logo.png)" },
    //image: "http://1.bp.blogspot.com/-8PfnHfgrH4I/TylX2v8pTMI/AAAAAAAAJJ4/TICBoSEI57o/s1600/search_by_image_image.png",
   // image: "https://i.pinimg.com/originals/93/29/d0/9329d0432af08368a94dc689f628660a.jpg",
    image: "https://ik.imagekit.io/demo/img/responsive_images_srcset_sizes_assets/big/1.jpeg",
    };
  }
}
</script>

<style scoped>
body, html {
  height: 100%;
}

.bg {
    display: block;
  margin-left: auto;
  margin-right: auto;
   margin-top: 50px;
  /* margin-bottom: auto; */
  /* background-image: url("img_girl.jpg"); */
  /* height: 900px;
  width: 1500px; */
    height: 450px;
  width: 750px;
  background-repeat: no-repeat;
  border-radius: 50%;
}   

.circular{
   /* width: 900px;  */
   max-width: 50%;
   max-height: 50%;
  /* width: 20px; */
   /* height: 900px;  */
  /* height: 20px; */
  background-size: contain;
  background-repeat: no-repeat;
  /* border-radius: 50px;
  -webkit-border-radius: 50px;
  -moz-border-radius: 50px; */
}

img {
    max-width: 100%;
}

</style>