<template>
    <div id="home">
        <header id="header">
            <div class="container">
                <div class="intro-text">
                    <h1>SS panel</h1>
                    <p>Life is short. The world is big.</p>
                    <router-link to="login"
                                 class="btn btn-custom btn-lg page-scroll">Get Start</router-link>
                </div>
            </div>
        </header>
        <div id="about">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-6 ">
                        <div class="about-img"><img src="http://xyz.ishadow.online/img/about.jpg"
                                 class="img-responsive"
                                 alt=""></div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="about-text">
                            <h2>How to use it</h2>
                            <hr>
                            <p>This software supported on most common devices like Windows/iPhone/iPad/Android/Macbook. There are only two steps to get it working. First, download and install it. Second, open it and scan QR image. Servers will be configured automatically. Then surfing any websites you like.</p>
                            <a href="#"
                               class="btn btn-custom btn-lg"
                               target="_blank">Tutorials</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>
