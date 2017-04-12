<template>
    <div id="home">
        <header id="header">
            <div class="container">
                <div class="intro-text">
                    <h1>SS panel</h1>
                    <p>Life is short. The world is big.</p>
                    <router-link to="login" class="btn btn-custom btn-lg page-scroll">开始使用</router-link>
                </div>
            </div>
        </header>

        <div id="about">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-6 ">
                        <div class="about-img"><img src="/storage/img/about.jpg" class="img-responsive" alt=""></div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="about-text">
                            <h2>如何使用</h2>
                            <hr>
                            <p>支持所有主流的平台下使用，包括windows/iphone/ipad/android/macbook。仅需2个步骤，第一下载软件，第二打开软件扫码自动配置，即可开启全新的网络体验。</p>
                            <a href="#" class="btn btn-custom btn-lg" target="_blank">使用教程</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="restaurant-menu">
            <div class="section-title text-center center">
                <div class="overlay">
                    <h2>软件下载</h2>
                    <hr>
                    <p>请在下方根据自身的设备类型，选择合适的软件下载</p>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="menu-section">
                            <h2 class="menu-section-title"><i class="fa fa-windows"></i> Windows</h2>
                            <hr>
                            <div class="menu-item">
                                <div class="menu-item-name"> SS for Windows </div>
                                <div class="menu-item-price"><a href="http://160.16.231.71/ss-3.4.3.zip" class="btn btn-custom btn-lg" target="_blank">SS 3.4.3</a></div>
                                <div class="menu-item-description"> 支持Windows全系列，部分windows(winxp)需要安装<a href="https://www.microsoft.com/en-us/download/details.aspx?id=53344"
                                        target="_blank">.NET</a>框架. </div>
                            </div>
                            <div class="menu-item">
                                <div class="menu-item-name"> SSR for Windows </div>
                                <div class="menu-item-price"> <a href="http://160.16.231.71/ssr-4.1.4-win.7z" class="btn btn-custom btn-lg" target="_blank">SSR 4.1.4</a>                                    </div>
                                <div class="menu-item-description"> 支持Windows全系列，部分windows(winxp)需要安装<a href="https://www.microsoft.com/en-us/download/details.aspx?id=53344"
                                        target="_blank">.NET</a>框架. </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="menu-section">
                            <h2 class="menu-section-title"><i class="fa fa-apple"></i> iPhone/iPad</h2>
                            <hr>
                            <div class="menu-item">
                                <div class="menu-item-name"> Shadowrocket(¥18) </div>
                                <div class="menu-item-price"><a href="http://dwz.cn/3BvX4t" class="btn btn-custom btn-lg" target="_blank">AppStore</a></div>
                                <div class="menu-item-description"> 无需越狱. 需要iOS9.0以上. 支持SS和SSR配置.</div>
                            </div>
                            <div class="menu-item">
                                <div class="menu-item-name"> Wingy(免费) </div>
                                <div class="menu-item-price"><a href="http://dwz.cn/5vCPvz" class="btn btn-custom btn-lg" target="_blank">AppStore</a></div>
                                <div class="menu-item-description"> 无需越狱. 需要iOS9.0以上. 支持SS和SSR配置.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="menu-section">
                            <h2 class="menu-section-title"><i class="fa fa-android"></i> Android</h2>
                            <hr>
                            <div class="menu-item">
                                <div class="menu-item-name"> SS for Andoird </div>
                                <div class="menu-item-price"><a href="http://160.16.231.71/ss-nightly-4.1.3.apk" class="btn btn-custom btn-lg" target="_blank">SS V4.1.3</a></div>
                                <div class="menu-item-description"> 无需ROOT，仅支持SS，官方版本. 更多版本请点击<a href="http://dwz.cn/sk7E1" target="_blank">这里</a>.</div>
                            </div>
                            <div class="menu-item">
                                <div class="menu-item-name"> SSR for Android </div>
                                <div class="menu-item-price"><a href="http://160.16.231.71/ssr-3.3.5.apk" class="btn btn-custom btn-lg" target="_blank">SSR V3.3.5</a></div>
                                <div class="menu-item-description"> 无需ROOT. 支持SS和SSR </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="menu-section">
                            <h2 class="menu-section-title"><i class="fa fa-laptop"></i> Macbook</h2>
                            <hr>
                            <div class="menu-item">
                                <div class="menu-item-name"> SS for OSX </div>
                                <div class="menu-item-price"><a href="http://160.16.231.71/ssx-2.6.3.dmg" class="btn btn-custom btn-lg" target="_blank">SSX V2.6.3</a></div>
                                <div class="menu-item-description"> 最后更新2015年3月6日，对SS来说，足够了. </div>
                            </div>
                            <div class="menu-item">
                                <div class="menu-item-name"> SSR for OSX </div>
                                <div class="menu-item-price"><a href="http://160.16.231.71/SSX-NG-R8.dmg" class="btn btn-custom btn-lg" target="_blank">SSR-NG-R8</a></div>
                                <div class="menu-item-description"> 非官方开发. 支持SS和SSR. <a href="http://dwz.cn/5yrkGs" target="_blank">项目地址</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="footer">
            <div class="container text-center">
                <div class="col-md-6">
                    <h3>使用须知</h3>
                    <div class="contact-item">
                        <p>本站提供SS仅供学习交流和实验用途</p>
                        <p>请遵守国家法律，否则后果自负</p>
                        <p>服务器已禁止Spam、BT下载以及绝大多数非法网站和非法信息</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>找回地址</h3>
                    <div class="contact-item">
                        <p>编辑任意邮件发送至下面的邮箱，将会自动回复最新地址.</p>
                        <p>Email: Losgif@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        mounted () {
            var that = this;
            axios.get("/isLogin").then(function (rsp) {
                if (rsp.data.status_code == 500) {
                    that.$store.state.list = that.$store.state.unloginList
                } else {
                    that.$store.state.list = that.$store.state.loginedList
                }
            });
        }
    }

</script>